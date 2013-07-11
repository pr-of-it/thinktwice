<?php

class m130711_105803_alter_table_users_add_column_consult_schedule_json extends CDbMigration
{
    public function up()
    {
        $this->addColumn('tt_users','consult_schedule_json', 'string');
    }

    public function down()
    {
        $this->dropColumn('tt_users','consult_schedule_json');
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
