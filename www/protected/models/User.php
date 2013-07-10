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
 * @property string $phone_verify_code
 * @property integer $phone_verified
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
     * @var string $avatar
     */
    public $avatar;

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
            array('register_time, update_time, roleid, avatar_file, phone', 'safe'),
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
            'blog' => array(self::HAS_ONE, 'Blog', 'user_id', 'condition'=>'blog.type=' . Blog::SIMPLE_BLOG),
            'subscriptions' => array(self::HAS_MANY, 'Blog', 'user_id', 'condition'=>'subscriptions.type=' . Blog::SUBSCRIPT_BLOG),

        );
    }

    /*
     * Аватар
     */

    public function hasAvatar() {
        return !empty($this->avatar_file);
    }

    /*
     * Финансы
     */

    public function getAmount() {
        if ( !$this->isNewRecord ) {
            $result = Yii::app()->db->createCommand("
                SELECT amount_after
                FROM " . UserTransaction::model()->tableName() . "
                WHERE user_id=" . $this->id . "
                ORDER BY id DESC
                LIMIT 1
            ")->queryScalar();
            return $result ?: 0;
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

    public function getAllBlogs() {
        $this->blog->title .= ' (Личный блог)';
        foreach ( $this->subscriptions as $blog )
            $blog->title .= ' (Подписка)';
        return array_merge( array($this->blog), (array)$this->subscriptions);
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
            'phone_verify_code' => Yii::t('User', 'Phone verify code'),
            'phone_verified' => Yii::t('User', 'Phone verified'),


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
        $criteria->compare('phone_verified',$this->phone_verified,true);
        $criteria->compare('phone_verify_code',$this->phone_verify_code,true);

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

    public function getExpertClosest() {
        return CallRequest::model()->findAllByAttributes(array(
            'status' => CallRequest::STATUS_ACCEPTED,
            'caller_id' => $this->id,

        ));
    }

    public  function getModeratorRssRequest() {
        return BlogRssRequest::model()->findAll();
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

    /*
     * ------------------------ BEFORE/AFTER методы ---------------------------------------
     */

    protected function afterFind() {
        if ( !empty($this->avatar_file) ) {
            $this->avatar = Yii::app()->baseUrl . $this->avatar_file;
        } else {
            $this->avatar = Yii::app()->baseUrl . self::AVATAR_UPLOAD_PATH . 'empty.jpg';
        }
        return parent::afterFind();
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
        if ( $this->isNewRecord ) {
            $blog = new Blog;
            $blog->user_id = $this->id;
            $blog->title = '';
            $blog->month_price = 0;
            $blog->week_price = 0;
            $blog->type = Blog::SIMPLE_BLOG;
            $blog->save();
        }
        return parent::afterSave();
    }

    /**
     * Для корректного формирования JSON из моделей
     * @return CMapIterator the iterator for the foreach statement
     */
    public function getIterator()
    {
        $attributes=$this->getAttributes();
        $vars = get_object_vars($this);
        $relations = array();

        foreach ($this->relations() as $key => $related)
        {
            if ($this->hasRelated($key))
            {
                $relations[$key] = $this->$key;
            }
        }

        $all = array_merge($attributes, $vars, $relations);

        return new CMapIterator($all);
    }

    public function doPhoneVerify() {

        $code = substr(md5(time() . $this->phone), 0, 6);
        $this->phone_verify_code = $code;
        $this->save();

        $this->sendMessage(
            'Код подтверждения',
            'Введите код подтверждения: ' . $this->phone_verify_code,
            array('sms')
        );

        return $this->phone_verify_code;

    }

    public function verifyPhoneCode($code) {
        return $code == $this->phone_verify_code;
    }
}