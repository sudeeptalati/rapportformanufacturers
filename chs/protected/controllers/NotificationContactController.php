<?php

class NotificationContactController extends RController
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
				'actions'=>array('create','update','AddNotificationContact','delete','admin'),
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
	public function actionCreate($id)
	{
		$model=new NotificationContact;
		
		// Uncomment the following line if AJAX validation is needed
		//$this->performAjaxValidation($model);
		 
		$model->notification_rule_id = $id;
		
		if(isset($_POST['NotificationContact']))
		{
			$model->attributes=$_POST['NotificationContact'];
			//echo "<br>rule id from contr = ".$model->notification_rule_id;
			
			$others_email_checked=$_POST['others_email_notification'];
			$others_sms_checked=$_POST['others_sms_notification'];
			
			$others_email_status;
			$others_sms_status;
			
			//*Setting the email & sms status from the value obtained*//
			if ($others_email_checked==1)
				$others_email_status=true;
			else 
				$others_email_status=false;
			
				
			if ($others_sms_checked==1)
				$others_sms_status=true;
			else 
				$others_sms_status=false;
			
			//*Getting the Notifictation code*//
			
			$others_notification_code=NotificationRules::model()->getNotificationCode($others_email_status, $others_sms_status);
			
			$model->notification_code_id = $others_notification_code;
			
			if($model->save())
			{
				$this->redirect(array('/notificationRules/update','id'=>$id));
				
			}//end of if(save).
			
		}//end of if(isset(attributes)).
		
	 	if (Yii::app()->request->isAjaxRequest)
        {
            echo CJSON::encode(array(
                'status'=>'failure', 
                'div'=>$this->renderPartial('_form', array('model'=>$model), true)));
            exit;               
        }//if AJAX REQUEST.
		else 	
			$this->render('create',array('model'=>$model));
	}//end of actionCreate().

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['NotificationContact']))
		{
			$model->attributes=$_POST['NotificationContact'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
//		if(Yii::app()->request->isPostRequest)
//		{
			// we only allow deletion via POST request
			
			//echo "In delete contr";
			$contactModel = NotificationContact::model()->findByPk($id);
			//echo "<br>rule id from contact  model = ".$contactModel->notification_rule_id;
			$rule_id = $contactModel->notification_rule_id;
			
			$this->loadModel($id)->delete();
			
			$anotherContactModel = NotificationContact::model()->findAllByAttributes(
														array(
															'notification_rule_id'=>$rule_id
														));
														
//			foreach ($anotherContactModel as $data)
//			{
//				echo "<br>person Name = ".$data->person_name;
//				echo "<br>Person info = ".$data->person_info;
//				echo "<br>email = ".$data->email;
//			}														
			
			if(count($anotherContactModel) == 0)
			{
				//echo "<br>Set notify others to 0";
				$rulesModel = NotificationRules::model()->findByPk($contactModel->notification_rule_id);
				
				$rulesUpdateModel = NotificationRules::model()->updateByPk(
													$contactModel->notification_rule_id,
													array(
														'notify_others'=> '0'
													));
			}//end of if(count()).
			else 
			{
				//echo "<br>There are other notifiers";
			}
			
			$this->redirect(array('/notificationRules/update','id'=>$rule_id));
			
	}//end of delete.

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('NotificationContact');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new NotificationContact('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['NotificationContact']))
			$model->attributes=$_GET['NotificationContact'];

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
		$model=NotificationContact::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='notification-contact-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
	
	public function actionAddNotificationContact()
	{
		
		$newModel = new NotificationContact();
		$newModel->attributes = $_POST["NotificationContact"];
		//echo "<br>Contact person = ".$newModel->person_name;
		//echo "<br>Notification rule id = ".$newModel->notification_rule_id;
		//echo "<br>Email checked = ".$_POST['others_email_notification'];
		//echo "<br>SMS checked = ".$_POST['others_sms_notification'];
		//echo "<br>mobile = ".$newModel->mobile;
		
		$others_email_checked=$_POST['others_email_notification'];
		$others_sms_checked=$_POST['others_sms_notification'];
			
		$others_email_status;
		$others_sms_status;

		//*Setting the email & sms status from the value obtained*//
		if ($others_email_checked==1)
			$others_email_status=true;
		else 
			$others_email_status=false;
			
				
		if ($others_sms_checked==1)
			$others_sms_status=true;
		else 
			$others_sms_status=false;
			
		//*Getting the Notifictation code*//
			
		$others_notification_code=NotificationRules::model()->getNotificationCode($others_email_status, $others_sms_status);
			
		//echo "<hr>  Notification code for Customer is ".$customer_notification_code;
		$newModel->notification_code_id = $others_notification_code;
		
		
		if($newModel->save())
		{
			//echo "saved";
			$this->redirect(array('notificationRules/update','id'=>$newModel->notification_rule_id));
		}
		else
		{
			//echo "<br>Problem in saving";
		}
		
	}//end of addNotificationContact().
	
	
	
	
	
}//end of class.
