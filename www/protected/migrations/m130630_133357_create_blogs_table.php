<?php

class m130630_133357_create_blogs_table extends CDbMigration
{
	public function up()
	{
        $this->createTable('tt_blogs', array(
            'id' => 'pk',
            'user_id' => 'integer',
            'title' => 'string',
        ));
	}

	public function down()
	{
		$this->dropTable('tt_blogs');
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