<?php

class GmservicecallsController extends RController
{

    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    public $layout = '//layouts/column2';

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
                'actions' => array('index', 'view', 'Servicecallreceivedfromgomobileserver', 'receivedcalls', 'gomobileserverurl', 'getserverurlname'),
                'users' => array('*'),
            ),
            array('allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions' => array('acceptengineerdata', 'admin', 'sentcalls', 'create', 'update', 'servicecallsenttogomobileserver', 'receiveservicecallfrommobile', 'receivedcalldetails'),
                'users' => array('@'),
            ),
            array('allow', // allow admin user to perform 'admin' and 'delete' actions
                'actions' => array('delete'),
                'users' => array('admin'),
            ),
            array('deny',  // deny all users
                'users' => array('*'),
            ),
        );
    }

    /**
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
    public function actionView($id)
    {
        /*
        $system_message = '';
        $this->render('view', array(
            'model' => $this->loadModel($id), 'system_message' => $system_message
        ));*/
       // $this->render('view');

        $model=Gmservicecalls::model()->findByPk($id);

        $this->redirect(array('/servicecall/view&id='.$model->servicecall_id.'#enggreporting'));

    }


    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return GmServicecalls the loaded model
     * @throws CHttpException
     */
    public function loadModel($id)
    {
        $model = Gmservicecalls::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate()
    {
        $model = new Gmservicecalls;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['GmServicecalls'])) {
            $model->attributes = $_POST['GmServicecalls'];
            if ($model->save())
                $this->redirect(array('view', 'id' => $model->id));
        }

        $this->render('create', array(
            'model' => $model,
        ));
    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionUpdate($id)
    {
        $model = $this->loadModel($id);

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['GmServicecalls'])) {
            $model->attributes = $_POST['GmServicecalls'];
            if ($model->save())
                $this->redirect(array('view', 'id' => $model->id));
        }

        $this->render('update', array(
            'model' => $model,
        ));
    }

    /**
     * Deletes a particular model.
     * If deletion is successful, the browser will be redirected to the 'admin' page.
     * @param integer $id the ID of the model to be deleted
     */
    public function actionDelete($id)
    {
        $this->loadModel($id)->delete();

        // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
        if (!isset($_GET['ajax']))
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
    }

    /**
     * Lists all models.
     */
    public function actionIndex()
    {
        $dataProvider = new CActiveDataProvider('Gmservicecalls');
        $this->render('index', array(
            'dataProvider' => $dataProvider,
        ));
    }

    /**
     * Manages all models.
     */
    public function actionAdmin()
    {
    
        $model=new Gmservicecalls('search');
        $model->unsetAttributes();  // clear any default values
        if(isset($_GET['Gmservicecalls']))
            $model->attributes=$_GET['Gmservicecalls'];

        $this->render('admin',array(
            'model'=>$model,
        ));
    }

    public function actionSentcalls()
    {
        $model = new Gmservicecalls('search_receivedcall');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['GmServicecalls']))
            $model->attributes = $_GET['GmServicecalls'];

        $this->render('sentcalls', array(
            'model' => $model,
        ));
    }///end of actionReceivedcalls()

    public function actionReceivedcalls()
    {
        $model = new Gmservicecalls('search_receivedcall');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['GmServicecalls']))
            $model->attributes = $_GET['GmServicecalls'];

        $this->render('admin', array(
            'model' => $model,
        ));
    }

    public function actionReceivedcalldetails($id)
    {
        $model = $this->loadModel($id);

        $this->render('receivedcalldetails', array(
            'model' => $model,
        ));
    }///// end of Servicecallsenttogomobileserver

    public function actionServicecallsenttogomobileserver()
    {
        header("Access-Control-Allow-Origin: *");
        $data_sent = '';
        echo '*********************************************************************';


        if (isset($_POST['servicecall_ids'])) {
            $servicecall_recieved = $_POST['servicecall_ids'];


            $data_sent = $_POST['data_sent'];

//        //$data='{"unsent_servicecalls":[{"service_reference_number":"127550","message":"Servicecall Cannot be Sent as engineer email is not found on the server. Please contact us at www.rapportsoftware.co.uk"},{"service_reference_number":"127548","message":"Servicecall Cannot be Sent as engineer email is not found on the server. Please contact us at www.rapportsoftware.co.uk"}],"sent_servicecalls":[{"service_reference_number":"127542","message":"Servicecall Sent"}]} ';
            $myfulldata = json_decode($servicecall_recieved);
            echo $servicecall_recieved;

            $mydata = $myfulldata->data;

            echo '======' . json_encode($mydata);


            if (count($mydata->unsent_servicecalls) > 0) {

                echo '***************TOTAL UNSNET SERVICEALLS' . count($mydata->unsent_servicecalls);
                foreach ($mydata->unsent_servicecalls as $servicecalls) {
                    $unsent_servicecalls_ref_no = $servicecalls->service_reference_number;
                    //$comments = $servicecalls->message;
                    $sent_status = '32';///as 32 means the job could not be delivered to the engineer
                    $this->savesentservicecallstatus($unsent_servicecalls_ref_no, $sent_status, $data_sent);///since 3 is rejected status

                }
            } else {
                echo '****************TOTAL SENT SERVICEALLS' . count($mydata->sent_servicecalls);
                foreach ($mydata->sent_servicecalls as $servicecalls) {
                    var_dump($servicecalls);
                    $sent_servicecalls_ref_no = $servicecalls->service_reference_number;
                    //$comments = $servicecalls->message;
                    $sent_status = '31';///as 31 means the job is sent to engineer
                    $this->savesentservicecallstatus($sent_servicecalls_ref_no, $sent_status, $data_sent);///since 1 is sent status

                }
            }


        }///end of if  if (isset($_POST['servicecall_ids']))
        else {
            echo 'Cannot post';
        }


    }///end of actionServicecallreceivedfromgomobileserver()

    public function savesentservicecallstatus($service_ref_no, $received_server_status, $data_sent)
    {
        $servicecall_id = Gmservicecalls::model()->getserviceidbyservicerefrencenumber($service_ref_no);

        $gm_id = Gmservicecalls::model()->getgomobileidbyservicereferenceno($service_ref_no);

        if ($gm_id) {
            $model = $this->loadModel($gm_id);
            $model->server_status_id = $received_server_status;

        } else {
            $model = new Gmservicecalls;
            $model->server_status_id = $received_server_status;
        }

        $model->servicecall_id = $servicecall_id;
        $model->service_reference_number = $service_ref_no;
        $model->data_sent = json_encode($data_sent);

        ///blank chat array initialised here
        if (empty($model->communications)) {
            $chatarray['chats'] = array();
            $model->communications = json_encode($chatarray);

        }
        $model->save();

        $model->updatestatusbygomobileid($model->id, $received_server_status);


    }

    public function actionServicecallreceivedfromgomobileserver()
    {
        header("Access-Control-Allow-Origin: *");
        $servicecall_recieved = $_POST['data'];

        $mydata = json_decode($servicecall_recieved);
        //echo json_encode($mydata);
        foreach ($mydata as $servicecalls) {
            $received_servicecalls_ref_no = $servicecalls->service_reference_number;
            $recieved_data = array();

            array_push($recieved_data, $servicecalls->work_carried_out);
            array_push($recieved_data, $servicecalls->images);

            $recieved_data['work_carried_out'] = $servicecalls->work_carried_out;
            $recieved_data['images'] = $servicecalls->images;

            $recieved_data_json = json_encode($recieved_data);


            echo '<hr>SERVIC REF NO#' . $received_servicecalls_ref_no;
            echo '<br>WORK CARRIED OUT#' . $servicecalls->work_carried_out;
            echo '<br>IMAGES #' . $servicecalls->images;
            echo $recieved_data_json;
            //echo '<br>COMMENTS ARE :'.print_r($recieved_data).'<hr>';

            $this->savesentservicecallstatus($received_servicecalls_ref_no, '5', $recieved_data_json);///since status id 5 is received from mobile status
        }//end of foreach


    }

    public function actionReceiveservicecallfrommobile()
    {
        $model = $model = new Gmservicecalls;
        $model->recieveservicecallfromserver();


        $this->redirect(array('/gomobile/gmservicecalls/admin'));

        //$this->render('receiveservicecallfrommobile');

    }////end of public function actionAcceptengineerdata()

    public function actionApprovetheclaim()
    {
        $system_message = '';

        if (isset($_POST['enggdata_gm_id'])) {
            $id = $_POST['enggdata_gm_id'];
            $job_payment_date = strtotime($_POST['job_payment_date']);

            $approved_claim_status_keyword = 'APPROVED';

            $model = $this->loadModel($id);

            $service_reference_number = $model->service_reference_number;
            $servicecall_id = $model->servicecall_id;

            echo $model->data_recieved;
            $recieveddata = json_decode($model->data_recieved, true);

//            $full_recieved_data = json_decode($model->data_recieved, true);
//            $recieveddata = json_decode($full_recieved_data['data'], true);


            ///Importing the data to servicecall
            Servicecall::model()->updateByPk($servicecall_id,
                array(
                    'work_carried_out' => $recieveddata['work_done'],
                    'engg_first_visit_date' => strtotime($recieveddata['first_visit_date']),
                    'job_finished_date' => strtotime($recieveddata['job_completion_date']),
                    'job_payment_date' => $job_payment_date,
                    'engg_claim_returned_date'=>strtotime($recieveddata['submission_date'])
                )
            );


            $approved_claim_status_id=JobStatus::model()->get_status_id_by_keyword($approved_claim_status_keyword);

            if ($model->updatestatusbygomobileid($id, $approved_claim_status_id)) {
                $system_message .= 'Saved <br>';

                /////Now Send a notification to Engineer
                $payment_month = date('F, Y', $job_payment_date);
                $msg = 'Your claim has been approved and you will be paid in month of ' . $payment_month;

                $system_message .= Gmservicecalls::model()->sendmessagetoengineer($service_reference_number, $msg, $approved_claim_status_keyword );

				$this->redirect(array('/servicecall/view&id='.$model->servicecall_id.'&openservicedialog=true'));
            } else
                $system_message .= '<br>There was some problem in changing the status of recieved data' . var_dump($model->getErrors());


        } else ///end of if(isset($_GET['id'])) {

        {
            $system_message .= 'Wrong access';
        }

        //echo  $system_message;

        

        $this->render('view', array(
            'model' => $model, 'system_message' => $system_message
        ));

    }


    public function actionRejectthisclaim()
    {
        $system_message = '';
        if (isset($_POST['gomobile_id'])) {

            $msg = $_POST['chat_msg'];
            $id = $_POST['gomobile_id'];

            $model = $this->loadModel($id);
            $service_reference_number = $model->service_reference_number;
            $claim_status = 'CLAIM_REJECTED'; ///as 54 is the status for Rejected.

            $servicecall_id = $model->servicecall_id;

            if ($model->updatestatusbygomobileid($id, $claim_status)) {
                $system_message .= 'Job Status Changed - ';
                $system_message .= Gmservicecalls::model()->sendmessagetoengineer($service_reference_number, $msg, $claim_status);

            } else {
                $system_message .= 'There has been some problem in this transaction. Please contact support';

            }

        } else { ///end of if (isset($_POST['service_ref_no']))

            $system_message .= 'BAD Access';
        }///else fo if (isset($_POST['service_ref_no']))

        echo $system_message;
    }///end of public function actionRejecttheclaim()


	public function actionNeedmoreinfoonthisclaim()
	{
		$system_message = '';
		
		if (isset($_POST['gomobile_id'])) {

            $msg = $_POST['chat_msg'];
            $id = $_POST['gomobile_id'];

            $model = $this->loadModel($id);
            $service_reference_number = $model->service_reference_number;
            $claim_status = '56'; ///as 56 is the status for Pending More Info

            $servicecall_id = $model->servicecall_id;

            if ($model->updatestatusbygomobileid($id, $claim_status)) {
                $system_message .= 'Job Status Changed - ';
                $system_message .= Gmservicecalls::model()->sendmessagetoengineer($service_reference_number, $msg, $claim_status);

            } else {
                $system_message .= 'There has been some problem in this transaction. Please contact support';

            }

        } else { ///end of if (isset($_POST['service_ref_no']))

            $system_message .= 'BAD Access';
        }///else fo if (isset($_POST['service_ref_no']))
        
         echo $system_message;
		
	}///end of public function actionNeedmoreinfoonthisclaim()



	public function actionCancelthisclaim()
	{
		$system_message = '';
		
		if (isset($_POST['gomobile_id'])) {

            $msg = $_POST['chat_msg'];
            $id = $_POST['gomobile_id'];

            $model = $this->loadModel($id);
            $service_reference_number = $model->service_reference_number;
            $claim_status = '102'; ///as 56 is the status for Cancelling a job

            $servicecall_id = $model->servicecall_id;

            if ($model->updatestatusbygomobileid($id, $claim_status)) {
                $system_message .= 'Job Status Changed - ';
                $system_message .= Gmservicecalls::model()->sendmessagetoengineer($service_reference_number, $msg, $claim_status);

            } else {
                $system_message .= 'There has been some problem in this transaction. Please contact support';

            }

        } else { ///end of if (isset($_POST['service_ref_no']))

            $system_message .= 'BAD Access';
        }///else fo if (isset($_POST['service_ref_no']))
        
         echo $system_message;
		
	}///end of public function actionCancelthisclaim()





    public function actionSendchatmessagetoengineer()
    {
        $system_message = '';

        if (isset($_POST['gomobile_id'])) {

            $only_chat_message = $_POST['only_chat_message'];
            $id = $_POST['gomobile_id'];

            $model = $this->loadModel($id);
            $service_reference_number = $model->service_reference_number;
            
            //$claim_status=$model->server_status_id;
            // Status disabled as We don not want to change the status when message is sent to engineer
            //$claim_status = '36'; ///as 36 is the status for message sent to engineer.

            $claim_status='MESSAGE_SENT';


            $system_message .= Gmservicecalls::model()->sendmessagetoengineer($service_reference_number, $only_chat_message, $claim_status);

            /*
            if ($model->updatestatusbygomobileid($id, $claim_status)) {
                $system_message .= 'Job Status Changed - ';
                $system_message .= Gmservicecalls::model()->sendmessagetoengineer($service_reference_number, $only_chat_message, $claim_status);

            } else {
                $system_message .= 'There has been some problem in sending chat message to engineer. Please contact support';

            }

            */

        } else { ///end of if (isset($_POST['service_ref_no']))

            $system_message .= 'BAD Access';
        }///else fo if (isset($_POST['service_ref_no']))


        echo $system_message;
    }///end of     public function actionSendchatmessagetoengineer()

    public function actionMarkservermessageasread()
    {
        $gm_service_id=$_GET['gmservicecall_id'];
        $servicecall_id=$_GET['servicecall_id'];


        echo '<br>marking as gm service'.$gm_service_id;

        $msg_read_status_id='38';//////read msg jobstatus id
        Gmservicecalls::model()->updategomobile_statusid($gm_service_id, $msg_read_status_id);


        $this->redirect(array('/Servicecall/view&id='.$servicecall_id));

    }///end of public function actionMarkservermessageasread($gm_service_id)

    public function actionMarkservermessageasunread()
    {
        $gm_service_id=$_GET['gmservicecall_id'];
        $servicecall_id=$_GET['servicecall_id'];


        echo '<br>marking as gm service'.$gm_service_id;

        $msg_read_status_id='37';//////unread msg jobstatus id
        Gmservicecalls::model()->updategomobile_statusid($gm_service_id, $msg_read_status_id);


        $this->redirect(array('/Servicecall/view&id='.$servicecall_id));

    }///end of public function actionMarkservermessageasread($gm_service_id)


    /**
     * Performs the AJAX validation.
     * @param GmServicecalls $model the model to be validated
     */
    protected function performAjaxValidation($model)
    {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'gm-servicecalls-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

}
