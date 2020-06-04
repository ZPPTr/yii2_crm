<?php
namespace common\models\stocks;

use common\components\ActiveRecord;
use common\models\shop\Product;
use yii\db\ActiveQuery;

/**
 * Class StockItems
 * @package common\models\stocks
 * @property int $id [int(10)]
 * @property int $user_id [int(10)]
 * @property int $product_id [int(10)]
 * @property int $variant_id [int(10)]
 * @property int $count [smallint(6)]
 */
class StockItems extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%users_sklad}}';
    }

    /**
     * @return ActiveQuery
     */
    public function getProduct()
    {
        return $this->hasOne(Product::className(), ['id' => 'product_id']);
    }
}
