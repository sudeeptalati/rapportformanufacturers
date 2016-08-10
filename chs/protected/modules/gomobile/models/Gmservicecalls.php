<?php

/**
 * This is the model class for table "gm_servicecalls".
 *
 * The followings are the available columns in table 'gm_servicecalls':
 * @property integer $id
 * @property integer $servicecall_id
 * @property integer $service_reference_number
 * @property integer $server_status_id
 * @property integer $created
 * @property integer $modified
 * @property string $comments
 * @property string $data_sent
 * @property string $data_recieved
 * @property string $communications
 * @property string $event_log
 *
 */
class Gmservicecalls extends CActiveRecord
{
	public $servicecall_status;
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'gm_servicecalls';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('servicecall_id, service_reference_number, server_status_id, created, modified', 'numerical', 'integerOnly'=>true),
			array('servicecall_status, data_sent, 	data_recieved, communications, event_log, comments', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array(' id, servicecall_id, service_reference_number, server_status_id, created, modified, comments', 'safe', 'on'=>'search'),
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
		'jobstatus'=>	array(self::BELONGS_TO, 'JobStatus', 'server_status_id'),
		'servicecall'=> array(self::BELONGS_TO, 'Servicecall', 'servicecall_id')
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'servicecall_id' => 'Servicecall',
			'service_reference_number' => 'Service Reference Number',
			'server_status_id' => 'Server Status',
			'created' => 'Claim Download Date',
			'modified' => 'Modified',
			'comments' => 'Comments',
			'data_sent' => 'Data Sent',
			'data_recieved' => 'Data Recieved',
			'communications' => 'Communications for this job',
			'event_log' => 'Event Log',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

	
        $criteria=new CDbCriteria;
		
		$criteria->compare('id',$this->id);
        $criteria->compare('servicecall_id',$this->servicecall_id);
        $criteria->compare('service_reference_number',$this->service_reference_number,true);
        $criteria->compare('server_status_id',$this->server_status_id);
        $criteria->compare('created',$this->created);
        $criteria->compare('modified',$this->modified);
        $criteria->compare('comments',$this->comments,true);
        $criteria->compare('data_sent',$this->data_sent,true);
        $criteria->compare('data_recieved',$this->data_recieved,true);
        $criteria->compare('communications',$this->communications,true);
        $criteria->compare('event_log',$this->event_log,true);
        
      
        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
            'sort'=>array('defaultOrder'=>'modified DESC'),
        ));
	}///end of search
	
	public function getdatabyserverstatusid($server_status_id)
	{
		$criteria=new CDbCriteria;
		$criteria->compare('server_status_id',$server_status_id);
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}////end of getdatabyserverstatusid

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return GmServicecalls the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	////creating function to load json file
	public function loadsetupjson()
		 {
			$url = 	Yii::getPathOfAlias('application.modules.gomobile.components');	
			//echo $url.'/graph.json';
			$string = file_get_contents($url.'/setup.json');
			//echo $string;
			$json_a=json_decode($string,true);
			//print_r ($json_a);
			return $json_a;
			
		 }///end of loadjson
	
	
	
	protected function beforeSave()
    {
    	if(parent::beforeSave())
        {

			if($this->isNewRecord)  // Creating new record 
            {
        		$this->created=time();
    			return true;
            }
            else
			{
				$this->modified=time();
				return true;
            }
        }//end of if(parent())
    }//end of beforeSave()
	
	
	public function getserverurl()
	{
		$json_data=$this->loadsetupjson();
		return $json_data['gomobile_server_url'];
	}//END OF public function getserverurl
	
	public function setserverurl($url)
	{
		$json_data=$this->loadsetupjson();
		return $json_data['gomobile_server_url'];
	}//END OF public function getserverurl
	
	
	
	
	
	public function getaccountid()
	{
		$json_data=$this->loadsetupjson();
		return $json_data['gomobile_account_id'];
	}//END OF public function Getaccountid
	
	public function setaccountid($account_id)
	{	
		defined('DS') ? null : define('DS', DIRECTORY_SEPARATOR);	
		$url = 	Yii::getPathOfAlias('application.modules.gomobile.components');	
		$file=$url.DS.'setup.json';
		$string=json_decode(file_get_contents($file));
		print_r($string->gomobile_account_id);
		$string->gomobile_account_id=$account_id;
		//echo $data['gomobile_account_id'];
		$data=json_encode($string);
		file_put_contents($file,$data); 

	}//END OF public function Getaccountid
	
	
	public function recieveservicecallfromserver()
	{
		$system_message="";
		$url=Gmservicecalls::model()->getserverurl();
		$final_url=$url.'index.php?r=server/getdatafordesktop';


		$engg_emails=Engineer::model()->getAllEngineersemailsincsv();

		$data='gomobile_account_id=AMICA&engineer_emails='.$engg_emails;
		$method='POST';

		$url = $final_url;
		$fields_string='';
		$fields = array(
			'engg_emails'=>$engg_emails,
			'engg_emails'=>'AMICA'
		);

//url-ify the data for the POST
		foreach($fields as $key=>$value) { $fields_string .= $key.'='.$value.'&'; }
		rtrim($fields_string,'&');

		$results= Setup::model()->callurl($url,$data,$method,count($fields) );


		$results_json=json_decode($results);

		if ($results_json->status=='OK')
		{
			$system_message.= 'Saving Servicecalls.';
			$data=json_decode($results_json->data);

			foreach ($data  as $recieved_sc_data )
			{
                if ($recieved_sc_data->type=='servicecall_data')
                {
					$servicecall_status=35;

                }else
                {
					$servicecall_status=0;
                }

				$this->saverecieveddatatoservicecalls($servicecall_status,$recieved_sc_data->service_reference_number, $recieved_sc_data->sent_data->data_sent, $recieved_sc_data->sent_data->communications);

			}
		}
		else
		{
			$system_message.="There are no servicecalls";
		}

		echo $system_message;


	}///end of 	public function recieveservicecallfromserver()


	public function saverecieveddatatoservicecalls($service_status,$ser_ref_no, $data, $communications )
	{
//		echo $ser_ref_no.$data.$communications;
		/*
		$model=new Gmservicecalls;

		*/
		$id=$this->getgomobileidbyservicereferenceno($ser_ref_no);
        $model=Gmservicecalls::model()->findByPk($id);
        $model->server_status_id=37;///as msg unread
        $model->data_recieved=$data;
        $model->communications=$communications;
        //$model->event_log=$model->event_log.'DATA Recieved';
        $model->save();

		////Only update servicecall status if it is service data
		if ($service_status!=0)
	        $this->updatestatusbygomobileid($id,$service_status);

	}////end of public function saverecieveddatatoservicecalls()


	public function getserviceidbyservicerefrencenumber($service_reference_number)
	{

		$sc_model=Servicecall::model()->findByAttributes(array('service_reference_number'=>$service_reference_number));
        if ($sc_model)
            return $sc_model->id;
        else
            return null;

	}//end of getserviceidbyservicerefrencenumber



	public function getgomobileidbyservicereferenceno($service_reference_number)
	{
		$model = Gmservicecalls::model()->findByAttributes(array('service_reference_number' => $service_reference_number));
		if ($model)
			return $model->id;
		else
			return null;
	}///end of 	public function getgomobileidbyservicereferenceno($service_reference_number)


	public function getgomobileidbyservicecallid($servicecall_id)
	{
		$model = Gmservicecalls::model()->findByAttributes(array('servicecall_id' => $servicecall_id));
		if ($model)
			return $model->id;
		else
			return null;
	}///end of 	public function getgomobileidbyservicereferenceno($service_reference_number)







	public function getportalurl()
    {
        return 'http://portal.amicaservice.co.uk/aep/';
    }


    public function getgomobileid()
    {
        return 'AMICA';
    }



    public function sendmessagetoengineer($service_reference_number, $msg, $claim_status)
    {
        $system_message='';
        $gm_id= Gmservicecalls::model()->getgomobileidbyservicereferenceno($service_reference_number);
        $model=Gmservicecalls::model()->findBypk($gm_id);


        $gomobile_account_id=$model->getgomobileid();

        $servicecall_id=$model->getserviceidbyservicerefrencenumber($service_reference_number);
        $servicecall_model = Servicecall::model()->findByPk($servicecall_id);

        $engineer_email=$servicecall_model->engineer->contactDetails->email;


        $chat_array = array();
        $chat_array['date'] = date( 'l jS \of F Y h:i:s A' );
        $chat_array['person'] = 'AMICA';
        $chat_array['message'] = $msg;



        $data_array=array();
        $data_array['service_reference_number']=$service_reference_number;
        $data_array['communications']=$chat_array;
        $data_array['claim_status']=$claim_status;
        $data_array['type']= 'chat_message';


        $data = array("data" => json_encode($data_array), "engineer_email"=>$engineer_email,"gomobile_account_id"=>$gomobile_account_id, "service_reference_number"=>$service_reference_number);

        $url=Gmservicecalls::model()->getserverurl()."index.php?r=server/getmessagefromportal";
        $method='POST';
        $fieldscount=count($data);

        $response= Setup::model()->callurl($url,$data,$method,$fieldscount);


        $response_array=json_decode($response,true);
        if ($response_array['status']=='OK')
        {
            $system_message.='Message sent ';

			/////Send email to the engineer about chat message
			$engineer_email;
			$engg_email_subject="Message recieved on amica portal - Job Ref. No# ".$service_reference_number;
			$engg_email_body="You have recieved following message on Amica Portal. ";
			$engg_email_body.="<a target='_blank' href='http://portal.amicaservice.co.uk/aep/index.php?r=servicecalls/mycalls' >Click here</a> to login in to the portal. <hr>";
			$engg_email_body.="<br><b>Amica Says:</b> ".$msg;
			
			$mailsent=NotificationRules::model()->sendEmail($engineer_email, $engg_email_body, $engg_email_subject);

			if (!$mailsent)
                $system_message.=" Message Email could not be sent";
            else
                $system_message.=", Engineer notified by email ";
            

			
			
			
            ///also add message to your communications
			$fullchat = $model->communications;
            $full_chat_array = json_decode( $fullchat, true );
            array_push( $full_chat_array['chats'], $chat_array );
            $model->communications = json_encode( $full_chat_array );
            $model->server_status_id =$claim_status;

            if ($model->save())
                $system_message.='and Saved';



        }else
        {
            $system_message.='Cannot deliver message:';
        }


        return $system_message;
    }//end of     public function sendmessagetoengineer()



    public function updatestatusbygomobileid($id, $status_id)
    {

        $model=$this->loadModel($id);
        $model->server_status_id=$status_id;

		$log='<tr>';
		$log.='<td>'.date('d-M-Y h:i A').'</td>';
		$log.='<td>'.$model->jobstatus->html_name.'</td>';
		$log.='<td>'.Yii::app()->user->name.'</td>';
		$log.='</tr>';
		$model->event_log.=$log;
			
        if ($model->save())
        {
            Servicecall::model()->updateByPk($model->servicecall_id,
                array(
                    'job_status_id'=>$status_id
                )
            );

			Servicecall::model()->updateactivitylog($model->servicecall_id);

            return true;
        }

        return false;

    }//end of public function updatestatusbyid($id)

    public function loadModel($id)
    {
        $model = Gmservicecalls::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }


	public function checkfornewdataonserver()
	{
		$url=Gmservicecalls::model()->getserverurl()."index.php?r=server/checkfornewdata";
        $method='POST';
        $data=array();
        $fieldscount=count($data);

        $response= Setup::model()->callurl($url,$data,$method,$fieldscount);
		return $response;
	}////end of	public function checkfornewmessages()


	public function getservicecallsbystatusescount($status_id)
	{
		$output=array();
		$output['count']=0;
		$output['html_name']='';
		
		
		if ($status_id){
			
			$jobstatus=JobStatus::model()->findByPk($status_id);
			
			$criteria=new CDbCriteria();
			$criteria->select="id";
			$criteria->addCondition('server_status_id='.$status_id); 
			$count=Gmservicecalls::model()->count($criteria);
			
			/*
			$output['count']='<div style="background:'.$jobstatus->backgroundcolor.';">'.$count.'</div>';
			$output['html_name']=$jobstatus->html_name;
			*/

			$output['count']=$count;
			$output['jobstatus_name']=$jobstatus->name;
			$output['html_name']='<div style="padding: 5px 5px 5px 30px; border-radius: 10px;background:'.$jobstatus->backgroundcolor.';">';
			$output['html_name'].='<table><tr><td>'.$jobstatus->name.'</td><td>'.$count.'</td></tr></table>';
			$output['html_name'].='</div>';
			
			
			
			
		}//END OF if ($stauts_id)
	 	
	 	return $output;
		
	}///end of public function getservicecallsstatusescount()
	
	
	public function moveengineerchathistorytocomments($service_id)
	{
	
		echo 'I am called'.$service_id;
		
		$servicecall_model=Servicecall::model()->findByPk($service_id);
		$gm_serviceid=$this->getgomobileidbyservicereferenceno($servicecall_model->service_reference_number);
		
		$gmservicecallmodel=Gmservicecalls::model()->findByPk($gm_serviceid);
		
		if ($gmservicecallmodel)
		{
			$old_engineer=$servicecall_model->engineer->company.'-'.$servicecall_model->engineer->fullname ;
			$chat_history=$gmservicecallmodel->communications;
			
			
			$chat_html_data='<h6>Engineer changed from '.$old_engineer.'</h6>';
			$fullchatarray = json_decode($gmservicecallmodel->communications, true);
            if ($fullchatarray){
           		$chat_html_data.='<table>';               
           
             	foreach ($fullchatarray['chats'] as $c) 
	            { 	
	          	$chat_html_data.='<tr>';       
				   	$chat_html_data.='<td>'.$c['person'].'</td>';       
		          	$chat_html_data.='<td>'.$c['message'].'</td>';       
	    	      	$chat_html_data.='<td>'.$c['date'].'</td>';       
			  	$chat_html_data.='</tr>';       
    	        }
            $chat_html_data.='</table>';               
            }///end of   if ($fullchatarray){
          
            $chat_history=Setup::model()->updatenotesorcomments($chat_html_data, $servicecall_model, 'comments');
		            
			$servicecall_update=Servicecall::model()->updateByPk($service_id,
			array(
					'comments'=>$chat_history					
			));
			
			$gmservicecallmodel->communications='';

			if($gmservicecallmodel->save())
				return true;
		}

		return false;
		
	}///end of public function moveengineerchathistorytocomments($service_id)

	
}
