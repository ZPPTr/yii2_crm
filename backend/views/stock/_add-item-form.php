<?php

use common\models\stocks\StockOrderItems;
use yii\bootstrap\ActiveForm;
use yii\bootstrap\Html;

/**
 * @var int $orderId
 * @var StockOrderItems $model
 * @var array $products
 */

$form = ActiveForm::begin([
    'method' => 'post',
    'action' => 'add-order-item?id='.$orderId
]);

echo $form->field($model, 'product_id')->dropDownList($products);
echo $form->field($model, 'quantity')->textInput(['maxlength' => true]);
echo $form->field($model, 'order_id')->hiddenInput(['value' => $orderId])->label('');

echo Html::tag('p', Html::submitButton('Подтвердить', ['class' => 'btn btn-success']), ['class' => 'text-right']);

$form = ActiveForm::end();
