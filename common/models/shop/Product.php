<?php
namespace common\models\shop;

use yii\db\ActiveQuery;
use yii\db\ActiveRecord;
use yii\web\NotFoundHttpException;

/**
 * Class Product
 * @package common\models\shop
 * @property int $id [int(10)]
 * @property string $code [varchar(32)]
 * @property string $name [varchar(200)]
 * @property string $alias [varchar(200)]
 * @property int $category_id [smallint(6)]
 * @property int $brand_id [smallint(5) unsigned]
 * @property string $preview [varchar(512)]
 * @property string $content
 * @property string $price [decimal(14,2)]
 * @property string $price_full [decimal(14,2)]
 * @property string $price_purchase [decimal(14,2)]
 * @property bool $currency [tinyint(1)]
 * @property string $old_price [decimal(14,2)]
 * @property int $in_stock [smallint(5)]
 * @property bool $measure [tinyint(1)]
 * @property float $in_pack [float(5,2)]
 * @property bool $discount [tinyint(3)]
 * @property bool $percent_to [tinyint(3)]
 * @property bool $stock_discount [tinyint(4)]
 * @property bool $is_action [tinyint(1)]
 * @property bool $feature [tinyint(2)]
 * @property bool $status [tinyint(1)]
 * @property string $photo [varchar(80)]
 * @property string $photo_thumb [varchar(80)]
 * @property string $photo_thumb2 [varchar(80)]
 * @property int $time_create [int(10) unsigned]
 * @property bool $visible [tinyint(1) unsigned]
 * @property int $is_related_sertificat [int(2)]
 * @property int $sorting [int(3)]
 */
class Product extends \common\components\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%products}}';
    }

    /**
     * @return ActiveQuery
     */
    public function getVariants()
    {
        return $this->hasMany(ProductVariants::className(), ['product_id' => 'id']);
    }

    /**
     * @param $id
     * @return ActiveRecord|null
     */
    public function getVariant($id)
    {
        return $this->getVariants()->andOnCondition(['id' => $id])->one();
    }

    /**
     * @return array
     */
    public static function getProductsDropDown()
    {
        $productList = static::find()
            ->with('variants')
            ->orderBy(['category_id' => SORT_ASC, 'sorting' => SORT_DESC])
            ->where(['visible' => 1])
            ->all();

        $dropDownList = [];
        foreach ($productList as $product) {
            if (!empty($product->variants)) {
                foreach ($product->variants as $variant) {
                    $dropDownList[$product->id.'|'.$variant->id] = $product->name.'('.$variant->measure_value.'-'.$variant->measure->title.')';
                }
            } else {
                $dropDownList[$product->id] = $product->name;
            }
        }

        return $dropDownList;
    }

    /**
     * @param null $variantId
     * @return float
     * @throws NotFoundHttpException
     */
    public function getStockPrice($variantId = null)
    {
        if ($this->stock_discount === 100) {
            return 0;
        }

        $regularPrice = $this->price;
        if ($variantId) {
            /** @var ProductVariants $productVariant */
            $productVariant = $this->getVariant($variantId);
            if (!$productVariant) {
                throw new NotFoundHttpException('The requested product variant does not exist.');
            }
            $regularPrice = $productVariant->price;
        }

        return round($regularPrice / 100 * (100 - $this->stock_discount), 2);
    }
}
