<?php

class m130712_085655_alter_rss_add_active extends CDbMigration
{
	public function up()
	{
        $this->addColumn('tt_blog_rss', 'active', 'integer DEFAULT 0');
	}

	public function down()
	{
		$this->dropColumn('tt_blog_rss', 'active');
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