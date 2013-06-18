<?php

class m130618_130657_insert_admin_user extends CDbMigration
{
	public function up()
	{
        $this->insert('tt_users', array(
            'login' => 'admin',
            'password' => 'a$naBbVaP.9Zo',
            'email' => 'admin@thinktwice.ru',
        ));
	}

	public function down()
	{
        $this->delete('tt_users', array('login' => 'admin'));
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