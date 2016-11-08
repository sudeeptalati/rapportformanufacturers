<?php

class DefaultController extends RController
{


	public function filters()
	{
		return array(
			'rights', // perform access control for CRUD operations
		);
		/*
		return array(
		'accessControl', // perform access control for CRUD operations
		);
		*/
	}
 
	public function accessRules()
	{
		return array(
		array('allow',  // allow all users to perform 'index' and 'view' actions
		'actions'=>array( 'view'),
		'users'=>array('*'),
		),
		array('allow', // allow authenticated user to perform 'create' and 'update' actions
		'actions'=>array('create','update'),
		'users'=>array('@'),
		),
		array('allow', // allow admin user to perform 'admin' and 'delete' actions
		'actions'=>array('index','admin','delete','getAllCustomers','selectedPostcodeCustomers', 'mergeCustomer','performMerge'),
		'users'=>array('admin'),
		),
		array('deny',  // deny all users
		'users'=>array('*'),
		),
		);
	}
	
	
	public function actionIndex()
	{
	
	
		$this->redirect(array('default/getAllCustomers'));
		
	}
	
	public function actionGetAllCustomers()
	{
		$model=new Customer('search');
		
		//$merged = $_GET['merged'];
		
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Customer']))
			$model->attributes=$_GET['Customer'];

		$this->render('getAllCustomers',array('model'=>$model));
	}//end of getAllCustomers.
	
	public function actionSelectedPostcodeCustomers($primary_id, $postcode)
	{
		$model=new Customer('search');
		
		//echo "<br>Postcode passed = ".$postcode;
		//echo "<br>Primary id passed = ".$primary_id;
		
		$postcodeSearchResult = DuplicateCustomer::model()->postcodeSearch($postcode, $primary_id);
		
		$this->render('selectedPostcodeCustomers',array('model'=>$model, 'postcodeData'=>$postcodeSearchResult, 'primary_id'=>$primary_id));
		
	}//end of SelectedPostcodeCustomers.
	
	public function actionMergeCustomer($secondary_id, $primary_id)
	{
		//echo "<br>Primary id passed in contr = ".$primary_id;
		//echo "<br>Secondary id passed in contr = ".$secondary_id;
		
		$this->render('mergeCustomer', array('primary_id'=>$primary_id, 'secondary_id'=>$secondary_id));
		
	}//end of actionMergeCustomer.
	
	public function actionPerformMerge($primary_id, $secondary_id)
	{
		$model=new Customer('search');
		
		$merged = 0;
		$prod_merged = 0;
		$service_merged = 0;
		
		//echo "<br>Pri id = ".$primary_id;
		//echo "<br>Secondary id = ".$secondary_id;
		$secondaryCustModel = Customer::model()->findByPk($secondary_id);
		//echo "<br>Sec cust prod id = ".$secondaryCustModel->product_id;
		
		//********* MERGING PRODUCT **************
		
		$secProductModel = Product::model()->findAllByAttributes(array('customer_id'=>$secondary_id));
		
		foreach($secProductModel as $prodData)
		{
			//echo "<hr>Product id = ".$prodData->id;
			//echo "<br>Customer id = ".$prodData->customer_id;
			//echo "<br>Model no = ".$prodData->model_number;
			//echo "<br>Serial no = ".$prodData->serial_number;
			
			$productUpdateModel = Product::model()->updateByPk($prodData->id, array('customer_id'=>$primary_id));
			
			$prod_merged = 1;
		
		}//end of foreach
		
		//********* MERGING PRODUCT **************
		
		//********* MERGING SERVICECALL **************
		$secondaryServiceModel = Servicecall::model()->findAllByAttributes(array('customer_id'=>$secondary_id));
		
		foreach($secondaryServiceModel as $serviceData)
		{
			//echo "<hr>Service id = ".$serviceData->id;
			//echo "<br>Cust id = ".$serviceData->customer_id;
			//echo "<br>Service ref no = ".$serviceData->service_reference_number;
			//echo "<br>Engineer id = ".$serviceData->engineer_id;
			
			$updateServiceModel = Servicecall::model()->updateByPk($serviceData->id, array('customer_id'=>$primary_id));
			
			$service_merged = 1;
			
		}//end of foreach.
		
		//********* MERGING SERVICECALL **************
		
		if(($prod_merged == 1) && ($service_merged == 1))
		{
		
			
			$connection=Yii::app()->db;   
			$sql_query = "INSERT INTO customer_duplicates SELECT * FROM customer WHERE id ='$secondary_id'";
			$command=$connection->createCommand($sql_query);
			$rowCount=$command->execute();
			
			$CustDeleteModel=Customer::model()->findByPk($secondary_id);
			$CustDeleteModel->delete();
			
			$merged = 1;
			
		
		}//end of if setting merged.
		
		$this->redirect(array('default/getAllCustomers','merged' => $merged ));
		
	}//end of performMerge.
	
}//end of default  contr.