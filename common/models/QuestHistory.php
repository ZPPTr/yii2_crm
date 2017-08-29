<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%quest_history}}".
 *
 * @property integer $quest_pack_id
 * @property integer $user_id
 * @property integer $question_id
 * @property integer $answer_id
 * @property string $comment
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
            [['user_id', 'question_id', 'quest_pack_id', 'answer_id'], 'required'],
            [['user_id', 'question_id', 'answer_id', 'quest_pack_id'], 'integer'],
			[['comment'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'user_id' => Yii::t('common', 'Пользователь'),
            'question_id' => Yii::t('common', 'Вопрос'),
            'answer_id' => Yii::t('common', 'Ответ'),
        ];
    }
}
