<?php

class TasksToDoController extends RController
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
				'actions'=>array('create','update','admin', 'CompleteTasks', 'PerformTasks','TasksLifetime', 'UpdateTasksLifetime', 'delete'),
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
		$model=new TasksToDo;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['TasksToDo']))
		{
			$model->attributes=$_POST['TasksToDo'];
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

		if(isset($_POST['TasksToDo']))
		{
			$model->attributes=$_POST['TasksToDo'];
			if($model->save())
				$this->redirect(array('update','id'=>$model->id));
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
		$dataProvider=new CActiveDataProvider('TasksToDo');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new TasksToDo('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['TasksToDo']))
			$model->attributes=$_GET['TasksToDo'];

		$this->render('admin',array('model'=>$model));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model=TasksToDo::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='tasks-to-do-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}//end of AJAX func.
	
	public function actionCompleteTasks()
	{
		//echo "<br>In completeTasks action";
		$this->render('completeTasks');
		
	}//end of completeTasks.
	
	public function actionPerformTasks($id)
	{

		$task_id = $id;
		if($task_id != '')
		{
			//echo "<hr> Task_id = ".$task_id;
			$taskModel = TasksToDo::model()->findByPk($task_id);
			$taskStatus = $taskModel->status;
			//echo "<br>task status in model = ".$taskStatus;
			
			if($taskStatus != 'finished')
			{
					//echo "<br>In perform tasks action";
				$tasksStatusUpdateModel = TasksToDo::model()->updateByPk($task_id, array('executed'=>time()));
				$tasksStatusUpdateModel = TasksToDo::model()->updateByPk($task_id, array('status'=>'running'));
				
				
				$response = TasksToDo::model()->listTasksToDo($task_id);
				echo $response;
				
				$time_for_log = date('d-M-Y H:i:s', time());
				$response_to_log_file = $response." At timestamp: ".$time_for_log;
				
				$filename = '../tasks.html';
				$fh = fopen($filename, 'a');
				fwrite($fh, $response_to_log_file);
				fclose($fh);
				
				
			}//end of if task status != finished.
			
			//}//end of else
			
		}//end of if(task_id != 0).
		else
		{
			echo "<br>Task_id not passed";
		}//end of else.
		
	}//end of PerformTasks
	
	public function actionTasksLifetime()
	{
		if(isset($_POST['lifetime_update_value']))
		{
			//echo "<br>Update value = ".$_POST['lifetime_update_value'];
			$new_lifetime_val = $_POST['lifetime_update_value'];
			$lifetime_id = '';
			$advancedModel = AdvanceSettings::model()->findAllByAttributes(array('parameter'=>'notification_lifetime'));
			foreach($advancedModel as $lifetime)
			{
				$lifetime_id = $lifetime->id;
				//echo "<br>id = ".$lifetime_id;
			}
			
			$advancedUpdateModel = AdvanceSettings::model()->updateByPk($lifetime_id, array('value'=>$new_lifetime_val));
			
		}//end of if(isset[]).
		
		$this->render('tasksLifetime');
		
	}//end of actionTasksLifetime.
	
	public function actionUpdateTasksLifetime()
	{
		//echo "<br>In anothjer view";
		
		
		
		$this->render('updateTasksLifetime');
		
	}//end of actionTasksLifetime.
	
	
	

	
	
	
	
	
    

	
	
	
	
}//end of class.
