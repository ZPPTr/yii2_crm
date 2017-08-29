<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;
use trntv\yii\datetime\DateTimeWidget;
use common\models\QuestResult;

Url::remember();

/* @var $this yii\web\View */
/* @var $quest common\models\QuestPack */

$this->title = Yii::t('backend', 'Update {modelClass}: ', [
		'modelClass' => 'Quest',
	]) . ' ' . $quest->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', 'Users'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $quest->title, 'url' => ['view', 'id' => $quest->id]];
$this->params['breadcrumbs'][] = Yii::t('backend', 'Run');
?>

<div class="quest-run-form">
	<ul class="col-md-6">
		<?php
		//_debug($quest_history);
		foreach($quest->questions as $question) :
			$question->checkApplied($user_id);
			?>
			<li>
				<p><strong><?= $question->title ?></strong></p>
				<?= Html::beginForm(['users/insert-quest-history'], 'post', ['class' => 'form']); ?>
				<div class="form-group">
				<?= Html::dropDownList('answer_id', $question->getAnswer($user_id), ArrayHelper::map($question->answers, 'id', 'title'), ['class' => 'form-control', 'disabled' => $question->checkApplied ? true : false]) ?>
				</div>
				<div class="form-group">
				<?= Html::textarea('comment', $question->getComment($user_id), ['class' => 'form-control']) ?>
				</div>
				<?= Html::hiddenInput('user_id', $user_id) ?>
				<?= Html::hiddenInput('question_id', $question->id) ?>
				<?= Html::hiddenInput('quest_pack_id', $quest->id) ?>
				<div class="form-group">
				<?= Html::submitButton(
						$question->checkApplied ? 'Ответ зафиксирован' : 'Зафиксировать ответ',
						['class' => $question->checkApplied ? 'btn btn-success' : 'btn btn-primary',
							'name' => 'hash-button',
							'disabled' => $question->checkApplied ? true : false]) ?>
				<?= Html::endForm() ?>
				</div>
			</li>
		<?php endforeach ?>
	</ul>

	<div class="clearfix"></div>
	<?php $form = ActiveForm::begin(); ?>

	<?php echo $form->errorSummary($quest_result); ?>

	<?php echo $form->field($quest_result, 'common_comment')->textarea() ?>
	<?php echo $form->field($quest_result, 'delay_to')->widget(
		DateTimeWidget::className(),
		[
			'phpDatetimeFormat' => 'dd.MM.yyyy, HH:mm'
		]
	) ?>
	<?php echo $form->field($quest_result, 'result')->dropDownList([
		QuestResult::RESULT_NONE => 'Не прозвонен',
		QuestResult::RESULT_CALLED => 'Прозвонен',
		QuestResult::RESULT_DELAY => 'Отложен',
	]) ?>
	<?php echo $form->field($quest_result, 'quest_pack_id')->hiddenInput(['value' => $quest->id]) ?>
	<?php echo $form->field($quest_result, 'user_id')->hiddenInput(['value' => $user_id]) ?>

	<div class="form-group">
		<?php echo Html::submitButton( Yii::t('backend', 'Update'),
			['class' => 'btn btn-success']) ?>
	</div>

	<?php ActiveForm::end(); ?>

</div>
