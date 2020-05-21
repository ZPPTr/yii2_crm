<?php

namespace backend\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\QuestResult;

/**
 * QuestResultSearch represents the model behind the search form about `common\models\QuestResult`.
 */
class QuestResultSearch extends QuestResult
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['quest_pack_id', 'user_id', 'created_at', 'updated_at', 'interviewer_id'], 'integer'],
            [['body'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = QuestResult::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'quest_pack_id' => $this->quest_pack_id,
            'user_id' => $this->user_id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'interviewer_id' => $this->interviewer_id,
        ]);

        $query->andFilterWhere(['like', 'body', $this->body]);

        return $dataProvider;
    }
}
