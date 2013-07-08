<?php

class m130708_075055_table_blog_post_images extends CDbMigration
{
public function up()
{
    $this->createTable('tt_blog_post_images', array(
        'id' => 'pk',
        'post_id' => 'integer',
        'image' => 'string',
    ));
}

    public function down()
    {
        $this->dropTable('tt_blog_post_images');
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