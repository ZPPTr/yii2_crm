<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%quest_history}}".
 *
 * @property integer $user_id
 * @property integer $question_id
 * @property integer $answer_id
 */
class QuestHistory extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%quest_history}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'question_id'], 'required'],
            [['user_id', 'question_id', 'answer_id'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'user_id' => Yii::t('common', 'User ID'),
            'question_id' => Yii::t('common', 'Question ID'),
            'answer_id' => Yii::t('common', 'Answer ID'),
        ];
    }
}
