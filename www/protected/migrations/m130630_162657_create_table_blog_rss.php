<?php

class m130630_162657_create_table_blog_rss extends CDbMigration
{
	public function up()
	{
        $this->createTable('tt_blog_rss', array(
            'id' => 'pk',
            'blog_id' => 'integer',
            'title' => 'string',
            'url' => 'string'
        ));
	}

	public function down()
	{
		$this->dropTable('tt_blog_rss');
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