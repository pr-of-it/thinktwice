<?php

class m130621_061909_tt_useramountoperation_after_amount extends CDbMigration
{
	public function up()
	{
            $this->addColumn('tt_user_account_operations', 'after_amount', 'money');
	}

	public function down()
	{
		$this->dropColumn('tt_user_account_operations', 'after_amount');
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