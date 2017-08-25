<?php
use yii\helpers\Html;
use yii\grid\GridView;

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
		'body:ntext',
		// 'interviewer_id',

		['class' => 'yii\grid\ActionColumn'],
	],
]);
