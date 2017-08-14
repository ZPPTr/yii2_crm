<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\search\UsersSearch */
/* @var $form yii\bootstrap\ActiveForm */
?>

<div class="users-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?php echo $form->field($model, 'id') ?>

    <?php echo $form->field($model, 'is_moderator') ?>

    <?php echo $form->field($model, 'number') ?>

    <?php echo $form->field($model, 'manager_id') ?>

    <?php echo $form->field($model, 'name') ?>

    <?php // echo $form->field($model, 'surname') ?>

    <?php // echo $form->field($model, 'patronymic') ?>

    <?php // echo $form->field($model, 'email') ?>

    <?php // echo $form->field($model, 'phone') ?>

    <?php // echo $form->field($model, 'country_id') ?>

    <?php // echo $form->field($model, 'city_id') ?>

    <?php // echo $form->field($model, 'city') ?>

    <?php // echo $form->field($model, 'address') ?>

    <?php // echo $form->field($model, 'address_cor') ?>

    <?php // echo $form->field($model, 'passport') ?>

    <?php // echo $form->field($model, 'passport_data') ?>

    <?php // echo $form->field($model, 'idnum') ?>

    <?php // echo $form->field($model, 'photo') ?>

    <?php // echo $form->field($model, 'photo_thumb') ?>

    <?php // echo $form->field($model, 'date_time') ?>

    <?php // echo $form->field($model, 'prolongation_at') ?>

    <?php // echo $form->field($model, 'ranking_at') ?>

    <?php // echo $form->field($model, 'controlled_at') ?>

    <?php // echo $form->field($model, 'mod_status') ?>

    <?php // echo $form->field($model, 'mod_comment') ?>

    <?php // echo $form->field($model, 'password') ?>

    <?php // echo $form->field($model, 'salt') ?>

    <?php // echo $form->field($model, 'is_active') ?>

    <?php // echo $form->field($model, 'group_id') ?>

    <?php // echo $form->field($model, 'user_type') ?>

    <?php // echo $form->field($model, 'is_valid') ?>

    <?php // echo $form->field($model, 'vk') ?>

    <?php // echo $form->field($model, 'fb') ?>

    <?php // echo $form->field($model, 'skype') ?>

    <?php // echo $form->field($model, 'is_handle') ?>

    <?php // echo $form->field($model, 'balance') ?>

    <?php // echo $form->field($model, 'bonus_balance') ?>

    <?php // echo $form->field($model, 'stock_balance') ?>

    <?php // echo $form->field($model, 'bank_card') ?>

    <?php // echo $form->field($model, 'bank_name') ?>

    <?php // echo $form->field($model, 'is_fop') ?>

    <?php // echo $form->field($model, 'rr') ?>

    <?php // echo $form->field($model, 'edrpou') ?>

    <?php // echo $form->field($model, 'mfo') ?>

    <?php // echo $form->field($model, 'is_potential_rank') ?>

    <?php // echo $form->field($model, 'am_coffee_machines') ?>

    <?php // echo $form->field($model, 'am_free_coffee') ?>

    <?php // echo $form->field($model, 'confirm_rule') ?>

    <?php // echo $form->field($model, 'is_valid_machine') ?>

    <?php // echo $form->field($model, 'is_valid_card') ?>

    <?php // echo $form->field($model, 'is_sklad') ?>

    <?php // echo $form->field($model, 'is_auto_pay') ?>

    <?php // echo $form->field($model, 'stock_auto_pay') ?>

    <?php // echo $form->field($model, 'agent_id') ?>

    <div class="form-group">
        <?php echo Html::submitButton(Yii::t('backend', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?php echo Html::resetButton(Yii::t('backend', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
