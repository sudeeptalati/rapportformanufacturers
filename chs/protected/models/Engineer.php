<?php

/**
 * This is the model class for table "engineer".
 *
 * The followings are the available columns in table 'engineer':
 * @property integer $id
 * @property string $first_name
 * @property string $last_name
 * @property integer $active
 * @property string $company
 * @property string $vat_reg_number
 * @property string $notes
 * @property integer $inactivated_by_user_id
 * @property string $inactivated_on
 * @property integer $contact_details_id
 * @property integer $delivery_contact_details_id
 * @property integer $created_by_user_id
 * @property string $created
 * @property string $modified
 * @property string $fullname
 * @property string $payment_name
 *
 * The followings are the available model relations:
 * @property ContactDetails $deliveryContactDetails
 * @property ContactDetails $contactDetails
 * @property User $createdByUser
 * @property User $inactivatedByUser
 * @property Product[] $products
 * @property Servicecall[] $servicecalls
 */
class Engineer extends CActiveRecord {

    public $user;
    
    public $engineer_email;

    /**
     * Returns the static model of the specified AR class.
     * @return Engineer the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'engineer';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        $contactDetailsModel = ContactDetails::model();

        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('first_name, last_name, active', 'required'),
            array('active, inactivated_by_user_id, contact_details_id, delivery_contact_details_id, created_by_user_id', 'numerical', 'integerOnly' => true),
            array('payment_name, engineer_email, company, vat_reg_number, notes, inactivated_on, modified, fullname', 'safe'),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id, first_name, last_name, active, company, vat_reg_number, notes, inactivated_by_user_id, inactivated_on, contact_details_id, delivery_contact_details_id, created_by_user_id, created, modified, fullname', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'deliveryContactDetails' => array(self::BELONGS_TO, 'ContactDetails', 'delivery_contact_details_id'),
            'contactDetails' => array(self::BELONGS_TO, 'ContactDetails', 'contact_details_id'),
            'createdByUser' => array(self::BELONGS_TO, 'User', 'created_by_user_id'),
            'inactivatedByUser' => array(self::BELONGS_TO, 'User', 'inactivated_by_user_id'),
            'products' => array(self::HAS_MANY, 'Product', 'engineer_id'),
            'servicecalls' => array(self::HAS_MANY, 'Servicecall', 'engineer_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'first_name' => 'First Name',
            'last_name' => 'Last Name',
            'active' => 'Active',
            'company' => 'Company',
            'vat_reg_number' => 'Vat Reg Number',
            'notes' => 'Notes',
            'inactivated_by_user_id' => 'Inactivated By User',
            'inactivated_on' => 'Inactivated On',
            'contact_details_id' => 'Contact Details',
            'delivery_contact_details_id' => 'Delivery Contact Details',
            'created_by_user_id' => 'Created By User',
            'created' => 'Created',
            'modified' => 'Modified',
            'fullname' => 'Engineer Name',
            'payment_name' => 'Make Payment in Name',
        );
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
     */
    public function search() {
        // Warning: Please modify the following code to remove attributes that
        // should not be searched.

        $criteria = new CDbCriteria;
		$criteria->with = array( 'contactDetails');
		
		$criteria->compare( 'contactDetails.email', $this->engineer_email, true );
		
        $criteria->compare('id', $this->id);
        $criteria->compare('first_name', $this->first_name, true);
        $criteria->compare('last_name', $this->last_name, true);
        $criteria->compare('active', $this->active);
        $criteria->compare('company', $this->company, true);
        $criteria->compare('vat_reg_number', $this->vat_reg_number, true);
        $criteria->compare('notes', $this->notes, true);
        $criteria->compare('inactivated_by_user_id', $this->inactivated_by_user_id);
        $criteria->compare('inactivated_on', $this->inactivated_on, true);
        $criteria->compare('contact_details_id', $this->contact_details_id);
        $criteria->compare('delivery_contact_details_id', $this->delivery_contact_details_id);
        $criteria->compare('created_by_user_id', $this->created_by_user_id);
        $criteria->compare('created', $this->created, true);
        $criteria->compare('modified', $this->modified, true);
        $criteria->compare('fullname', $this->fullname, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

//end of search().

    private static $_items = array();

    /**
     * Returns the items for the specified type.
     * @param string item type (e.g. 'PostStatus').
     * @return array item names indexed by item code. The items are order by their position values.
     * An empty array is returned if the item type does not exist.
     */
    public static function items($type) {
        if (!isset(self::$_items[$type]))
            self::loadItems($type);
        return self::$_items[$type];
    }

//end of items.

    /**
     * Returns the item name for the specified type and code.
     * @param string the item type (e.g. 'PostStatus').
     * @param integer the item code (corresponding to the 'code' column value)
     * @return string the item name for the specified the code. False is returned if the item type or code does not exist.
     */
    public static function item($type, $code) {
        if (!isset(self::$_items[$type]))
            self::loadItems($type);
        return isset(self::$_items[$type][$code]) ? self::$_items[$type][$code] : false;
    }

//end of item.

    /**
     * Loads the lookup items for the specified type from the database.
     * @param string the item type
     */
    private static function loadItems($type) {
        self::$_items[$type] = array();
        $criteria = new CDbCriteria();
        $criteria->condition = 'active = 1';
        $criteria->order = 'company ASC';
        $models = self::model()->findAll($criteria);
        //$models=self::model()->findAll(array('order'=>'company ASC'));
        foreach ($models as $model)
            self::$_items[$type][$model->id] = $model->company;
    }

//end of loaditems.

    protected function beforeSave() {
        if (parent::beforeSave()) {
            if ($this->isNewRecord) {  // Creating new record 
                $this->created_by_user_id = Yii::app()->user->id;
                $this->fullname = $this->first_name . "  " . $this->last_name;
                //$this->created=date("F j, Y, g:i a");
                $this->created = time();

                return true;
            }//end of new record.
            else {
                $this->modified = time();
                $this->fullname = $this->first_name . " " . $this->last_name;

                //if()

                return true;
            }
        }//end of if(parent())
    }

//end of beforeSave().

    protected function afterSave() {
        $contactDetailsQueryModel = ContactDetails::model()->findByPK($this->contact_details_id);
        //echo "ID IN AFTER SAVE() :".$contactDetailsQueryModel->id;

        $contactDetailsUpdateModel = ContactDetails::model()->updateByPk($contactDetailsQueryModel->id, array('lockcode' => 0)
        );

        $deliveryDetailsQueryModel = ContactDetails::model()->findByPK($this->delivery_contact_details_id);
        //echo "ID IN AFTER SAVE() :".$contactDetailsQueryModel->id;

        $deliveryDetailsUpdateModel = ContactDetails::model()->updateByPk($deliveryDetailsQueryModel->id, array('lockcode' => 0)
        );
    }

//END OF afterSave().

    public function getAllEngineers() {
        return CHtml::listData(Engineer::model()->findAll(array('order' => "`fullname` ASC")), 'id', 'fullname');
    }

//end of getAllEngineers().

    public function getAllCompanyNames() {
        return CHtml::listData(Engineer::model()->findAll(array('order' => "`company` ASC")), 'id', 'company');
    }

//end of getAllEngineers().

    public function getAllEnggAndCompany() {
	
        //return CHtml::listData(Engineer::model()->findAll(array('condition' => 'active=1', 'order' => "`fullname` ASC")), 'id', 'fullname', 'company');
		$engglist=$this->getactiveengineerslist();
		return $engglist;
   }

//end of getAllEnggAndCompany().

    public function getCodeArray() {
        $codes = self::model()->findAll();
        $data = array(); // data to be returned
        foreach ($codes as $c) {
            $data[$c->id] = $c->company;
        }
        return $data;
    }

//end of getCodeArray().

    public function getAllCompanyNamesArray() {
        $companyNamesArray = array();
        $companyNamesResult = Engineer::model()->findAll();

        foreach ($companyNamesResult as $data) {
            //echo "model no = ".$data->model_number."<br>";
            array_push($companyNamesArray, $data->company);
            //array_push($companyNamesArray[$data->id] = $data->company);
        }//end pf foreach.

        return $companyNamesArray;
    }

//end of getAllModelNumbers().

    public function getdisplayformatoptions() {
        $options_array = array();

        $options_array[1] = 'Company Name Only';
        $options_array[2] = 'Engineer Full name only';
        $options_array[3] = 'Company Name First and Then Engineer Full Name both';
        $options_array[4] = 'Engineer Full name First and Then Company Name both';

        return $options_array;
    }

/////end of getdisplayformatoptions

    public function getdisplayformatid() {
        $advanceModel = AdvanceSettings::model()->findByAttributes(array('parameter' => 'engglistdisplayformat'));
        return $advanceModel->value;
    }

///end of  getdisplayformatid()

    public function getactiveengineerslist() {

        $listdata = array();
        $blank_select = array(''=>'Please select your country');

        switch ($this->getdisplayformatid()) {
          
			case '1':	///// 'Company Name Only';
						$listdata = CHtml::listData(Engineer::model()->findAll(array('condition' => 'active=1', 'order' => "`company` ASC")), 'id', 'company');
						break;
            case '2':	///'Engineer Full name only';
						$listdata = CHtml::listData(Engineer::model()->findAll(array('condition' => 'active=1', 'order' => "`fullname` ASC")),'id', 'fullname' );
						break;
            case '3': 	/////'Company Name First and Then Engineer Full Name both';
                        $listdata=CHtml::listData(Engineer::model()->findAll(array('condition'=>'active=1', 'order'=>"`company` ASC")), 'id', 'company', 'fullname');
						break;
            case '4': 	////'Engineer Full name First and Then Company Name both';
						$listdata=CHtml::listData(Engineer::model()->findAll(array('condition'=>'active=1', 'order'=>"`fullname` ASC")), 'id', 'fullname', 'company');
                        break;
            default:
						$listdata = CHtml::listData(Engineer::model()->findAll(array('condition' => 'active=1', 'order' => "`fullname` ASC")),'id', 'fullname' );
						break;
            }
            
            return $listdata;
            
        }///end of getactiveengineerslist
        
    public function getAllEngineersemailsincsv()
    {
        $enggs=Engineer::model()->findAll(array('condition' => 'active=1'));
        $engineer_emails_array=array();

        foreach ($enggs as $e)
        {
            //echo '<br>'.$e->fullname.' - '.$e->contactDetails->email;
            array_push($engineer_emails_array,$e->contactDetails->email);
        }

        return implode(", ",$engineer_emails_array);
    }///end of get public function getAllEngineersemailsincsv()



}//end of class.