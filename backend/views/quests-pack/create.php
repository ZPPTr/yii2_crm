<?php

/* @var $this yii\web\View */
/* @var $model common\models\QuestPack */

$this->title = Yii::t('backend', 'Create {modelClass}', [
    'modelClass' => 'Quest Pack',
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', 'Quest Packs'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="quest-pack-create">

    <?php echo $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
