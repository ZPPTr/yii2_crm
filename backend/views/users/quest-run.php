<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;

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
	<ul>
		<?php
		_debug($quest_history);
		foreach($quest->questions as $question) :
			?>
			<li>
				<?= $question->title ?>
				<?= Html::beginForm(['users/insert-quest-history'], 'post', [/*'data-pjax' => '', */'class' => 'form-inline']); ?>
				<?= Html::dropDownList('answer_id', '', ArrayHelper::map($question->answers, 'id', 'title'), ['class' => 'form-control']) ?>
				<?= Html::input('hidden', 'user_id', $user_id) ?>
				<?= Html::input('hidden', 'question_id', $question->id) ?>
				<?= Html::input('hidden', 'quest_pack_id', $quest->id) ?>
				<?= Html::submitButton('Зафиксировать ответ', ['class' => 'btn btn-primary', 'name' => 'hash-button']) ?>
				<?= Html::endForm() ?>
			</li>
		<?php endforeach ?>
	</ul>


</div>
