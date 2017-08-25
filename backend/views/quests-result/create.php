<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\QuestResult */

$this->title = Yii::t('backend', 'Create {modelClass}', [
    'modelClass' => 'Quest Result',
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', 'Quest Results'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="quest-result-create">

    <?php echo $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
