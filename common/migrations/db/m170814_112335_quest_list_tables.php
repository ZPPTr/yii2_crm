<?php

use yii\db\Migration;

class m170814_112335_quest_list_tables extends Migration
{
	public function safeUp()
	{
		$tableOptions = null;
		if ($this->db->driverName === 'mysql') {
			$tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
		}

		$this->createTable('{{%quest_pack}}', [
			'id' => $this->primaryKey(),
			'parent_id' => $this->integer(),
			'title' => $this->string(512)->notNull(),
			'description' => $this->text(),
		], $tableOptions);

		$this->createTable('{{%question}}', [
			'id' => $this->primaryKey(),
			'quest_pack_id' => $this->integer(5),
			'title' => $this->text()->notNull(),
			'description' => $this->text(),
			'sorting' => $this->integer(5),
		], $tableOptions);

		$this->createTable('{{%answer}}', [
			'id' => $this->primaryKey(),
			'question_id' => $this->integer(5)->notNull(),
			'title' => $this->text()->notNull(),
		], $tableOptions);

		$this->createTable('{{%quest_result}}', [
			'quest_pack_id' => $this->integer(5),
			'user_id' => $this->integer(11),
			'created_at' => $this->integer(),
			'body' => $this->text(),
		], $tableOptions);

		$this->createTable('{{%quest_history}}', [
			'user_id' => $this->integer(11),
			'question_id' => $this->integer(11),
			'answer_id' => $this->integer(11),
		], $tableOptions);

		$this->addColumn('{{%question}}', 'parent_answer_id', $this->integer()->defaultValue(0));

		$this->addForeignKey('fk_answer_question', '{{%answer}}', 'question_id', '{{%question}}', 'id', 'cascade', 'cascade');
		$this->addPrimaryKey('pk_quest_result', '{{%quest_result}}', ['quest_pack_id', 'user_id']);
		$this->addPrimaryKey('pk_quest_history', '{{%quest_history}}', ['question_id', 'user_id']);
	}

    public function down()
    {
    	$this->dropPrimaryKey('pk_quest_history', '{{%quest_history}}');
    	$this->dropPrimaryKey('pk_quest_result', '{{%quest_result}}');
        $this->dropForeignKey('fk_answer_question', '{{%answer}}');

        $this->dropTable('{{%quest_history}}');
        $this->dropTable('{{%quest_result}}');
        $this->dropTable('{{%answer}}');
        $this->dropTable('{{%question}}');
        $this->dropTable('{{%quest_pack}}');
    }
}
