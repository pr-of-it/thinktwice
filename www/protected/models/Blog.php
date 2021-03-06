<?php

/**
 * This is the model class for table "tt_blogs".
 *
 * The followings are the available columns in table 'tt_blogs':
 * @property integer $id
 * @property integer $user_id
 * @property string $title
 * @property integer $type
 * @property integer $month_price
 * @property integer $week_price
 * @property integer $year_price
 * @property text $desc
 *
 * @property User $user
 */
class Blog extends CActiveRecord
{
    const SIMPLE_BLOG = 1;
    const RSS_BLOG = 2;
    const SUBSCRIPT_BLOG =3;
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tt_blogs';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('user_id', 'numerical', 'integerOnly'=>true),
            array('month_price', 'numerical', 'integerOnly'=>true),
            array('week_price', 'numerical', 'integerOnly'=>true),
            array('year_price', 'numerical', 'integerOnly'=>true),
			array('title', 'length', 'max'=>255),
            array('desc', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, user_id, title, desc', 'safe', 'on'=>'search'),
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
            'user' => array(self::BELONGS_TO, 'User', 'user_id'),
            'posts' => array(self::HAS_MANY, 'BlogPost', 'blog_id'),
            'rss' => array(self::HAS_MANY, 'BlogRss', 'blog_id'),
            'rssRequests' => array(self::HAS_MANY, 'BlogRssRequest', 'blog_id'),
   		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'user_id' => 'User',
			'title' => 'Title',
            'type' => 'Type',
            'month_price' => 'Month price',
            'week_price' => 'Week price',
            'year_price' => 'Year price',
            'desc' => 'Desc',
		);
	}

    public function getAllTypes() {
        return array(
            self::SIMPLE_BLOG => 'Блог пользователя',
            self::RSS_BLOG => 'Лента новостей',
            self::SUBSCRIPT_BLOG => 'Подписка (платный блог)',
        );
    }
    public function getAllIdTypes() {
        $ret = array();
        foreach ( $this->getAllTypes() as $id=>$type) {
            $ret[] = array('id'=>$id, 'type'=>$type);
        }
        return $ret;
    }
    public function getTypeLabel($type) {
        $types = $this->getAllTypes();
        return $types[$type];
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
		$criteria->compare('user_id',$this->user_id);
        $criteria->compare('type',$this->type,true);
        $criteria->compare('month_price',$this->month_price,true);
        $criteria->compare('week_price',$this->week_price,true);
        $criteria->compare('year_price',$this->year_price,true);
        $criteria->compare('desc', $this->desc);
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Blog the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

    /**
     * Для корректного формирования JSON из моделей
     * @return CMapIterator the iterator for the foreach statement
     */
    public function getIterator()
    {
        $attributes=$this->getAttributes();
        $relations = array();

        foreach ($this->relations() as $key => $related)
        {
            if ($this->hasRelated($key))
            {
                $relations[$key] = $this->$key;
            }
        }

        $all = array_merge($attributes, $relations);

        return new CMapIterator($all);
    }
}
