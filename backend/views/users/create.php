<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Users */

$this->title = Yii::t('backend', 'Create {modelClass}', [
    'modelClass' => 'Users',
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', 'Users'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="users-create">

    <?php echo $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
