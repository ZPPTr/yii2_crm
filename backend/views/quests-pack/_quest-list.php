<?php

use yii\widgets\Pjax;
use yii\helpers\Html;
use yii\helpers\Url;

/* @var $pack_id  */


Url::remember();
?>
<div class="quest-list-form">
	<?php Pjax::begin(); ?>

	<?= Html::beginForm(['quests-pack/add-question'], 'post', ['data-pjax' => '', 'class' => 'form-inline']); ?>
	<?= Html::input('text', 'title', Yii::$app->request->post('title'), ['class' => 'form-control', 'placeholder' => 'Вопрос']) ?>
	<?= Html::input('text', 'description', Yii::$app->request->post('description'), ['class' => 'form-control', 'placeholder' => 'Описание']) ?>
	<?= Html::input('text', 'parent_answer_id', Yii::$app->request->post('parent_answer_id'), ['class' => 'form-control', 'placeholder' => 'Id Родительского ответа']) ?>
	<?= Html::input('text', 'sorting', Yii::$app->request->post('sorting'), ['class' => 'form-control', 'placeholder' => 'Сортировка']) ?>
	<?= Html::input('hidden', 'pack_id', $pack_id) ?>
	<?= Html::submitButton('Добавить вопрос', ['class' => 'btn btn-primary', 'name' => 'hash-button']) ?>
	<?= Html::endForm() ?>

	<?php if(!empty($questions_list)) : ?>
		<ul>
			<?php foreach($questions_list as $question) : ?>
				<li data-sorting="<?php echo $question->sorting ?>">
					<span><?php echo $question->title ?></span>
					<span><?php echo $question->description ?></span>
					<span class="actions">
						<?= Html::a('<i class="fa fa-pencil-square-o"></i>', ['quests-pack/update-question', 'id' => $question->id] ) ?>
						<?= Html::a('<i class="fa fa-times-circle"></i>', ['quests-pack/delete-question', 'id' => $question->id] ) ?>
					</span>
					<?php if(!empty($question->answers)) : ?>
						<ol>
							<?php foreach($question->answers as $answer) : ?>
								<?= Html::tag('li', $answer->title) ?>
							<?php endforeach ?>
						</ol>

					<?php endif ?>
				</li>
			<?php endforeach ?>
		</ul>

	<?php endif ?>
	<?php Pjax::end(); ?>

</div>