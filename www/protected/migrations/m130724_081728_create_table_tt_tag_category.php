<?php

class m130724_081728_create_table_tt_tag_category extends CDbMigration
{
	public function up()
	{
        $this->createTable('tt_tag_category', array(
            'id' => 'pk',
            'name' => 'string',
            'left' => 'integer',
            'right' => 'integer',
            'level' => 'integer',
        ));
        $this->createIndex('set', 'tt_tag_category', 'left, right, level');
	}

	public function down()
	{
        $this->dropIndex('set', 'tt_tag_category');
        $this->dropTable('tt_tag_category');
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