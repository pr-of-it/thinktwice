<?php

class m130626_074212_create_table_transactions_incomplete extends CDbMigration
{
	public function up()
	{
        $this->createTable('tt_user_transactions_incomplete', array(
            'id'=>'pk',
            'user_id'=>'int',
            'amount'=>'money',
            'reason'=>'string',
            'time' => 'datetime',
        ));
	}

	public function down()
	{
        $this->dropTable('tt_user_transactions_incomplete');
	}

	/*
	// Use safeUp/safeDown to do migration with transaction
	public function safeUp()
	{
	}

	public function safeDown()
	{
	}
	*/
}