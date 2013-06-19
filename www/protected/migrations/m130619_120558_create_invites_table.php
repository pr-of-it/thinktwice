<?php

class m130619_120558_create_invites_table extends CDbMigration
{
	public function up()
	{
        $this->createTable('tt_invites', array(
            'id' => 'pk',
            'inviter_user_id' => 'integer',
            'email' => 'string',
            'code' => 'character varying (12)',
        ));
	}

	public function down()
	{
        $this->dropTable('tt_invites');
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