<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%question}}".
 *
 * @property integer $id
 * @property integer $quest_pack_id
 * @property string $title
 * @property string $description
 * @property integer $sorting
 * @property integer $parent_answer_id
 *
 * @property Answer[] $answers
 */
class Question extends \yii\db\ActiveRecord
{

	public $checkApplied;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%question}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['quest_pack_id', 'sorting', 'parent_answer_id'], 'integer'],
            [['title', 'quest_pack_id'], 'required'],
            [['title', 'description'], 'string'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('common', 'ID'),
            'quest_pack_id' => Yii::t('common', 'Quest Pack ID'),
            'title' => Yii::t('common', 'Title'),
            'description' => Yii::t('common', 'Description'),
            'sorting' => Yii::t('common', 'Sorting'),
            'parent_answer_id' => Yii::t('common', 'Parent Answer ID'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAnswers()
    {
        return $this->hasMany(Answer::className(), ['question_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function checkApplied($user_id)
    {
		$item_history = Yii::$app->db->createCommand("SELECT * FROM quest_history WHERE user_id = $user_id AND question_id = $this->id")->queryOne();

		$this->checkApplied = !empty($item_history);

		return !empty($item_history);
    }
}
