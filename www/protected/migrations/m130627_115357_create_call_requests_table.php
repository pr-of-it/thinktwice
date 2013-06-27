<?php

class m130627_115357_create_call_requests_table extends CDbMigration
{

	public function up()
	{
        $this->createTable('tt_call_requests', array(
            'id' => 'pk',
            'user_id' => 'integer',
            'caller_id' => 'integer',
            'title' => 'string',
            'text' => 'text',
            'status' => 'integer DEFAULT 0',
            'call_time' => 'time',
            'alter_call_time_1' => 'time',
            'alter_call_time_2' => 'time',
            'duration' => 'time',
            'comments' => 'text',
        ));
	}

	public function down()
	{
		$this->dropTable('tt_call_requests');
	}

}