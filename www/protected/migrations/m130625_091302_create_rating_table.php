<?php

class m130625_091302_create_rating_table extends CDbMigration
{
	public function up()
	{
        $this->createTable('tt_user_rating',array(
            'id'=>'pk',
            'user_id'=>'integer',
            'rater_id'=>'integer',
            'rate'=>'integer',
            'date'=>'datetime'
        ));
	}

	public function down()
	{
		$this->dropTable('tt_user_rating');
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