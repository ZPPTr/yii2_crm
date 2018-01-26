<?php
/* @author Eugene Bogun <eugenebogun@gmail.com> */

namespace common\widgets;
use yii\helpers\Html;

class Editable extends \kartik\editable\Editable
{
    public $editIcon = '<i class="fa fa-pencil"></i>';
    public $valueIfNull = '<i class="fa fa-pencil"></i>';
    public $submitButton = [
        'icon' => 'Сохранить',
        'class' => 'btn btn-sm btn-success'
    ];
    public $resetButton = [
        'icon' => 'Закрыть',
        'class' => 'btn btn-sm kv-editable-close btn-default',
        'data-dismiss' => 'popover-x'
    ];
    
    protected function initOptions() {
        parent::initOptions();
        $value = $this->hasModel() ? Html::getAttributeValue($this->model, $this->attribute) : $this->value;
        if ($this->format == self::FORMAT_BUTTON) {
            if (empty($this->editableButtonOptions['label'])) {
                $this->editableButtonOptions['label'] = '<i class="glyphicon glyphicon-pencil"></i>';
            }
            Html::addCssClass($this->editableButtonOptions, 'kv-editable-toggle');
            $this->_popoverOptions['toggleButton'] = $this->editableButtonOptions;
        } else {
            if (!$value){
                Html::addCssClass($this->editableValueOptions, 'kv-editable-empty-value');
            }
            $this->_popoverOptions['toggleButton'] = $this->editableValueOptions;
            $this->_popoverOptions['toggleButton']['label'] = $this->displayValue . ($value? $this->editIcon : '');
        }
    }
}