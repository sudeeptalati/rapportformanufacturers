<?php

/**
 * This is the model class for table "notification_contact".
 *
 * The followings are the available columns in table 'notification_contact':
 * @property integer $id
 * @property integer $notification_rule_id
 * @property string $person_name
 * @property string $person_info
 * @property string $email
 * @property integer $mobile
 * @property integer $notification_code_id
 * @property string $created
 * @property string $modified
 * @property string $deleted
 *
 * The followings are the available model relations:
 * @property NotificationCode $notificationCode
 * @property NotificationRule $notificationRule
 */
class NotificationContact extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return NotificationContact the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'notification_contact';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('person_name', 'required'),
			array('notification_rule_id, mobile, notification_code_id', 'numerical', 'integerOnly'=>true),
			array('person_name, person_info, email, created, modified, deleted', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, notification_rule_id, person_name, person_info, email, mobile, notification_code_id, created, modified, deleted', 'safe', 'on'=>'search'),
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
			'notificationCode' => array(self::BELONGS_TO, 'NotificationCode', 'notification_code_id'),
			'notificationRule' => array(self::BELONGS_TO, 'NotificationRule', 'notification_rule_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'notification_rule_id' => 'Notification Rule',
			'person_name' => 'Person Name',
			'person_info' => 'Person Info',
			'email' => 'Email',
			'mobile' => 'Mobile',
			'notification_code_id' => 'Notification Code',
			'created' => 'Created',
			'modified' => 'Modified',
			'deleted' => 'Deleted',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('notification_rule_id',$this->notification_rule_id);
		$criteria->compare('person_name',$this->person_name,true);
		$criteria->compare('person_info',$this->person_info,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('mobile',$this->mobile);
		$criteria->compare('notification_code_id',$this->notification_code_id);
		$criteria->compare('created',$this->created,true);
		$criteria->compare('modified',$this->modified,true);
		$criteria->compare('deleted',$this->deleted,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}//end of search().
	
// 	protected function afterSave()
// 	{
// 		$notification_rules_id = $this->notification_rule_id;
		
// 		$notificationUpdateModel = NotificationRules::model()->updateByPk($notification_rules_id,
// 											array('notify_others'=> 1) 
// 										);
// 	}//end of afterSave
	
	
}//end of class.