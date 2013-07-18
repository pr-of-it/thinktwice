<?php

class m130718_075653_create_added_subscriptions extends CDbMigration
{
	public function up()
	{
        $this->createTable('tt_added_subscriptions', array(
            'id' => 'pk',
            'user_id' => 'integer',
            'blog_id' => 'integer',
            'expaire' =>'datetime',
        ));
	}

	public function down()
	{
        $this->dropTable('tt_added_subscriptions');
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