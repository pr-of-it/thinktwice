<?php

class m130709_111502_alter_table_call_request_add_column extends CDbMigration
{
	public function up()
	{
        $this->addColumn('tt_call_requests', 'duration','integer');
        $this->addColumn('tt_call_requests', 'call_time','datetime');
        $this->addColumn('tt_call_requests', 'alter_call_time_1','datetime');
        $this->addColumn('tt_call_requests', 'alter_call_time_2','datetime');
	}

	public function down()
	{
        $this->dropColumn('tt_call_requests', 'duration');
        $this->dropColumn('tt_call_requests', 'call_time');
        $this->dropColumn('tt_call_requests', 'alter_call_time_1');
        $this->dropColumn('tt_call_requests', 'alter_call_time_2');
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