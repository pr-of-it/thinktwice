<?php

class m130619_070932_alter_users_add_update_time extends CDbMigration
{
	public function up()
	{
        $this->renameColumn('tt_users', 'registered', 'register_time');
        $this->addColumn('tt_users', 'update_time', 'datetime');
	}

	public function down()
	{
        $this->dropColumn('tt_users', 'update_time');
        $this->renameColumn('tt_users', 'register_time', 'registered');
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