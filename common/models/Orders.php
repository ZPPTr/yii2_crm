<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "orders".
 *
 * @property string $id
 * @property string $user_id
 * @property integer $sklad_id
 * @property string $fio
 * @property string $email
 * @property string $phone
 * @property string $address
 * @property integer $delivery
 * @property integer $payway
 * @property integer $discount
 * @property string $total_sum
 * @property string $supply_sum
 * @property string $club_profit_sum
 * @property string $branch_profit
 * @property string $stock_discount_sum
 * @property string $coffee_machine_profit
 * @property string $bonus_count
 * @property integer $total_quantity
 * @property integer $status
 * @property string $time_stamp
 * @property integer $end_time
 * @property string $comment
 * @property integer $admin_is_new
 * @property integer $transaction_id
 * @property integer $country_id
 * @property integer $is_action
 * @property integer $is_certificate
 * @property string $coffee_kg
 */
class Orders extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'orders';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'sklad_id', 'delivery', 'payway', 'discount', 'total_quantity', 'status', 'time_stamp', 'end_time', 'admin_is_new', 'transaction_id', 'country_id', 'is_action', 'is_certificate'], 'integer'],
            [['fio', 'email', 'phone', 'address', 'time_stamp', 'comment', 'country_id'], 'required'],
            [['total_sum', 'supply_sum', 'club_profit_sum', 'branch_profit', 'stock_discount_sum', 'coffee_machine_profit', 'bonus_count', 'coffee_kg'], 'number'],
            [['fio', 'email'], 'string', 'max' => 50],
            [['phone'], 'string', 'max' => 15],
            [['address'], 'string', 'max' => 128],
            [['comment'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('common', 'ID'),
            'user_id' => Yii::t('common', 'User ID'),
            'sklad_id' => Yii::t('common', 'Sklad ID'),
            'fio' => Yii::t('common', 'Fio'),
            'email' => Yii::t('common', 'Email'),
            'phone' => Yii::t('common', 'Phone'),
            'address' => Yii::t('common', 'Address'),
            'delivery' => Yii::t('common', 'Delivery'),
            'payway' => Yii::t('common', 'Payway'),
            'discount' => Yii::t('common', 'Discount'),
            'total_sum' => Yii::t('common', 'Total Sum'),
            'supply_sum' => Yii::t('common', 'Supply Sum'),
            'club_profit_sum' => Yii::t('common', 'Club Profit Sum'),
            'branch_profit' => Yii::t('common', 'Branch Profit'),
            'stock_discount_sum' => Yii::t('common', 'Stock Discount Sum'),
            'coffee_machine_profit' => Yii::t('common', 'Coffee Machine Profit'),
            'bonus_count' => Yii::t('common', 'Bonus Count'),
            'total_quantity' => Yii::t('common', 'Total Quantity'),
            'status' => Yii::t('common', 'Status'),
            'time_stamp' => Yii::t('common', 'Time Stamp'),
            'end_time' => Yii::t('common', 'End Time'),
            'comment' => Yii::t('common', 'Comment'),
            'admin_is_new' => Yii::t('common', 'Admin Is New'),
            'transaction_id' => Yii::t('common', 'Transaction ID'),
            'country_id' => Yii::t('common', 'Country ID'),
            'is_action' => Yii::t('common', 'Is Action'),
            'is_certificate' => Yii::t('common', 'Is Certificate'),
            'coffee_kg' => Yii::t('common', 'Coffee Kg'),
        ];
    }

    /**
     * @inheritdoc
     * @return \common\models\query\OrdersQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\OrdersQuery(get_called_class());
    }

	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getOrderItems()
	{
		return $this->hasMany(OrderItems::className(), ['order_id' => 'id']);
	}
}
