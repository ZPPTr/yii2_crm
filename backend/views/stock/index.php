<?php
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('backend', 'Склады');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index">
    <?php echo GridView::widget([
        'dataProvider' => $dataProvider,
        'options' => [
            'class' => 'grid-view table-responsive'
        ],
        'columns' => [
            'id',
            'number',
            'fullName',
            'email:email',
            [
            	'label' => 'Адрес',
	            'value' => function($model) {
    	            return $model->agent ? $model->agent->city.', '.$model->agent->address : '';
	            }
            ],
            ['class' => 'yii\grid\ActionColumn', 'template'=>'{view}'],
        ],
    ]); ?>

</div>
