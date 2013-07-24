<?php

class m130724_081114_crate_table_tt_tags extends CDbMigration
{
	public function up()
	{
        $this->createTable('tt_tags', array(
            'id' => 'pk',
            'cat_id' => 'integer',
            'tag' => 'string',
            'serial' => 'string',
         ));
	}

	public function down()
	{
        $this->dropTable('tt_tags');
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