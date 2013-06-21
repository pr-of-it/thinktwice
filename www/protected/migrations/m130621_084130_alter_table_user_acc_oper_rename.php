<?php

class m130621_084130_alter_table_user_acc_oper_rename extends CDbMigration
{
	public function up()
	{
        $this->renameColumn('tt_user_account_operations','before_amount','amount_before');
        $this->renameColumn('tt_user_account_operations','after_amount','amount_after');
	}

	public function down()
	{
        $this->renameColumn('tt_user_account_operations','amount_before','before_amount');
        $this->renameColumn('tt_user_account_operations','amount_after','after_amount');
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