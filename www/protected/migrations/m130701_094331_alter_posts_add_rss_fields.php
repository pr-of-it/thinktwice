<?php

class m130701_094331_alter_posts_add_rss_fields extends CDbMigration
{
	public function up()
	{
        $this->addColumn('tt_blog_posts', 'rss_id', 'integer');
        $this->addColumn('tt_blog_posts', 'rss_guid', 'string');
	}

	public function down()
	{
        $this->dropColumn('tt_blog_posts', 'rss_guid');
        $this->dropColumn('tt_blog_posts', 'rss_id');
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