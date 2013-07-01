<?php

class m130701_064037_create_blog_posts_table extends CDbMigration
{
	public function up()
	{
        $this->createTable('tt_blog_posts', array(
            'id' => 'pk',
            'blog_id' => 'integer',
            'title' => 'string',
            'text' => 'string',
            'time' => 'datetime',
        ));
	}

	public function down()
	{
		$this->dropTable('tt_blog_posts');
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