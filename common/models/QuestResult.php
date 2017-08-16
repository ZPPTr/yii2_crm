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
            [['quest_pack_id', 'user_id', 'created_at'], 'integer'],
            [['body'], 'string'],
			[['created_at'], 'default', 'value' => function () {
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
            'quest_pack_id' => Yii::t('common', 'Quest Pack ID'),
            'user_id' => Yii::t('common', 'User ID'),
            'created_at' => Yii::t('common', 'Created At'),
            'body' => Yii::t('common', 'Body'),
        ];
    }

	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getQuest()
	{
		return $this->hasOne(QuestPack::className(), ['id' => 'quest_pack_id']);
	}
}
