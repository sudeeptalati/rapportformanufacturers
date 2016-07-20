<?php

/**
 * This is the model class for table "customer".
 *
 * The followings are the available columns in table 'customer':
 * @property integer $id
 * @property string $title
 * @property string $first_name
 * @property string $last_name
 * @property integer $product_id
 * @property string $address_line_1
 * @property string $address_line_2
 * @property string $address_line_3
 * @property string $town
 * @property string $postcode_s
 * @property string $country
 * @property string $telephone
 * @property string $mobile
 * @property string $fax
 * @property string $email
 * @property string $notes
 * @property integer $created_by_user_id
 * @property string $created
 * @property string $modified
 * @property string $fullname
 * @property string $lockcode
 * @property string $postcode_e
 * @property string $postcode
 *
 * The followings are the available model relations:
 * @property Product $product
 * @property User $createdByUser
 * @property Product[] $products
 * @property Servicecall[] $servicecalls
 */
class DuplicateCustomer extends CActiveRecord
{
	public $created_by_user;
	public $product_type;
	public $product_brand;
	public $model_number;
	public $serial_number;
	public $service_number;
	/**
	 * Returns the static model of the specified AR class.
	 * @return Customer the static model class
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
		return 'customer';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('title, last_name, address_line_1, town, postcode_s, postcode_e', 'required'),
			array('product_id, created_by_user_id', 'numerical', 'integerOnly'=>true),
			array('first_name, address_line_2, address_line_3, country,telephone, mobile, email, fax, notes, modified, fullname, lockcode, model_number, serial_number', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, title, first_name, last_name, product_id, address_line_1, address_line_2, address_line_3, town, postcode, country, telephone, mobile, fax, email, notes, created_by_user_id, created, modified, fullname, postcode, model_number, serial_number, product_id, product_brand, product_type', 'safe', 'on'=>'search'),
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
			'product' => array(self::BELONGS_TO, 'Product', 'product_id'),
			'createdByUser' => array(self::BELONGS_TO, 'User', 'created_by_user_id'),
			'products' => array(self::HAS_MANY, 'Product', 'customer_id'),
			'servicecalls' => array(self::HAS_MANY, 'Servicecall', 'customer_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'title' => 'Title',
			'first_name' => 'Company Name',
			'last_name' => 'Name',
			'product_id' => 'Product',
			'address_line_1' => 'Address Line 1',
			'address_line_2' => 'Address Line 2',
			'address_line_3' => 'Address Line 3',
			'town' => 'Town',
			'postcode_s' => 'Postcode',
			'postcode_e' => 'Postcode_e',
			'country' => 'Country',
			'telephone' => 'Telephone',
			'mobile' => 'Mobile',
			'fax' => 'Fax',
			'email' => 'Email',
			'notes' => 'Customer Notes',
			'created_by_user_id' => 'Created By User',
			'created' => 'Created',
			'modified' => 'Modified',
			'fullname' => 'Customer Name',
			'postcode' => 'Postcode',
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
		$criteria->with = array( 'product','product.brand','product.productType' );
		$criteria->together = true;
		
    	$criteria->compare('product.id',$this->product_id, true);
    	$criteria->compare('product.model_number', $this->model_number, true );
    	$criteria->compare('product.serial_number', $this->serial_number, true );
		$criteria->compare('product.brand.name', $this->product_brand, true );
		$criteria->compare('product.productType.name', $this->product_type, true );
		
		$criteria->compare('id',$this->id, true);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('first_name',$this->first_name,true);
		$criteria->compare('last_name',$this->last_name,true);
		
		$criteria->compare('address_line_1',$this->address_line_1,true);
		$criteria->compare('address_line_2',$this->address_line_2,true);
		$criteria->compare('address_line_3',$this->address_line_3,true);
		$criteria->compare('town',$this->town,true);
		$criteria->compare('postcode_s',$this->postcode_s,true);
		$criteria->compare('postcode_e',$this->postcode_e,true);
		$criteria->compare('postcode',$this->postcode,true);
		$criteria->compare('country',$this->country,true);
		$criteria->compare('telephone',$this->telephone,true);
		$criteria->compare('mobile',$this->mobile,true);
		$criteria->compare('fax',$this->fax,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('notes',$this->notes,true);
		$criteria->compare('created_by_user_id',$this->created_by_user_id);
		$criteria->compare('created',$this->created,true);
		$criteria->compare('modified',$this->modified,true);
		$criteria->compare('fullname',$this->fullname,true);
		
	//	$criteria->order = 'product.created DESC';
		
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			/*
			'sort'=>array(
							'defaultOrder'=>'product.created DESC',
						),
			*/
			 
		
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
			self::$_items[$type][$model->id]=$model->fullname;
	}//end of loaditems.
	
	protected function beforeSave()
	{
		if(parent::beforeSave())
        {
			$this->postcode_s = trim($this->postcode_s);
			$this->postcode_e = trim($this->postcode_e);
			$this->postcode=$this->postcode_s." ".$this->postcode_e;
        	$this->fullname=trim($this->first_name)." ".trim($this->last_name);
        	//$this->fullname=$this->first_name;
        	
        	if($this->isNewRecord)  // Creating new record 
            {
        		$this->created_by_user_id=Yii::app()->user->id;
        		
        		/******CHECKING WHETHER CUSTOMER IS CREATED FROM CREATE OF CUSTOMER*/
        		if($this->lockcode == '0')
        		{
        			//echo "Lockcode is set to zeero, In Create of customers";
        			$this->lockcode=0;
        		}
        		else 
        		{
        			//echo "Lockdode is not set, some error";
        			$this->lockcode=Yii::app()->user->id*1000;
        		}
        		
        		$this->created=time();
        		
        		//SAVING DETAILS TO PRODUCT TABLE.
        		
        		
        		if (empty($this->product_id))
        		{
	        		$productModel=new Product;
	        		$productModel->attributes=$_POST['Product'];
	        		//$productModel->customer_id=0;
					if($productModel->save())
					{
						//echo "lockcode of product model is :".$productModel->lockcode."<br>";
					}
					
					//GETTING LOCKCODE FROM PRODUCT TABLE.
					
					$lockcode=$productModel->lockcode;
					
					$productQueryModel = Product::model()->findByAttributes(
	        											array('lockcode'=>$lockcode)
														);
					//echo "ID GOT FROM LOCKCODE : ".$productQueryModel->id;
					
					$this->product_id=$productQueryModel->id;
	        	}
	        	
	        	
	        	
        		return true;
            }//end of if($this->isNewRecord).
            /******** END OF SAVING NEW RECORD *************/
            else
            {
            	if(isset($_GET['product_id']))
            	{
//            		$prod_id=$_GET['product_id'];
//            		
//            	if($prod_id != $this->product_id)
            	
            		//echo "SECONDARY PROD";
            		$product_id=$_GET['product_id'];/* CHECKING FOR PRIMARY PRODUCT */
            		//echo $product_id;
            		
            		$productModel=Product::model()->findByPk($product_id);
	            	$productModel->attributes=$_POST['Product'];
	            	if($productModel->save())
	            	{
	            		
	            	}
	            	$trimmed_s = $this->postcode_s;
			        $trimmed_e = $this->postcode_e;
			        $this->postcode=$trimmed_s." ".$trimmed_e;
					$this->modified=time();
	                return true;
            	}//end of if(isset()).
            	
            	else 
            	{
            	//	echo "PRIMARY PROD";
            		
	            	$productModel=Product::model()->findByPk($this->product_id);
		            $productModel->attributes=$_POST['Product'];
		            if($productModel->save())
		            {
		            	
		            }
		            $trimmed_s = $this->postcode_s;
			        $trimmed_e = $this->postcode_e;
			        $this->postcode=$trimmed_s." ".$trimmed_e;
					$this->modified=time();
		            return true;
            	}//end of else of if(isset()).
            	//}//end of if().
          	}//end of ELSE of if($this->isNewRecord).
        }//end of if(parent())
	}//end of beforeSave().
	
	protected function afterSave()
    {
    	$productQueryModel = Product::model()->findByPK(
        											$this->product_id
													);
    	//echo "PRODUCT ID IN AFTER SAVE() :".$productQueryModel->id;
    	
    	$productUpdateModel = Product::model()->updateByPk(
													$productQueryModel->id,
													
													array
													(
														'lockcode'=>0,
														'customer_id'=>$this->id
													)
													);
    	
    }//END OF afterSave().
    
    public function freeSearch($keyword)
    {
        $criteria=new CDbCriteria;

        $criteria->with = array('product');

        $criteria->compare('fullname', $keyword, true, 'OR');

        $criteria->compare('postcode', $keyword, true, 'OR');
        $criteria->compare('town', $keyword, true, 'OR');
        $criteria->compare('telephone', $keyword, true, 'OR');
        $criteria->compare('mobile', $keyword, true, 'OR');
        $criteria->compare('product.serial_number', $keyword, true, 'OR');


        /*result limit*/
        //$criteria->limit = 100;

        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
         //  'pagination'=>array('pageSize'=>'100',),
                  'pagination'=>false,
                ));

    }//end of freeSearch().
    
    public function getAllProducts($id)
    {
    	return Product::model()->findAllByAttributes(array('customer_id'=>$id));
    }
	
	public function postcodeSearch($postcode, $primary_id)
    {
        $criteria=new CDbCriteria;

		$criteria->compare('postcode', $postcode, true, 'AND');
		$criteria->compare('id','<>'.$primary_id, true, 'AND'); 
		
		
		return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
         //  'pagination'=>array('pageSize'=>'100',),
                  'pagination'=>false,
                ));

    }//end of freeSearch().
    
    
}//end of class.