<?php

namespace common\models\stocks;

/**
 * This is the ActiveQuery class for [[StockOrder]].
 *
 * @see StockOrder
 */
class StockOrderQuery extends \yii\db\ActiveQuery
{
    /**
     * @inheritdoc
     * @return StockOrder[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return StockOrder|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
