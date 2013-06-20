<?php

class m130620_093759_tt_user_account_operations extends CDbMigration
{
	public function up()
	{
            $this->createTable('tt_user_account_operations',array(
                'id'=>'pk',
                'user_id'=>'int',
                'amount'=>'money',
                'reason'=>'string',
            ));
	}

	public function down()
	{
             $this->dropTable('tt_user_account_operations');
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