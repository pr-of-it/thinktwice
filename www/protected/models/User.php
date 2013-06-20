<?php

/**
 * This is the model class for table "tt_users".
 *
 * The followings are the available columns in table 'tt_users':
 * @property string $login
 * @property string $password
 * @property string $name
 * @property string $email
 * @property string $register_time
 * @property string $update_time
 * @property integer $roleid
 *
 * The followings are the available model relations:
 * @property UserRole $role
 * @property UserService[] $servoces
 * @property User[] $followers
 */
class User extends CActiveRecord
{
    /**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tt_users';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
            array('login, password, email', 'required'),
            array('login, email', 'unique'),
            array('login, password, name, email', 'length', 'max'=>255),
			array('register_time, update_time', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('login, password, name, email, register_time, update_time, roleid', 'safe', 'on'=>'search'),
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
            'role' => array(self::BELONGS_TO, 'UserRole', 'roleid'),
            'services' => array(self::HAS_MANY, 'UserService', 'user_id'),
            'followers' => array(self::MANY_MANY, 'User', 'tt_followers(user_id, follower_id)'),
		);
	}

    /**
     * @return array behaviors
     */
    public function behaviors(){
        return array(
            'CTimestampBehavior' => array(
                'class' => 'zii.behaviors.CTimestampBehavior',
                'createAttribute' => 'register_time',
                'updateAttribute' => 'update_time',
                'setUpdateOnCreate' => true,
                'timestampExpression' => new CDbExpression('NOW()'),
            )
        );
    }

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'login' => Yii::t('User', 'Login'),
			'password' => Yii::t('User', 'Password'),
			'name' => Yii::t('User', 'Name'),
			'email' => Yii::t('User', 'E-mail'),
			'register_time' => Yii::t('User', 'Register time'),
			'update_time' => Yii::t('User', 'Update time'),
			'followers' => Yii::t('User', 'Followers'),
			'roleid' => Yii::t('User', 'Role ID'),
			'role' => Yii::t('User', 'Role'),
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

		$criteria->compare('login',$this->login,true);
        $criteria->compare('password',$this->password,true);
        $criteria->compare('name',$this->password,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('register_time',$this->register_time,true);
		$criteria->compare('update_time',$this->update_time,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return User the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

    protected function beforeSave() {
        if ( $this->getIsNewRecord() ) {
            $this->password = crypt($this->password);
        }
        return true;
    }
    
}