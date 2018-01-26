<?php

namespace common\models;

use common\components\ActiveRecord;
use common\models\query\UsersQuery;
use Yii;


/**
 * This is the model class for table "users".
 *
 * @property string $id
 * @property integer $is_moderator
 * @property string $number
 * @property integer $manager_id
 * @property string $name
 * @property string $surname
 * @property string $patronymic
 * @property string $email
 * @property string $phone
 * @property integer $country_id
 * @property integer $city_id
 * @property string $city
 * @property string $address
 * @property string $address_cor
 * @property string $passport
 * @property string $passport_data
 * @property string $idnum
 * @property string $photo
 * @property string $photo_thumb
 * @property string $date_time
 * @property string $prolongation_at
 * @property string $ranking_at
 * @property string $controlled_at
 * @property integer $mod_status
 * @property string $mod_comment
 * @property string $password
 * @property string $salt
 * @property integer $is_active
 * @property integer $group_id
 * @property integer $user_type
 * @property integer $is_valid
 * @property string $vk
 * @property string $fb
 * @property string $skype
 * @property integer $is_handle
 * @property string $balance
 * @property string $bonus_balance
 * @property string $stock_balance
 * @property string $bank_card
 * @property string $bank_name
 * @property integer $is_fop
 * @property string $rr
 * @property string $edrpou
 * @property string $mfo
 * @property integer $is_potential_rank
 * @property integer $am_coffee_machines
 * @property double $am_free_coffee
 * @property integer $confirm_rule
 * @property integer $is_valid_machine
 * @property integer $is_valid_card
 * @property integer $is_sklad
 * @property integer $is_auto_pay
 * @property integer $stock_auto_pay
 * @property integer $agent_id
 */
class Users extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'users';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
        	[['city', 'email', 'phone'], 'required'],
			['email', 'email'],
//            [['is_moderator', 'manager_id', 'country_id', 'city_id', 'mod_status', 'is_active', 'group_id', 'user_type', 'is_valid', 'is_handle', 'is_fop', 'is_potential_rank', 'am_coffee_machines', 'confirm_rule', 'is_valid_machine', 'is_valid_card', 'is_sklad', 'is_auto_pay', 'stock_auto_pay', 'agent_id'], 'integer'],
//            [['number', 'manager_id', 'name', 'surname', 'patronymic', 'phone', 'country_id', 'city_id', 'city', 'address', 'address_cor', 'passport', 'passport_data', 'idnum', 'photo', 'photo_thumb', 'prolongation_at', 'ranking_at', 'controlled_at', 'mod_comment', 'salt', 'vk', 'fb', 'skype', 'bank_card', 'bank_name', 'rr', 'edrpou', 'mfo'], 'required'],
//            [['date_time', 'prolongation_at', 'ranking_at', 'controlled_at'], 'safe'],
//            [['balance', 'bonus_balance', 'stock_balance', 'am_free_coffee'], 'number'],
//            [['number', 'name', 'surname', 'patronymic', 'phone', 'passport', 'idnum', 'password', 'salt', 'bank_card', 'bank_name'], 'string', 'max' => 32],
//            [['email', 'city', 'photo', 'photo_thumb', 'vk', 'fb', 'skype', 'rr', 'edrpou', 'mfo'], 'string', 'max' => 64],
//            [['address', 'address_cor'], 'string', 'max' => 128],
            [['address'], 'string', 'max' => 256],
            [['city', 'phone', 'patronymic'], 'string', 'max' => 64],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('backend', 'ID'),
            'is_moderator' => Yii::t('backend', 'Является ли модератором'),
            'number' => Yii::t('backend', 'Номер карты'),
            'manager_id' => Yii::t('backend', 'ID менеджера'),
            'name' => Yii::t('backend', 'Имя'),
            'surname' => Yii::t('backend', 'Фамилия'),
            'patronymic' => Yii::t('backend', 'Отчество'),
            'email' => Yii::t('backend', 'E-mail'),
            'phone' => Yii::t('backend', 'Телефон'),
            'country_id' => Yii::t('backend', 'Страна'),
            'city_id' => Yii::t('backend', 'Город'),
            'city' => Yii::t('backend', 'Город'),
            'address' => Yii::t('backend', 'Адрес'),
            'address_cor' => Yii::t('backend', 'Координаты адреса'),
            'photo' => Yii::t('backend', 'Фото'),
            'photo_thumb' => Yii::t('backend', 'Миниатюра фото (200х200)'),
            'date_time' => Yii::t('backend', 'Дата регистрации'),
            'prolongation_at' => Yii::t('backend', 'Дата пролонгации'),
            'ranking_at' => Yii::t('backend', 'Дата смены ранга'),
            'controlled_at' => Yii::t('backend', 'Controlled At'),
            'mod_status' => Yii::t('backend', 'Mod Status'),
            'mod_comment' => Yii::t('backend', 'Mod Comment'),
            'password' => Yii::t('backend', 'Password'),
            'salt' => Yii::t('backend', 'Salt'),
            'is_active' => Yii::t('backend', 'Is Active'),
            'group_id' => Yii::t('backend', 'Group ID'),
            'user_type' => Yii::t('backend', 'User Type'),
            'is_valid' => Yii::t('backend', 'Is Valid'),
            'vk' => Yii::t('backend', 'Vk'),
            'fb' => Yii::t('backend', 'Fb'),
            'skype' => Yii::t('backend', 'Skype'),
            'is_handle' => Yii::t('backend', 'Is Handle'),
            'balance' => Yii::t('backend', 'Balance'),
            'bonus_balance' => Yii::t('backend', 'Bonus Balance'),
            'stock_balance' => Yii::t('backend', 'Stock Balance'),
            'bank_card' => Yii::t('backend', 'Bank Card'),
            'bank_name' => Yii::t('backend', 'Bank Name'),
            'is_fop' => Yii::t('backend', 'Is Fop'),
            'rr' => Yii::t('backend', 'Rr'),
            'edrpou' => Yii::t('backend', 'Edrpou'),
            'mfo' => Yii::t('backend', 'Mfo'),
            'is_potential_rank' => Yii::t('backend', 'Is Potential Rank'),
            'am_coffee_machines' => Yii::t('backend', 'Am Coffee Machines'),
            'am_free_coffee' => Yii::t('backend', 'Am Free Coffee'),
            'confirm_rule' => Yii::t('backend', 'Confirm Rule'),
            'is_valid_machine' => Yii::t('backend', 'Is Valid Machine'),
            'is_valid_card' => Yii::t('backend', 'Is Valid Card'),
            'is_sklad' => Yii::t('backend', 'Is Sklad'),
            'is_auto_pay' => Yii::t('backend', 'Is Auto Pay'),
            'stock_auto_pay' => Yii::t('backend', 'Stock Auto Pay'),
            'agent_id' => Yii::t('backend', 'Agent ID'),
        ];
    }

    /**
     * @inheritdoc
     * @return UsersQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new UsersQuery(get_called_class());
    }

	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getUserOrders()
	{
		return $this->hasMany(Orders::className(), ['user_id' => 'id'])
			->where('is_certificate = 0')
			->orderBy('end_time DESC');
	}

	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getUserQuests()
	{
		return $this->hasMany(QuestResult::className(), ['user_id' => 'id']);
	}

	public function getFullName()
	{
		return $this->name . ' ' . $this->surname;
	}
}
