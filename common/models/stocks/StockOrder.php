<?php

namespace common\models\stocks;

use Cassandra\Exception\ValidationException;
use common\models\Article;
use common\models\shop\Product;
use common\models\Users;
use Yii;
use yii\base\InvalidConfigException;
use yii\data\ActiveDataProvider;
use yii\db\ActiveQuery;
use yii\web\NotFoundHttpException;

/**
 * This is the model class for table "{{%stock_order}}".
 *
 * @property int $id
 * @property int $user_id
 * @property int $delivery
 * @property int $pay_way
 * @property double $total_sum
 * @property int $status
 * @property string $address
 * @property string $comment
 * @property int $country_id
 * @property string $created_at
 * @property string $completed_at
 *
 * @property Users $agent
 * @property StockOrderItems[] $orderItems
 */
class StockOrder extends \yii\db\ActiveRecord
{
    const ORDER_STATUS_ON_HOLD = 0;
    const ORDER_STATUS_PAID_ONLY = 1;
    const ORDER_STATUS_SENT_ONLY = 4;
    const ORDER_STATUS_COMPLETED = 2;
    const ORDER_STATUS_REVERTED = 3;
    const ORDER_STATUSES = [self::ORDER_STATUS_ON_HOLD, self::ORDER_STATUS_PAID_ONLY, self::ORDER_STATUS_SENT_ONLY, self::ORDER_STATUS_COMPLETED, self::ORDER_STATUS_REVERTED];

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'delivery', 'pay_way', 'total_sum', 'status', 'country_id', 'created_at'], 'required'],
            [['user_id', 'delivery', 'pay_way', 'status', 'country_id'], 'integer'],
            ['user_id', 'exist', 'targetClass' => Users::className(), 'targetAttribute' => 'id'],
            ['status', 'in', 'range' => self::ORDER_STATUSES],
            [['total_sum'], 'number'],
            [['created_at', 'completed_at'], 'date'],
            [['address', 'comment'], 'string', 'max' => 512],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'delivery' => 'Delivery',
            'pay_way' => 'Pay Way',
            'total_sum' => 'Total Sum',
            'status' => 'Status',
            'address' => 'Address',
            'comment' => 'Comment',
            'country_id' => 'Country ID',
            'created_at' => 'Created At',
            'completed_at' => 'Completed At',
        ];
    }

    /**
     * @return ActiveQuery
     */
    public function getOrderItems()
    {
        return $this->hasMany(StockOrderItems::className(), ['order_id' => 'id']);
    }

    /**
     * @return ActiveQuery
     */
    public function getAgent()
    {
        return $this->hasOne(Users::className(), ['id' => 'user_id']);
    }

    /**
     * @return float|int
     */
    public function getTotalSum()
    {
        $items = $this->getOrderItems()->select(['price', 'quantity'])->all();
        $total = 0;

        foreach ($items as $item) {
            $total += $item['price'] * $item['quantity'];
        }

        return $total;

    }

    /**
     * @return float|int
     */
    public function getTotalTo()
    {
        $items = $this->getOrderItems()->select(['price', 'quantity', 'to_coefficient'])->all();
        $total = 0;

        foreach ($items as $item) {
            $total += round($item['price'] * $item['quantity'] / 100 * $item['to_coefficient'], 2);
        }

        return $total;

    }

    /**
     * @inheritdoc
     * @return StockOrderQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new StockOrderQuery(get_called_class());
    }

    /**
     * Creates data provider instance with search query applied
     * @param $params
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = static::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'status' => $this->status,
            'created_at' => $this->created_at,
        ]);

        return $dataProvider;
    }

    /**
     * @param $request
     * @return StockOrder
     * @throws InvalidConfigException
     * @throws NotFoundHttpException
     */
    public function addItem($request)
    {
        $ids = explode('|', $request['product_id']);
        if (!$product = Product::findOne($ids['0'])) {
            throw new NotFoundHttpException('The requested product does not exist.');
        }
        $variantId = isset($ids[1]) ? $ids[1] : null;

        $orderItem = Yii::createObject([
            'class' => StockOrderItems::className(),
            'order_id' => $request['order_id'],
            'product_id' => $ids[0],
            'variant_id' => $variantId,
            'price' => $product->getStockPrice($variantId) * 26, // 26 - course of exchanging on general site
            'quantity' => $request['quantity'],
            'to_coefficient' => $product->percent_to
        ]);

        $orderItem->save();

        return $this;
    }
}
