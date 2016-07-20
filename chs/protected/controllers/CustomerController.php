<?php

class CustomerController extends RController
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
				'actions'=>array('create','update', 'viewProduct' , 'OpenDialog' ,'freeSearch','admin','allProducts', 'SearchEngine','UpdateCustomer', 'ListOfCustomers','testSMS'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				//'actions'=>array('admin','delete'),
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
		//echo "<br>echo in cust create contr";
		$model=new Customer;
		$productModel=new Product;


		// Uncomment the following line if AJAX validation is needed
		 $this->performAjaxValidation($model, $productModel);
		 
		if(isset($_POST['Customer'],$_POST['Product']))
		{
			$model->attributes=$_POST['Customer'];
			$productModel->attributes=$_POST['Product'];
			
			$valid=$productModel->validate();
			$valid=$model->validate() && $valid;
			 
			if($valid)
			{
				$calling_code = '';
				//*** GETTING PHONE NUMBER FROM FORM *****
				if(isset($_POST['hidden_code_val']))
				{
					$calling_code = $_POST['hidden_code_val'];
					//echo "<br>Calling code in cust controller = ".$calling_code;
					
					$mobile_number = $model->mobile;
					//echo "<br>Mobile number user entered = ".$mobile_number;
					
					if($mobile_number != '')
					{
						if( $mobile_number{0} == "0" && strlen($mobile_number)>10 ) 
						{
							//echo "<br>Mobile number is starting with 0";
							$mobile_number = substr($mobile_number, 1);
						}
						
						$model->mobile = $calling_code.$mobile_number;
						//echo "<br>Mobile no after adding code = ".$model->mobile;
						
					}//end of if($mobile_number != '').
				}//end of if isset(['hidden_code_val']), for getting mobile number with calling_code.
				
				//**** END OF GETTING PHONE NUMBER FROM FORM *****
				
				
				if($model->save())
				{
					$this->redirect(array('view','id'=>$model->id));
				}
				
				
			}//end of if model valid.
// 			else 
// 			{
// 				echo "Enter all mandatory fields of Products";
// 			}
		}//enf of if(isset())

		$this->render('create',array('model'=>$model, 'productModel'=>$productModel));
	}//end of create.

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		//echo "<br>In Update contr";
		$model=$this->loadModel($id);
		$productModel=Product::model()->findByPk($model->product_id);
									

		// Uncomment the following line if AJAX validation is needed
		//$this->performAjaxValidation($model);
		$this->performAjaxValidation($model, $productModel);
		
		if(isset($_POST['Customer'],$_POST['Product']))
		{
			//echo "<br>In Update contr, in isset _POST";
			$model->attributes=$_POST['Customer'];
			
			$productModel->attributes=$_POST['Product'];
			
			//$valid=$model->validate();
			//$valid=$productModel->validate() && $valid;
			
			//if($valid)
			if($model->validate())
			{
				//******** GETTING PHONE NUMBER FROM FORM ************
				if(isset($_POST['hidden_code_val']))
				{
					$calling_code = $_POST['hidden_code_val'];
					//echo "<br>Calling code in cust controller = ".$calling_code;
					
					$mobile_number = $model->mobile;
					//echo "<br>Mobile number user entered = ".$mobile_number;
					
					
					if($mobile_number != '')
					{
					
						if( $mobile_number{0} == "0" && strlen($mobile_number)>10 ) 
						{
							//echo "<br>Mobile number is starting with 0";
							$mobile_number = substr($mobile_number, 1);
						}
						
						$model->mobile = $calling_code.$mobile_number;
						//echo "<br>Mobile no after adding code = ".$model->mobile;
						
					}//end of if ($mobile_number != '')
					
				}//end of if(isset(['hidden_code_val'])), getting mobile no with calling code.
				
				
				//******* END OF GETTING PHONE NUMBER FROM FORM ********
				
				
				if($model->save())
					$this->redirect(array('viewProduct','customer_id'=>$model->id, 'product_id'=>$model->product_id));
					
			}//end of model validate.
			
		}//end of if(isset()).

		$this->render('update',array('model'=>$model, 'productModel'=>$productModel));
	}//end of update.

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
		$dataProvider=new CActiveDataProvider('Customer');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Customer('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Customer']))
			$model->attributes=$_GET['Customer'];

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
		$model=Customer::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param CModel the model to be validated
	 */
	protected function performAjaxValidation($model, $productModel)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='customer-form')
		{
			echo CActiveForm::validate(array($model, $productModel));
			Yii::app()->end();
		}
	}
	
	public function actionListOfCustomers()
	{
	    $model=new Customer('view');
	
	    // uncomment the following code to enable ajax-based validation
	    /*
	    if(isset($_POST['ajax']) && $_POST['ajax']==='customer-listOfCustomers-form')
	    {
	        echo CActiveForm::validate($model);
	        Yii::app()->end();
	    }
	    */

    	if(isset($_POST['Customer']))
    	{
        	$model->attributes=$_POST['Customer'];
        	if($model->validate())
        	{
            	// form inputs are valid, do something here
            	return;
        	}
    	}
    	$this->render('listOfCustomers',array('model'=>$model));
	}//end of actionListOfCustomers.
	
	public function actionUpdateCustomer($customer_id, $product_id)
	{
		//$model=new Customer('update');
	    $model=$this->loadModel($customer_id);
	    
	   // uncomment the following code to enable ajax-based validation
	    /*
	    if(isset($_POST['ajax']) && $_POST['ajax']==='customer-updateCustomer-form')
	    {
	        echo CActiveForm::validate($model);
	        Yii::app()->end();
	    }
	    */
	    
	    if(isset($_POST['Customer']))
	    {
	        $model->attributes=$_POST['Customer'];
//	        $productModel=new Product;
//			$productModel->attributes=$_POST['Product'];
	        if($model->validate())
	        {
	        	if($model->save())
	        	{
	        		
	        	}
	        		
				$this->redirect(array('viewProduct','customer_id'=>$model->id,'product_id'=>$product_id));
	            // form inputs are valid, do something here
	            //return;
	        }
	    }
	    $this->render('updateCustomer',array('model'=>$model));
	}//end of updateCustomer.
	
	public function actionFreeSearch()
    {
    	//WE ARE SEARCHING IN CUSTOMER TABLE, SO CREATING INSTANCE OF CUSTOMER MODEL.
        $model=new Customer('search');
        $this->render('freeSearch',array('model'=>$model));
    }//end of freeSearch().
    
    public function actionSearchEngine($keyword)
    {
      //echo "THIS IS IAJAXX  ".$keyword;
 
        $model=new Customer();
        $model->unsetAttributes();  // clear any default values
        $results=$model->freeSearch($keyword);
        //echo 'Results '.$results;
        
        
        $this->renderPartial('_ajax_search',array(
                'results'=>$results,
        ));
    }//end of searchEngine().
    
	public function actionViewProduct($customer_id, $product_id)
	{
    	$model=new Customer('view');

	    // uncomment the following code to enable ajax-based validation
	    /*
	    if(isset($_POST['ajax']) && $_POST['ajax']==='customer-viewProduct-form')
	    {
	        echo CActiveForm::validate($model);
	        Yii::app()->end();
	    }
	    */
	
	    if(isset($_POST['Customer']))
	    {
	        $model->attributes=$_POST['Customer'];
	        if($model->validate())
	        {
	            // form inputs are valid, do something here
	            return;
	        }
	    }
	    $this->render('viewProduct',array('model'=>$model));
	}//end of viewProduct().
	
	public function actionOpenDialog($customer_id,$product_id)
	{
		//$model=$this->loadModel($customer_id);
		$model=$this->loadModel($customer_id);
		
		$result = Product::model()->findAllByAttributes(array('customer_id'=>$customer_id));
		//echo count($result);
	    if(count($result)>1)
	    {
	    	//echo ">1";
	    	$message = " ";
			foreach ($result as $data)
			{
				$message.= CHtml::link($data->productType->name."<br><br> ", array('Customer/updateCustomer', 'customer_id'=>$customer_id,'product_id'=>$data->id));
			}
		    
		   //$message="Fill all the mandatory fields of Product also.";
					
					$this->beginWidget('zii.widgets.jui.CJuiDialog',array(
		    				'id'=>'juiDialog',
		    				'options'=>array(
		    						'title'=>'Select the product',
		    						'autoOpen'=>true,
		    						'modal'=>'true',
		    						'show' => 'blind',
	                            	'hide' => 'explode',
	                            	//'color' => 'blue',
		    						//'width'=>'40px',
		    						//'height'=>'40px',
		    						),
		    				'cssFile'=>Yii::app()->request->baseUrl.'/css/jquery-ui.css',
	       					
		    				
		    		));
		    		
		    		echo $message;
		    		$this->endWidget();
	    	
		    		
	 		$this->render('updateCustomer',array('model'=>$model));
	    }//end if if(count).
	    
	    else 
	    {
	    	//echo "<1";
//	    	$this->render('updateCustomer',array('model'=>$model,
//	    	));
	    	//$this->redirect('update/'.$customer_id);
			$this->redirect(array('update','id'=>$customer_id));
	    	//$this->redirect('update',array('model'=>$model));
	    	
	    }
	}//end of openDialog().
	
	public function actionTestSMS()
	{
		//echo "In sms action<hr>";
		
		//Yii::app()->sms->send(array('to'=>'447550508559', 'message'=>'Happy New Year 2013!!!'));
		
	}//end of testSMS
    
}//end of class.
