<?php

/**
 * This is the model class for table "tt_tag_category".
 *
 * The followings are the available columns in table 'tt_tag_category':
 * @property integer $id
 * @property string $name
 * @property integer $left
 * @property integer $right
 * @property integer $level
 */
class TagCategory extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tt_tag_category';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			#array('left, right, level', 'numerical', 'integerOnly'=>true),
			array('name', 'length', 'max'=>255),
            array('right, left, level', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, name, left, right, level', 'safe', 'on'=>'search'),
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
            'tag' => array(self::HAS_MANY, 'Tag', 'cat_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
    public function behaviors()
    {
        return array(
            'nestedSetBehavior'=>array(
                'class'=>'ext.nested-set.NestedSetBehavior',
                'leftAttribute'=>'left',
                'rightAttribute'=>'right',
                'levelAttribute'=>'level',


            ),
        );
    }

	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'name' => 'Name',
			'left' => 'Left',
			'right' => 'Right',
			'level' => 'Level',
		);
	}

    public function getTree($nil = false) {
        $data = self::model()->findAll();
        if ( $nil ) {
            $nil = new stdClass();
            $nil->id = 0;
            $nil->name = '---';
            $nil->level = 0;
            $data = array_merge(array($nil), $data);
        }
        return $data;
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
		$criteria->compare('name',$this->name,true);
		$criteria->compare('left',$this->left);
		$criteria->compare('right',$this->right);
		$criteria->compare('level',$this->level);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return TagCategory the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
