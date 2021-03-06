<?php

class JobStatusController extends RController
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
				'actions'=>array('dashboardorder','orderdropdown','dropdownorder','create','update','ChangeOrder','order','admin'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('delete'),
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
		$model=new JobStatus;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['JobStatus']))
		{
			$model->attributes=$_POST['JobStatus'];
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
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['JobStatus']))
		{
			$model->attributes=$_POST['JobStatus'];
			if($model->save())
                // $this->redirect(array('update','id'=>$model->id));
                $this->redirect ( array('admin'));

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
		$dataProvider=new CActiveDataProvider('JobStatus');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new JobStatus('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['JobStatus']))
			$model->attributes=$_GET['JobStatus'];

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
		$model=JobStatus::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='job-status-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
	
	public function actionOrder()
    {
             //ajax draggable sorter cggridview

             // Handle the POST request data submission
        	if (isset($_POST['Order']))
        	{
            	// Since we converted the Javascript array to a string,
                // convert the string back to a PHP array
                $models = explode(',', $_POST['Order']);

                for ($i = 0; $i < sizeof($models); $i++)
                {
                    if ($model = JobStatus::model()->findbyPk($models[$i]))
                    {
                        $model->dashboard_prority_order = $i;

                        $model->save();
                    }
                }///end of for loop
              $ansver = array('msg'=>'Dashboard Priority order Set successfully.');
              //echo CJSON::encode($ansver);
              $this->renderPartial('jsonoutput',array(
              		'ansver'=>$ansver,
              ));
              
                
			}///end of isset if POST
        
    }///end of public function action order
    
    public function actionDropdownorder()
    {
    	
    	$model=new JobStatus('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['JobStatus']))
			$model->attributes=$_GET['JobStatus'];

		$this->render('dropdownorder',array(
			'model'=>$model,
		));
    }//end of actionDropdownorder().

	public function actionOrderdropdown()
    {
             //ajax draggable sorter cggridview

             // Handle the POST request data submission
        	if (isset($_POST['Order']))
        	{
        		
            	// Since we converted the Javascript array to a string,
                // convert the string back to a PHP array
                $models = explode(',', $_POST['Order']);

                for ($i = 0; $i < sizeof($models); $i++)
                {
                	
                    if ($model = JobStatus::model()->findbyPk($models[$i]))
                    {
                    	
                        $model->view_order = $i;
                        //echo $models[$i][0]."....";
						$model->save();
						///$this->redirect(array('enggdiary/currentAppointments'));
						
                    }
                }///end of for loop
              $ansver = array('msg'=>'Dropdown Ordered Successfully');
              
              $this->renderPartial('jsonoutput',array(
              		'ansver'=>$ansver,
              ));
              
              
			}///end of isset if POST
        
    }///end of public function action order    

    
    public function actionDashboardorder()
    {
    	
    	$model=new JobStatus('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['JobStatus']))
			$model->attributes=$_GET['JobStatus'];

		$this->render('dashboardorder',array(
			'model'=>$model,
		));
    }//end of actionDropdownorder().

 
}//end of class.
