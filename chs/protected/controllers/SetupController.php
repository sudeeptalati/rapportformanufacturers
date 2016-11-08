<?php
session_start();
class SetupController extends RController
{
	
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'rights', // perform access control for CRUD operations
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('PostcodeAnywhereView','PostcodeAnywhereSetup','RemoteConnection','diaryparameterform', 'ClickatellsmsAccount','SmsSettingsView','smsSettingsForm','CloudUrlUpdated','CloudUrlUpdated','CloudSetup','ShowUpdateProgress','create','update','admin','about','changeLogo','restoreDatabase','testConnection','mailServer','mailSettings', 'diaryparametersview', 'sendTestEmail'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete'),
				'users'=>array('admin'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Setup;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Setup']))
		{
			$model->attributes=$_POST['Setup'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		//echo "<br>In update controller";
		$model=$this->loadModel($id);
		$code_to_append = '';

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Setup']))
		{
			$model->attributes=$_POST['Setup'];
			
			if(isset($_POST['hidden_code_val']))
			{
				//echo "<br>Code value in update action = ".$_POST['hidden_code_val'];
				$code_to_append = $_POST['hidden_code_val'];
				if($code_to_append != '')
					$model->mobile = $code_to_append.$model->mobile;
				
			}//end of if(isset[hodden_code_val]).
			
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}//end of if(isset())

		$this->render('update',array('model'=>$model));
	}//end of update.

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		if(Yii::app()->request->isPostRequest)
		{
			// we only allow deletion via POST request
			$this->loadModel($id)->delete();

			// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
			if(!isset($_GET['ajax']))
				$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
		}
		else
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Setup');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Setup('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Setup']))
			$model->attributes=$_GET['Setup'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model=Setup::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param CModel the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='setup-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
	
	/***************** USER DEFINED ACTIONS ********************/
	
	public function actionAbout()
	{
		
		
		$setupModel = Setup::model()->findByPk('1');
		//echo $setupModel->version_update_url;
		$update_url_from_db = $setupModel->version_update_url;
		$request=$update_url_from_db.'/latest_callhandling_version.txt';
		//$request='http://www.rapportsoftware.co.uk/versions_test/latest_callhandling_version.txt';
		
		$available_variable = $this->curl_file_get_contents($request);
		//echo "<br>available version = ".$available_variable;
		// store session data
		$_SESSION['available_variable']=$available_variable;
				
		$this->render('about');
	}//End of actionAbout().
	
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
	
	public function actionChangeLogo()
	{
	    $model=new Setup('view');
	
	    // uncomment the following code to enable ajax-based validation
	    /*
	    if(isset($_POST['ajax']) && $_POST['ajax']==='setup-changeLogo-form')
	    {
	        echo CActiveForm::validate($model);
	        Yii::app()->end();
	    }
	    */
	    
	    if(isset($_POST['finish']))
	    {
	    	$allowedExts = array("jpg", "jpeg", "gif", "png", "JPG", "JPEG", "GIF", "PNG");
	    	$info = pathinfo($_FILES['logo_url']['name']);
	    	$extension = $info['extension'];
	    	//echo "extention = ".$extension;
	    	//if (( ($_FILES["logo_url"]["type"] == "image/png")) && ($_FILES["logo_url"]["size"] < 1000000))
	    	
	    	if ((($_FILES["logo_url"]["type"] == "image/gif")
	    			|| ($_FILES["logo_url"]["type"] == "image/jpeg")
	    			|| ($_FILES["logo_url"]["type"] == "image/png")
	    			|| ($_FILES["logo_url"]["type"] == "image/pjpeg")) && in_array($extension, $allowedExts))
			{
	    		if ($_FILES["logo_url"]["error"] > 0)
	    		{
	    			echo "Return Code: " . $_FILES["logo_url"]["error"] . "<br />";
	    		}
	    		else
	    		{
	    			//echo "Upload: " . $_FILES["logo_url"]["name"] . "<br />";
	    			//echo "Type: " . $_FILES["logo_url"]["type"] . "<br />";
	    			//echo "Size: " . ($_FILES["logo_url"]["size"] / 1024) . " Kb<br />";
	    			//echo "Temp uploaded: " . $_FILES["logo_url"]["tmp_name"] . "<br />";
	    			$uploadedname="company_logo.png";
	    			$uploaded_file= $_FILES["logo_url"]["tmp_name"];
	    
	    			$location="images/company_logo.png";
	    			//echo '<br>'.$location;
	    			if (move_uploaded_file($uploaded_file,$location))
	    			{
	    				echo "<br>Stored";
						//$this->redirect(array('changeLogo'));
						$this->redirect(array('setup/changeLogo'));
	    			}
	    			else
	    			{
	    				//echo "Problem in storing";
	    			}
	    
	    
	    		}//end of else
	    
	    	}///end of if(checking extention).
	    	else
	    	{
 	    		//echo "<br>Invalid FILE";
	    	}//end of else
	    
	    }//end of isset POST finish
		
	    $this->render('changeLogo',array('model'=>$model));
	}//end of changeLogo().
	
	
	public function actionRestoreDatabase()
	{
	    if(isset($_POST['finish']))
		{
			$dbRestoreMesg = '';
			if ($_FILES["database"]["type"] == "application/octet-stream" && $_FILES["database"]["name"] == "chs.db")
			{
				if ($_FILES["database"]["error"] > 0)
				{
					//echo "Return Code: " . $_FILES["logo_url"]["error"] . "<br />";
				}//end of if for error
				else
				{
					$uploaded_file= $_FILES["database"]["tmp_name"];
					$location="protected/data/chs.db";
					//echo '<br>'.$location;
					if (move_uploaded_file($uploaded_file,$location))
					{
						$dbRestoreMesg = "<span style='background-color:green; color:black;' > Database Restored </span><br>";
					}
					else
					{
						$dbRestoreMesg = '<span style="background-color:red; color:black;">Not Stored , Please try again</span><br> ';
					}

				}//end of inside else
			}///end of if for check for database file check
			else 
			{
				$dbRestoreMesg = '<span style="background-color:red; color:black;">Please upload chs.db file only</span><br>';
			}
			
			$this->renderPartial('displayRestoreDbMesg', array('dbRestoreMesg'=>$dbRestoreMesg));

		}//ennd of if of post finish

		$this->render('restoreDatabase');
	}//end of RestoreDatabase().
	

	public function actionTestConnection()
	{
		if(!$conn = @fsockopen("google.com", 80, $errno, $errstr, 30))
		{
			//echo "PLEASE CHECK YOUR INTERNET CONNECTION";
		}
		else 
		{
			$root = dirname(dirname(__FILE__));
			//echo $root."<br>";
			$filename = $root.'/config/mail_server.json';
			
			$reciever_email='';
			$sender_email='';
			
			if(file_exists($filename))
			{
				//echo "File is present<br>";
				$data = file_get_contents($filename);
				$decodedata = json_decode($data, true);
				//echo "Username = ".$decodedata['smtp_username']."<br>";
				$sender_email = $decodedata['smtp_username'];
				$smtp_password = $decodedata['smtp_password'];
				$smtp_encryption = $decodedata['smtp_encryption'];
				$smtp_port = $decodedata['smtp_port'];
			}
			
			$reciever_email=$sender_email;
			
			$message = new YiiMailMessage();
			$message->setTo(array($reciever_email));
		    $message->setFrom(array($sender_email));
		    $message->setSubject('Test');
			$message->setBody("This is a test mail from call handling");
		    
		    
		 	if(Yii::app()->mail->send($message))
		   	{
		   		//echo "TEST EMAIL IS SENT, CONNECTION IS OK<br>"; 
		   	}
		   	
		}//end of else.
		
	}//end of testConnection.
	
	public function actionMailServer()
	{
		$this->render('mailServer');
	}//end of mailServer().
	
	
	public function actionMailSettings()
	{
	    $model=new Setup('view');
		$this->render('mailSettings',array('model'=>$model));
	}//end of mailSettings().
	
	public function actionShowUpdateProgress($curr_step)
	{
		$model=new Setup();
		//echo "step value in controller ".$curr_step;
		$step=$curr_step;
		 
		if($step!=0)
		{
			$step_info = $model->updateVersion($step);
		}//end of if.
		else 
		{
			 session_unset(); 
		}
		$this->renderPartial('showUpdateProgress',array('step_info'=>$step_info));
	}//end of showUpdateProgress().
	
	/******** ACTION TO RENDER VIEW TO SETUP CLOUD URL********/
	
	public function actionCloudSetup()
	{
		//echo "In action CLOUD SETUP";
		$this->render('cloudSetup');
	}//end of cloudSetup().
	
	
	public function actionCloudUrlUpdated()
	{
		$this->render('cloudUrlUpdated');
		
	}//end of actionCloudUrlUpdated().
	
	public function actionSmsSettingsForm()
	{
		$this->render('smsSettingsForm');
	}//end of actionSmsSettingsForm().
	
	public function actionSmsSettingsView()
	{
		$this->render('smsSettingsView');
	}
	
	public function actionDiaryparametersview()
	{
		$this->render('diaryparametersview');
	}
	public function actionDiaryparameterform()
	{
		$this->render('diaryparameterform');
	}
	public function actionClickatellsmsAccount()
	{
		$model=new Setup('view');
	
		if(isset($_POST['Setup']))
		{
			$model->attributes=$_POST['Setup'];
			if($model->validate())
			{
				// form inputs are valid, do something here
				return;
			}
		}
		$this->render('clickatellsmsAccount',array('model'=>$model));
	}//end of actionClickatellsmsAccount().
	
	public function actionRemoteConnection()
	{
		$this->render('remoteConnection');
	}//end of remoteConnection().
	
	public function actionPostcodeAnywhereSetup()
	{
		$model=$this->loadModel(1);
		
		if(isset($_POST['Setup']))
		{
			$model->attributes=$_POST['Setup'];
			
			//echo "<br>postcode code = ".$model->postcodeanywhere_account_code;
			$postcode_acc_code = $model->postcodeanywhere_account_code;
			//echo "<br>postcode Key = ".$model->postcodeanywhere_license_key;
			$postcode_lic_key = $model->postcodeanywhere_license_key;
			
			$setupModel = Setup::model()->updateByPk(1,
						array('postcodeanywhere_account_code'=>$postcode_acc_code,
								'postcodeanywhere_license_key'=>$postcode_lic_key
								)
					);
			
			$this->redirect('index.php?r=setup/postcodeAnywhereView',array('model'=>$model));
			
		}//end of if(isset()).
		
		
		$this->render('postcodeAnywhereSetup',array('model'=>$model));
	}//end of actionPostcodeAnywhereSetup().
	
	public function actionPostcodeAnywhereView()
	{
		$model=$this->loadModel(1);
		$this->render('postcodeAnywhereView',array('model'=>$model));
	}//end of actionPostcodeAnywhereView().
	
	
	
	
	public function actionSendTestEmail()
	{
		$model=new Setup;
		
		// uncomment the following code to enable ajax-based validation
		/*	if(isset($_POST['ajax']) && $_POST['ajax']==='setup-sendTestEmail-form')
			{
			echo CActiveForm::validate($model);
			Yii::app()->end();
			}
		*/
		
		if(isset($_POST['Setup']))
		{
		 
			



			
			$model->attributes=$_POST['Setup'];
			$reciever_email_address=$model->email;
			$body=$model->alternate;
			$subject="Notification Test from Rapport Call Handling";
			
			/*
			echo "I am here";
			echo "<br> EMAIL IS :".$model->email;
			echo "<br> Body is IS :".$model->alternate;
			echo "<br> Subject IS :".$subject;
			*/
			
			$success_msg="";
			
			if (NotificationRules::model()->sendEmail($reciever_email_address, $body, $subject))
			{
				$success_msg="The Test Email has been successfully sent";				
			}else
			{
				$success_msg="ERROR : There was problem in sending your email. Please check your settings again or the email address";				
			}
			
			
			echo "<script>alert('$success_msg');</script>";
			
		 
			
			
			
			
			 
		}
		$this->render('mailSettings',array('model'=>$model));
	}
	
	
}//end of class.
