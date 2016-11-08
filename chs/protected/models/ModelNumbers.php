<?php

/**
 * This is the model class for table "model_numbers".
 *
 * The followings are the available columns in table 'model_numbers':
 * @property integer $id
 * @property string $model_number
 * @property integer $brand_id
 * @property integer $product_type_id
 */
class ModelNumbers extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return ModelNumbers the static model class
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
		return 'model_numbers';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('brand_id, product_type_id', 'numerical', 'integerOnly'=>true),
			array('model_number', 'safe'),
			array('model_number', 'required'),
			
			
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, model_number, brand_id, product_type_id', 'safe', 'on'=>'search'),
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
			'productType' => array(self::BELONGS_TO, 'ProductType', 'product_type_id'),
			'brand' => array(self::BELONGS_TO, 'Brand', 'brand_id'),
			
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'model_number' => 'Model Number',
			'brand_id' => 'Brand',
			'product_type_id' => 'Product Type',
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
		$criteria->compare('model_number',$this->model_number,true);
		$criteria->compare('brand.name',$this->brand_id);
		$criteria->compare('product_type_id',$this->product_type_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}//end of search().
	
	public function getAllModelNumbers()
	{
		$modelArray = array();
		$modelResult = ModelNumbers::model()->findAll();
		 
		foreach ($modelResult as $data)
		{
			//echo "model no = ".$data->model_number."<br>";
			array_push($modelArray, $data->model_number);
		}//end pf foreach.
	
		return $modelArray;
		 
	}//end of getAllModelNumbers().
	
	
}//end of class.