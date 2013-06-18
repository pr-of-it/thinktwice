<?php

class m130618_110925_create_users_table extends CDbMigration
{
	public function up()
	{
        $this->createTable('tt_users', array(
            'id' => 'pk',
            'login' => 'string',
            'password' => 'string',
            'email' => 'string',
            'registered' => 'datetime',
        ));
	}

	public function down()
	{
        $this->dropTable('tt_users');
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