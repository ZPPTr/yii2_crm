<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\search\UsersSearch */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $questList  array
 */
?>

<div class="users-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>
	<div class="row">
		<div class="col-xs-12">
			<h4><strong>Фильтр клиентов</strong></h4>
		</div>
	</div>
	<div class="row">
		<div class="col-md-6">
			<?php echo $form->field($model, 'questPackId')->dropdownList($questList) ?>
		</div>
	</div>
	<div class="row">
		<div class="col-md-6">
			<div class="form-group">
				<?php echo Html::submitButton(Yii::t('backend', 'Применить'), ['class' => 'btn btn-primary']) ?>
				<?php echo Html::resetButton(Yii::t('backend', 'Reset'), ['class' => 'btn btn-default']) ?>
			</div>
		</div>
	</div>




    <?php ActiveForm::end(); ?>

</div>
