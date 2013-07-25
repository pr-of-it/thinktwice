<?php

class m130725_071027_alter_table_tt_blogs_add_column_year_price extends CDbMigration
{
	public function up()
	{
        $this->addColumn('tt_blogs','year_price','integer');
	}

	public function down()
	{
		$this->dropColumn('tt_blogs','year_price');
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