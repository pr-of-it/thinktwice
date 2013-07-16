<?php

/**
 * This is the model class for table "tt_blog_rss".
 *
 * The followings are the available columns in table 'tt_blog_rss':
 * @property integer $id
 * @property integer $blog_id
 * @property string $title
 * @property string $url
 * @property integer $active
 */
class BlogRss extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tt_blog_rss';
	}


	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('blog_id', 'numerical', 'integerOnly'=>true),
			array('active', 'numerical', 'integerOnly'=>true),
			array('title, url', 'length', 'max'=>255),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, blog_id, title, url, active', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
            'blog' => array(self::BELONGS_TO, 'Blog', 'blog_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'blog_id' => 'Blog ID',
			'title' => 'Title',
			'url' => 'Url',
			'active' => 'Active',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('blog_id',$this->blog_id);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('url',$this->url,true);
		$criteria->compare('active',$this->active,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return BlogRss the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
