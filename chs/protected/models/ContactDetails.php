<?php

/**
 * This is the model class for table "contact_details".
 *
 * The followings are the available columns in table 'contact_details':
 * @property integer $id
 * @property string $address_line_1
 * @property string $address_line_2
 * @property string $address_line_3
 * @property string $town
 * @property string $postcode_s
 * @property string $country
 * @property string $latitudes
 * @property string $longitudes
 * @property string $mobile
 * @property string $telephone
 * @property string $fax
 * @property string $email
 * @property string $website
 * @property string $created
 * @property string $lockcode
 * @property string $postcode_e
 * @property string $postcode
 * 
 *
 * The followings are the available model relations:
 * @property Contract[] $contracts
 * @property Contract[] $contracts1
 * @property Contract[] $contracts2
 * @property Contract[] $contracts3
 * @property Contract[] $contracts4
 * @property Engineer[] $engineers
 * @property Engineer[] $engineers1
 */
class ContactDetails extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return ContactDetails the static model class
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
		return 'contact_details';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('address_line_1, town,  telephone, email,  postcode_s, postcode_e', 'required'),
			array('address_line_2, address_line_3, country, latitudes, longitudes, mobile, fax, website', 'safe'),
			array('email','email'),
			array('email','unique','message'=>'{attribute}:{value} already exists!'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, address_line_1, address_line_2, address_line_3, town, postcode, country, latitudes, longitudes, mobile, telephone, fax, email, website, created', 'safe', 'on'=>'search'),
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
//			'contracts' => array(self::HAS_MANY, 'Contract', 'technical_contact_details_id'),
//			'contracts1' => array(self::HAS_MANY, 'Contract', 'accounts_contact_details_id'),
//			'contracts2' => array(self::HAS_MANY, 'Contract', 'spares_contact_details_id'),
//			'contracts3' => array(self::HAS_MANY, 'Contract', 'management_contact_details_id'),
			'contracts4' => array(self::HAS_MANY, 'Contract', 'main_contact_details_id'),
			'engineers' => array(self::HAS_MANY, 'Engineer', 'delivery_contact_details_id'),
			'engineers1' => array(self::HAS_MANY, 'Engineer', 'contact_details_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'address_line_1' => 'Address Line 1',
			'address_line_2' => 'Address Line 2',
			'address_line_3' => 'Address Line 3',
			'town' => 'Town',
			'country' => 'Country',
			'latitudes' => 'Latitudes',
			'longitudes' => 'Longitudes',
			'mobile' => 'Mobile',
			'telephone' => 'Telephone',
			'fax' => 'Fax',
			'email' => 'Email',
			'website' => 'Website',
			'created' => 'Created',
			'postcode_s' => 'Postcode First Part',
			'postcode_e' => 'Postcode Second Part',
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

		$criteria->compare('id',$this->id);
		$criteria->compare('address_line_1',$this->address_line_1,true);
		$criteria->compare('address_line_2',$this->address_line_2,true);
		$criteria->compare('address_line_3',$this->address_line_3,true);
		$criteria->compare('town',$this->town,true);
		$criteria->compare('postcode_s',$this->postcode_s,true);
		$criteria->compare('postcode_e',$this->postcode_e,true);
		$criteria->compare('postcode',$this->postcode,true);
		$criteria->compare('country',$this->country,true);
		$criteria->compare('latitudes',$this->latitudes,true);
		$criteria->compare('longitudes',$this->longitudes,true);
		$criteria->compare('mobile',$this->mobile,true);
		$criteria->compare('telephone',$this->telephone,true);
		$criteria->compare('fax',$this->fax,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('website',$this->website,true);
		$criteria->compare('created',$this->created,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	protected function beforeSave()
    {
    	if(parent::beforeSave())
        {
        	$trimmed_s = $this->postcode_s;
        	$trimmed_e = $this->postcode_e;
        	//$this->postcode = $this->postcode_s." ".$this->postcode_e;
        	$this->postcode=$trimmed_s." ".$trimmed_e;
        		
        	if($this->isNewRecord)  // Creating new record 
            {
            	$this->created=time();
        		//SAVING lockcode DATA.
        		$this->lockcode=Yii::app()->user->id*1000;
    			return true;
            }
            else
            {
            	return true;
            }
        }//end of if(parent())
    }//end of beforeSave().
    
    //*************** FUNCTIONS FOR DROPDOWN FILTER IN ADMIN VIEW ****************
    
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
    }
    
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
    }
    
    /**
     * Loads the lookup items for the specified type from the database.
     * @param string the item type
     */
    private static function loadItems($type)
    {
    	self::$_items[$type]=array();
    	$models=self::model()->findAll();
    	foreach($models as $model)
    		self::$_items[$type][$model->id]=$model->name;
    }
    
    //*************** END OF FUNCTIONS FOR DROPDOWN FILTER IN ADMIN VIEW ****************
    
    
    
    
}//end of class.