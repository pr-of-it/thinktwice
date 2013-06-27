<?php

/**
 * This is the model class for table "tt_invites".
 *
 * The followings are the available columns in table 'tt_invites':
 * @property integer $id
 * @property integer $inviter_user_id
 * @property string $email
 * @property string $code
 *
 * The followings are the available model relations:
 * @property User $inviter
 */
class Invite extends CActiveRecord
{

    const CODE_LENGTH = 12;

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tt_invites';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('inviter_user_id', 'numerical', 'integerOnly'=>true),
			array('email, code', 'length', 'max'=>255),
			array('code', 'length', 'max'=>self::CODE_LENGTH),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, inviter_user_id, email, code', 'safe', 'on'=>'search'),
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
            'inviter' => array(self::BELONGS_TO, 'User', 'inviter_user_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'inviter_user_id' => 'Inviter User ID',
			'inviter' => 'Inviter',
			'email' => 'Email',
			'code' => 'Code',
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
		$criteria->compare('inviter_user_id',$this->inviter_user_id);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('code',$this->code,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Invite the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

    protected function afterConstruct() {
        if ( empty($this->inviter_user_id) ) {
            $this->inviter_user_id = Yii::app()->user->id;
        }
        if ( empty($this->code) ) {
            $this->code = substr(md5(uniqid('', true)), 0, self::CODE_LENGTH);
        }
    }

    protected  function afterSave() {
        parent::afterSave();
        $url=Yii::app()->createAbsoluteUrl('site/register/?code='.$this->code.'&email='.$this->email);
        $th = iconv ("UTF-8","koi8-r",'Приглашение');
        $text = 'Вас пригласил на thinktwice.ru пользователь : '.$this->inviter->name.
        "\r\nДля регистрации перейдите по ссылке: ".$url."\r\nКод регистрации : ".$this->code;
        $message = iconv("UTF-8","koi8-r", $text);
        mail($this->email, $th , $message); 
    }
}
