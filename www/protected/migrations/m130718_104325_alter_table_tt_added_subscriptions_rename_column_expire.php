<?php

class m130718_104325_alter_table_tt_added_subscriptions_rename_column_expire extends CDbMigration
{
	public function up()
	{
        $this->renameColumn('tt_added_subscriptions', 'expaire', 'expire');
	}

	public function down()
	{
        $this->renameColumn('tt_added_subscriptions', 'expire', 'expaire');
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