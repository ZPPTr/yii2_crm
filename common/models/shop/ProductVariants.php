<?php
namespace common\models\shop;

use common\components\ActiveRecord;
use yii\db\ActiveQuery;

/**
 * Class Product
 * @package common\models\shop
 * @property int $id [int(10)]
 * @property string $price [decimal(14,2)]
 * @property string $price_full [decimal(14,2)]
 * @property string $price_purchase [decimal(14,2)]
 * @property int $product_id [int(10)]
 * @property bool $measure_id [tinyint(1)]
 * @property string $measure_value [varchar(32)]
 * @property bool $position [tinyint(2)]
 *
 * @property Measure $measure
 */
class ProductVariants extends ActiveRecord
{
    /**
     * @return ActiveQuery
     */
    public function getMeasure()
    {
        return $this->hasOne(Measure::className(), ['id' => 'measure_id']);
    }
}
