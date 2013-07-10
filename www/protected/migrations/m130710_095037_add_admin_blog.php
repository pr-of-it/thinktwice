<?php

class m130710_095037_add_admin_blog extends CDbMigration
{
	public function up()
	{
        $admin = User::model()->findByAttributes(array('email' => 'admin@thinktwice.ru'));

        $this->insert('tt_blogs', array(
            'user_id' => $admin->id,
            'title' => 'Блог администратора сайта',
            'type' => Blog::SIMPLE_BLOG,
        ));
	}

	public function down()
	{
        $admin = User::model()->findByAttributes(array('email' => 'admin@thinktwice.ru'));

        $this->delete('tt_blogs', array(
            'user_id' => $admin->id,
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