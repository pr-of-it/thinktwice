<?php

class m130704_093848_alter_table_blogs_add_week_price extends CDbMigration
{
    public function up()
    {
        $this->addColumn('tt_blogs', 'week_price', 'integer');
    }

    public function down()
    {
        $this->dropColumn('tt_blogs', 'week_price');
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