<?php

class m130619_080147_create_followers_table extends CDbMigration
{
	public function up()
	{
        $this->createTable('tt_followers', array(
            'id' => 'pk',
            'user_id' => 'integer',
            'follower_id' => 'integer',
        ));
	}

	public function down()
	{
        $this->dropTable('tt_followers');
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