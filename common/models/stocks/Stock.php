<?php
namespace common\models\stocks;

use common\models\Users;
use yii\data\ActiveDataProvider;
use yii\db\ActiveQuery;

/**
 * Class Stock
 * @package common\models\stocks
 *
 * @var StockItems[] $items
 */
class Stock extends Users
{
    /**
     * @return ActiveQuery
     */
    public function getStock()
    {
        return $this->hasOne(Agents::className(), ['id' => 'agent_id']);
    }

    /**
     * @return ActiveQuery
     */
    public function getItems()
    {
        return $this->hasMany(StockItems::className(), ['user_id' => 'id'])
            ->joinWith('product')
            ->orderBy(['products.category_id' => SORT_ASC, 'products.sorting' => SORT_DESC]);
    }


    /**
     * Creates data provider instance with search query applied
     * @param array $params
     * @return ActiveDataProvider
     */
    public function search($params = [])
    {
        $query = self::find()->where(['is_sklad' => 1]);

        return new ActiveDataProvider([
            'query' => $query,
        ]);
    }

}
