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
 * @property text $consult_schedule_json
 * @property string $auth_token
 * @property string $auth_token_expire
 *
 * @property string $amount
 * @property string avatar
 *
 * The followings are the available model relations:
 * @property UserRole $role
 * @property UserService[] $services
 * @property User[] $subscripts
 * @property User[] $followers
 * @property UserTransaction[] $transactions
 * @property UserTransactionIncomplete[] $transactions_incomplete
 * @property Blog $blog
 * @property Blog[] $subscriptions
 * @property Blog[] $feeds
 *
 */
class User extends CActiveRecord
{

    /**
     * Путь, где хранятся файлы аватаров пользователей
     */
    const AVATAR_UPLOAD_PATH = '/upload/avatars/';

    /**
     * Время жизни токена авторизации, в секундах
     */
    const AUTH_TOKEN_EXPIRE_TIME = 86400;

    /**
     * Относительная ссылка на аватар пользователя
     * @var string $avatar
     */
    public $avatar;

    /**
     * Массив, содержащий расписание консультаций
     * @var array $consultSchedule
     */
    public $consultSchedule = array();

    /**
     * Флаг, указывающий подписан ли текущий пользователь (follow) на данного
     * @var bool $isCurrentUserSubscribed
     */
    public $isCurrentUserSubscribed;


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
            array('consult_price', 'default', 'value'=>0 ),
            array('password, name, email', 'length', 'max'=>255),
            array('register_time, update_time, roleid, avatar_file, phone', 'safe'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('name, email, phone, register_time, update_time, roleid, active, can_consult, avatar_file, consult_price, consult_schedule_json', 'safe', 'on'=>'search'),
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
            // те, на кого подписан пользователь:
            'subscripts' => array(self::MANY_MANY, 'User', 'tt_followers(user_id, follower_id)'),
            // те, кто подписан на пользователя:
            'followers' => array(self::MANY_MANY, 'User', 'tt_followers(follower_id, user_id)'),
            'transactions' => array(self::HAS_MANY, 'UserTransaction', 'user_id'),
            'transactions_incomplete' => array(self::HAS_MANY, 'UserTransactionIncomplete', 'user_id'),
            'blog' => array(self::HAS_ONE, 'Blog', 'user_id', 'condition'=>'blog.type=' . Blog::SIMPLE_BLOG),
            'subscriptions' => array(self::HAS_MANY, 'Blog', 'user_id', 'condition'=>'subscriptions.type=' . Blog::SUBSCRIPT_BLOG),
            'feeds' => array(self::HAS_MANY, 'Blog', 'user_id', 'condition'=>'feeds.type=' . Blog::RSS_BLOG),
            'addedSubscriptions' => array(self::HAS_MANY, 'AddedSubscription', 'user_id'),

        );
    }

    /*
     * Авторизация через токен
     */
    public function getAuthToken() {
        if ( empty($this->auth_token) || time() > strtotime($this->auth_token_expire) ) {
            $this->generateAuthToken();
        }
        return $this->auth_token;
    }

    public function generateAuthToken() {
        $this->auth_token = substr(md5($this->register_time), 0, 2) . base_convert(time(), 10, 36);
        $this->auth_token_expire = date('Y-m-d H:i:s', time()+self::AUTH_TOKEN_EXPIRE_TIME);
        $this->save();
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
     * Подписка (follow)
     */

    /**
     * Метод возвращает
     * - true, если текущий пользователь сайта подписан на данного (follow его)
     * - false в противном случае
     * @return bool
     */
    public function getIsCurrentUserSubscribed() {
        if ( Yii::app()->user->isGuest )
            return false;
        $id = Yii::app()->user->id;
        foreach ( $this->followers as $follower ) {
            if ( $id == $follower->id )
                return true;
        };
        return false;
    }

    /*
     * Блоги
     */

    public function hasBlog() {
        return !empty($this->blog);
    }

    public function getAllBlogs() {
        if ( $this->hasBlog() ) {
            $this->blog->title .= ' (Личный блог)';
        }
        foreach ( $this->subscriptions as $blog )
            $blog->title .= ' (Подписка)';
        foreach ( $this->feeds as $blog )
            $blog->title .= ' (Лента)';
        return array_merge( $this->blog ? array($this->blog) : array(), (array)$this->subscriptions, (array)$this->feeds);
    }

    public function getAllBlogIds() {
        if ( $this->hasBlog() ) {
            $this->blog->id;
        }
        foreach ( $this->subscriptions as $blog )
            $blog->id;
        foreach ( $this->feeds as $blog )
            $blog->id;
        return array_merge( $this->blog ? array($this->blog) : array(), (array)$this->subscriptions, (array)$this->feeds);
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
            'subscripts' => Yii::t('User', 'Subscripts'),
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

        $this->consultSchedule = json_decode($this->consult_schedule_json);

        //$this->isCurrentUserSubscribed = $this->getIsCurrentUserSubscribed();

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

        $this->consult_schedule_json = json_encode($this->consultSchedule);

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
        if ( $code == $this->phone_verify_code ) {
            $this->phone_verified = 1;
            return $this->save();
        } else {
            return false;
        }
    }
}