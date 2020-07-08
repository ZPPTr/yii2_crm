<?php
//use kartik\grid\GridView;
use common\models\stocks\StockOrderItems;
use yii\bootstrap\ActiveForm;
use yii\data\ActiveDataProvider;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;

/**
 * @var $this yii\web\View
 * @var $model common\models\stocks\StockOrder
 * @var $dataProvider ActiveDataProvider
 */

$this->title = Yii::t('backend', 'Редактировать заказ: ') . ' ' . $model->agent->fullName;
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', 'Список заказов'), 'url' => ['oorders']];
$this->params['breadcrumbs'][] = Yii::t('backend', 'Редактировать');
?>
<div class="order-update">
	<?php
	echo DetailView::widget([
        'model' => $model,
        'attributes' => [
            'agent.fullName',
            'agent.email:email',
            'status',
            'created_at:date',
            'completed_at:date',
        ],
    ]);

	echo Html::tag('h3', 'Единицы заказа');
    echo GridView::widget([
    	'dataProvider' => $dataProvider,
        'columns' => [
            'product.name',
            [
            	'label' => 'Вариант',
	            'content' => function ($model) {
    	            return $model->measureText;
	            }
            ],
	        'price',
	        'quantity',
	        [
	        	'label' => 'Всего' ,
		        'value' => function (StockOrderItems $model) {
    	            return $model->price * $model->quantity;
		        }
	        ],
	        'to_coefficient',
	        [
	        	'label' => 'К зачислению в ТО',
		        'content' => function (StockOrderItems $model) {
    	            return round($model->price * $model->quantity / 100 * $model->to_coefficient, 2);
		        }
	        ],
	        [
                'class' => 'yii\grid\ActionColumn',
                'buttons' => [
                    'update' => function($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-pencil"></span>',
                            Url::to(str_replace('update', 'update-order-item', $url)),
                            ['title' => 'Редактировать']
                        );
                    },
	                'delete' => function($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-trash"></span>',
                            Url::to(str_replace('delete', 'delete-order-item', $url)),
                            ['title' => 'Удалить', 'onclick' => 'return confirm(\'Are you sure you want to delete this item\')']
                        );
	                }
                ],
                'template'=>'{update} {delete}'
            ],
        ],
    ]);

	?>
	<hr>
	<div id="add-item-form"></div>
	<p class="text-right">
		<?php echo Html::a('Добавить позицию', 'add-order-item?id='.$model->id,
			[
				'class' => 'btn btn-primary',
				'id' => 'add-order-item',
				'data-order-id' => $model->id,
			]); ?>
	</p>
	<hr>
	<table class="table table-condensed">
		<tbody>
			<tr>
				<th style="width: 100%"><h4><strong>Всего по заказу:</strong></h4></th>
				<th></th>
				<th></th>
			</tr>
			<tr>
				<td>Сумма заказа - </td>
				<td><?php echo $model->totalSum ?></td>
			</tr>
			<tr>
				<td>Ушло в товарооборот - </td>
				<td><?php echo $model->totalTo ?></td>
			</tr>
		</tbody>
	</table>
</div>
