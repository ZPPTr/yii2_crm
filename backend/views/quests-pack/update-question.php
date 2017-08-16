<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model common\models\Question */
/* @var $answers_list common\models\Answer */

Url::remember(['quests-pack/update-question', 'id' => $model->id], 'question');

$this->title = Yii::t('backend', 'Update {modelClass}: ', [
		'modelClass' => 'Question',
	]) . ' ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', 'Quest Packs'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('backend', 'Update');
?>
<div class="quest-pack-update">

	<div class="quest-form">

		<?php $form = ActiveForm::begin(); ?>

		<?php echo $form->errorSummary($model); ?>

		<?php echo $form->field($model, 'title')->textInput() ?>

		<?php echo $form->field($model, 'description')->textarea(['rows' => 6]) ?>
		<?php echo $form->field($model, 'sorting')->textInput() ?>
		<?php echo $form->field($model, 'parent_answer_id')->textInput(['rows' => 6]) ?>

		<div class="form-group">
			<?php echo Html::submitButton(Yii::t('backend', 'Update'), ['class' => 'btn btn-primary']) ?>
		</div>

		<?php ActiveForm::end(); ?>
		<div class="quest-list-form">
			<?php // Pjax::begin(); ?>

			<?= Html::beginForm(['quests-pack/add-answer'], 'post', ['data-pjax' => '', 'class' => 'form-inline']); ?>
			<?= Html::input('text', 'title', Yii::$app->request->post('title'), ['class' => 'form-control', 'placeholder' => 'Ответ']) ?>
			<?= Html::input('hidden', 'question_id', $model->id) ?>
			<?= Html::submitButton('Добавить ответ', ['class' => 'btn btn-primary', 'name' => 'hash-button']) ?>
			<?= Html::endForm() ?>

			<?php if(!empty($answers_list)) : ?>
				<ul>
					<?php foreach($answers_list as $answer) : ?>
						<li>
							<span><?php echo $answer->title ?></span>
							<span class="actions">
								<?= Html::a('<i class="fa fa-times-circle"></i>', ['quests-pack/delete-answer', 'id' => $answer->id] ) ?>
							</span>
						</li>
					<?php endforeach ?>
				</ul>

			<?php endif ?>
			<?php // Pjax::end(); ?>

		</div>

	</div>

</div>
