<?php
namespace common\models\finances;

use common\components\ActiveRecord;
use common\models\Users;
use yii\bootstrap\Html;

/**
 * Class DecreasedBalance
 * @package common\models\finances
 */
class DecreasedBalance extends ActiveRecord
{
    const STATUS_DRAFT = 'draft';
    const STATUS_APPROVED = 'approved';
    const STATUS_WARNING = 'warning';
    const STATUSES = [self::STATUS_DRAFT, self::STATUS_APPROVED, self::STATUS_WARNING];

    public function rules()
    {
        return [
            [['user_id', 'ym', 'amount', 'status'], 'required'],
            [['user_id', 'ym'], 'integer'],
            ['user_id', 'exist', 'targetClass' => Users::className(), 'targetAttribute' => 'id'],
            ['amount', 'float'],
            [['status', 'comment'], 'string'],
            ['status', 'in', 'range' => self::STATUSES]
        ];
    }

    public function getUser()
    {
        return $this->hasOne(Users::className(), ['id' => 'user_id']);
    }

    public function getStatusHtml()
    {
        switch ($this->status) {
            case self::STATUS_WARNING:
                $labelClass = 'badge badge-warning';
                break;
            case self::STATUS_APPROVED:
                $labelClass = 'badge badge-success';
                break;
            case self::STATUS_DRAFT:
            default:
                $labelClass = 'badge badge-info';
        }

        return Html::label($this->status, '', ['class' => $labelClass]);
    }
}
