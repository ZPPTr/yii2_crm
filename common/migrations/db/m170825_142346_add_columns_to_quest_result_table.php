<?php

use yii\db\Migration;

class m170825_142346_add_columns_to_quest_result_table extends Migration
{
    public function up()
    {
		$this->addColumn('quest_result', 'common_comment', $this->text()->null());
		$this->addColumn('quest_result', 'result', $this->smallInteger()->defaultValue(0));
		$this->addColumn('quest_result', 'delay_to', $this->integer(11)->null());
    }

    public function down()
    {
		$this->dropColumn('quest_result', 'delay_to');
		$this->dropColumn('quest_result', 'result');
		$this->dropColumn('quest_result', 'common_comment');
    }

}
