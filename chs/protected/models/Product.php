<?php

/**
 * This is the model class for table "product".
 *
 * The followings are the available columns in table 'product':
 * @property integer $id
 * @property integer $contract_id
 * @property integer $brand_id
 * @property integer $product_type_id
 * @property integer $customer_id
 * @property integer $engineer_id
 * @property string $purchased_from
 * @property string $purchase_date
 * @property string $warranty_date
 * @property string $model_number
 * @property string $serial_number
 * @property string $production_code
 * @property string $enr_number
 * @property string $fnr_number
 * @property integer $discontinued
 * @property integer $warranty_for_months
 * @property double $purchase_price
 * @property string $notes
 * @property integer $created_by_user_id
 * @property string $created
 * @property string $modified
 * @property string $cancelled
 * @property string $lockcode
 * @property string $distributor
 *
 * The followings are the available model relations:
 * @property Customer[] $customers
 * @property Engineer $engineer
 * @property Customer $customer
 * @property ProductType $productType
 * @property Brand $brand
 * @property Contract $contract
 * @property User $createdByUser
 * @property Servicecall[] $servicecalls
 */
class Product extends CActiveRecord
{
	
	public $created_by_user;
	public $contracter_name;
	public $brand_name;
	public $product_name;
	public $warranty_until;
	public $engineer_name;
	public $customer_name;
	public $customer_town;
	public $customer_postcode;
	
	
	/**
	 * Returns the static model of the specified AR class.
	 * @return Product the static model class
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
		return 'product';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('contract_id, brand_id, product_type_id', 'required'),
			array('contract_id, brand_id, product_type_id, customer_id, engineer_id, discontinued, warranty_for_months, created_by_user_id', 'numerical', 'integerOnly'=>true),
			array('purchase_price,serial_number', 'numerical'),
			array('purchased_from, warranty_until, purchase_date, warranty_date, model_number, serial_number, production_code, enr_number, fnr_number, notes, modified, cancelled, lockcode, distributor', 'safe'),
			array('serial_number','unique','message'=>'{attribute}:{value} already exists!'),
			array('serial_number', 'length', 'is'=>14, 'message'=>'{attribute}:should be of exact 14 digits-numeric values only!'),
			array('model_number','filter','filter'=>array($this,'processtouppercaseandtrimwhitespace')),
			
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('customer_name,customer_town, customer_postcode, id, contract_id, brand_id, product_type_id, customer_id, engineer_id, purchased_from, purchase_date, distributor, warranty_date, model_number, serial_number, production_code, enr_number, fnr_number, discontinued, warranty_for_months, purchase_price, notes, created_by_user_id, created, modified, cancelled', 'safe', 'on'=>'search'),
		);
	}///end of rules
	
	
	public function processtouppercaseandtrimwhitespace($code){
   	 	$code= strtoupper($code);
		//$code = str_replace(' ', '', $code);///for all spaces
		$code = preg_replace('/\s+/', '', $code);//for whitespaces
		return $code;
	}///end of public function processtouppercaseandtrimwhitespace($code){
	
	



	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'customer' => array(self::BELONGS_TO, 'Customer', 'customer_id'),
			'engineer' => array(self::BELONGS_TO, 'Engineer', 'engineer_id'),
			'productType' => array(self::BELONGS_TO, 'ProductType', 'product_type_id'),
			'brand' => array(self::BELONGS_TO, 'Brand', 'brand_id'),
			'contract' => array(self::BELONGS_TO, 'Contract', 'contract_id'),
			'createdByUser' => array(self::BELONGS_TO, 'User', 'created_by_user_id'),
			'servicecalls' => array(self::HAS_MANY, 'Servicecall', 'product_id'),
			'createdByUser' => array(self::BELONGS_TO, 'User', 'created_by_user_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'contract_id' => 'Contract',
			'brand_id' => 'Brand',
			'product_type_id' => 'Product Type',
			'customer_id' => 'Customer',
			'engineer_id' => 'Engineer',
			'purchased_from' => 'Retailer',
			'purchase_date' => 'Purchase Date',
			'warranty_date' => 'Warranty Start',
			'model_number' => 'Model',
			'serial_number' => 'Serial No',
			'production_code' => 'Production Code',
			'enr_number' => 'Index Number',
			'fnr_number' => 'Alternate Serial Number & Reason',
			'discontinued' => 'Product Discontinued',
			'warranty_for_months' => 'Warranty For Months',
			'purchase_price' => 'Purchase Price',
			'notes' => 'Product Notes',
			'created_by_user_id' => 'Created By User',
			'created' => 'Created',
			'modified' => 'Modified',
			'cancelled' => 'Cancelled',
		/*USER ADDED ATTRIBUTED*/
			'warranty_until' => 'Warranty Expires',
			'distributor' => 'Distributor',
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
		$criteria->with = array( 'customer','engineer');
		
		$criteria->compare( 'customer.fullname', $this->customer_name ,true);
		$criteria->compare( 'customer.town', $this->customer_town,true );
		$criteria->compare( 'customer.postcode', $this->customer_postcode ,true);

		$criteria->compare('id',$this->id);
		$criteria->compare('contract_id',$this->contract_id);
		$criteria->compare('brand_id',$this->brand_id);
		$criteria->compare('product_type_id',$this->product_type_id);
		$criteria->compare('customer_id',$this->customer_id);
		$criteria->compare('engineer_id',$this->engineer_id);
		$criteria->compare('purchased_from',$this->purchased_from,true);
		$criteria->compare('purchase_date',$this->purchase_date,true);
		$criteria->compare('warranty_date',$this->warranty_date,true);
		$criteria->compare('model_number',$this->model_number,true);
		$criteria->compare('serial_number',$this->serial_number,true);
		$criteria->compare('production_code',$this->production_code,true);
		$criteria->compare('enr_number',$this->enr_number,true);
		$criteria->compare('fnr_number',$this->fnr_number,true);
		$criteria->compare('discontinued',$this->discontinued);
		$criteria->compare('warranty_for_months',$this->warranty_for_months);
		$criteria->compare('purchase_price',$this->purchase_price);
		$criteria->compare('notes',$this->notes,true);
		$criteria->compare('created_by_user_id',$this->created_by_user_id);
		$criteria->compare('created',$this->created,true);
		$criteria->compare('modified',$this->modified,true);
		$criteria->compare('cancelled',$this->cancelled,true);
		$criteria->compare('distributor',$this->distributor,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}//end of search().
	
	
	private static $_items=array();
	
	/**
	 * Returns the items for the specified type.
	 * @param string item type (e.g. 'PostStatus').
	 * @return array item names indexed by item code. The items are order by their position values.
	 * An empty array is returned if the item type does not exist.
	 */
	public static function items($type)
	{
		if(!isset(self::$_items[$type]))
			self::loadItems($type);
		return self::$_items[$type];
	}//end of items.
	
	/**
	 * Returns the item name for the specified type and code.
	 * @param string the item type (e.g. 'PostStatus').
	 * @param integer the item code (corresponding to the 'code' column value)
	 * @return string the item name for the specified the code. False is returned if the item type or code does not exist.
	 */
	public static function item($type,$code)
	{
		if(!isset(self::$_items[$type]))
			self::loadItems($type);
		return isset(self::$_items[$type][$code]) ? self::$_items[$type][$code] : false;
	}//end of item.
	
	/**
	 * Loads the lookup items for the specified type from the database.
	 * @param string the item type
	 */
	private static function loadItems($type)
	{
		self::$_items[$type]=array();
		$models=self::model()->findAll();
		foreach($models as $model)
			self::$_items[$type][$model->id]=$model->productType->name;
	}//end of loaditems.
	
	
	
	public function getAllBrands()
    {
    	return CHtml::listData(Brand::model()->findAll(array('condition'=>'active=1', 'order'=>"`name` ASC")), 'id', 'name');
    }//end of getAllBrands().
    
    public function getProductTypes()
    {
    	return CHtml::listData(ProductType::model()->findAll(array('condition'=>'active=1', 'order'=>"`name` ASC")), 'id', 'name');
    }//end of getproductTypes().
    
    public function getAllContract()
    {
    	return CHtml::listData(Contract::model()->findAll(array('condition'=>'active=1', 'order'=>"`name` ASC")), 'id', 'name','contractType.name');
    }//end of getAllContract().
    
    public function getAllEngineers()
    {
    	return CHtml::listData(Engineer::model()->findAll(array('condition'=>'active=1', 'order'=>"`fullname` ASC")), 'id', 'fullname');
    }//end of getAllEngineers().
    
	public function getAllCompanyNames()
    {
    	return CHtml::listData(Engineer::model()->findAll(array('order'=>"`company` ASC")), 'id', 'company');
    }//end of getAllEngineers().
    
    protected function beforeSave()
    {
    	if(parent::beforeSave())
        {
			$this->purchase_date=strtotime($this->purchase_date);
        	$this->warranty_date=strtotime($this->warranty_date);
			$this->serial_number=Product::model()->processSerialNumber($this->serial_number);
			
        	if($this->isNewRecord)  // Creating new record 
            {
        		//$this->created_by_user_id=Yii::app()->user->id;
        		$this->created_by_user_id='1';
        		
        		//$this->customer_id=0;
        		
        		//if(isset($_GET['customer_id']))
        		//if($this->customer_id=='0')
        		if($this->customer_id=='0')
        		{
        			//echo "CUSTOMER DOSENT EXIST.<br>";
        			$this->customer_id=0;
        			$this->lockcode=Yii::app()->user->id*1000;
        		}
        		else 
        		{
        			//echo "<hr>CUSTOMER ID IN BEFORE SAVE :".$this->customer_id."<BR>";
        			$this->lockcode=0;
        		}
        		
        		if(empty($this->customer_id))
        		{
        			$this->customer_id=0;
        			$this->lockcode=Yii::app()->user->id*1000;
        		}
        		else 
        		{
        			//echo "<hr>CUSTOMER ID IN BEFORE SAVE :".$this->customer_id."<BR>";
        			$this->lockcode=0;
        		}
        		
				$this->created=time();
        		return true;
            }//end if($this->isNewRecord).
            else
            {
            	$this->modified=time();
                return true;
            }
        }//end of if(parent())
    }//end of beforeSave().
    
    public function enggProductReport($engg_id)
    {
    	//echo "<br>Engg id in prod method = ".$engg_id;
    	
    	if($engg_id == '0')
    	{
    		// or using: $rawData=Yii::app()->db->createCommand('SELECT * FROM tbl_user')->queryAll();
			$allProdData=Product::model()->findAll();
			$prodDataProvider=new CArrayDataProvider($allProdData);
			return $prodDataProvider;
			
    	}//end of if, returnd all prods.
    	else 
    	{
    	
	    	$criteria=new CDbCriteria();
			$criteria->condition = 'engineer_id='.$engg_id;
	//		$criteria->addCondition('fault_date BETWEEN :from_date AND :to_date');
	//		$criteria->params = array(
	//		  ':from_date' => $from_date,
	//		  ':to_date' => $to_date,
	//		);
			return new CActiveDataProvider(Product::model(),
						 array(
	    					'criteria' => $criteria
					));
    	}//end of else, returns selected engg's prods.
    	
    }//end of enggProductReport($engg_id).
	
	
	 public function processSerialNumber($serialnumber)
    {
		$serialnumber=str_replace(" ", "", $serialnumber);
		$serialnumber = strtoupper($serialnumber);
		return $serialnumber;
	}
	
	
	
}//end of class.