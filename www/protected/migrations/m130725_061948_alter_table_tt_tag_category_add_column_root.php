<?php

class m130725_061948_alter_table_tt_tag_category_add_column_root extends CDbMigration
{
	public function up()
	{
        $this->addColumn('tt_tag_category', 'root', 'integer');
	}

	public function down()
	{
		$this->dropColumn('tt_tag_category', 'root');
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