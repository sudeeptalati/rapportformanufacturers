<?php

/**
 * This is the model class for table "user".
 *
 * The followings are the available columns in table 'user':
 * @property integer $id
 * @property string $username
 * @property string $password
 * @property string $name
 * @property string $email
 * @property string $profile
 * @property string $created
 * @property string $modified
 * @property integer $usergroup_id
 *
 * The followings are the available model relations:
 * @property Brand[] $brands
 * @property Contract[] $contracts
 * @property Contract[] $contracts1
 * @property ContractType[] $contractTypes
 * @property Customer[] $customers
 * @property Engineer[] $engineers
 * @property Engineer[] $engineers1
 * @property JobStatus[] $jobStatuses
 * @property Product[] $products
 * @property ProductType[] $productTypes
 * @property Servicecall[] $servicecalls
 * @property SparesUsedStatus[] $sparesUsedStatuses
 */
class User extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return User the static model class
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
		return 'user';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('username, password, name, email', 'required'),
			array('usergroup_id', 'numerical', 'integerOnly'=>true),
			array('profile, modified', 'safe'),
			//CUSTOMIZED RULES.
			array('username,email','unique','message'=>'{attribute}:{value} already exists!'),
			array('email','email'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, username, password, name, email, profile, created, modified, usergroup_id', 'safe', 'on'=>'search'),
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
			'brands' => array(self::HAS_MANY, 'Brand', 'created_by_user_id'),
			'contracts' => array(self::HAS_MANY, 'Contract', 'inactivated_by_user_id'),
			'contracts1' => array(self::HAS_MANY, 'Contract', 'created_by_user_id'),
			'contractTypes' => array(self::HAS_MANY, 'ContractType', 'created_by_user_id'),
			'customers' => array(self::HAS_MANY, 'Customer', 'created_by_user_id'),
			'engineers' => array(self::HAS_MANY, 'Engineer', 'created_by_user_id'),
			'engineers1' => array(self::HAS_MANY, 'Engineer', 'inactivated_by_user_id'),
			'jobStatuses' => array(self::HAS_MANY, 'JobStatus', 'updated_by_user_id'),
			'products' => array(self::HAS_MANY, 'Product', 'created_by_user_id'),
			'productTypes' => array(self::HAS_MANY, 'ProductType', 'created_by_user_id'),
			'servicecalls' => array(self::HAS_MANY, 'Servicecall', 'created_by_user_id'),
			'sparesUsedStatuses' => array(self::HAS_MANY, 'SparesUsedStatus', 'created_by_user_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'username' => 'Username',
			'password' => 'Password',
			'name' => 'Name',
			'email' => 'Email',
			'profile' => 'Profile',
			'created' => 'Created',
			'modified' => 'Modified',
			'usergroup_id' => 'Usergroup',
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
		$criteria->compare('username',$this->username,true);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('password',$this->password,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('profile',$this->profile,true);
		$criteria->compare('created',$this->created,true);
		$criteria->compare('modified',$this->modified,true);
		$criteria->compare('usergroup_id',$this->usergroup_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}//end of search.
	
	
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
			self::$_items[$type][$model->id]=$model->name;
	}//end of loaditems.
	
	
	
	
	public function validatePassword($password)	
    {
    	if (!empty($this->newPassword))
    	
                    $this->password = hash('sha256', $this->newPassword);
    }//end of validatePassword().
    
    protected function beforeSave()
    {
    	if(parent::beforeSave())
        {
        	if($this->isNewRecord)  // Creating new record 
            {
        		$this->password = hash('sha256', $this->password);
        		$this->created=time();
    			return true;
            }
            else
            {
            	$this->password = hash('sha256', $this->password);
                $this->modified=time();
                return true;
            }
        }//end of if(parent())
        else
        	return false;
    }//end of beforeSave()          
	
}//end of class.