<?php

class m130716_063602_alter_table_blog_post_images_rename extends CDbMigration
{
	public function up()
	{
        $this->renameColumn('tt_blog_post_images', 'image', 'url');
        $this->addColumn('tt_blog_post_images', 'type', 'string');
        $this->renameTable('tt_blog_post_images', 'tt_blog_post_media');

	}

	public function down()
	{
        $this->renameTable('tt_blog_post_media', 'tt_blog_post_images');
        $this->dropColumn('tt_blog_post_images', 'type');
        $this->renameColumn('tt_blog_post_images', 'url', 'image');
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