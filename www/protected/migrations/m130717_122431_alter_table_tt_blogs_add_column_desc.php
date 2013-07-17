<?php

class m130717_122431_alter_table_tt_blogs_add_column_desc extends CDbMigration
{
	public function up()
	{
        $this->addColumn('tt_blogs', 'desc', 'text');
	}

	public function down()
	{
        $this->dropColumn('tt_blogs', 'desc');
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