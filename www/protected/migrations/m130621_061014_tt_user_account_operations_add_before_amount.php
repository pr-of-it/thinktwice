<?php

class m130621_061014_alter_tt_useraccountoperations_add_before_amount extends CDbMigration
{
	public function up()
	{
            $this->addColumn('tt_user_account_operations','before_amount','money');
	}

	public function down()
	{
		$this->dropColumn('tt_user_account_operations','before_amount');
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