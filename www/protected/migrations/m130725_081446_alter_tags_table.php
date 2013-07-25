<?php

class m130725_081446_alter_tags_table extends CDbMigration
{
	public function up()
	{
        $this->renameColumn('tt_tags', 'tag', 'title');
    }

	public function down()
	{
        $this->renameColumn('tt_tags', 'title', 'tag');
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