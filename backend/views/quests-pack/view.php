<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\QuestPack */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', 'Quest Packs'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="quest-pack-view">

    <p>
        <?php echo Html::a(Yii::t('backend', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?php /*echo Html::a(Yii::t('backend', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('backend', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) */?>
    </p>

    <?php echo DetailView::widget([
        'model' => $model,
        'attributes' => [
            //'id',
            'parent_id',
            'title',
            'description:ntext',
        ],
    ]) ?>

	<div class="box box-success">
		<div class="box-header with-border">
			<i class="fa fa-question-circle"></i>
			<h3 class="box-title">Вопросы квеста</h3>

			<?php echo $this->render('_quest-questions', [
				'quest' => $model
			]); ?>
		</div>
	</div>

	<div class="box box-success">
		<div class="box-header with-border">
			<i class="fa fa-list"></i>

			<h3 class="box-title">Список прозвоненых пользователей</h3>
			<?php echo $this->render('_quest-result-list', [
				'users' => $model->questResults,
				'searchModel' => $searchModel,
				'dataProvider' => $dataProvider,
			]); ?>
		</div>
	</div>


</div>
