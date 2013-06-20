<?php

class m130619_093127_create_user_roles_table extends CDbMigration
{
	public function up()
	{

        require __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'models' . DIRECTORY_SEPARATOR . 'User.php';
        require __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'models' . DIRECTORY_SEPARATOR . 'UserRole.php';

        $this->createTable('tt_user_roles', array(
            'id' => 'pk',
            'name' => 'string',
        ));
        $this->insert('tt_user_roles', array(
            'name' => 'user',
        ));
        $this->insert('tt_user_roles', array(
            'name' => 'operator',
        ));
        $this->insert('tt_user_roles', array(
            'name' => 'moderator',
        ));
        $this->insert('tt_user_roles', array(
            'name' => 'expert',
        ));
        $this->insert('tt_user_roles', array(
            'name' => 'lector',
        ));
        $this->insert('tt_user_roles', array(
            'name' => 'admin',
        ));

        $role = UserRole::model()->findByAttributes(array('name' => 'user'));
        $this->addColumn('tt_users', 'roleid', 'integer DEFAULT ' . $role->id);

        $admin = User::model()->findByAttributes(array('login' => 'admin'));
        $role = UserRole::model()->findByAttributes(array('name' => 'admin'));

        $this->execute('UPDATE tt_users SET roleid=' . $role->id . ' WHERE id=' . $admin->id);

    }

	public function down()
	{
        $this->dropColumn('tt_users', 'roleid');
        $this->dropTable('tt_user_roles');
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