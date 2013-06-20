<?php

class m130619_185701_create_table_user_services extends CDbMigration
{
	public function up()
	{
        $this->createTable('tt_user_services', array(
            'id' => 'pk',
            'user_id' => 'integer',
            'service' => 'string',
            'service_user_id' => 'string',
            'service_user_name' => 'string',
        ));
	}

	public function down()
	{
        $this->dropTable('tt_user_services');
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