<?php

class m130712_084159_alter_table_users_alter_column_consult_schedule_json extends CDbMigration
{
	public function up()
	{
        $this->alterColumn('tt_users','consult_schedule_json','text');

	}

	public function down()
	{
        $this->alterColumn('tt_users','consult_schedule_json','string');

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