<?php

use yii\db\Migration;

/**
 * Handles the creation of table `decreased_balance`.
 */
class m200531_141126_create_decreased_balance_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('decreased_balance', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer(11),
            'ym' => $this->integer(6),
            'amount' => $this->float(),
            'comment' => $this->string(255)->defaultValue(''),
            'status' => $this->string(32)
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('decreased_balance');
    }
}
