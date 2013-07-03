<?php

require __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'models' . DIRECTORY_SEPARATOR . 'UserRole.php';

class m130703_075543_alter_table_users_roles_add_user_rss extends CDbMigration
{
	public function up()
	{
        $this->insert('tt_user_roles', array(
            'id' => '7',
            'name' => 'rss',
        ));
	}

	public function down()
	{
        $role = UserRole::model()->findByAttributes(array('name' => 'rss'));
        $role->delete();
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