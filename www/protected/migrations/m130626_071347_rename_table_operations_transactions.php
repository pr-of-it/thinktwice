<?php

class m130626_071347_rename_table_operations_transactions extends CDbMigration
{
	public function up()
	{
        $this->renameTable('tt_user_account_operations', 'tt_user_transactions');
	}

	public function down()
	{
        $this->renameTable('tt_user_transactions', 'tt_user_account_operations');
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