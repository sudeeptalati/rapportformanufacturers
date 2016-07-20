<?php

/**
 * This is the model class for table "uplifts_config".
 *
 * The followings are the available columns in table 'uplifts_config':
 * @property integer $id
 * @property string $prefix
 * @property integer $start_from
 * @property string $available_code
 */
class UpliftsNumberSeries extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return UpliftsNumberSeries the static model class
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
		return 'uplifts_number_series';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('start_from', 'numerical', 'integerOnly'=>true),
			array('prefix, available_code', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, prefix, start_from, available_code', 'safe', 'on'=>'search'),
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
			'prefix' => 'Prefix',
			'start_from' => 'Start From Number',
			'available_code' => 'Next Code',
		);
	}
	
	public function getAvailableCodeById($id)
	{
		$series = UpliftsNumberSeries::model()->findByPk($id);
		return $series->available_code;
	}
	
	public function updateNextAvailableCodeById($id)
	{
		$series = UpliftsNumberSeries::model()->findByPk($id);
		$series->start_from=$series->start_from+1;
		$series->available_code=$series->prefix.$series->start_from;
		$series->save();
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
		$criteria->compare('prefix',$this->prefix,true);
		$criteria->compare('start_from',$this->start_from);
		$criteria->compare('available_code',$this->available_code,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	
	protected function beforeSave()
    {
		$this->available_code=$this->prefix.$this->start_from;
		return true;
		
	}
	
	
	
}