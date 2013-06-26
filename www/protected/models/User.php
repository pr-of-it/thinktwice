<?php

/**
 * This is the model class for table "tt_users".
 *
 * The followings are the available columns in table 'tt_users':
 * @property string $email
 * @property string $password
 * @property string $name
 * @property string $phone
 * @property string $register_time
 * @property string $update_time
 * @property integer $roleid
 * @property integer $active
 * @property integer $can_consult
 * @property string $consult_price
 * @property string $avatar
 *
 * The followings are the available model relations:
 * @property UserRole $role
 * @property UserService[] $services
 * @property User[] $followers
 * @property UserTransaction[] $transactions
 * @property UserTransactionIncomplete[] $transactions_incomplete
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
            array('active, can_consult', 'boolean'),
            array('consult_price', 'numerical'),
            array('password, name, email', 'length', 'max'=>255),
			array('register_time, update_time, roleid, avatar, phone', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('name, email, phone, register_time, update_time, roleid, active, can_consult, avatar, consult_price', 'safe', 'on'=>'search'),
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
            'transactions' => array(self::HAS_MANY, 'UserTransaction', 'user_id'),
            'transactions_incomplete' => array(self::HAS_MANY, 'UserTransactionIncomplete', 'user_id'),
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
                FROM " . UserTransaction::model()->tableName() . "
                WHERE user_id=" . $this->id . "
                ORDER BY id DESC
                LIMIT 1
            ")->queryScalar();
        } else {
            return 0;
        }
    }


    public function getRating() {
        if ( !$this->isNewRecord ) {
            $result=Yii::app()->db->createCommand("
                SELECT AVG(rate)
                FROM ". UserRating::model()->tableName() ."
                WHERE user_id=" . $this->id . "
            ")->queryScalar();
            return $result;
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
            ),
            'commentable' => array(
                'class' => 'ext.comment-module.behaviors.CommentableBehavior',
                // name of the table created in last step
                'mapTable' => 'tt_user_comments',
                // name of column to related model id in mapTable
                'mapRelatedColumn' => 'userId'
            ),
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
			'phone' => Yii::t('User', 'Phone'),
			'email' => Yii::t('User', 'E-mail'),
			'active' => Yii::t('User', 'Active'),
			'register_time' => Yii::t('User', 'Register time'),
			'update_time' => Yii::t('User', 'Update time'),
			'followers' => Yii::t('User', 'Followers'),
			'roleid' => Yii::t('User', 'Role ID'),
			'role' => Yii::t('User', 'Role'),
			'can_consult' => Yii::t('User', 'Can consult'),
			'consult_price' => Yii::t('User', 'Consult price'),
            'avatar' => Yii::t('User', 'Avatar'),

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
        $criteria->compare('active',$this->active,true);
		$criteria->compare('register_time',$this->register_time,true);
		$criteria->compare('update_time',$this->update_time,true);
        $criteria->compare('can_consult',$this->can_consult,true);
        $criteria->compare('consult_price',$this->consult_price,true);
        $criteria->compare('avatar',$this->avatar,true);

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

    public static function cryptPassword($password) {
        return crypt($password);
    }

    protected function beforeSave() {
        if ( $this->getIsNewRecord() ) {
            $this->password = self::cryptPassword($this->password);
        } else {
            $old_password = self::model()->findByPk($this->id)->password;
            if ( $old_password != $this->password ) {
                $this->password = self::cryptPassword($this->password);
            }
        }
       return parent::beforeSave();
    }

}