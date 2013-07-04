<?php

class m130704_070845_alter_table_blogs_add_month_price extends CDbMigration
{
    public function up()
    {
        $this->addColumn('tt_blogs', 'month_price', 'integer');
    }

    public function down()
    {
        $this->dropColumn('tt_blogs', 'month_price');
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