<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\search\UsersSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('backend', 'Users');
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
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'number',
            'manager_id',
            'name',
            'surname',
            'patronymic',
            'email:email',
            'phone',
            // 'country_id',
            // 'city_id',
            'city',

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
