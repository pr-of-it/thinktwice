<?php

class m130703_091527_table_blog_rss_request extends CDbMigration
{
    public function up()
    {
        $this->createTable('tt_blog_rss_requests', array(
            'id' => 'pk',
            'blog_id' => 'integer',
            'title' => 'string',
            'url' => 'string'
        ));
    }

    public function down()
    {
        $this->dropTable('tt_blog_rss_requests');
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