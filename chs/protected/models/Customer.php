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
class Customer extends CActiveRecord
{
    private static $_items = array();
    public $created_by_user;
    public $product_type;
    public $product_brand;
    public $model_number;
    public $serial_number;
    public $service_number;

/**
     * Returns the items for the specified type.
     * @param string item type (e.g. 'PostStatus').
     * @return array item names indexed by item code. The items are order by their position values.
     * An empty array is returned if the item type does not exist.
     */
    public static function items($type)
    {
        if (!isset(self::$_items[$type]))
            self::loadItems($type);
        return self::$_items[$type];
    }

/**
     * Loads the lookup items for the specified type from the database.
     * @param string the item type
     */
    private static function loadItems($type)
    {
        self::$_items[$type] = array();
        $models = self::model()->findAll();
        foreach ($models as $model)
            self::$_items[$type][$model->id] = $model->fullname;
    }

        /**
     * Returns the static model of the specified AR class.
     * @return Customer the static model class
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }///end of public function processtouppercaseandtrimwhitespace($code){

/**
     * Returns the item name for the specified type and code.
     * @param string the item type (e.g. 'PostStatus').
     * @param integer the item code (corresponding to the 'code' column value)
     * @return string the item name for the specified the code. False is returned if the item type or code does not exist.
     */
    public static function item($type, $code)
    {
        if (!isset(self::$_items[$type]))
            self::loadItems($type);
        return isset(self::$_items[$type][$code]) ? self::$_items[$type][$code] : false;
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
            array(' last_name, address_line_1, town, postcode', 'required'),
            array('product_id, created_by_user_id', 'numerical', 'integerOnly' => true),
            array('title, first_name, address_line_2, address_line_3, country,telephone, mobile, email, fax, notes, modified, fullname, lockcode, model_number, serial_number', 'safe'),
            array('email', 'email'),
            array('postcode', 'filter', 'filter' => array($this, 'processtouppercaseandtrimwhitespace')),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id, title, first_name, last_name, product_id, address_line_1, address_line_2, address_line_3, town, postcode, country, telephone, mobile, fax, email, notes, created_by_user_id, created, modified, fullname, postcode, model_number, serial_number, product_id, product_brand, product_type', 'safe', 'on' => 'search'),
        );
    }//end of search().

public function processtouppercaseandtrimwhitespace($code)
    {
        $code = strtoupper($code);
        //$code = str_replace(' ', '', $code);///for all spaces
        //$code = preg_replace('/\s+/', '', $code);//for whitespaces
        $code = trim($code);//for whitespaces
        return $code;
    }

        /**
     * @return array relational rules.
     */
    public function relations()
    {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            //'product' => array(self::BELONGS_TO, 'Product', 'product_id'),
            'createdByUser' => array(self::BELONGS_TO, 'User', 'created_by_user_id'),
            'products' => array(self::HAS_MANY, 'Product', 'customer_id'),
            'servicecalls' => array(self::HAS_MANY, 'Servicecall', 'customer_id'),
        );
    }//end of items.

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
            'fax' => 'Work',
            'email' => 'Email',
            'notes' => 'Customer Notes',
            'created_by_user_id' => 'Created By User',
            'created' => 'Created',
            'modified' => 'Modified',
            'fullname' => 'Customer Name',
            'postcode' => 'Postcode',
        );
    }//end of item.

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
     */
    public function search()
    {
        // Warning: Please modify the following code to remove attributes that
        // should not be searched.

        $criteria = new CDbCriteria;
        $criteria->with = array('products', 'products.brand', 'products.productType');
        $criteria->together = true;

        $criteria->compare('products.id', $this->product_id, true);
        $criteria->compare('products.model_number', $this->model_number, true);
        $criteria->compare('products.serial_number', $this->serial_number, true);
        $criteria->compare('products.brand.name', $this->product_brand, true);
        $criteria->compare('products.productType.name', $this->product_type, true);

        $criteria->compare('id', $this->id, true);
        $criteria->compare('title', $this->title, true);
        $criteria->compare('first_name', $this->first_name, true);
        $criteria->compare('last_name', $this->last_name, true);

        $criteria->compare('address_line_1', $this->address_line_1, true);
        $criteria->compare('address_line_2', $this->address_line_2, true);
        $criteria->compare('address_line_3', $this->address_line_3, true);
        $criteria->compare('town', $this->town, true);
        $criteria->compare('postcode_s', $this->postcode_s, true);
        $criteria->compare('postcode_e', $this->postcode_e, true);
        $criteria->compare('postcode', $this->postcode, true);
        $criteria->compare('country', $this->country, true);
        $criteria->compare('telephone', $this->telephone, true);
        $criteria->compare('mobile', $this->mobile, true);
        $criteria->compare('fax', $this->fax, true);
        $criteria->compare('email', $this->email, true);
        $criteria->compare('notes', $this->notes, true);
        $criteria->compare('created_by_user_id', $this->created_by_user_id);
        $criteria->compare('created', $this->created, true);
        $criteria->compare('modified', $this->modified, true);
        $criteria->compare('fullname', $this->fullname, true);

        //	$criteria->order = 'product.created DESC';

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
            'sort' => array(
                'defaultOrder' => 'products.created DESC',
            ),


        ));
    }//end of loaditems.

    public function freeSearch($keyword)
    {


        /*
        $sql='SELECT  customer.fullname AS customer_name, customer.postcode as customer_postcode, product.serial_number AS product_serial_no
FROM `customer`
LEFT JOIN  product ON customer.id=product.customer_id
WHERE customer.postcode LIKE 'gl50 4bd'
';
        */


        $criteria = new CDbCriteria;

        $criteria->with = array(
            'products' => array('joinType' => 'LEFT JOIN')
        );
        $criteria->compare('fullname', $keyword, true, 'OR');
        $criteria->compare('postcode', $keyword, true, 'OR');
        $criteria->compare('town', $keyword, true, 'OR');
        $criteria->compare('telephone', $keyword, true, 'OR');
        $criteria->compare('mobile', $keyword, true, 'OR');
        $criteria->compare('products.serial_number', $keyword, true, 'OR');


        /*result limit*/
        //$criteria->limit = 100;

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
            //  'pagination'=>array('pageSize'=>'100',),
            'pagination' => false,
        ));

    }//end of beforeSave().

        public function getAllProducts($id)
    {
        return Product::model()->findAllByAttributes(array('customer_id' => $id));
    }//END OF afterSave().

    protected function beforeSave()
    {
        $setupmodel = Setup::model();

        if (parent::beforeSave()) {
            $this->fullname = trim($this->first_name) . " " . trim($this->last_name);
            //$this->fullname=$this->first_name;

            if ($this->isNewRecord)  // Creating new record
            {
                $this->created_by_user_id = Yii::app()->user->id;
                $this->notes = $setupmodel->initiatetimestampnotesorcomments($this->notes);


                /******CHECKING WHETHER CUSTOMER IS CREATED FROM CREATE OF CUSTOMER*/
                if ($this->lockcode == '0') {
                    //echo "Lockcode is set to zeero, In Create of customers";
                    $this->lockcode = 0;
                } else {
                    //echo "Lockdode is not set, some error";
                    $this->lockcode = Yii::app()->user->id * 1000;
                }

                $this->created = time();

                //SAVING DETAILS TO PRODUCT TABLE.


                if (empty($this->product_id)) {
                    $productModel = new Product;
                    $productModel->attributes = $_POST['Product'];
                    //$productModel->customer_id=0;
                    if ($productModel->save()) {
                        //echo "lockcode of product model is :".$productModel->lockcode."<br>";
                    }

                    //GETTING LOCKCODE FROM PRODUCT TABLE.

                    $lockcode = $productModel->lockcode;

                    $productQueryModel = Product::model()->findByAttributes(
                        array('lockcode' => $lockcode)
                    );
                    //echo "ID GOT FROM LOCKCODE : ".$productQueryModel->id;

                    $this->product_id = $productQueryModel->id;
                }


                return true;
            }//end of if($this->isNewRecord).
            /******** END OF SAVING NEW RECORD *************/
            else {
                $this->notes = $setupmodel->updatenotesorcomments($this->notes, $this, 'notes');

                if (isset($_GET['product_id'])) {
//            		$prod_id=$_GET['product_id'];
//
//            	if($prod_id != $this->product_id)

                    //echo "SECONDARY PROD";
                    $product_id = $_GET['product_id'];/* CHECKING FOR PRIMARY PRODUCT */
                    //echo $product_id;

                    $productModel = Product::model()->findByPk($product_id);
                    $productModel->attributes = $_POST['Product'];
                    if ($productModel->save()) {

                    }

                    $this->modified = time();
                    return true;
                }//end of if(isset()).

                else {
                    //	echo "PRIMARY PROD";
                    if (isset($_POST['Product'])) {
                        $productModel = Product::model()->findByPk($this->product_id);

                        $productModel->attributes = $_POST['Product'];
                        $productModel->save();
                        $this->modified = time();
                    }
                    return true;
                }//end of else of if(isset()).
                //}//end of if().
            }//end of ELSE of if($this->isNewRecord).
        }//end of if(parent())
    }//end of freeSearch().

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
                'lockcode' => 0,
                'customer_id' => $this->id
            )
        );

    }


}//end of class.