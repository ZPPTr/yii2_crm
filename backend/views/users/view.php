<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
//use kartik\editable\Editable;
use common\widgets\Editable;

/* @var $this yii\web\View */
/* @var $model common\models\Users */
/* @var $orders common\models\Orders */
/* @var $quests common\models\QuestPack */
/* @var $allowed_quests common\models\QuestPack */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', 'Users'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="users-view">

    <p>
        <?php //echo Html::a(Yii::t('backend', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?php //echo Html::a(Yii::t('backend', 'Delete'), ['delete', 'id' => $model->id], [
//            'class' => 'btn btn-danger',
//            'data' => [
//                'confirm' => Yii::t('backend', 'Are you sure you want to delete this item?'),
//                'method' => 'post',
//            ],
//        ]) ?>
    </p>
	<div class="row">
		<div class="col-md-6">
			<div class="box box-warning">
				<div class="box-header with-border">
					<h3 class="box-title">Данные пользователя</h3>
				</div>
				<?php echo DetailView::widget([
					'model' => $model,
					'attributes' => [
						'id',
						'number',
						'manager_id',
						//'name',
						//'surname',
						[
							'attribute' => 'name',
							'label' => 'Имя',
							'format' => 'raw',
							'value' => Editable::widget([
								'name' => 'Users[name]',
								'asPopover' => false,
								'size' => 'md',
								'value' => $model->name,
								'inputType' => Editable::INPUT_TEXT,
								'format' => Editable::FORMAT_BUTTON,
								'options' => ['class' => 'form-control'],
								'formOptions' => ['action' => ['/users/ajax-update', 'id' => $model->id]],
							])
						],
						[
							'attribute' => 'surname',
							'label' => 'Фамилия',
							'format' => 'raw',
							'value' => Editable::widget([
								'name' => 'Users[surname]',
								'asPopover' => false,
								'size' => 'md',
								'value' => $model->surname,
								'inputType' => Editable::INPUT_TEXT,
								'format' => Editable::FORMAT_BUTTON,
								'options' => ['class' => 'form-control'],
								'formOptions' => ['action' => ['/users/ajax-update', 'id' => $model->id]],
							])
						],
						[
							'attribute' => 'patronymic',
							'label' => 'Отчество',
							'format' => 'raw',
							'value' => Editable::widget([
								'name' => 'Users[patronymic]',
								'asPopover' => false,
								'size' => 'md',
								'value' => $model->patronymic,
								'inputType' => Editable::INPUT_TEXT,
								'format' => Editable::FORMAT_BUTTON,
								'options' => ['class' => 'form-control'],
								'formOptions' => ['action' => ['/users/ajax-update', 'id' => $model->id]],
							])
						],
						[
							'attribute' => 'email',
							'label' => 'E-mail',
							'format' => 'raw',
							'value' => Editable::widget([
								'name' => 'Users[email]',
								'asPopover' => false,
								'size' => 'md',
								'value' => $model->email,
								'inputType' => Editable::INPUT_TEXT,
								'format' => Editable::FORMAT_BUTTON,
								'options' => ['class' => 'form-control'],
								'formOptions' => ['action' => ['/users/ajax-update', 'id' => $model->id]],
							])
						],
						[
							'attribute' => 'phone',
							'label' => 'Телефон',
							'format' => 'raw',
							'value' => Editable::widget([
								'name' => 'Users[phone]',
								'asPopover' => false,
								'size' => 'md',
								'value' => $model->phone,
								'inputType' => Editable::INPUT_TEXT,
								'format' => Editable::FORMAT_BUTTON,
								'options' => ['class' => 'form-control'],
								'formOptions' => ['action' => ['/users/ajax-update', 'id' => $model->id]],
							])
						],
						[
							'attribute' => 'city',
							'label' => 'Город',
							'format' => 'raw',
							'value' => Editable::widget([
								'name' => 'Users[city]',
								'asPopover' => false,
								'size' => 'md',
								'value' => $model->city,
								'inputType' => Editable::INPUT_TEXT,
								'format' => Editable::FORMAT_BUTTON,
								'options' => ['class' => 'form-control'],
								'formOptions' => ['action' => ['/users/ajax-update', 'id' => $model->id]],
							])
						],
						[
							'attribute' => 'address',
							'label' => 'Адрес',
							'format' => 'raw',
							'value' => Editable::widget([
								'name' => 'Users[address]',
								'asPopover' => false,
								'size' => 'md',
								'value' => $model->address,
								'inputType' => Editable::INPUT_TEXTAREA,
								'format' => Editable::FORMAT_BUTTON,
								'options' => ['class' => 'form-control'],
								'formOptions' => ['action' => ['/users/ajax-update', 'id' => $model->id]],
							])
						],
						'date_time:datetime',
					],
				]) ?>
			</div>
			<?php echo $this->render('_questions-list', [
				'quests' => $quests,
				'allowed_quests' => $allowed_quests,
				'user_id' => $model->id,
			]) ?>


		</div>
		<div class="col-md-6">
			<div class="box box-warning orders-list">
				<div class="box-header with-border">
					<h3 class="box-title">Заказы пользователя</h3>
				</div>
				<?php if(!empty($orders)) : ?>
				<?php foreach($orders as $order) : ?>
					<div class="box-body table-responsive">
						<table class="table">
							<tbody>
							<tr>
								<th>ID</th>
								<th>Общая сумма заказа</th>
								<th>Дата проводки</th>
								<th>Вес кофе в заказе</th>
							</tr>
							<tr>
								<?php echo Html::tag('td', $order->id) ?>
								<?php echo Html::tag('td', $order->total_sum) ?>
								<?php echo Html::tag('td', Yii::$app->formatter->asDate($order->end_time, 'long')) ?>
								<?php echo Html::tag('td', $order->coffee_kg.'kg') ?>
							</tr>
							<tr>
								<td colspan="4">
									<?php foreach($order->orderItems as $item) : ?>
										<table class="table table-hover">
											<tbody>
											<tr>
												<?php echo Html::tag('td', $item->product_name) ?>
												<?php echo Html::tag('td', $item->quantity.'шт') ?>
												<?php echo Html::tag('td', $item->additionals) ?>
												<?php echo Html::tag('td', 'Общая стоимость '.$item->total_price.'грн') ?>
											</tr>
											</tbody>
										</table>
									<?php endforeach ?>
								</td>
							</tr>
							</tbody>
						</table>
					</div>
				<?php endforeach; ?>
				<?php else : ?>
					<h4>Пользователь еще ни чего не заказывал</h4>
				<?php endif ?>
			</div>
		</div>
	</div>


</div>
