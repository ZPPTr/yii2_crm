<?php
namespace common\models;

use common\components\ActiveRecord;

/**
 * Class Finances
 * @package common\models
 * @property int $id [int(10)]
 * @property int $user_id [int(10)]
 * @property int $from_user_id [int(10)]
 * @property string $amount [decimal(14,2)]
 * @property string $comment [varchar(255)]
 * @property string $date_time [datetime]
 * @property bool $mode [tinyint(1)]
 * @property bool $kind [tinyint(2)]
 * @property int $order_id [int(10)]
 */
class Finances extends ActiveRecord
{
    const MODE_MANUAL_CHARGE_TO_COMPANY = 1;
    const MODE_AUTO_CHARGE_BY_ORDER = 2;
    const MODE_MANUAL_CHARGE_FROM_COMPANY = 3;
    const MODE_CHARGE_STOCK_BALANCE_BY_ORDER = 4;
    const MODES = [
        self::MODE_MANUAL_CHARGE_TO_COMPANY,
        self::MODE_AUTO_CHARGE_BY_ORDER,
        self::MODE_MANUAL_CHARGE_FROM_COMPANY,
        self::MODE_CHARGE_STOCK_BALANCE_BY_ORDER
    ];

    const KIND_INCREASE = 0;
    const KIND_DECREASE = 1;

    public function rules()
    {
        return [
            [['user_id', 'amount', 'comment', 'date_time', 'mode', 'kind'], 'required'],
            [['user_id', 'from_user_id', 'mode', 'kind'], 'integer'],
            [['comment'], 'string'],
            [['user_id', 'from_user_id'], 'exist', 'targetClass' => Users::className(), 'targetAttribute' => 'id'],
            ['mode', 'in', 'range' => self::MODES],
            ['kind', 'in', 'range' => [self::KIND_INCREASE, self::KIND_DECREASE]],
            ['date_time', 'default', 'value' => date('Y-m-d H:i:s')]
        ];
    }
}
