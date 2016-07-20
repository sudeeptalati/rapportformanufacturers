<?php

class AddonsController extends RController
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
				'actions'=>array('create','update','view','index','admin','enable_disable'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','uninstall'),
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
	public function actionIndex()
	{
		 $this->render('index');
	}
	
	
	
 	public function actionInstall()
	{
	
		$log_msgs=array();
		
		
		
		$model=new Addons();
		//Step 1: Download or upload package in temp folder

		array_push($log_msgs,$model->upload());
		
		//print_r($log_msgs);
		
		//Step 2: Unzip it
		array_push($log_msgs,$model->unzip());

		//Step 3: Read the XML Install Script
		$addons_model=new Addons();
		
		
		$xml=simplexml_load_file("temp/tempaddonfile/install_addon.xml");
		
		$addons_model->name=$xml->info->name;
		$addons_model->addon_label=$xml->info->label;
		$addons_model->type=$xml->info->type;
		$addons_model->active=intval($xml->info->active);
		//echo intval($xml->info->active);
		
		
		
		if($addons_model->save())
		{
		
			
			//Step 4: Install Table
			array_push($log_msgs,$model->readsqlscript());
		 
			
			
			//Step 5: Copy files images, javascript and all
			array_push($log_msgs,$model->copyfiles());

			
			//Step 6: Create Entry in XML file in Config Folder
			array_push($log_msgs,$model->appendaddonsxml_forinstall($addons_model->name));
			
			
			//Step 7: Create entry in table
			//Step 8: Ammend if you want for javascript like in main file.
			
			//Setp 9: DELETE THE CONTENTS OF TEMP FOLDER
			
			array_push($log_msgs,$model->cleartempdata());
			
			
		}
		
		
		
		$this->render('install',array(
			'model'=>$model, 'errors'=>$addons_model->getErrors(), 'log_msgs'=>$log_msgs,
			));
		
		
	
	}///endo of actionInstall
	
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
		$model=new Addons;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Addons']))
		{
			$model->attributes=$_POST['Addons'];
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

		if(isset($_POST['Addons']))
		{
			$model->attributes=$_POST['Addons'];
			if($model->save())
				$this->redirect(array('admin'));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}
	
	
	public function actionEnable_disable($id)
	{
		$model=$this->loadModel($id);
		
		
		echo '<br>BEFORE SAVE -'.$model->active;
		
		
		if ($model->active==0)
		{
			$model->active=1;
		}else
		{
			$model->active=0;
		}
		
		echo '<br>AFTER SAVE -'.$model->active;
		
		
		if($model->save())
				$this->redirect(array('admin'));
		
	
	}/// end of actionEnableDisable($id)


	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionUninstall($id)
	{
			
		$model=$this->loadModel($id);
			
		if(isset($_POST['confirm_uinstall']))
		{
			//// STEP 1 DELETE ENTRY FROM AddonXML
			$model->appendaddonsxml_foruninstall($model->name);
	
			
			//// STEP 2 DELETE FOLDER
			$model->deletemodulefolder($model->name);
			//// STEP 3 DROP TABLES if required
			
			
	
			//// STEP 3 DELETE ENTRY FROM DATABASE
			$this->loadModel($id)->delete();
			
			
			
			// we only allow deletion via POST request
			// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
		}
	
		
		$this->render('uninstall',array(
			'model'=>$model,
		));
		
		
		
	}///end of actionUninstall

	
	
	
	
	/**
	 * Lists all models.
	 */


	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Addons('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Addons']))
			$model->attributes=$_GET['Addons'];

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
		$model=Addons::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='addons-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
	
	
	public function actionInstalladdon()
	{
		$model=new Setup;
		
		$this->render('Installaddon',array('model'=>$model));
	}
}
