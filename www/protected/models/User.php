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
 * @property string $avatar_file
 * @property string $avatar
 *
 * @property string $amount
 *
 * The followings are the available model relations:
 * @property UserRole $role
 * @property UserService[] $services
 * @property User[] $followers
 * @property UserTransaction[] $transactions
 * @property UserTransactionIncomplete[] $transactions_incomplete
 *
 * @property Blog $blog
 *
 */
class User extends CActiveRecord
{

    const AVATAR_UPLOAD_PATH = '/upload/avatars/';


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
            array('password, name, email', 'length', 'max'=>255),
            array('register_time, update_time, roleid, avatar_file, phone, can_consult, consult_price', 'safe'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('name, email, phone, register_time, update_time, roleid, active, can_consult, avatar_file, consult_price', 'safe', 'on'=>'search'),
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
            'blog' => array(self::HAS_ONE, 'Blog', 'user_id'),
        );
    }

    /*
     * Аватар
     */

    public function hasAvatar() {
        return !empty($this->avatar_file);
    }

    public function getAvatar() {
        if ( !empty($this->avatar_file) ) {
            return Yii::app()->baseUrl . $this->avatar_file;
        } else {
            return Yii::app()->baseUrl . self::AVATAR_UPLOAD_PATH . 'empty.jpg';
        }
    }

    /*
     * Финансы
     */

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

    /*
     * Рейтинг
     */

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

    /*
     * Социальные сети
     */

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

    /*
     * Отслеживание (дружба)
     */

    public function doesFollow($follower_id) {

        foreach ( $this->followers as $follow ) {
            if ( $follower_id == $follow->id )
                return true;
        }
        return false;
    }

    /*
     * Блоги
     */

    public function hasBlog() {
        return !empty($this->blog);
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
            'avatar_file' => Yii::t('User', 'Avatar file'),

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
        $criteria->compare('avatar_file',$this->avatar_file,true);

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

    public function getOperatorCallRequests() {
        return CallRequest::model()->findAllByAttributes(array(
            'status' => CallRequest::STATUS_CREATED));
    }

    public function getExpertCallRequests() {
        return CallRequest::model()->findAllByAttributes(array(
            'status' => CallRequest::STATUS_MODERATED,
            'caller_id' => $this->id
        ));
    }


    public function sendMessage($subject, $message, $methods = array()) {

        if ( empty($methods) )
            $methods = array('email', 'sms');

        if ( in_array('email', $methods) ) {
            Email::sendMail($this->email, $subject, $message);
        }

        if (in_array('sms', $methods)) {
            if ( !empty($this->phone) )
                Sms::send($this->phone, $message);
        }

        return true;

    }

    public static function cryptPassword($password, $salt=null) {
        return crypt($password, $salt);
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

    protected function afterSave() {
        $file = CUploadedFile::getInstance($this, 'avatar_file');
        if ( $file ) {
            $uploaded = Yii::getPathOfAlias('webroot') . self::AVATAR_UPLOAD_PATH . $file->getName();
            $file->saveAs($uploaded);
            $this->avatar_file = self::AVATAR_UPLOAD_PATH . $file->getName();
            $this->saveAttributes(array('avatar_file'=>$this->avatar_file));
        }
        return parent::afterSave();
    }

}