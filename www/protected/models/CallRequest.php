<?php

/**
 * This is the model class for table "tt_call_requests".
 *
 * The followings are the available columns in table 'tt_call_requests':
 * @property integer $id
 * @property integer $user_id
 * @property integer $caller_id
 * @property string $title
 * @property string $text
 * @property integer $status
 * @property string $call_time
 * @property string $alter_call_time_1
 * @property string $alter_call_time_2
 * @property string $duration
 * @property string $comments_json
 * @property array $comments
 */
class CallRequest extends CActiveRecord
{

    const STATUS_CREATED = 0;
    const STATUS_MODERATED = 1;
    const STATUS_ACCEPTED = 2;
    const STATUS_REJECTED = 100;
    const STATUS_COMPLETE = 200;

    public $comments = array();

    public $_old_status = -1;

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tt_call_requests';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('user_id, caller_id, status, duration', 'numerical', 'integerOnly'=>true),
            array('user_id, caller_id, title, text, call_time, duration', 'required'),
           # array('title', 'length', 'max'=>255),
           # array('call_time, alter_call_time_1, alter_call_time_2', 'date' ),
            array('duration', 'numerical', 'min' => 15, 'tooSmall' => 'Продолжительность консультации не может быть менее 15 минут'),
			array('title, text, call_time, alter_call_time_1, alter_call_time_2, duration, comments_json', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, user_id, caller_id, title, text, status, call_time, alter_call_time_1, alter_call_time_2, duration, comments_json', 'safe', 'on'=>'search'),
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
            'caller' => array(self::BELONGS_TO, 'User', 'caller_id'),
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
			'caller_id' => 'Caller',
			'title' => 'Title',
			'text' => 'Text',
			'status' => 'Status',
			'call_time' => 'Call Time',
			'alter_call_time_1' => 'Alter Call Time 1',
			'alter_call_time_2' => 'Alter Call Time 2',
			'duration' => 'Duration',
			'comments_json' => 'Comments JSON',
			'comments' => 'Comments',
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
		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('caller_id',$this->caller_id);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('text',$this->text,true);
		$criteria->compare('status',$this->status);
		$criteria->compare('call_time',$this->call_time,true);
		$criteria->compare('alter_call_time_1',$this->alter_call_time_1,true);
		$criteria->compare('alter_call_time_2',$this->alter_call_time_2,true);
		$criteria->compare('duration',$this->duration,true);
        $criteria->compare('comments_json',$this->comments_json,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

   	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return CallRequest the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

    protected function afterFind() {
        $this->_old_status = $this->status;
        $this->comments = json_decode($this->comments_json);
    }

    protected function beforeSave() {
        $this->comments_json = json_encode($this->comments);
        return parent::beforeSave();
    }

    protected function afterSave() {
        if ( $this->status != $this->_old_status ) {
            $this->sendStatusMessage();
            $this->_old_status = $this->status;
        }
        $this->comments = json_decode($this->comments_json);
        return parent::afterSave();
    }

    protected function sendStatusMessage() {
        switch ( $this->status ) {
            case self::STATUS_CREATED:
                $text = 'Вы создали заявку на звонок эксперту. Ее номер ' . $this->id;
                break;
            case self::STATUS_MODERATED:
                $text = 'Ваша заявка номер ' . $this->id . ' прошла проверку модератором.';
                break;
            case self::STATUS_ACCEPTED:
                $text = 'Ваша заявка номер ' . $this->id . ' принята экспертом. Ожидайте звонка в ' . $this->call_time ;
                break;
            case self::STATUS_COMPLETE:
                $text = 'Звонок эксперта по заявке номер ' . $this->id . ' состоялся. Спасибо, что воспользовались нашим сервисом!';
                break;

        }
        $user = User::model()->findByPk($this->user_id);
        $user->sendMessage('Заявка на звонок эксперта', $text, array('sms'));
    }

    public function getStatusDesc() {
        switch ( $this->status ) {
            case '0':
                return 'Новая заявка';
            case '1':
                return 'Заявка принята';
            case '100':
                return 'Заявка отклонена';

        }
    }

    public function getStatusList() {
        return array(
            array(
                'id' => self::STATUS_CREATED,
                'value' => 'Ожидает проверки модератором',
            ),
            array(
                'id' => self::STATUS_MODERATED,
                'value' => 'Ожидает подтверждения экспертом',
            ),
            array(
                'id' => self::STATUS_ACCEPTED,
                'value' => 'Звонок подтверждён',
            ),
            array(
                'id' => self::STATUS_COMPLETE,
                'value' => 'Звонок осуществлён',
            ),
        );
    }
}
