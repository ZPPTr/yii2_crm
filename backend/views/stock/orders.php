<?php
use yii\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $searchModel */

$this->title = Yii::t('backend', 'Склады');
$this->params['breadcrumbs'][] = $this->title;


?>
<div class="user-index">
    <?php echo GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'options' => [
            'class' => 'grid-view table-responsive'
        ],
        'columns' => [
            'agent.number',
            'agent.fullName',
            'agent.email:email',
            [
            	'attribute' => 'status',
	            'content' => function($model) {
    	            return $model->status;
	            }
            ],
	        'created_at:date',
            [
            	'class' => 'yii\grid\ActionColumn',
	            'buttons' => [
                    'update' => function($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-pencil"></span>',
                            Url::to(str_replace('update', 'update-order', $url)),
                            ['title' => 'Редактировать']
                        );
                    }
	            ],
	            'template'=>'{update}'
            ],
        ],
    ]); ?>

</div>
