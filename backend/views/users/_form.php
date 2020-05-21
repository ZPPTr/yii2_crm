<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Users */
/* @var $form yii\bootstrap\ActiveForm */
?>

<div class="users-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php echo $form->errorSummary($model); ?>

    <?php echo $form->field($model, 'id')->textInput(['maxlength' => true]) ?>

    <?php echo $form->field($model, 'is_moderator')->textInput() ?>

    <?php echo $form->field($model, 'number')->textInput(['maxlength' => true]) ?>

    <?php echo $form->field($model, 'manager_id')->textInput() ?>

    <?php echo $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?php echo $form->field($model, 'surname')->textInput(['maxlength' => true]) ?>

    <?php echo $form->field($model, 'patronymic')->textInput(['maxlength' => true]) ?>

    <?php echo $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

    <?php echo $form->field($model, 'phone')->textInput(['maxlength' => true]) ?>

    <?php echo $form->field($model, 'country_id')->textInput() ?>

    <?php echo $form->field($model, 'city_id')->textInput() ?>

    <?php echo $form->field($model, 'city')->textInput(['maxlength' => true]) ?>

    <?php echo $form->field($model, 'address')->textInput(['maxlength' => true]) ?>

    <?php echo $form->field($model, 'address_cor')->textInput(['maxlength' => true]) ?>

    <?php echo $form->field($model, 'passport')->textInput(['maxlength' => true]) ?>

    <?php echo $form->field($model, 'passport_data')->textInput(['maxlength' => true]) ?>

    <?php echo $form->field($model, 'idnum')->textInput(['maxlength' => true]) ?>

    <?php echo $form->field($model, 'photo')->textInput(['maxlength' => true]) ?>

    <?php echo $form->field($model, 'photo_thumb')->textInput(['maxlength' => true]) ?>

    <?php echo $form->field($model, 'date_time')->textInput() ?>

    <?php echo $form->field($model, 'prolongation_at')->textInput() ?>

    <?php echo $form->field($model, 'ranking_at')->textInput() ?>

    <?php echo $form->field($model, 'controlled_at')->textInput() ?>

    <?php echo $form->field($model, 'mod_status')->textInput() ?>

    <?php echo $form->field($model, 'mod_comment')->textInput(['maxlength' => true]) ?>

    <?php echo $form->field($model, 'password')->passwordInput(['maxlength' => true]) ?>

    <?php echo $form->field($model, 'salt')->textInput(['maxlength' => true]) ?>

    <?php echo $form->field($model, 'is_active')->textInput() ?>

    <?php echo $form->field($model, 'group_id')->textInput() ?>

    <?php echo $form->field($model, 'user_type')->textInput() ?>

    <?php echo $form->field($model, 'is_valid')->textInput() ?>

    <?php echo $form->field($model, 'vk')->textInput(['maxlength' => true]) ?>

    <?php echo $form->field($model, 'fb')->textInput(['maxlength' => true]) ?>

    <?php echo $form->field($model, 'skype')->textInput(['maxlength' => true]) ?>

    <?php echo $form->field($model, 'is_handle')->textInput() ?>

    <?php echo $form->field($model, 'balance')->textInput(['maxlength' => true]) ?>

    <?php echo $form->field($model, 'bonus_balance')->textInput(['maxlength' => true]) ?>

    <?php echo $form->field($model, 'stock_balance')->textInput(['maxlength' => true]) ?>

    <?php echo $form->field($model, 'bank_card')->textInput(['maxlength' => true]) ?>

    <?php echo $form->field($model, 'bank_name')->textInput(['maxlength' => true]) ?>

    <?php echo $form->field($model, 'is_fop')->textInput() ?>

    <?php echo $form->field($model, 'rr')->textInput(['maxlength' => true]) ?>

    <?php echo $form->field($model, 'edrpou')->textInput(['maxlength' => true]) ?>

    <?php echo $form->field($model, 'mfo')->textInput(['maxlength' => true]) ?>

    <?php echo $form->field($model, 'is_potential_rank')->textInput() ?>

    <?php echo $form->field($model, 'am_coffee_machines')->textInput() ?>

    <?php echo $form->field($model, 'am_free_coffee')->textInput() ?>

    <?php echo $form->field($model, 'confirm_rule')->textInput() ?>

    <?php echo $form->field($model, 'is_valid_machine')->textInput() ?>

    <?php echo $form->field($model, 'is_valid_card')->textInput() ?>

    <?php echo $form->field($model, 'is_sklad')->textInput() ?>

    <?php echo $form->field($model, 'is_auto_pay')->textInput() ?>

    <?php echo $form->field($model, 'stock_auto_pay')->textInput() ?>

    <?php echo $form->field($model, 'agent_id')->textInput() ?>

    <div class="form-group">
        <?php echo Html::submitButton($model->isNewRecord ? Yii::t('backend', 'Create') : Yii::t('backend', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
