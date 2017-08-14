<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "order_items".
 *
 * @property string $id
 * @property string $order_id
 * @property string $product_id
 * @property string $product_name
 * @property integer $quantity
 * @property string $price_per_one
 * @property string $total_price
 * @property integer $discount
 * @property string $additionals
 * @property string $url
 * @property integer $kind
 * @property integer $variant_id
 */
class OrderItems extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'order_items';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['order_id', 'product_id', 'quantity', 'discount', 'kind', 'variant_id'], 'integer'],
            [['price_per_one', 'total_price'], 'number'],
            [['discount', 'kind'], 'required'],
            [['product_name'], 'string', 'max' => 150],
            [['additionals', 'url'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('common', 'ID'),
            'order_id' => Yii::t('common', 'Order ID'),
            'product_id' => Yii::t('common', 'Product ID'),
            'product_name' => Yii::t('common', 'Product Name'),
            'quantity' => Yii::t('common', 'Quantity'),
            'price_per_one' => Yii::t('common', 'Price Per One'),
            'total_price' => Yii::t('common', 'Total Price'),
            'discount' => Yii::t('common', 'Discount'),
            'additionals' => Yii::t('common', 'Additionals'),
            'url' => Yii::t('common', 'Url'),
            'kind' => Yii::t('common', 'Kind'),
            'variant_id' => Yii::t('common', 'Variant ID'),
        ];
    }

    /**
     * @inheritdoc
     * @return \common\models\query\OrderItemsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\OrderItemsQuery(get_called_class());
    }
}
