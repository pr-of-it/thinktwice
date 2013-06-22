<?php

/**
 * This is the model class for table "tt_users".
 *
 * The followings are the available columns in table 'tt_users':
 * @property string $email
 * @property string $password
 * @property string $name
 * @property string $register_time
 * @property string $update_time
 * @property integer $roleid
 *
 * The followings are the available model relations:
 * @property UserRole $role
 * @property UserService[] $services
 * @property User[] $followers
 */
class User extends CActiveRecord
{

    public $amount;

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
            array('email, password', 'required'),
            array('email', 'unique'),
            array('password, name, email', 'length', 'max'=>255),
			array('register_time, update_time, roleid', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('name, email, register_time, update_time, roleid', 'safe', 'on'=>'search'),
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
            'operations' => array(self::HAS_MANY, 'UserAccountOperation', 'user_id'),
		);
	}

    public function hasService($service) {
        foreach ( $this->services as $s ) {
            if (
                $s->service = $service->getServiceName()
                && $s->service_user_id = $service->id
            ) {
                return true;
            }
        }
        return false;
    }

    public function getAmount() {
        if ( !$this->isNewRecord ) {
            return Yii::app()->db->createCommand("
                SELECT amount_after
                FROM " . UserAccountOperation::model()->tableName() . "
                WHERE user_id=" . $this->id . "
                ORDER BY id DESC
                LIMIT 1
            ")->queryScalar();
        } else {
            return 0;
        }
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

        $criteria->compare('password',$this->password,true);
        $criteria->compare('name',$this->password,true);
		$criteria->compare('email',$this->email,true);
        $criteria->compare('roleid',$this->roleid,true);
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

    public function getRole()
    {
        return $this->role;
    }

    protected function beforeSave() {
        if ( $this->getIsNewRecord() ) {
            $this->password = crypt($this->password);
        }
       parent::beforeSave();
    }
    
}