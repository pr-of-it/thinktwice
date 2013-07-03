<?php

class m130703_094630_alter_tt_blogs_add_type extends CDbMigration
{
	public function up()
	{
        $this->addColumn('tt_blogs', 'type', 'integer');
	}

	public function down()
	{
        $this->dropColumn('tt_blogs', 'type');
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