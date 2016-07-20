<?php

/**
 * This is the model class for table "config".
 *
 * The followings are the available columns in table 'config':
 * @property integer $id
 * @property string $company
 * @property string $address
 * @property string $town
 * @property string $postcode_s
 * @property string $postcode_e
 * @property string $county
 * @property string $country
 * @property string $email
 * @property string $telephone
 * @property string $mobile
 * @property string $alternate
 * @property string $fax
 * @property string $postcodeanywhere_account_code
 * @property string $postcodeanywhere_license_key
 * @property string $website
 * @property string $vat_reg_no
 * @property string $company_number
 * @property string $postcode
 * @property string $custom5
 */
class Config extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Config the static model class
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
		return 'config';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
		array('company, address, town, postcode_s, postcode_e, county, country, email, telephone, mobile, alternate, fax, postcodeanywhere_account_code, postcodeanywhere_license_key, website, vat_reg_no, company_number, custom4, custom5', 'safe'),
		// The following rule is used by search().
		// Please remove those attributes that should not be searched.
		array('id, company, address, town, postcode_s, postcode_e, county, country, email, telephone, mobile, alternate, fax, postcodeanywhere_account_code, postcodeanywhere_license_key, postcode, custom5', 'safe', 'on'=>'search'),
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
			'company' => 'Company',
			'address' => 'Address',
			'town' => 'Town',
			'postcode_s' => 'Postcode S',
			'postcode_e' => 'Postcode E',
			'postcode' => 'Postcode',
			'county' => 'County',
			'country' => 'Country',
			'email' => 'Email',
			'telephone' => 'Telephone',
			'mobile' => 'Mobile',
			'alternate' => 'Alternate',
			'fax' => 'Fax',
			'postcodeanywhere_account_code' => 'Postcode Anywhere Account Code',
			'postcodeanywhere_license_key' => ' Postcode Anywhere License Key',
			'website' => 'Website ',
			'vat_reg_no' => 'VAT Registration No.',
			'company_number' => 'Comapny Number',
			'custom4' => 'Live Call ID',
			'custom5' => 'Custom5',
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
		$criteria->compare('address',$this->address,true);
		$criteria->compare('town',$this->town,true);
		$criteria->compare('postcodes',$this->postcode_s,true);
		$criteria->compare('postcode_e',$this->postcode_e,true);
		$criteria->compare('postcode',$this->postcode,true);
		$criteria->compare('county',$this->county,true);
		$criteria->compare('country',$this->country,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('telephone',$this->telephone,true);
		$criteria->compare('mobile',$this->mobile,true);
		$criteria->compare('alternate',$this->alternate,true);
		$criteria->compare('fax',$this->fax,true);
		$criteria->compare('postcodeanywhere_account_code',$this->postcodeanywhere_account_code,true);
		$criteria->compare('postcodeanywhere_license_key',$this->postcodeanywhere_license_key,true);


		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}//end of search().


	public function updateVersion($id)
	{

		$last_successful_step='';
 		
		
		$last_successful_step_message='';
		$step_info=array();




		$request='http://www.rapportsoftware.co.uk/versions/rapport_callhandling.txt';
			
		$installed_version=Yii::app()->params['software_version'];
		$available_version = $this->curl_file_get_contents($request);

		$server_update_filename = $installed_version."_to_".$available_version."_update.zip";
		$server_update_filepath = "http://www.rapportsoftware.co.uk/versions/";
		$server_update_full_filepath=$server_update_filepath.$server_update_filename;

		$update_directory='updates';
		$local_desination_server_update_file=$update_directory.'/'.$server_update_filename;

		/*THESE VARIABLEUES USED IN STEP 5 & 6*/
		$unzip_folder = $update_directory.'/'.$installed_version."_to_".$available_version."_update";
		$setup_file=getcwd().'/'.$unzip_folder.'/setup.json';/*THE SETUP FILES IS LIKE CONTENTS OF NEW FILES TO BE COPIED*/

		switch ($id)
		{
/*STEP 1*//*Downlaoding the update file*/
			CASE 1:

				if (!@copy($server_update_full_filepath,$local_desination_server_update_file)) {
					$errors= error_get_last();
					$last_successful_step_message= "File Download ERROR: ".$errors['type']."<br>".$server_update_full_filepath;
					$last_successful_step_message.= "<br />\n".$errors['message'];
					$last_successful_step_message.="<br /><span style='color:red;'>There was some problem in downloading the file from the server. Please check your internet connection. If Problem still persist, contact support at <a href='mailto:support@rapportsoftware.co.uk'>support@rapportsoftware.co.uk</a><br /></span> ";
					$last_successful_step=0;
				}else
				{
					$last_successful_step=1;
					$last_successful_step_message="Files succesfully downloaded!";
				}

				$message=$this->createMessage($last_successful_step_message, $last_successful_step);
				array_push($step_info, $last_successful_step);
				array_push($step_info, $message);
				return $step_info ;
				break;

					
					
/*STEP 2*//*Creating a backup of database*/
			CASE 2:

				$db_current_location=getcwd().'\protected\data\chs.db';
				$db_backup_location = $update_directory.'\backup\version_'.$installed_version.'_database';
				$db_backup_filename=$db_backup_location.'\ver_'.$installed_version.'.data.db';
				
				if( !file_exists($db_backup_filename) )
				{
					if(!is_dir($db_backup_location))
					{
						if (!mkdir($db_backup_location, 0, true)) {
							$last_successful_step=0;
							$last_successful_step_message="Cannot create Directory for Database backup, please check permissions";
							die('Failed to create folders...');
							break;
						}
					}///end of if dir present at backup location

					if (!@copy($db_current_location,$db_backup_filename)) {
						$errors= error_get_last();
						$last_successful_step=0;
						$last_successful_step_message= "<br>Database backup creation error: ".$errors['type'];
						$last_successful_step_message.= "<br />\n".$errors['message'];
						$last_successful_step_message.= "<br /><span style='color:red;'>There was some problem in creating backup of database. Make sure all users are logged out of the system.  If Problem still persist, contact support at <a href='mailto:support@rapportsoftware.co.uk'>support@rapportsoftware.co.uk</a><br /></span> ";
					}///end of if of STEP 2 database backup error
					else {
						$last_successful_step=2;
						$last_successful_step_message="Database successfully Backuped";
					}///end of else
				}//////end of if of is backup file present .i.e. to check backup already created
				else
				{
					$last_successful_step=2;
					$last_successful_step_message="Database backup skipped because data is already backed up";
						
				}////end of else of database backup skipped
					

				$message=$this->createMessage($last_successful_step_message, $last_successful_step);
				
				array_push($step_info, $last_successful_step);
				array_push($step_info, $message);
				return $step_info ;
				break;
					
/*STEP 3*//*Creating Backup of Files*/
			CASE 3:
				/*STEP 3*//*Creating Backup of Files*/
				/*Creating Backup of Files*/
				$source=getcwd().'\protected';
				$dest=$update_directory.'\backup\version_'.$installed_version.'_files\protected';

				if( !is_dir($dest) )
				{
					if(!is_dir($dest))
					{
						if (!mkdir($dest, 0, true)) {
							$last_successful_step=0;
							$last_successful_step_message="Cannot create Directory for Files backup, please check permissions";
							die('Failed to create folders...');
							break;
						}
					}
	
					if ($this->recurse_copy($source, $dest)==true)
					{
						$last_successful_step=3;
						$last_successful_step_message="Files have been successfully backed up";
		 
					}
					else
					{	
						$last_successful_step=0;
						$last_successful_step_message=" There was some problem in creating mannual backup of files. Try again to run the backup. If Problem still persist, contact support at <a href='mailto:support@rapportsoftware.co.uk'>support@rapportsoftware.co.uk</a><br /> ";;
	 
					}
				}
				else 
				{
						$last_successful_step=3;
						$last_successful_step_message="Files Backup Skipped as there is already a folder";
					
				}

				$message=$this->createMessage($last_successful_step_message, $last_successful_step);
				array_push($step_info, $last_successful_step);
				array_push($step_info, $message);
				return $step_info ;
				break;
				
				

/*STEP 4*//*Unzipping Downloaded files*/
				CASE 4:
									
				$zip = new ZipArchive;
				$res = $zip->open( $local_desination_server_update_file);
				if ($res === TRUE) {
						$zip->extractTo($update_directory);
						$zip->close();

						$last_successful_step=4;
						$last_successful_step_message="Downloaded Files have been successfully unzipped";
				}///end of if
				else
					{
						$last_successful_step=0;
						$last_successful_step_message=" There was some problem in unzippping the downloaded files. If Problem still persist, contact support at <a href='mailto:support@rapportsoftware.co.uk'>support@rapportsoftware.co.uk</a><br /> ";;
					}
					
					
				$message=$this->createMessage($last_successful_step_message, $last_successful_step);
				array_push($step_info, $last_successful_step);
				array_push($step_info, $message);
				return $step_info ;
				break;

 /*STEP 5*//*Modifying the Database*/
			CASE 5:
					
					//$json=$this->curl_file_get_contents($setup_file);
					$json=file_get_contents($setup_file);
					
					$jsonIterator = new RecursiveIteratorIterator(
												new RecursiveArrayIterator(json_decode($json, TRUE)),
													RecursiveIteratorIterator::SELF_FIRST);

					/*We will get the location of database update file by following  procedure*/
					
													
					$db_update_file='';
						foreach ($jsonIterator as $key => $val) {
							
							/////*Since within the database Key is the location of update file
							if ($key=='database')
							{
								$db_update_file=getcwd().'/'.$unzip_folder.$val;
							}
						}///end of foreach iterator
					
						
						////////*NOW By reading the update file we will be changing the main database
						try
						{
							$db = new PDO('sqlite:protected\data\chs.db');
							//	echo '<hr>'.$db_update_file;
							$file_handle=fopen($db_update_file,'r');
							//echo "<br />";
							while(!feof($file_handle))
							{
								$line=fgets($file_handle);

								$db->exec($line);
								 
								}
								fclose($file_handle);
								// close the database connection
								$db = NULL;
	
								$last_successful_step=5;
								$last_successful_step_message.="Database is successfully changed";
						
						}///END OF TRY BLOCK
						catch(PDOException $e)
						{							
								$last_successful_step=0;
								$last_successful_step_message="Unable to Change the Database";
								print 'Exception : '.$e->getMessage();
						}
						

						$message=$this->createMessage($last_successful_step_message, $last_successful_step);
						array_push($step_info, $last_successful_step);
						array_push($step_info, $message);
						return $step_info ;
						break;
		
				
						

/*STEP 6*//*Moving the new files*/
						
			/*	Development Value 10
			 * 	RELEASE VALUE 6
			 * */
						
						
			CASE 6:
						$folder='';
						$non_copied_files='';
						$non_copied_files_flag=1;
						
						
						
						$json=file_get_contents($setup_file);
						$jsonIterator = new RecursiveIteratorIterator(
												new RecursiveArrayIterator(json_decode($json, TRUE)),
													RecursiveIteratorIterator::SELF_FIRST);
						
						foreach ($jsonIterator as $key => $val) {
								if(is_array($val)) {
									echo "$key:<br>";
									if ($key=='folders')
									{
										$folder=true;
									}
									else{
										$folder=false;
									}/////end of if of folder check
								} ////end of if of is_array
								else 
								{
									if ($folder)
									{
										echo "<hr><span style='color:green;'> $key => $val</span><br>";
										////*COPY FOLDERS NOW
										$folder_name=$key;
										$folder_copy_from=getcwd().'/'.$unzip_folder.''.$val;
										$folder_copy_to=getcwd().'/protected/'.$folder_name;
											
										echo " <span style='color:green;'>";
										echo "COPY FROM :".$folder_copy_from;
										echo "<br>COPY TO :".$folder_copy_to;
										echo "</span><hr>";

										if ($this->recurse_copy($folder_copy_from, $folder_copy_to)==false)
										{
											$non_copied_files="<br>Folder ".$folder_copy_from."was not coped to".$folder_copy_to;
											$non_copied_files_flag=0;
											throw new Exception('Unable to copy folders.');

										}///end of if copy
										else
										{
											$last_successful_step_message= " All new files copied";
											$last_successful_step=6;
										}
											

									}////end of if of copy folders
								}///end of else of is_array
							}///end of foreach iterator
						
							
							$last_successful_step_message= " All new files copied";
							$last_successful_step=6;
											
											
						$message=$this->createMessage($last_successful_step_message, $last_successful_step);
						array_push($step_info, $last_successful_step);
						array_push($step_info, $message);
						return $step_info ;
						break;
				
	CASE 7:
						
						$last_successful_step=7;
						$last_successful_step_message="Congrates !! Update Successfully Done ";
						$message=$this->createMessage($last_successful_step_message, $last_successful_step);
						array_push($step_info, $last_successful_step);
						array_push($step_info, $message);
						return $step_info ;
						break;
		
				
/*STEP 0*//*Whem Something Fails*/
			default:
				{
					$last_successful_step_message="<br /><span style='color:red;'>There is some unknown problem in update progress, Try again !! <br>
					 If Problem still persist send this screen shot or contact support at <a href='mailto:support@rapportsoftware.co.uk'>support@rapportsoftware.co.uk</a><br /></span> ";
					$last_successful_step=0;
						
						
					$message="<hr><br><span style='color:red;'>".$fail_htmltag." &nbsp;&nbsp;Step-".$last_successful_step;
					$message.=": ".$last_successful_step_message.'</span>';



					array_push($step_info, $last_successful_step);
					array_push($step_info, $message);
						
					return $step_info ;
					break;

				}






		}//end of switch($id) opened at the very beginning.
	}//end of updateVersion().








	/**Private Functions used in same class */



	public function recurse_copy($src,$dst)
	{
		$dir = opendir($src);
		@mkdir($dst);
		while(false !== ( $file = readdir($dir)) ) {
			if (( $file != '.' ) && ( $file != '..' )) {
				if ( is_dir($src . '/' . $file) ) {
					$this->recurse_copy($src . '/' . $file,$dst . '/' . $file);
				}
				else {
					if (!copy($src . '/' . $file,$dst . '/' . $file))
					{
						echo 'Error in copying files';
						return false;
						exit;
					}
				} //end of if else is_dir
			}///end of if $file
		}//////end of while
		closedir($dir);
		return true;
	}//end of function   recurse_copy($src,$dst) {


	/**
	 * Deletes a directory and all files and folders under it
	 * @return Null
	 * @param $dir String Directory Path
	 */
	public function rmdir_files($dir)
	{
	 $dh = opendir($dir);
	 if ($dh) {
	  while($file = readdir($dh)) {
	   if (!in_array($file, array('.', '..'))) {
	    if (is_file($dir.$file)) {
	     unlink($dir.$file);
	    }
	    else if (is_dir($dir.$file)) {
	     rmdir_files($dir.$file);
	    }
	   }
	  }
	  rmdir($dir);
	 }
	}///end of function rmdir_files($dir) {


	
	/*TO DECODE THE CONETENTS DOWNLOADED FROM URL*/
	public function curl_file_get_contents($request)
	{
		$curl_req = curl_init($request);


		curl_setopt($curl_req, CURLOPT_URL, $request);
 		curl_setopt($curl_req, CURLOPT_RETURNTRANSFER, TRUE);
		curl_setopt($curl_req, CURLOPT_HEADER, FALSE);

		$contents = curl_exec($curl_req);

		curl_close($curl_req);

		return $contents;
	}///end of functn curl File get contents
	
	
	
	
	
	
	
	public function createMessage($last_successful_step_message,$last_successful_step)
	{
		$successImgUrl = Yii::app()->request->baseUrl.'/images/tick.png';
		$success_htmltag=  CHtml::image($successImgUrl, 'Success', array('width'=>12, 'height'=>12, 'title'=>'Success'));
		$failImgUrl = Yii::app()->request->baseUrl.'/images/cross.png';
		$fail_htmltag=  CHtml::image($failImgUrl, 'Success', array('width'=>12, 'height'=>12, 'title'=>'Success'));
		$image='';
		
		if ($last_successful_step==0)
		{
		$color='red';
		$image=$fail_htmltag;
		}
		else
		{
		$color='green';
		$image=$success_htmltag;
		}
	
		$message="<hr><span style='color:".$color.";'>".$image." &nbsp;&nbsp;Step-".$last_successful_step;
		$message.=": ".$last_successful_step_message.'</span>';
		
		return $message;
	}
	






}//end of class.
