<?php
use yii\helpers\Html;
use yii\grid\GridView;
use common\models\QuestResult;

echo GridView::widget([
	'dataProvider' => $dataProvider,
	'filterModel' => $searchModel,
	'columns' => [
		['class' => 'yii\grid\SerialColumn'],

		//'quest_pack_id',
		[
			'attribute' => 	'user_id',
			'value' => 'user.fullName',
		],
		[
			'label' => 	'Номер карты',
			'value' => 'user.number',
		],
		'created_at:date',
		'updated_at:date',
		'delay_to:date',
		[
			'attribute' => 'result',
			'content' => function($data) {
				switch ($data->result) {
					case QuestResult::RESULT_CALLED :
						$content =  'Прозвонен';
						$classes = 'btn-success';
						break;
					case QuestResult::RESULT_DELAY :
						$content =  'Отложен';
						$classes = 'btn-warning';
						break;
					default:
					case QuestResult::RESULT_NONE :
						$content =  'Не Прозвонен';
						$classes = 'btn-default';
						break;
				}
				return '<span class="btn-xs '.$classes.'">'.$content.'</span>';
			},
		],

		//'body:ntext',
		// 'interviewer_id',

		[
			'class' => 'yii\grid\ActionColumn',
			'template' => '{view} ',//{update},
			'buttons' => [
				'view' => function ($url, $model) {
					return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', $url, [
						'title' => Yii::t('app', 'lead-view'),
					]);
				},
			],
			'urlCreator' => function ($action, $model, $key, $index) {
				if ($action === 'view') {
					$url = '@web/users/run-quest?quest_id=' . $model->quest_pack_id . '&user_id=' . $model->user_id;
					return $url;
				}
			}
		],
	],
]);
