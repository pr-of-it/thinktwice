<?php

class m130622_064510_create_user_comments_table extends CDbMigration
{
	public function up()
	{
        $this->createTable('tt_user_comments', array(
            'userId' => 'integer',
            'commentId' => 'integer',
        ));
        $this->addPrimaryKey('pk', 'tt_user_comments', 'userId, commentId');
	}

	public function down()
	{
        $this->dropTable('tt_user_comments');
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