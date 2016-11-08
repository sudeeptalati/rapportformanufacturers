<?php

/**
 * This is the model class for table "advance_settings".
 *
 * The followings are the available columns in table 'advance_settings':
 * @property integer $id
 * @property string $parameter
 * @property string $value
 * @property string $name
 */
class AdvanceSettings extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return AdvanceSettings the static model class
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
		return 'advance_settings';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('parameter, value, name', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, parameter, value, name', 'safe', 'on'=>'search'),
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
			'parameter' => 'Parameter',
			'value' => 'Value',
			'name' => 'Name'
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
	
		$criteria->compare('parameter',$this->parameter,true);
		$criteria->compare('value',$this->value,true);
		$criteria->compare('name',$this->name,true);
	
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
		
	}//end of search().
	
	public function dataForAdmin()
	{
		$criteria=new CDbCriteria;
			
		$criteria->condition = " parameter<>'ftp_password'";
		$criteria->compare('parameter',$this->parameter,true);
		$criteria->compare('value',$this->value,true);
		$criteria->compare('name',$this->name,true);
			
		return new CActiveDataProvider($this, array(
				'criteria'=>$criteria,
		));
		
	
	}//end of dataForAdmin().
	
	
	
}//end of class.