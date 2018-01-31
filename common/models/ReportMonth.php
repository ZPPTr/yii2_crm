<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "report_month".
 *
 * @property int $id
 * @property int $user_id
 * @property int $ym
 * @property int $personal_purchase
 * @property string $personal_sum
 * @property int $structure_purchase
 * @property string $structure_sum
 * @property string $profit
 * @property string $card_profit
 * @property string $coffee_count
 * @property string $coffee_machine_profit
 * @property int $country_id
 */
class ReportMonth extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'report_month';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'ym', 'personal_purchase', 'country_id'], 'required'],
            [['user_id', 'ym', 'personal_purchase', 'structure_purchase', 'country_id'], 'integer'],
            [['personal_sum', 'structure_sum', 'profit', 'card_profit', 'coffee_count', 'coffee_machine_profit'], 'number'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'ym' => 'Ym',
            'personal_purchase' => 'Personal Purchase',
            'personal_sum' => 'Personal Sum',
            'structure_purchase' => 'Structure Purchase',
            'structure_sum' => 'Structure Sum',
            'profit' => 'Profit',
            'card_profit' => 'Card Profit',
            'coffee_count' => 'Coffee Count',
            'coffee_machine_profit' => 'Coffee Machine Profit',
            'country_id' => 'Country ID',
        ];
    }
}
