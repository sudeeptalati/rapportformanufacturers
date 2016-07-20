<?php

/**
 * This is the model class for table "spares_used".
 *
 * The followings are the available columns in table 'spares_used':
 * @property integer $id
 * @property integer $master_item_id
 * @property integer $servicecall_id
 * @property string $item_name
 * @property integer $part_number
 * @property double $unit_price
 * @property integer $quantity
 * @property double $total_price
 * @property string $date_ordered
 * @property string $created
 * @property string $modified
 * @property string $notes
 *
 * The followings are the available model relations:
 * @property Servicecall $servicecall
 * @property MasterItems $masterItem
 */
class SparesUsed extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return SparesUsed the static model class
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
		return 'spares_used';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('master_item_id, servicecall_id, item_name, quantity', 'required'),
			array('master_item_id, servicecall_id, quantity', 'numerical', 'integerOnly'=>true),
			array('unit_price, total_price', 'numerical'),
			array('date_ordered, modified, notes', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, master_item_id, servicecall_id, item_name, part_number, unit_price, quantity, total_price, date_ordered, created, modified', 'safe', 'on'=>'search'),
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
			'servicecall' => array(self::BELONGS_TO, 'Servicecall', 'servicecall_id'),
			'masterItem' => array(self::BELONGS_TO, 'MasterItems', 'master_item_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'master_item_id' => 'Master Item',
			'servicecall_id' => 'Servicecall',
			'item_name' => 'Item Name',
			'part_number' => 'Part Number',
			'unit_price' => 'Unit Price',
			'quantity' => 'Quantity',
			'total_price' => 'Total Price',
			'date_ordered' => 'Date Ordered',
			'created' => 'Created',
			'modified' => 'Modified',
			'notes' => 'Notes'
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
		$criteria->compare('master_item_id',$this->master_item_id);
		$criteria->compare('servicecall_id',$this->servicecall_id);
		$criteria->compare('item_name',$this->item_name,true);
		$criteria->compare('part_number',$this->part_number);
		$criteria->compare('unit_price',$this->unit_price);
		$criteria->compare('quantity',$this->quantity);
		$criteria->compare('total_price',$this->total_price);
		$criteria->compare('date_ordered',$this->date_ordered,true);
		$criteria->compare('created',$this->created,true);
		$criteria->compare('modified',$this->modified,true);
		$criteria->compare('notes',$this->notes,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	protected function beforeSave()
    {
    	if(parent::beforeSave())
        {
        	if($this->isNewRecord)  // Creating new record 
            {
            	$this->total_price = $this->unit_price*$this->quantity;
        		$this->created_by_user=Yii::app()->user->id;
        		$this->created=time();
    			return true;
            }
            else
            {
            	$this->modified=time();
                return true;
            }
        }
    }//end of beforeSave().
    
    public function initialize()
    {
    	//echo "<hr>Initialize is called";
    	
    	//$filename = '../jsonTest.json';
    	$filename = '../jsondata.json';
		$fh = fopen($filename, 'w');
		$beginStr = '{ "results": [';
		fwrite($fh, $beginStr);
		fclose($fh);
    	
    }//end of initialize.
    
    public function addData($param)
    {
    	//echo "<hr>AddData is called, Adding data to file";
    	
    	$filename = '../jsondata.json';
//    	$filename = '../test.php';
//		$fh = fopen($filename, 'r');
//		$sData = fread($fh, filesize($filename));
//		echo "<hr>".$sData;
//		fclose($fh);
//		  
		$fh1 = fopen($filename, 'a');
		$str = ',';
		fwrite($fh1, json_encode($param));
		fwrite($fh1, $str);
		fclose($fh1);
		
		
    }//end of addData.

    
    public function finalize()
    {
    	
    	$today = date("FjYhisA");
    	//echo $today;
    	
    	//echo "<hr> Finalize is called";
    	//$finalStr = ']}';
    	$closingStr = '],';
    	$status = '"status":0}';
		
		$filename = '../jsondata.json';
		
		$fh = fopen($filename, 'r+');
		$stat = fstat($fh);
		$trunkdata = ftruncate($fh, $stat['size']-1);
		//echo "<hr>".$trunkdata;
		fclose($fh); 
		
		$fh = fopen($filename, 'a');
		fwrite($fh, $closingStr);
		fwrite($fh, $status);
		fclose($fh);
    	
    	$oldname = '../jsondata.json';
    	//echo "<hr> path ".$oldname."<hr>";
    	$name = 'jsondataold.json';
    	$newname = '../'.$today.$name;
    	//echo $newname;
    	$uploadfileName = $today.$name;
    	
    	if(file_exists($oldname))
    	{
    		//echo "<hr>php file is present";
    		rename($oldname, $newname);
    		//echo "<hr> file is renamed";

    		$sparesModel = SparesUsed::model()->initialize();
    		//echo "<hr> new file is created by initialize method";
    		
    		$uploadModel = SparesUsed::model()->uploadFile($uploadfileName);
    		
    	}
    	else
    	{
    		//echo "<hr>file not present";
    	}	
    		
    	
    		
    }//end of finalize.
    
    public function uploadFile($newname)
    {
    	//echo "Upload files function called<hr>";
    	
    	//echo "New name = ".$newname."<br>";
    	
    	$ftpsettingModel = FtpSettings::model()->findByPk(1);
    	
    	$server = $ftpsettingModel->url;
    	//echo "server = ".$server."<br>";
    	$ftp_user_name = $ftpsettingModel->ftp_username;
    	//echo "user name = ".$ftp_user_name."<br>";
    	$ftp_user_pass = $ftpsettingModel->ftp_password;
    	//echo "password = ".$ftp_user_pass."<br>";
    	
    	
    	$local_file = '../'.$newname;
		//$ftp_path = '/home/acerserver/jsonData.json';
		$ftp_path = '/rapportsoftware.co.uk/html.spares/newfiles/'.$newname;
	    	
		// set up basic connection
		$conn_id = ftp_connect($server);
		
		if(!$conn_id)
		{
			//echo "Connection attemp failed<hr>";
		}
		else 
		{
			//echo "Connection established<hr>";
		}
		
		// login with username and password
		$login_result = ftp_login($conn_id, $ftp_user_name, $ftp_user_pass);
		
		if(!$login_result)
		{
			//echo "Login failure<hr>";
		}
		else 
		{
			//echo "Login is success<hr>";
		}
		
		// upload a file
		if (ftp_put($conn_id, $ftp_path, $local_file, FTP_ASCII)) 
		{
		 	//echo "successfully uploaded $local_file\n";
		}
		else 
		{
		 	//echo "There was a problem while uploading $local_file\n";
		}
		
		
		
		//echo ftp_chmod($conn_id, 0777, $ftp_path) ? "CHMOD successful!" : 'Error';
		
		// close the connection
		ftp_close($conn_id);

	
    	
    	/****** ALTERNATIVE METHOD ****************
    	
	    // connect to FTP server (port 21)
		$connection = ftp_connect($server, 21) or die ("Cannot connect to host");
	
		$login = ftp_login($connection, $ftp_user_name, $ftp_user_pass);
		
		if (!$connection || !$login) 
		{ 
			die('Connection attempt failed!');
			echo "<hr>"; 
		}
		else 
		{
			echo "Connection success<hr>";
		}
		
		$local_file = '../jsonDataOld.json';
		$ftp_path = '/var/www/jsonData.json';
		
		if(file_exists($ftp_path))
		{
			echo "File present to upload<hr>";
		}
		else
		{
			echo "File not found<hr>";
		}
		
		//$upload = ftp_put($connection, $ftp_path, $local_file, FTP_ASCII);
		//$upload = ftp_put($connection, $ftp_path, $local_file, FTP_BINARY);
		
//    	if (!$upload)
//    	{
//    		echo 'FTP upload failed!<hr>'; 
//    	}
		
		ftp_close($connection);
		
		*/
			
    	
    }//end of uploadFile().
    

}//end of class.