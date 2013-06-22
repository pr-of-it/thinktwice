<?php

class m130622_063731_create_comments_table extends CDbMigration
{
	public function up()
	{
        $this->createTable('comments', array(
            'id' => 'pk',
            'message' => 'text',
            'userId' => 'integer',
            'createDate' => 'datetime',
        ));
	}

	public function down()
	{
        $this->dropTable('comments');
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