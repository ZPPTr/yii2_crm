<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\QuestResult */

$this->title = Yii::t('backend', 'Update {modelClass}: ', [
    'modelClass' => 'Quest Result',
]) . ' ' . $model->quest_pack_id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', 'Quest Results'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->quest_pack_id, 'url' => ['view', 'quest_pack_id' => $model->quest_pack_id, 'user_id' => $model->user_id]];
$this->params['breadcrumbs'][] = Yii::t('backend', 'Update');
?>
<div class="quest-result-update">

    <?php echo $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
