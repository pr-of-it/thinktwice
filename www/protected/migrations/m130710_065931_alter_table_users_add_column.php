<?php

class m130710_065931_alter_table_users_add_column extends CDbMigration
{
	public function up()
	{
        $this->addColumn('tt_users', 'phone_verified', 'integer');
        $this->addColumn('tt_users', 'phone_verify_code', 'string');
	}

	public function down()
	{
        $this->dropColumn('tt_users', 'phone_verified');
        $this->dropColumn('tt_users', 'phone_verify_code');
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