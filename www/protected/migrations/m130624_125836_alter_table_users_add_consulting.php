<?php

class m130624_125836_alter_table_users_add_consulting extends CDbMigration
{
	public function up()
	{
        $this->addColumn('tt_users', 'can_consult', 'integer');
        $this->addColumn('tt_users', 'consult_price', 'money');
	}

	public function down()
	{
        $this->dropColumn('tt_users', 'consult_price');
        $this->dropColumn('tt_users', 'can_consult');
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