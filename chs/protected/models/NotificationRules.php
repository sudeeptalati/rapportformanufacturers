<?php

/**
 * This is the model class for table "notification_rules".
 *
 * The followings are the available columns in table 'notification_rules':
 * @property integer $id
 * @property integer $job_status_id
 * @property string $active
 * @property integer $customer_notification_code
 * @property integer $engineer_notification_code
 * @property integer $warranty_provider_notification_code
 * @property string $notify_others
 * @property string $created
 * @property string $modified
 * @property string $delete
 *
 * The followings are the available model relations:
 * @property JobStatus $jobStatus
 * @property NotificationCode $warrantyProviderNotificationCode
 * @property NotificationCode $engineerNotificationCode
 * @property NotificationCode $customerNotificationCode
 */
class NotificationRules extends CActiveRecord
{
	public $status_changed;
	public $customer_notification;
	public $engineer_notification;
	public $warranty_provider_notification;
	public $created;
	public $custom_column;
			
	/**
	 * Returns the static model of the specified AR class.
	 * @return NotificationRules the static model class
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
		return 'notification_rules';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('job_status_id', 'required'),
			array('job_status_id, customer_notification_code, engineer_notification_code, warranty_provider_notification_code', 'numerical', 'integerOnly'=>true),
			array('active, notify_others, created, modified, delete', 'safe'),
			array('job_status_id','unique','message'=>'{attribute}:{value} already exists!'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, job_status_id, active, customer_notification_code, engineer_notification_code, warranty_provider_notification_code, notify_others, created, modified, delete', 'safe', 'on'=>'search'),
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
			'jobStatus' => array(self::BELONGS_TO, 'JobStatus', 'job_status_id'),
			'warrantyProviderNotificationCode' => array(self::BELONGS_TO, 'NotificationCode', 'warranty_provider_notification_code'),
			'engineerNotificationCode' => array(self::BELONGS_TO, 'NotificationCode', 'engineer_notification_code'),
			'customerNotificationCode' => array(self::BELONGS_TO, 'NotificationCode', 'customer_notification_code'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'job_status_id' => 'Job Status',
			'active' => 'Enabled',
			'customer_notification_code' => 'Customer ',
			'engineer_notification_code' => 'Engineer ',
			'warranty_provider_notification_code' => 'Warranty Provider ',
			'notify_others' => 'Notify Others',
			'created' => 'Created on',
			'modified' => 'Last Modified on',
			'delete' => 'Delete',
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
		
		$criteria->with = array('jobStatus');
		$criteria->compare( 'jobStatus.name', $this->status_changed, true );

		$criteria->compare('id',$this->id);
		$criteria->compare('job_status_id',$this->job_status_id);
		$criteria->compare('active',$this->active,true);
		$criteria->compare('customer_notification_code',$this->customer_notification_code);
		$criteria->compare('engineer_notification_code',$this->engineer_notification_code);
		$criteria->compare('warranty_provider_notification_code',$this->warranty_provider_notification_code);
		$criteria->compare('notify_others',$this->notify_others,true);
		$criteria->compare('created',$this->created,true);
		$criteria->compare('modified',$this->modified,true);
		$criteria->compare('delete',$this->delete,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}//end of search.
	
	protected function beforeSave()
    {
    	if(parent::beforeSave())
        {
        	//********** Creating new record
        	if($this->isNewRecord)  
            {
        		$this->created=time();
        		return true;
            }//END OF IF NEW RECORD.
            else
            {
            	$this->modified=time();
            	return true;
            }//END OF ELSE, THIS BIT IS CALLED IN UPDATE.
            
        }//end of if(parent())
    }//end of beforeSave().
    
    
    protected function afterSave()
    {
    	
    }//end of afterSave().
    
	
    public function getNotificationCode($email_status,$sms_status)
	{
		$email_value;
		$sms_value;
		/**RETURNING CODE IS (Refer Table) 
		 * 	0- NONE
		 * 	1- Email Only
		 *  2- SMS Only
		 *  3- Email & SMS
		 * */
		//echo "in model method";
		$emailNotificationCodeModel = NotificationCode::model()->findByAttributes(
																array(
																'notify_by'=>'email'
															));
		//echo "<hr>EMAIL id got from db using findall = ".$emailNotificationCodeModel->id;	
		$emailNotifyId = $emailNotificationCodeModel->id;														
		
		$smsNotificationCodeModel = NotificationCode::model()->findByAttributes(
																array(
																'notify_by'=>'sms'
															));
		//echo "<hr>SMS id got from db using findall = ".$smsNotificationCodeModel->id;
		$smsNotifyId = $smsNotificationCodeModel->id;
		
		if ($email_status==true)
		{
			//$email_value=1;	///*You can also write logic here to get email code by findAllByAttribute and sending value as 'email' *//
			$email_value = $emailNotifyId;
		}
		else
		{ 
			$email_value=0;
		}
		
		if ($sms_status==true)
		{
			//$sms_value=2;	///*You can also write logic here to get email code by findAllByAttribute and sending value as 'sms' *//
			$sms_value = $smsNotifyId;
		}
		else
		{ 
			$sms_value=0;
		}
		
		$notification_code=$email_value+$sms_value;
		return $notification_code;

					
	}///end of function getNotificationCode($email_status,$sms_status)
	
	public function getEmailCheckBoxStatus($notification_code)
	{
		switch($notification_code) { 
			
			case 0://*Since none is value of 0*//
				return false;
				break;
			case 1://*Since Email only is value of 1*//
				return true;
				break;
			case 2://*Since SMS only is value of 1*//
				return false;
				break;
			case 3://*Since Email & SMS is value of 3*//
				return true;
				break;
			
		}//end of switch
	}//getEmailCheckBoxStatus($notification_code)
	
	
	public function getSMSCheckBoxStatus($notification_code)
	{
		switch($notification_code) { 
			
			case 0://*Since none is value of 0*//
				return false;
				break;
			case 1://*Since Email only is value of 1*//
				return false;
				break;
			case 2://*Since SMS only is value of 1*//
				return true;
				break;
			case 3://*Since Email & SMS is value of 3*//
				return true;
				break;
			
		}//end of switch
	}//getEmailCheckBoxStatus($notification_code)
	
	public function notifyByEmailAndSms($receiver_email_address, $telephone, $notificaionCode, $body, $subject, $smsMessage)
	{
		//echo "<br>Receiver email addresss = ".$receiver_email_address;
		//echo "<br>Telephone no = ".$telephone;
		//echo "<br>Notification code in model = ".$notificaionCode;
		$response_array = array();
		switch ($notificaionCode)
		{
			case 1:
				//echo "<br>Send email";
				
				//************ ADDING TASK TO TASKS TO DO TABLE *******
				$tasksModel = new TasksToDo();
				$tasksModel->task = 'email';
				$tasksModel->status = 'pending';
				$tasksModel->msgbody =  $body;
				$tasksModel->subject =  $subject;
				$tasksModel->send_to = $receiver_email_address;
				$tasksModel->created = time();
				
				$tasksModel->save();
				//******** END OF ADDING TASK TO TASKS TO DO TABLE *******
				
				/*
				$email_response = NotificationRules::sendEmail($receiver_email_address, $body, $subject);
				$response_array['sms_response']= 'none';
				$response_array['email_response']= $email_response;
				return $response_array;
				*/
				break;
				
			case 2:
				//echo "<br>Send SMS";
				
				//************ ADDING TASK TO TASKS TO DO TABLE *******
				$tasksModel = new TasksToDo();
				$tasksModel->task = 'sms';
				$tasksModel->status = 'pending';
				$tasksModel->msgbody =  $smsMessage;
				$tasksModel->send_to = $telephone;
				$tasksModel->created = time();
				
				$tasksModel->save();
				//******** END OF ADDING TASK TO TASKS TO DO TABLE *******
				
				/*
				$sms_response = NotificationRules::sendSMS($telephone, $smsMessage);
				//echo "<br> sms notification message in model = ".$sms_response;
				$response_array['sms_response']= $sms_response;
				$response_array['email_response']= 'none';
				return $response_array;
				*/
				break;
				
				
			case 3:
				echo "<br>Send email and SMS also";
				
				//************ ADDING EMAIL TASK TO TASKS TO DO TABLE *******
				$tasksModel = new TasksToDo();
				$tasksModel->task = 'email';
				$tasksModel->status = 'pending';
				$tasksModel->msgbody =  $body;
				$tasksModel->subject =  $subject;
				$tasksModel->send_to = $receiver_email_address;
				$tasksModel->created = time();
				
				$tasksModel->save();
				//******** END OF ADDING EMAIL TASK TO TASKS TO DO TABLE *******
				
				//************ ADDING SMS TASK TO TASKS TO DO TABLE *******
				$tasksModel = new TasksToDo();
				$tasksModel->task = 'sms';
				$tasksModel->status = 'pending';
				$tasksModel->msgbody =  $smsMessage;
				$tasksModel->send_to = $telephone;
				$tasksModel->created = time();
				
				$tasksModel->save();
				//******** END OF ADDING SMS TASK TO TASKS TO DO TABLE *******
				
				
				/*
				$sms_response = NotificationRules::sendSMS($telephone, $smsMessage);
				$email_response = NotificationRules::sendEmail($receiver_email_address, $body, $subject);
				//echo "<br> sms notification message in model = ".$sms_response;
				$response_array['sms_response']= $sms_response;
				//echo "<br>TYPE OF RESPONSE IN MODEL FUNC = ".gettype($sms_response);
				$response_array['email_response']= $email_response;
				return $response_array;
				*/
				break;
				
		}//end of switch().
		
	}//end of sendCustomerEmailAndSms().
	
	
	public function sendEmail($reciever_email_address, $body, $subject, $callsheet_pdfattachment=null, $other_attachments=null )
	{
		$email_response = '';
		$email_body =nl2br($body);
		
		$setupModel = Setup::model()->findByPk(1);
		$company_name = $setupModel->company.' - '.Yii::app()->user->name;
		
		$reciever_email=$reciever_email_address;
		$sender_email=$setupModel->getloggedinuseremail();
		
		try 
		{
			//****** SENDING CODE FROM PHPMAILER ****************
			Yii::import('application.vendors.*');
			require_once ('mailer/class.phpmailer.php');
				
			$host = Yii::app()->params['smtp_host'];
			//echo "<br>Host value from main = ".$host;
			$username = Yii::app()->params['smtp_username'];
			//echo "<br>Host value from main = ".$username;
			$password = Yii::app()->params['smtp_password'];
			//echo "<br>Host value from main = ".$password;
			$encry = Yii::app()->params['smtp_encry'];
			//echo "<br>Host value from main = ".$encry;
			$smtp_auth = Yii::app()->params['smtp_auth'];
			//echo "<br>SMTP authentication = ".$smtp_auth;
			$smtp_port = Yii::app()->params['smtp_port'];
			//echo "<br>SMTP authentication = ".$smtp_auth;
			
			
			
			//$sender_email = $username;
				
			$mail = new PHPMailer();

			$mail->IsSMTP();
			$mail->SMTPAuth = $smtp_auth;
			$mail->Host = $host;  // Specify main and backup server
			$mail->Username = $username;// SMTP username
			$mail->Password = $password;// SMTP password
			$mail->SMTPSecure = $encry;  
			$mail->Port       = $smtp_port;
			$from_name = $company_name;
				
			$mail->From = $sender_email;
			$mail->FromName = $from_name;
			$mail->AddAddress($reciever_email);  // Add a recipient
			$mail->AddBCC($sender_email);
			$mail->AddReplyTo($sender_email);

            if ($callsheet_pdfattachment!=null)
            {
                $mail->AddStringAttachment($callsheet_pdfattachment['pdf'], $callsheet_pdfattachment['filename'], $encoding = 'base64', $type = 'application/pdf');
            }


			if ($other_attachments!=null)
			{
				foreach ($other_attachments as $oa)
				{
					$mail->addAttachment($oa['location'], $oa['filename']);
				}

			}


            $mail->WordWrap = 50;                                 // Set word wrap to 50 characters
			//$mail->AddAttachment('/var/tmp/file.tar.gz');         // Add attachments
			//$mail->AddAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
			$mail->IsHTML(true);                                  // Set email format to HTML
				
			$mail->Subject = $subject;
			$mail->Body = $email_body;
			//$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
			
			if(!$mail->Send())
			{
				echo "<br>Mailer Error: " . $mail->ErrorInfo."<hr>";
				echo "<br>Mailer Error: " . $mail->ErrorInfo."<hr>";
				echo "<br> IsSMTP: ".$mail->IsSMTP();
				echo "<br> SMTPAuth: ".$mail->SMTPAuth; 
				echo "<br> Host: ".$mail->Host ;  // Specify main and backup server
				echo "<br>Username :".$mail->Username ;// SMTP username
				echo "<br>Password :".$mail->Password ;// SMTP password
				echo "<br>SMTPSecure :".$mail->SMTPSecure ;  
				echo "<br>SMTP PORT :".$mail->Port ;  
				
				$email_response = 0;
			}
			else
			{
				//echo "<br>Mail sent<hr>";
				$email_response = 1;
			}
			
		}//end of try.
		catch (Exception $e) 
		{
			echo $e->getMessage();
			$email_response = 0;
		}
		
		return $email_response;
		
	}//end of sendEmail().
	
	public function sendSMS($mobileNumber, $smsMessage)
	{
		//echo "sendSMS func called";
		$response = Yii::app()->sms->send(array('to'=>$mobileNumber, 'message'=>$smsMessage));
		//print_r($response);
		
		if(isset($response[1]))
		{
			//echo "<br>error mesg = ".$response[1];
			return $response[1];
		}
		else 
			return true;
		
	}//end of sendSMS().
	
	public function performNotification($status_id, $service_id)
	{
		$info = '';
		//echo "<hr>in perform validation function, follwoing data is from this func";
		//echo "<br>Value of status_id = ".$status_id;
		//echo "<br>Value of service_id = ".$service_id;
	
		$serviceModel = Servicecall::model()->findByPk($service_id);
		$setupModel = Setup::model()->findByPk(1);
	
		$cust_id = $serviceModel->customer_id;
		$engineer_id = $serviceModel->engineer_id;
		$contract_id = $serviceModel->product->contract_id;
		$company_name = $setupModel->company;
		$company_email = $setupModel->email;

		$product_type_name=$serviceModel->product->productType->name;
		$product_brand=$serviceModel->product->brand->name;
		//echo "<br>cust id = ".$cust_id;
		//echo "<br>engg id = ".$engineer_id;
		//echo "<br>contract id = ".$contract_id;
	
		$notificationModel = NotificationRules::model()->findAllByAttributes(array('job_status_id'=>$status_id, 'active'=>'1'));
	
		if(count($notificationModel)!=0)
		{
			//echo "<br>Rule is present";
			$serviceDetailsModel = Servicecall::model()->findByPk($service_id);
				
			//echo "<br>Service reference no = ".$serviceDetailsModel->service_reference_number;
			$reference_number = $serviceDetailsModel->service_reference_number;
			//echo "<br>Fault Desc = ".$serviceDetailsModel->fault_description;
			$fault_desc = $serviceDetailsModel->fault_description;
			//echo "<br>Customer Name = ".$serviceDetailsModel->customer->fullname;
			$customer_name = $serviceDetailsModel->customer->fullname;
			//echo "<br>Engineer Name = ".$serviceDetailsModel->engineer->fullname;
			$engineer_name = $serviceDetailsModel->engineer->company.', '.$serviceDetailsModel->engineer->fullname;
				
			$jobStatusModel = JobStatus::model()->findByPk($status_id);
			//echo "<br>Status id from job model = ".$jobStatusModel->name;
			$status = $jobStatusModel->name;
				
			$subject = 'Service call '.$reference_number.' Status changed to '.$status;
			//echo "<br>Subject = ".$subject;
				
			$body = '<br>  The status of your '.$product_brand.' '.$product_type_name.' servicecall with reference no '.$reference_number.' is changed to '.$status."\n".'Engineer: '.$engineer_name.'<br><br>For any queries related to this call, please contact '.$company_email.'. <br><br>Regards,<br>'.$company_name;
			$smsMessage = 'Dear '.$customer_name.', The status of your '.$product_brand.' '.$product_type_name.' servicecall with reference no '.$reference_number.' is changed to '.$status."\n".'Engineer: '.$engineer_name;
		
			foreach($notificationModel as $data)
			{
				$customerNotificationCode =$data->customer_notification_code;
				$engineerNotificationCode =$data->engineer_notification_code;
				$warrantyProviderNotificationCode =$data->warranty_provider_notification_code;
				$othersNotificationCode =$data->notify_others;
	
				if($customerNotificationCode != 0)
				{
					$customerModel = Customer::model()->findByPk($cust_id);
					$receiver_email_address = $customerModel->email;
					$telephone = $customerModel->mobile;
					$name = $customerModel->fullname;
					$customer_body = 'Dear '.$name.','."<br>".$body;
	
					$response = NotificationRules::model()->notifyByEmailAndSms($receiver_email_address, $telephone, $customerNotificationCode, $customer_body, $subject, $smsMessage);
					//$info.= $this->createMessage($response, 'customer');
					$info .= NotificationRules::model()->createMessage($response, 'customer'); 
					//echo "<br>INFO returned from func = ".$info;
					//return $response;
	
				}//end of if of CUSTOMER.
	
				if($engineerNotificationCode != 0)
				{
					$engineerModel = Engineer::model()->findByPk($engineer_id);
					$receiver_email_address = $engineerModel->contactDetails->email;
					//echo "<br>Engineer telephone = ".$engineerModel->contactDetails->mobile;
					$telephone = $engineerModel->contactDetails->mobile;
					$name = $engineerModel->fullname;
					$engineer_body = 'Dear '.$name.','."\n".$body;
	
					$response = NotificationRules::model()->notifyByEmailAndSms($receiver_email_address, $telephone, $engineerNotificationCode, $engineer_body, $subject, $smsMessage);
					$info .= NotificationRules::model()->createMessage($response, 'engineer');
				}//end of if of ENGINEER.
					
				if($warrantyProviderNotificationCode != 0)
				{
					$contractModel = Contract::model()->findByPk($contract_id);
					$receiver_email_address = $contractModel->mainContactDetails->email;
					//echo "<br>Warranty Provider telephone = ".$contractModel->mainContactDetails->mobile;
					$telephone = $contractModel->mainContactDetails->mobile;
					$warranty_body = 'Dear Recepient,'."\n".$body;
	
					$response = NotificationRules::model()->notifyByEmailAndSms($receiver_email_address, $telephone, $warrantyProviderNotificationCode, $warranty_body, $subject, $smsMessage);
					$info .= NotificationRules::model()->createMessage($response, 'warranty provider');
				}//end of if of WARRANTY PROVIDER.
					
				if($othersNotificationCode != 0)
				{
					//echo "<hr>INSIDE Others Notification code IF ELSE BLOCK = ".$othersNotificationCode;
					//echo "<br>Notification rule id = ".$data->id."<hr>";
					$notificationContactModel = NotificationContact::model()->findAllByAttributes(array('notification_rule_id'=>$data->id));
					foreach ($notificationContactModel as $contact)
					{
						//echo "<br>Others email address = ".$contact->email;
						$receiver_email_address = $contact->email;
						//echo "<br>Others telephone = ".$contact->mobile;
						$telephone = $contact->mobile;
						//echo "<br>Other name = ".$contact->person_name;
						$name = $contact->person_name;
						$others_body = 'Dear '.$name.','."\n".$body;
						$other_notification_code = $contact->notification_code_id;
	
						$response = NotificationRules::model()->notifyByEmailAndSms($receiver_email_address, $telephone, $other_notification_code, $others_body, $subject, $smsMessage);
						$info .= NotificationRules::model()->createMessage($response, 'others');
					}//end of inner foreach($contact).
						
				}//end of if of OTHERS.
	
			}//end of foreach($notificationModel).
			
				
		}//end of count($notificationModel).
		return $info;
	}//end of performNotification().
	
	public function createMessage($notifyStatusArray, $notifiedTo)
	{
	
	
		/* SMS API RETURNS 1 ON SUCCESFUL SMS SENT, OR RESTURNS EMPTY STRING.
		 * EMAIL SUCESSFUL SENT RETURNS 1 ELSE RETURNS 0.
		* */
		$msg = '';
		//echo "<br>SMS response in createMesg func = ".$notifyStatusArray['sms_response'];
	
		if($notifyStatusArray['sms_response'] == '1')
		{
			//echo "<br>!!!!!!!!!!!!!!!!!!!!!!!!!!.............. sms sent sucessfully ......!!!!!!!!!";
			$msg .= "<br><span style='background-color:#C9E0ED; color:#555555;   border-radius:10px 10px 10px 10px; '>SMS has been sent to ".$notifiedTo.". </span>";
		}
		elseif($notifyStatusArray['sms_response'] != 'none')
		{
			//echo "<br> SMS NOT SENT PROPERLY................!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!";
			$msg = $msg."<br><div style='background-color:#CD0000; color:white;   border-radius:10px 10px 10px 10px; '>Please check your sms settings or make sure the mobile number ".$notifiedTo." is valid. &nbsp;&nbsp;&nbsp;Server Response:<i> ".$notifyStatusArray['sms_response'].".</i></div>";
		}//end of if(sms_response)
	
		if($notifyStatusArray['email_response'] == 1)
		{
			//echo "<br>Email sent sucessfully ......!!!!!!!!!";
			$msg = $msg."<br><span style='background-color:#C9E0ED; color:#555555;   border-radius:10px 10px 10px 10px; '>Email has been sent to ".$notifiedTo.". </span>";
		}
		elseif($notifyStatusArray['sms_response'] != 'none')
		{
			//echo "<br>Error in sending email, check EMAIL settings.";
			$msg = $msg."<br><span style='background-color:red; color:#CD0000;   border-radius:10px 10px 10px 10px; '>Error in sending email to ".$notifiedTo.", check EMAIL settings.</span>";
		}
		//echo "<br> Message returned for ".$notifiedTo." = ".$msg;
		
		//return $msg;
		return "";
		
	
	}//end of createMessage().
	
	
 
	
	
	
}//end of class.