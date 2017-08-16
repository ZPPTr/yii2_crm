<?php

namespace common\models;

use Yii;

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
    public function rules()
    {
        return [
            [['quest_pack_id', 'user_id'], 'required'],
            [['quest_pack_id', 'user_id', 'created_at'], 'integer'],
            [['body'], 'string'],
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
}
