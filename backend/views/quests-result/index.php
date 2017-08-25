<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\search\QuestResultSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('backend', 'Quest Results');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="quest-result-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?php echo Html::a(Yii::t('backend', 'Create {modelClass}', [
    'modelClass' => 'Quest Result',
]), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php echo GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'quest_pack_id',
            'user_id',
            'created_at',
            'updated_at',
            'body:ntext',
            // 'interviewer_id',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
