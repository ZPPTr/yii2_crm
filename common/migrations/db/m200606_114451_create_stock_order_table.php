<?php

use yii\db\Migration;

/**
 * Handles the creation of table `stock_order`.
 */
class m200606_114451_create_stock_order_table extends Migration
{
    private $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
    private $tableNameOrder = '{{%stock_order}}';
    private $tableNameItems = '{{%stock_order_items}}';

    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->createTable($this->tableNameOrder, [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer(11),
            'delivery' => $this->smallInteger(),
            'pay_way' => $this->smallInteger(),
            'total_sum' => $this->float(),
            'status' => $this->smallInteger(),
            'address' => $this->string(512)->null(),
            'comment' => $this->string(512)->null(),
            'country_id' => $this->integer(11)->defaultValue(248),
            'created_at' => $this->date(),
            'completed_at' => $this->date()->null(),
        ], $this->tableOptions);

        $this->createTable($this->tableNameItems, [
            'id' => $this->primaryKey(),
            'order_id' => $this->integer(11),
            'product_id' => $this->integer(11),
            'quantity' => $this->integer(11),
            'price' => $this->float(2),
            'to_coefficient' => $this->float(2)->defaultValue(1),
            'variant_id' => $this->integer(11)->null()
        ], $this->tableOptions);

        $this->addForeignKey('fk_stock_order_items_order', $this->tableNameItems, 'order_id', $this->tableNameOrder, 'id', 'CASCADE', 'CASCADE');
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk_stock_order_items_order', $this->tableNameItems);

        $this->dropTable($this->tableNameItems);
        $this->dropTable($this->tableNameOrder);
    }
}
