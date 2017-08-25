<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\QuestResult */

$this->title = $model->quest_pack_id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', 'Quest Results'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="quest-result-view">

    <p>
        <?php echo Html::a(Yii::t('backend', 'Update'), ['update', 'quest_pack_id' => $model->quest_pack_id, 'user_id' => $model->user_id], ['class' => 'btn btn-primary']) ?>
        <?php echo Html::a(Yii::t('backend', 'Delete'), ['delete', 'quest_pack_id' => $model->quest_pack_id, 'user_id' => $model->user_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('backend', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?php echo DetailView::widget([
        'model' => $model,
        'attributes' => [
            'quest_pack_id',
            'user_id',
            'created_at',
            'updated_at',
            'body:ntext',
            'interviewer_id',
        ],
    ]) ?>

</div>
