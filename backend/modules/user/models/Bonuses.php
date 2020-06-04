<?php
namespace backend\modules\user\models;

use common\models\Finances;
use common\models\finances\DecreasedBalance;
use common\models\Users;
use Yii;
use yii\base\Model;
use yii\db\Exception;
use yii\web\BadRequestHttpException;

class Bonuses extends Model
{
    const COLUMN_NAME = 0;
    const COLUMN_CARD = 1;
    const COLUMN_BALANCE = 4;
    const COLUMN_PAY = 5;

    /**
     * @var date('Ym')
     */
    private $actualPeriod;

    /**
     * @var Finances[]
     */
    private $finances = [];

    /**
     * @var DecreasedBalance[]
     */
    private $users = [];

    public function init()
    {
        $this->actualPeriod = date('Ym', strtotime('- 5 weeks'));
        parent::init();
    }

    /**
     *
     */
    public function exportBonuses() {
        $columns = ['UserId', 'FullName', 'CardNumber', 'AutoPay', 'Stock', 'Balance'];
        $data[] = $columns;

        $models = Users::find()
            ->where(['>=', 'balance', 50])
            ->with('agent')
            ->all();

        foreach ($models as $model) {
            $data[] = [
                $model->id,
                $model->fullName,
                $model->number,
                $model->is_auto_pay ? 'да' : 'нет',
                $model->agent->city.', '.$model->agent->address,
                $model->balance];
        }

        $this->downloadSendHeaders("data_export_" . date("Y-m-d") . ".csv");
        echo $this->array2csv($data);
        die();

    }

    public function array2csv(array &$array)
    {
        if (count($array) == 0) {
            return null;
        }
        ob_start();
        $df = fopen("php://output", 'w');
        fputcsv($df, array_keys(reset($array)));
        foreach ($array as $row) {
            fputcsv($df, $row);
        }
        fclose($df);
        return ob_get_clean();
    }

    private function downloadSendHeaders($filename) {
        // disable caching
        $now = gmdate("D, d M Y H:i:s");
        header("Expires: Tue, 03 Jul 2001 06:00:00 GMT");
        header("Cache-Control: max-age=0, no-cache, must-revalidate, proxy-revalidate");
        header("Last-Modified: {$now} GMT");

        // force download
        header("Content-Type: application/force-download");
        header("Content-Type: application/octet-stream");
        header("Content-Type: application/download");

        // disposition / encoding on response body
        header("Content-Disposition: attachment;filename={$filename}");
        header("Content-Transfer-Encoding: binary");
    }

    /**
     * @return boolean
     * @throws Exception
     */
    public function chargeBonuses()
    {
        $users = DecreasedBalance::findAll(['ym' => $this->actualPeriod, 'status' => DecreasedBalance::STATUS_DRAFT]);

        $transaction = Yii::$app->db->beginTransaction();
        foreach ($users as $user) {
            $this->collectFinances($user->user_id, $user->amount);
            if (!$this->decreaseBalance($user->user_id, $user->amount)) {
                $transaction->rollBack();
                throw new Exception('Could not decrease balance for user ' . $user->user_id);
            } else {
                $user->status = DecreasedBalance::STATUS_APPROVED;
                $user->save(false);
            }
        }
        if (!$this->saveFinancesData()) {
            $transaction->rollBack();
            throw new Exception('Could not save finances info');
        }
        $transaction->commit();
        return true;
    }

    /**
     * @throws BadRequestHttpException
     * @throws Exception
     */
    public function importBonuses()
    {
        $pathToFile = Yii::getAlias('@backend') . '/web/import-files/'.$this->actualPeriod.'.csv';

        if (!file_exists($pathToFile) || !is_readable($pathToFile)) {
            throw new BadRequestHttpException('Can\'t to find the file or the pointed file is not readable');
        }


        if (($handle = fopen($pathToFile, 'r')) !== false) {
            $i = 0;
            while (($row = fgetcsv($handle, 1000, ',')) !== false) {
                if ($i > 0) {
                    $user = Users::findOne(['number' => $this->generateCardNumber($row[self::COLUMN_CARD])]);
                    $this->collectUsers($user->id, $row);
                }
                $i++;
            }
            fclose($handle);

            $this->saveCollectedUsers();
        }
    }

    /**
     * @param $userId
     * @param $amount
     * @return int
     * @throws Exception
     */
    private function decreaseBalance($userId, $amount)
    {
        return Yii::$app->db->createCommand('UPDATE users SET balance = balance - :amount WHERE id = :userId', [
            'amount' => $amount,
            'userId' => $userId,
        ])->execute();
    }

    /**
     * @param $cardNumber
     * @return string
     */
    private function generateCardNumber($cardNumber)
    {
        $numberLength = 7;
        $diff = $numberLength - strlen((string) $cardNumber);

        $prefix = '';
        for ($i = 0; $i < $diff; $i++) {
            $prefix .= '0';
        }

        return $prefix.$cardNumber;
    }

    /**
     * @return string
     */
    private function getMessage()
    {
        return 'Списание бонусов за ' . date('m.Y', strtotime('- 5 weeks'));
    }

    /**
     * @param $userId
     * @param $amount
     */
    private function collectFinances($userId, $amount)
    {
        $this->finances[] = [
            'user_id' => $userId,
            'from_user_id' => 1,
            'amount' => $amount,
            'comment' => $this->getMessage(),
            'mode' => Finances::MODE_MANUAL_CHARGE_FROM_COMPANY,
            'kind' => Finances::KIND_DECREASE,
            'date_time' => date('Y-m-d H:i:s')
        ];
    }

    private function saveFinancesData()
    {
        $financeAttributes = ['user_id', 'from_user_id', 'amount', 'comment', 'mode', 'kind', 'date_time'];
        return Yii::$app->db->createCommand()->batchInsert(Finances::tableName(), $financeAttributes, $this->finances)->execute();
    }

    /**
     * @param $userId
     * @param $row
     */
    private function collectUsers($userId, $row)
    {
        $this->users[] = [
            'user_id' => $userId,
            'ym' => (int) $this->actualPeriod,
            'amount' => (float) $row[self::COLUMN_PAY],
            'status' => $row[self::COLUMN_PAY] != $row[self::COLUMN_BALANCE] ? DecreasedBalance::STATUS_WARNING : DecreasedBalance::STATUS_DRAFT,
        ];
    }

    /**
     * @throws Exception
     */
    private function saveCollectedUsers()
    {
        $decreasedBalanceAttributes = ['user_id', 'ym', 'amount', 'status'];
        Yii::$app->db->createCommand()->batchInsert(DecreasedBalance::tableName(), $decreasedBalanceAttributes, $this->users)->execute();
    }
}
