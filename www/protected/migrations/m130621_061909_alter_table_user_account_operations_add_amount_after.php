<?php

class m130621_061909_alter_table_user_account_operations_add_amount_after extends CDbMigration
{
	public function up()
	{
            $this->addColumn('tt_user_account_operations','amount_after', 'money');
	}

	public function down()
	{
		$this->dropColumn('tt_user_account_operations','amount_after');
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