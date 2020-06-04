<?php
namespace common\models\shop;

/**
 * Class Product
 * @package common\models\shop
 * @property int $id [int(10)]
 * @property string $title [varchar(32)]
 */
class Measure extends \common\components\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%measures}}';
    }
}
