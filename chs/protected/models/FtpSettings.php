<?php

/**
 * This is the model class for table "ftp_settings".
 *
 * The followings are the available columns in table 'ftp_settings':
 * @property integer $id
 * @property string $url
 * @property string $ftp_username
 * @property string $ftp_password
 * @property string $ftp_port
 */
class FtpSettings extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return FtpSettings the static model class
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
		return 'ftp_settings';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('url, ftp_username, ftp_password','required'),
			array('url, ftp_username, ftp_password, ftp_port', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, url, ftp_username, ftp_password, ftp_port', 'safe', 'on'=>'search'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'url' => 'Url',
			'ftp_username' => 'Ftp Username',
			'ftp_password' => 'Ftp Password',
			'ftp_port' => 'Ftp Port',
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
		$criteria->compare('url',$this->url,true);
		$criteria->compare('ftp_username',$this->ftp_username,true);
		$criteria->compare('ftp_password',$this->ftp_password,true);
		$criteria->compare('ftp_port',$this->ftp_port,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}