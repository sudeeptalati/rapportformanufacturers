<?php

/**
 * This is the model class for table "country_codes".
 *
 * The followings are the available columns in table 'country_codes':
 * @property integer $id
 * @property string $iso2
 * @property string $short_name
 * @property string $long_name
 * @property string $iso3
 * @property string $numcode
 * @property string $un_member
 * @property string $calling_code
 * @property string $cctld
 */
class CountryCodes extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return CountryCodes the static model class
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
		return 'country_codes';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('iso2, short_name, long_name, iso3, numcode, un_member, calling_code, cctld', 'safe'),
			array('iso2,calling_code','unique','message'=>'{attribute}:{value} already exists!'),
			array('calling_code', 'numerical', 'integerOnly'=>true),
			array('calling_code,long_name', 'required'),
			
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, iso2, short_name, long_name, iso3, numcode, un_member, calling_code, cctld', 'safe', 'on'=>'search'),
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
			'id' => 'Country',
			'iso2' => 'Iso2',
			'short_name' => 'Country Short Name',
			'long_name' => 'Country Long Name',
			'iso3' => 'Iso3',
			'numcode' => 'Numcode',
			'un_member' => 'Un Member',
			'calling_code' => 'Country Calling Code (For Sending SMS)',
			'cctld' => 'Cctld',
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
		$criteria->compare('iso2',$this->iso2,true);
		$criteria->compare('short_name',$this->short_name,true);
		$criteria->compare('long_name',$this->long_name,true);
		$criteria->compare('iso3',$this->iso3,true);
		$criteria->compare('numcode',$this->numcode,true);
		$criteria->compare('un_member',$this->un_member,true);
		$criteria->compare('calling_code',$this->calling_code,true);
		$criteria->compare('cctld',$this->cctld,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}//end of search().
	
	public function getAllCountryNames()
	{
		return CHtml::listData(CountryCodes::model()->findAll(array('order'=>"`short_name` ASC")), 'id', 'short_name');
	}//end of getAllCodes().
	
	
}//end of class.