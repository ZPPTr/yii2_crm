<?php

/* @var $this yii\web\View */
/* @var $model common\models\QuestPack */
/* @var $questions_list common\models\Question */

$this->title = Yii::t('backend', 'Update {modelClass}: ', [
    'modelClass' => 'Quest Pack',
]) . ' ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', 'Quest Packs'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('backend', 'Update');
?>
<div class="quest-pack-update">

    <?php echo $this->render('_form', [
        'model' => $model,
        'questions_list' => $questions_list,
    ]) ?>

</div>
