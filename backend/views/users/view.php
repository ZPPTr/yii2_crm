<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $model common\models\Users */
/* @var $orders common\models\Orders */

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
						'name',
						'surname',
						'patronymic',
						'email:email',
						'phone',
						//'country_id',
						//'city_id',
						'city',
						'address',
						//'address_cor',

						'photo',
						//'photo_thumb',
						'date_time',
						//'prolongation_at',
						//'ranking_at',
						//'controlled_at',
						//'salt',
						//'is_active',
						//'is_valid',


						//'is_valid_card',

						//'agent_id',
					],
				]) ?>
			</div>


		</div>
		<div class="col-md-6">
			<div class="box box-warning orders-list">
				<div class="box-header with-border">
					<h3 class="box-title">Заказы пользователя</h3>
				</div>
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
									<?php foreach($order->orderItems as $item) :
										//_debug($item);?>
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
			</div>
		</div>
	</div>


</div>
