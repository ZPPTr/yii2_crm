<?php

use common\models\shop\ProductVariants;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\User */

$this->title = $model->fullName;
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', 'Stock'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-view">

    <?php echo DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'fullName',
            'number',
            'email:email',
        ],
    ]); ?>

	<div class="box box-default">
		<div class="box-header with-border">
			<h3 class="box-title">
				<i class="fa fa-cart-arrow-down"></i>
				Ассортимент склада
			</h3>
		</div>
		<!-- /.card-header -->
		<div class="box-body">
        <?php foreach ($model->items as $index => $item) :
    	    $accentClass = ($index > 0)
		        && ($model->items[$index-1]->product_id == $item->product_id)
		        && ($model->items[$index-1]->variant_id == $item->variant_id)
			    ? 'danger' : 'info';

            /** @var ProductVariants $productVariant */
            $productVariant = $item->product->getVariant($item->variant_id);
			$variantMeasure = '';
            $variantId = '';
			if ($productVariant) {
				$variantMeasure = ': '.$productVariant->measure_value.' '.$productVariant->measure->title;
				$variantId = $productVariant->id;
			}

			$additionalInfo = 'Product ID - '.$item->id;
			$additionalInfo .= $variantId ? ' | Вариант ID - '.$variantId : '';
    	?>
	    <div class="callout callout-<?php echo $accentClass ?>">
		    <?php echo Html::button('×', [
		    	'class' => 'close delete-stock-item',
			    'data-dismiss' => 'alert',
			    'aria-hidden' => 'true',
			    'onClick' => 'deleteStockItem('.$item->id.', this)'
		    ]) ?>
		    <?php echo Html::tag('h4', $item->product->name.$variantMeasure.' - '.$item->count.'шт.')  ?>
		    <?php echo Html::tag('p', $additionalInfo) ?>
	    </div>
    	<?php endforeach; ?>
		</div><!-- /.card-body -->
	</div>
</div>
