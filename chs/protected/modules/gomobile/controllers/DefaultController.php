<?php

class DefaultController extends RController
{

	public function filters() {
        return array(
            'rights', // perform access control for CRUD operations
        );
    }
	
	
	public function actionIndex()
	{
		//$this->render('index');


		$this->redirect(array('/gomobile/gmservicecalls/receiveservicecallfrommobile'));

	}///end of index
	
	public function actionPostdatatoserver()
	{
	$this->render('postdata');
	}///end of PostDatatoServer
	
	public function actionJobstatusselectionofservicecall()
	{
	$this->render('jobstatusselectionofservicecall');
	}///end of Jobstatusselectionofservicecall
	
	public function actionDatabyappointmentdate()
	{
		$this->render('databyappointmentdate');
	}///end of Databyappointmentdate
	
	public function actionGetaccountid()
	{
		$gomobile_account_id=Gmservicecalls::model()->getaccountid();
		$this->render('accountsetup_view', array('gomobile_account_id'=>$gomobile_account_id));
	}////end of Getaccountid
	
	public function actionSetaccountid()
	{
		if (isset($_POST['gomobile_account_id']))
		{
			Gmservicecalls::model()->setaccountid($_POST['gomobile_account_id']); 
			$this->redirect(array('/gomobile/default/getaccountid'));
		}
		$gomobile_account_id=Gmservicecalls::model()->getaccountid(); 
		$this->render('setaccountid', array('gomobile_account_id'=>$gomobile_account_id));
	}////end of Getaccountid
	
	public function actionGetserverurl()
	{
		$gomobile_server_url=Gmservicecalls::model()->getserverurl();
		$this->render('serverurl_view', array('server_url'=>$gomobile_server_url));
	}////end of actionGetserverurl
	
	
	public function actionSendsingleservicecalltoserver()
	{
		$id = $_GET['id'];
		$model = Servicecall::model()->findByPk($id);

		$emailmodel=new Emailform();
        $setupmodel = Setup::model()->findByPk(1);
        $service_ref_no = $model->service_reference_number;
        $customer_name = $model->customer->fullname;
        $model_number = $model->product->model_number;

        $filename = $service_ref_no . ' ' . $customer_name . ' ' . $model_number . '.pdf';


		$this->performEmailformAjaxValidation($emailmodel);
		$this->render('sendserviceemailtoengineer', array('id'=>$id, 'model'=>$model, 'emailmodel'=>$emailmodel,'setupmodel'=>$setupmodel, 'attachfilename'=>$filename));



		if (isset($_POST['Emailform'])) {

            $emailmodel->attributes=$_POST['Emailform'];

			$html = Yii::app()->controller->renderFile(Yii::app()->basePath . '/views/servicecall/preview.php', array('model' => $model, 'company_details' => $setupmodel), true);
			//mPDF, **** accessing mpdf directly from vendors *******
			Yii::import('application.vendors.*');
			require_once('mpdf/mpdf.php');

			$mpdf = new mPDF(); // Create new mPDF Document


			$mpdf->WriteHTML(utf8_encode($html));

            $pdfattachment=array();
            $pdfattachment['pdf'] = $mpdf->Output('', 'S');
			$pdfattachment['filename'] = $filename;

			$other_attachments=array();
			$uploaded_attachments= CUploadedFile::getInstancesByName('uploaded_attachments');

			if (isset($uploaded_attachments) && count($uploaded_attachments) > 0) {
				// go through each uploaded image
				foreach ($uploaded_attachments as $image => $pic) {
					$attach_this=array();
					$attach_this['location']=$pic->tempName;
					$attach_this['filename']=$pic->name;
					array_push($other_attachments, $attach_this);
				}
             }


	 



			$mailsent=NotificationRules::model()->sendEmail($emailmodel->email_to, $emailmodel->email_body, $emailmodel->email_subject, $pdfattachment, $other_attachments);

			if (!$mailsent)
                $this->render('sendserviceemailtoengineer', array('id'=>$id, 'model'=>$model, 'emailmodel'=>$emailmodel,'setupmodel'=>$setupmodel, 'attachfilename'=>$filename,'system_message'=>'Cannot send the Email. Please contact support'));


            $this->renderPartial('sendsingleservicecalltoserver');


        }///end of if(isset($_POST['message_body']{

	
	
	}//end of public function actionSendsingleservicecalltoserver() ///created by SUDEEP TALATI


	protected function performEmailformAjaxValidation($emailmodel)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='Emailform-form')
		{
			echo CActiveForm::validate(array($emailmodel));
			Yii::app()->end();
		}
	}
		
}////end of class