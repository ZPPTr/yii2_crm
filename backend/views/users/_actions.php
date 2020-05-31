<?php
use yii\bootstrap\Html; ?>

<p>
    <?php echo Html::a(Yii::t('backend', 'Export Bonuses'), ['export-bonuses'], ['class' => 'btn btn-success']) ?>
    <?php echo Html::a(Yii::t('backend', 'Import Bonuses'), ['import-bonuses'], ['class' => 'btn btn-success']) ?>
    <?php echo Html::a(Yii::t('backend', 'Approve Charging Bonuses'), ['approve-payout-of-bonuses'], ['class' => 'btn btn-danger']) ?>
</p>
