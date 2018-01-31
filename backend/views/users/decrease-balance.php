<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\search\UsersSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('backend', 'Списание Баланса');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="users-index">

	<?php // echo $this->render('_search', ['model' => $searchModel]); ?>

	<p>
		<?php echo Html::a(Yii::t('backend', 'Create {modelClass}', [
			'modelClass' => 'Users',
		]), ['create'], ['class' => 'btn btn-success']) ?>
	</p>

	<?php echo GridView::widget([
		'dataProvider' => $dataProvider,
		'filterModel' => $searchModel,
		'pager' => [
			'options'=>['class'=>'pagination'],   // set clas name used in ui list of pagination
			'prevPageLabel' => 'Previous',   // Set the label for the "previous" page button
			'nextPageLabel' => 'Next',   // Set the label for the "next" page button
			'firstPageLabel'=>'First',   // Set the label for the "first" page button
			'lastPageLabel'=>'Last',    // Set the label for the "last" page button
			'nextPageCssClass'=>'next',    // Set CSS class for the "next" page button
			'prevPageCssClass'=>'prev',    // Set CSS class for the "previous" page button
			'firstPageCssClass'=>'first',    // Set CSS class for the "first" page button
			'lastPageCssClass'=>'last',    // Set CSS class for the "last" page button
			'maxButtonCount'=>10,    // Set maximum number of page buttons that can be displayed
		],
		'columns' => [
			['class' => 'yii\grid\SerialColumn'],

			'number',
			[
				'label' => 'Имя',
				'value' => 'fullName',
			],
			//'email:email',
			'email',
			'phone',
			// 'country_id',
			// 'city_id',
			'userReportLastMonth.profit',

			// 'date_time',
			// 'prolongation_at',
			// 'ranking_at',
			// 'controlled_at',
			// 'mod_status',
			// 'mod_comment',

			// 'agent_id',

			[
				'class' => 'yii\grid\ActionColumn',
				'template' => '{view} '//{update}
			],
		],
	]); ?>

</div>
