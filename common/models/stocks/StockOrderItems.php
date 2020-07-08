<?php

namespace common\models\stocks;

use common\models\shop\Product;
use common\models\shop\ProductVariants;
use Yii;
use yii\db\ActiveQuery;

/**
 * This is the model class for table "{{%stock_order_items}}".
 *
 * @property int $id
 * @property int $order_id
 * @property int $product_id
 * @property int $quantity
 * @property double $price
 * @property float $to_coefficient
 * @property string $variant_id
 *
 * @property Product $product
 * @property StockOrder $order
 */
class StockOrderItems extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['order_id', 'product_id', 'quantity', 'price'], 'required'],
            [['order_id', 'product_id', 'variant_id', 'quantity'], 'integer'],
            ['product_id', 'exist', 'targetClass' => Product::className(), 'targetAttribute' => 'id'],
            ['variant_id', 'exist', 'targetClass' => ProductVariants::className(), 'targetAttribute' => 'id'],
            [['price'], 'number'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'order_id' => 'Order ID',
            'product_id' => 'Product ID',
            'quantity' => 'Quantity',
            'price' => 'Price',
            'variant_id' => 'Variant ID',
        ];
    }

    /**
     * @return ActiveQuery
     */
    public function getProduct()
    {
        return $this->hasOne(Product::className(), ['id' => 'product_id']);
    }

    /**
     * @return ActiveQuery
     */
    public function getOrder()
    {
        return $this->hasOne(StockOrder::className(), ['id' => 'order_id'])->inverseOf('orderItems');
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
     * @return string
     */
    public function getMeasureText()
    {
        /** @var ProductVariants $variant */
        $variant = $this->product->getVariant($this->variant_id);
        return $variant ? $variant->measure_value.' ('. $variant->measure->title.'.)' : '';
    }
}
