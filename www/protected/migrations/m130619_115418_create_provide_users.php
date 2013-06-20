<?php

class m130619_115418_create_provide_users extends CDbMigration
{
	public function up()
	{
            $this->createTable('provide_users', array(
            'id' => 'pk',
            'oauth_provider' => 'varchar',
            'oauth_uid' => 'text',
            'username' => 'text',
            
        ));
	}

	public function down()
	{
		$this->dropTable('provide_users');
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