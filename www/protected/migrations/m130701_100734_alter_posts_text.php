<?php

class m130701_100734_alter_posts_text extends CDbMigration
{
	public function up()
	{
        $this->alterColumn('tt_blog_posts', 'text', 'text');
	}

	public function down()
	{
        $this->alterColumn('tt_blog_posts', 'text', 'string');
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