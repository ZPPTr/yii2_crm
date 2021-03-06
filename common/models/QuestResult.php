<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "{{%quest_result}}".
 *
 * @property integer $quest_pack_id
 * @property integer $user_id
 * @property integer $created_at
 * @property string $body
 */
class QuestResult extends \yii\db\ActiveRecord
{
	const RESULT_NONE = 0;
	const RESULT_CALLED = 1;
	const RESULT_DELAY = 2;
	/**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%quest_result}}';
    }

	/**
	 * @inheritdoc
	 */
	public function behaviors()
	{
		return [
			TimestampBehavior::className(),
		];
	}

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['quest_pack_id', 'user_id'], 'required'],
            [['quest_pack_id', 'user_id', 'result'], 'integer'],
			[['delay_to'], 'filter', 'filter' => 'strtotime', 'skipOnEmpty' => false],
            [['body', 'common_comment'], 'string'],
			[['created_at', 'delay_to'], 'default', 'value' => function () {
				return date(DATE_ISO8601);
			}],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'quest_pack_id' => Yii::t('common', 'Название Квеста'),
            'user_id' => Yii::t('common', 'Пользователь'),
            'created_at' => Yii::t('common', 'Создан'),
            'updated_at' => Yii::t('common', 'Обновлен'),
            'body' => Yii::t('common', 'Body'),
            'interviewer_id' => Yii::t('common', 'Интервьювер'),
            'common_comment' => Yii::t('common', 'Общий комментарий'),
            'result' => Yii::t('common', 'Результат'),
            'delay_to' => Yii::t('common', 'Отложен до'),
        ];
    }

	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getQuest()
	{
		return $this->hasOne(QuestPack::className(), ['id' => 'quest_pack_id']);
	}

	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getUser()
	{
		return $this->hasOne(Users::className(), ['id' => 'user_id']);
	}
}
