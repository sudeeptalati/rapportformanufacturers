<?php

class ReportsController extends RController
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
	
	
	public function actionForm()
	{
		$serviceacall_model=new Servicecall();
		
		$active_data=new CActiveDataProvider($serviceacall_model, array(
						'criteria'=>array('condition'=>'id=0'),
						//'pagination'=>false,
						'sort'=>array(
							'defaultOrder'=>'service_reference_number DESC',
							),
					));
		
		if(isset($_GET['generate_report']))
		{
				$criteria=$this->loadCriteria();
				$active_data=new CActiveDataProvider($serviceacall_model, array(
						'criteria'=>$criteria,
						//'pagination'=>false,
						'sort'=>array(
							'defaultOrder'=>'service_reference_number DESC',
							),
					));
			}///end of if(isset($_GET['generate_report']))
			$this->render('form',array('model'=>$serviceacall_model, 'active_data'=>$active_data ));
	
	}///end of form
	
	
	
	public function actionExporttocsv()
	{
		$serviceacall_model=new Servicecall();
		$criteria=$this->loadCriteria();
		$active_data_for_csv=new CActiveDataProvider($serviceacall_model, array(
										'criteria'=>$criteria,
										'pagination'=>false,
										'sort'=>array(
										'defaultOrder'=>'service_reference_number DESC',
											),
										));	
		
		
		$this->renderPartial('csvdata', array('active_data_for_csv'=> $active_data_for_csv));  
		 
		
	}///enf of 	public function actionExporttocsv()

	
	/************************************************************************************************************************
	**************************************************LOCAL FUNCTIONS********************************************************
	************************************************************************************************************************/
	
	public function loadCriteria()
	{
		$criteria=new CDbCriteria();
		$criteria->with = array( 'engineer','jobStatus','customer', 'product');
		//$criteria->together = true;
		$criteria->compare('job_status_id',$_GET['job_status_id']);
		$criteria->compare('engineer.id',$_GET['engineer_id']);

		$criteria->compare( 'product.brand_id', $_GET['brand_id'] );
		$criteria->compare( 'product.product_type_id', $_GET['product_type_id'] );
		
		 
		$criteria->compare( 'product.model_number', $_GET['product_model_number'], true);
		
		
		if ($_GET['fault_dateStartDate']!='')
		{
			$fault_dateStartDate=strtotime($_GET['fault_dateStartDate']);
			$fault_dateEndDate=strtotime($_GET['fault_dateEndDate']);
			$criteria->addBetweenCondition('fault_date', $fault_dateStartDate, $fault_dateEndDate);
		}
		if ($_GET['jobPaymentStartDate']!='')
		{
			$jobPaymentStartDate=strtotime($_GET['jobPaymentStartDate']);
			$jobPaymentEndDate=strtotime($_GET['jobPaymentEndDate']);
			$criteria->addBetweenCondition('job_payment_date', $jobPaymentStartDate, $jobPaymentEndDate);
		}
		if ($_GET['jobFinishedStartDate']!='')
		{
			$jobFinishedStartDate=strtotime($_GET['jobFinishedStartDate']);
			$jobFinishedEndDate=strtotime($_GET['jobFinishedEndDate']);
			$criteria->addBetweenCondition('job_finished_date', $jobFinishedStartDate, $jobFinishedEndDate);
		}
	
		
		return $criteria;
	}//end of loadCriteria()
	
	
	

	
	
	
	// Uncomment the following methods and override them if needed
	/*
	public function filters()
	{
		// return the filter configuration for this controller, e.g.:
		return array(
			'inlineFilterName',
			array(
				'class'=>'path.to.FilterClass',
				'propertyName'=>'propertyValue',
			),
		);
	}

	public function actions()
	{
		// return external action classes, e.g.:
		return array(
			'action1'=>'path.to.ActionClass',
			'action2'=>array(
				'class'=>'path.to.AnotherActionClass',
				'propertyName'=>'propertyValue',
			),
		);
	}
	*/
}