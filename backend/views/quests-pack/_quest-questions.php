<?php

use dosamigos\chartjs\ChartJs;

?>
<div class="row">
	<?php foreach($quest->questions as $question) : ?>
	<div class="col-xs-12">
		<!-- small box -->
		<div class="small-box bg-aqua">
			<div class="inner">
				<div class="row">
					<div class="col-sm-8">
						<h4><?php echo $question->title ?></h4>
						<?php
						$cart_labels = [];
						$chart_values = [];
						foreach($question->answers as $answer) : ?>
							<p><?php echo $answer->title ?>............................<?php echo $answer->countReceivedAnswer ?></p>
							<?php
								$cart_labels[] = $answer->title;
								$chart_values[] = $answer->countReceivedAnswer;
							?>
							<? //_debug(Json::encode($cart_labels)) ?>
						<?php endforeach; ?>
					</div>
					<div class="col-sm-3">
						<?= ChartJs::widget([
							'type' => 'doughnut',
							'options' => [
								'height' => 400,
								'width' => 400
							],
							'data' => [
								'labels' => $cart_labels,
								'datasets' => [
									[
										'label' => "My Second dataset",
										'backgroundColor' => ['#00A65A', '#F39C12', '#3C8DBC', '#F56954'],
										'borderColor' => "#fff",
										'pointBackgroundColor' => "rgba(255,255,255,1)",
										'pointBorderColor' => "#fff",
										'pointHoverBackgroundColor' => "#fff",
										'pointHoverBorderColor' => "rgba(255,99,132,1)",
										'data' => $chart_values
									]
								]
							]
						]);
						?>
					</div>
				</div>

			</div>
			<!--<div id="myfirstchart" style="height: 250px;"></div>-->

			<div class="icon">
				<i class="fa fa-question-circle"></i>
			</div>
		</div>
	</div>
	<?php endforeach ?>
</div>