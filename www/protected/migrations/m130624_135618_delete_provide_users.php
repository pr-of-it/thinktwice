<?php

class m130624_135618_delete_provide_users extends CDbMigration
{
	public function up()
	{
        $this->dropTable('provide_users');
	}

	public function down()
	{
        $this->createTable('provide_users', array(
            'id' => 'pk',
            'oauth_provider' => 'varchar',
            'oauth_uid' => 'text',
            'username' => 'text',
        ));
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