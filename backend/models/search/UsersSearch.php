<?php

namespace backend\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Users;

/**
 * UsersSearch represents the model behind the search form about `common\models\Users`.
 */
class UsersSearch extends Users
{
	public $fullName;


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'is_moderator', 'manager_id', 'country_id', 'city_id', 'mod_status', 'is_active', 'group_id', 'user_type', 'is_valid', 'is_handle', 'is_fop', 'is_potential_rank', 'am_coffee_machines', 'confirm_rule', 'is_valid_machine', 'is_valid_card', 'is_sklad', 'is_auto_pay', 'stock_auto_pay', 'agent_id'], 'integer'],
            [['number', 'name', 'surname', 'fullName', 'patronymic', 'email', 'phone', 'city', 'address', 'address_cor', 'passport', 'passport_data', 'idnum', 'photo', 'photo_thumb', 'date_time', 'prolongation_at', 'ranking_at', 'controlled_at', 'mod_comment', 'password', 'salt', 'vk', 'fb', 'skype', 'bank_card', 'bank_name', 'rr', 'edrpou', 'mfo'], 'safe'],
            [['balance', 'bonus_balance', 'stock_balance', 'am_free_coffee'], 'number'],
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
        $query = Users::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'is_moderator' => $this->is_moderator,
            'manager_id' => $this->manager_id,
            'country_id' => $this->country_id,
            'city_id' => $this->city_id,
            'date_time' => $this->date_time,
            'prolongation_at' => $this->prolongation_at,
            'ranking_at' => $this->ranking_at,
            'controlled_at' => $this->controlled_at,
            'mod_status' => $this->mod_status,
            'is_active' => $this->is_active,
            'group_id' => $this->group_id,
            'user_type' => $this->user_type,
            'is_valid' => $this->is_valid,
            'is_handle' => $this->is_handle,
            'balance' => $this->balance,
            'bonus_balance' => $this->bonus_balance,
            'stock_balance' => $this->stock_balance,
            'is_fop' => $this->is_fop,
            'is_potential_rank' => $this->is_potential_rank,
            'am_coffee_machines' => $this->am_coffee_machines,
            'am_free_coffee' => $this->am_free_coffee,
            'confirm_rule' => $this->confirm_rule,
            'is_valid_machine' => $this->is_valid_machine,
            'is_valid_card' => $this->is_valid_card,
            'is_sklad' => $this->is_sklad,
            'is_auto_pay' => $this->is_auto_pay,
            'stock_auto_pay' => $this->stock_auto_pay,
            'agent_id' => $this->agent_id,
        ]);

        $query->andFilterWhere(['like', 'number', $this->number])
            ->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'surname', $this->surname])
            ->andFilterWhere(['like', 'patronymic', $this->patronymic])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'phone', $this->phone])
            ->andFilterWhere(['like', 'city', $this->city])
            ->andFilterWhere(['like', 'address', $this->address])
            ->andFilterWhere(['like', 'address_cor', $this->address_cor])
            ->andFilterWhere(['like', 'passport', $this->passport])
            ->andFilterWhere(['like', 'passport_data', $this->passport_data])
            ->andFilterWhere(['like', 'idnum', $this->idnum])
            ->andFilterWhere(['like', 'photo', $this->photo])
            ->andFilterWhere(['like', 'photo_thumb', $this->photo_thumb])
            ->andFilterWhere(['like', 'mod_comment', $this->mod_comment])
            ->andFilterWhere(['like', 'password', $this->password])
            ->andFilterWhere(['like', 'salt', $this->salt])
            ->andFilterWhere(['like', 'vk', $this->vk])
            ->andFilterWhere(['like', 'fb', $this->fb])
            ->andFilterWhere(['like', 'skype', $this->skype])
            ->andFilterWhere(['like', 'bank_card', $this->bank_card])
            ->andFilterWhere(['like', 'bank_name', $this->bank_name])
            ->andFilterWhere(['like', 'rr', $this->rr])
            ->andFilterWhere(['like', 'edrpou', $this->edrpou])
            ->andFilterWhere(['like', 'mfo', $this->mfo]);

        return $dataProvider;
    }
}
