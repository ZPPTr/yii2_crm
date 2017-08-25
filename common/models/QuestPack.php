<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%quest_pack}}".
 *
 * @property integer $id
 * @property integer $parent_id
 * @property string $title
 * @property string $description
 */
class QuestPack extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%quest_pack}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title'], 'required'],
            [['description'], 'string'],
            [['title'], 'string', 'max' => 512],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('common', 'ID'),
            'title' => Yii::t('common', 'Title'),
            'description' => Yii::t('common', 'Description'),
        ];
    }

	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getQuestions()
	{
		return $this->hasMany(Question::className(), ['quest_pack_id' => 'id'])->orderBy('sorting');
	}

	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getQuestResults()
	{
		return $this->hasMany(QuestResult::className(), ['quest_pack_id' => 'id'])->orderBy('created_at');
	}
}
