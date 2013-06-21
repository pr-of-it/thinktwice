<?php

class m130621_061014_tt_user_account_operations_add_amount_before extends CDbMigration
{
	public function up()
	{
            $this->addColumn('tt_user_account_operations','amount_before','money');                
	}

	public function down()
	{
		$this->dropColumn('tt_user_account_operations','amount_before');
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