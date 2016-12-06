<?php

/**
 * This is the model class for table "retailers_and_distributors".
 *
 * The followings are the available columns in table 'retailers_and_distributors':
 * @property integer $id
 * @property string $company
 * @property string $companytype
 * @property string $address
 * @property string $town
 * @property string $postcode
 * @property string $telephone
 * @property string $created
 */
class RetailersAndDistributors extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return RetailersAndDistributors the static model class
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
		return 'retailers_and_distributors';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('company,companytype ', 'required'),
			array('company, companytype, address, town, postcode, telephone, created', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, company, companytype, address, town, postcode, telephone, created', 'safe', 'on'=>'search'),
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
			'company' => 'Company Name	',
			'companytype' => 'Company Type',
			'address' => 'Address',
			'town' => 'Town',
			'postcode' => 'Postcode',
			'telephone' => 'Telephone',
			'created' => 'Created',
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
		$criteria->compare('company',$this->company,true);
		$criteria->compare('companytype',$this->companytype,true);
		$criteria->compare('address',$this->address,true);
		$criteria->compare('town',$this->town,true);
		$criteria->compare('postcode',$this->postcode,true);
		$criteria->compare('telephone',$this->telephone,true);
		$criteria->compare('created',$this->created,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			//'pagination'=>false,
			'sort'=>array(
							'defaultOrder'=>'id DESC',
							),
		));
	}
	
	public function getListDataByType($companytype)
	{
		
		$listData=CHtml::listData(RetailersAndDistributors::model()->findAllByAttributes(array('companytype'=>$companytype,), array('order'=>'company ASC')),'id','company');
		return $listData;
		
	}//	public function getListDataByType($companytype)

	public function getAllRetailersAndDistributorsNamesArray()
	{
		$companyNamesArray = array();
		$companyNamesResult = RetailersAndDistributors::model()->findAll();
		 
		foreach ($companyNamesResult as $data)
		{
			//echo "model no = ".$data->model_number."<br>";
			array_push($companyNamesArray, $data->company);
			//array_push($companyNamesArray[$data->id] = $data->company);
			

		}//end pf foreach.
	
		return $companyNamesArray;
		 
	}//end of getAllModelNumbers().
	
	
}