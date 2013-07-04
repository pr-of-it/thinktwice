<?php

class m130704_094007_blog_posts_add_image extends CDbMigration
{
	public function up()
	{
        $this->addColumn('tt_blog_posts', 'image', 'string');
	}

	public function down()
	{
		$this->dropColumn('tt_blog_posts', 'image');
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