<?php

use yii\helpers\Html;
use yii\widgets\Pjax;
use yii\helpers\ArrayHelper;

?>

<div class="box box-warning">
	<?php Pjax::begin(); ?>
	<div class="box-header with-border">
		<div class="pull-right">
			<?= Html::beginForm(['users/create-quest'], 'post', ['data-pjax' => '', 'class' => 'form-inline']); ?>
			<?= Html::dropDownList('quest_pack_id', '', ArrayHelper::map($allowed_quests, 'id', 'title'), ['class'=>'form-control']) ?>
			<?= Html::input('hidden', 'user_id', $user_id) ?>
			<?= Html::input('hidden', 'interviewer_id', Yii::$app->user->id) ?>
			<?= Html::submitButton('Создать опрос', ['class' => 'btn btn-primary', 'name' => 'hash-button']) ?>
			<?= Html::endForm() ?>
		</div>
		<h3 class="box-title">Прозвоны пользователя</h3>

	</div>
	<?php if(!empty($quests)) : ?>
		<ul>
			<?php foreach($quests as $quest) : ?>
				<li>
					<span><?php echo $quest->quest->title ?></span>
					<span class="actions">
						<?= Html::a('<i class="fa fa-pencil-square-o"></i>', ['users/run-quest', 'quest_id' => $quest->quest->id, 'user_id' => $user_id] ) ?>
					</span>
				</li>
			<?php endforeach ?>
		</ul>

	<?php else : ?>
		<h4>Прозвоны относительно этого пользователя еще не совершались</h4>
	<?php endif ?>
	<?php Pjax::end(); ?>
</div>