<?php

class m130620_124533_alter_table_user_account_operations_add_time extends CDbMigration
{
	public function up()
	{
            $this->addColumn('tt_user_account_operations', 'time', 'datetime');
	}

	public function down()
	{
            $this->dropColumn('tt_user_account_operations', 'time');
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