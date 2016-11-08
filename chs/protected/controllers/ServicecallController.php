<?php

class ServicecallController extends RController
{
	public $notify_flag;
	public $job_status_before;
	
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
				'actions'=>array('index','view', 'Getitems','curl_file_get_contents'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('DisplayMap','exportTest','DisplayDropdown','export','EnggJobReport','SelectEngineer','engineerDiary','ChangeEngineerOnly','addProduct','freeSearch','SearchEngine','PrintAllJobsForDay','UpdateServicecall','ExistingCustomer','Report','preview','create','update','admin','htmlPreview','DownloadReport'),
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
	
	public function actionPreview($id)
	{
	
		//mPDF, **** accessing mpdf directly from vendors *******
		Yii::import('application.vendors.*');
		require_once('mpdf/mpdf.php');
		///Create an instance of the class:
		$mpdf=new mPDF();

	
		$model=$this->loadModel($id);
		$setupModel = Setup::model()->findByPk(1);
		//$config= Config::model()->findByPk(1);	
    
		$service_ref_no=$model->service_reference_number;
		$customer_name=$model->customer->fullname;
		$model_number=$model->product->model_number;
		$warranty=$model->contract->name;
		$filename=$service_ref_no.' '.$customer_name.' '.$model_number.' '.$warranty.'.pdf';
		

////Write some HTML code:
//$mpdf->WriteHTML('<p>Hallo World</p>');

$mpdf->WriteHTML($this->renderPartial('preview',array('model'=>$model,'company_details'=>$setupModel), true));
 
///Output a PDF file:
$mpdf->Output($filename,'I');
	
	/*
	
		//echo 'I M HERE';		
// 		$this->renderPartial('Preview',array(
// 			'model'=>$this->loadModel($id),'config'=>$config,
// 		));
		# You can easily override default constructor's params
		$mPDF1 = Yii::app()->ePdf->mPDF('', 'A4');
		
		
		 
		//$mPDF1->SetDisplayMode('fullpage','two');
		# render (full page)
		//$mPDF1->WriteHTML($this->renderPartial('Preview',array('model'=>$model,'config'=>$config), true));
		$mPDF1->WriteHTML($this->renderPartial('preview',array('model'=>$model,'company_details'=>$setupModel), true));
		# Load a stylesheet
		//$stylesheet = file_get_contents(Yii::getPathOfAlias('webroot.css') . '/main.css');
		//$mPDF1->WriteHTML($stylesheet, 1);
		# Outputs ready PDF
		$mPDF1->Output($filename,'I');
	*/	
	}//end of public function actionPreview($id)
	
	public function actionHtmlPreview($id)
	{
		
		//echo "<br>Id in HTML Preview = ".$id;
		$model=$this->loadModel($id);
		$setupModel = Setup::model()->findByPk(1);
		//$config= Config::model()->findByPk(1);
		$this->renderPartial('preview',array('model'=>$model,'company_details'=>$setupModel));
	
	}//end of HTML Preview.
	
	
	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$serviceCallModel=new Servicecall;
		$customerModel=new Customer;
		$productModel=new Product;

		// Uncomment the following line if AJAX validation is needed
		$this->performAjaxValidation($serviceCallModel, $customerModel, $productModel);

		if(isset($_POST['Servicecall'],$_POST['Customer'],$_POST['Product'] ))
		{
			$serviceCallModel->attributes=$_POST['Servicecall'];
			$customerModel->attributes=$_POST['Customer'];
			$productModel->attributes=$_POST['Product'];
			
			$serviceModelValid=$serviceCallModel->validate();
			$productModelValid=$productModel->validate();
			$customerModelValid=$customerModel->validate();
			//////FIRST SAVING PRODUCT
			
			
			 if($productModelValid)
			 {
				//echo "Product Model OK";
				if($productModel->save())
				{
					//echo "<hr>Product Model SAVED----product id is ".$productModel->id;
					$customerModel->product_id=$productModel->id;
					
					///////SECOND SAVING CUSTOMER
					if($customerModelValid)
					{
						//*********** GETTING PHONE NUMBER FROM FORM **********
						
						if(isset($_POST['hidden_code_val']))
						{
							$calling_code = $_POST['hidden_code_val'];
							//echo "<br>Code in serviceceall contrl = ".$calling_code;
							
							$mobile_number = $customerModel->mobile;
							//echo "<br>No entered by user = ".$mobile_number;
							
							if($mobile_number != '')
							{
								if($mobile_number{0} == '0' && strlen($mobile_number)>10)
								{
									//echo "<br>Mobile number is starting with 0";
									$mobile_number = substr($mobile_number, 1);
								}
								
								$customerModel->mobile = $calling_code.$mobile_number;
								//echo "<br>Mobile no after adding code = ".$customerModel->mobile;
							}//end of if($mobile_number != '').
							
						}//end if (isset[hidden_code_val]), to get mobile number with calling_code.
						
						
						
					
					
						//*********** END OF GETTING PHONE NUMBER FROM FORM ********
						
						
						if($customerModel->save())
						{
							//echo "<hr>CUSTOMER  Model SAVED----CUSTIOMER id is ".$customerModel->id;
							//Setting the Primary Product of Customer
								$serviceCallModel->job_status_id=1;///status is logged
								$status_id = $serviceCallModel->job_status_id;
								$serviceCallModel->customer_id=$customerModel->id;
								$serviceCallModel->product_id=$productModel->id;
								$serviceCallModel->engineer_id=$productModel->engineer_id;
								$serviceCallModel->contract_id=$productModel->contract_id;
								
								$serviceModelValid=$serviceCallModel->validate();
								
								if($serviceModelValid)
								{
									if($serviceCallModel->save())
									{
										$notificationModel = NotificationRules::model()->findAllByAttributes(array('job_status_id'=>$status_id, 'active'=>'1'));
										
										if(count($notificationModel)!=0)
										{
											//echo "<br>Rule is present";
											$service_id = $serviceCallModel->id;
											$internet_status = '';
											$advanceModel = AdvanceSettings::model()->findAllByAttributes(array('parameter'=>'internet_connected'));
											foreach ($advanceModel as $data)
											{
												$internet_status = $data->value;
											}
											
											if($internet_status == 1)
											{
												try
												{
													//echo "<br>Inside try, calling performNotification";
													//$this->performNotification($status_id, $service_id);
													$response = NotificationRules::model()->performNotification($status_id, $service_id);
													
												}//end of try.
												catch (Exception $e)
												{
													
												}
											}//end of if(internet Connection).
										}//end of if(notification rule present).
										else
										{
											//echo "<br>Rule is not present";
										}
										
										$engg_id=$serviceCallModel->engineer_id; 
										$baseUrl=Yii::app()->request->baseUrl;
										//$this->redirect(array('/enggdiary/bookingAppointment/', 'id'=>$serviceCallModel->id, 'engineer_id'=>$engg_id));
										//$this->redirect(array('/enggdiary/diary/', 'id'=>$serviceCallModel->id, 'engineer_id'=>$engg_id));
										$this->redirect(array('/servicecall/view/', 'id'=>$serviceCallModel->id));
										
										
										
									}//end of if(save).
									
								}/////end of outer if().
								
						}///end of customer model saved
						
					
					}///end of customer model valid
					
				}//end of $productModel->save()
				
			 
			 }//end of "Product Model VALID";
			
			
		}//end of if(isset()).

		$this->render('create',array('model'=>$serviceCallModel));
	}//end of create.

	
	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);
		
		$previous_status_id = $model->job_status_id;
		//echo "<br>Id before getting form values = ".$previous_status_id;
		
		$response = '';
		
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		 
			if(isset($_POST['Servicecall']))
			{
				$model->attributes=$_POST['Servicecall'];
				$invoiceModel = Invoice::model()->findByAttributes(array('servicecall_id'=>$model->id));
				if($invoiceModel)
				{
					///echo "<br>invoice id = ".$invoiceModel->id;
				}
				else
				{
					$invoiceModel = new Invoice();
				}

				if(isset($_POST['Invoice']))
				{
					$invoiceModel->attributes=$_POST['Invoice'];
					$invoiceModel->servicecall_id = $model->id;

					if($invoiceModel->save())
					{
						echo "<br>Invoice saved";
						$model->net_cost = $model->net_cost+$invoiceModel->shipping_handling_cost+$invoiceModel->labour_cost;
						echo "<br>Serivce calls net cost = ".$model->net_cost;
					}
					else
					{
						echo "<br>Error in saving Invoice";
					}


				}//end of isset(invoice).
				//echo "Contract id in update cntl = ".$model->contract_id;
				//echo "<br>Contract id of product, Imust chamge this = ".$model->product->contract_id;
				$product_id = $model->product_id;
				
				$productModel = Product::model()->updateByPk($product_id, 
																array('contract_id'=>$model->contract_id)
															);
				
				$current_status_id = $model->job_status_id;
				//echo "<br>id after getting values = ".$current_status_id;
				$service_id = $model->id;
				
				if($previous_status_id != $current_status_id)
				{
					//echo "<br>Status Changed....";
					$internet_connection = '';
					//**** CHECKING IF CONNECT TO INTERNET IS ENABLED OR NOT ****
					$advancedModel = AdvanceSettings::model()->findAllByAttributes(array('parameter'=>'internet_connected'));
					foreach ($advancedModel as $data)
					{
						//echo "<br>Value of internet connection = ".$data->value;
						$internet_connection = $data->value;
					}
					
 					if($internet_connection == 1)
					{
						//$response = $this->performNotification($current_status_id, $service_id);
						$response = NotificationRules::model()->performNotification($current_status_id, $service_id);
					}
				}//END of IF(status change).
				

				if($model->save())
				{

					$this->redirect(array('view','id'=>$model->id ));
					//echo "saved";
				}
				else
				{
					//echo "<br>Not Save";
				}

			}//end of if(isset(Servicecall)).
			
	 
		
		if ($model->job_status_id<100 || Yii::app()->user->checkAccess('Admin') )
			$this->render('updateServicecall',array('model'=>$model));
		else
			//$this->redirect(array('site/error'));
		throw new CHttpException(403,'You need to have admin rights to perform this operation');

		
	}//end of update().


	/**
	 *
	 * Updating the dialog
	 * public function actionUpdateservicecalldialog()
	 */

	public function actionUpdateservicecalldialog()
	{
		$error_msg='';
		if (isset($_POST['Servicecall'])) {

			$servicecall_id=$_GET['servicecall_id'];
			$service_model=Servicecall::model()->findByPk($servicecall_id);

			$service_model->attributes = $_POST['Servicecall'];

			/*
			var_dump($_POST['Product']);
			var_dump($product_model);
			*/
			$invoiceModel = Invoice::model()->findByAttributes(array('servicecall_id'=>$service_model->id));
			if($invoiceModel)
			{
				echo "<br>existing invoice id = ".$invoiceModel->id;
			}
			else
			{
				echo "New Invoice<br>";
				$invoiceModel = new Invoice();
			}

			if(isset($_POST['Invoice']))
			{
				$invoiceModel->attributes=$_POST['Invoice'];
				$invoiceModel->servicecall_id = $servicecall_id;

				if($invoiceModel->save())
				{
					echo "<br>Invoice saved";
					var_dump($invoiceModel->attributes);
					$service_model->net_cost = $service_model->net_cost+$invoiceModel->shipping_handling_cost+$invoiceModel->labour_cost;
					echo "<br>Serivce calls net cost = ".$service_model->net_cost;
				}
				else
				{
					echo "<br>Error in saving Invoice";
					echo "getErrors";
					$errors=$invoiceModel->getErrors();
					$error_msg.='<h5>Invoice cost Details Not Updated</h5>';
					foreach ($errors as $key=>$value)
						$error_msg.="<br>".$value[0];




				}


			}//end of isset(invoice).





			if ($service_model->save()) {
				echo "Svaed";
				$this->redirect(array('servicecall/view&id='.$servicecall_id.'#service-details'));
			}
			else{
				echo "getErrors";
				$errors=$service_model->getErrors();
				$error_msg='<h5>Servicecall Details Not Updated</h5>';
				foreach ($errors as $key=>$value)
					$error_msg.="<br>".$value[0];


				//$this->redirect(array('servicecall/view', 'id' => $servicecall_id, 'error_msg='=>$error_msg));
				$this->redirect(array('servicecall/view&id='.$servicecall_id.'&error_msg='.$error_msg.''));
			}




		}


	}///end of 	public function actionUpdateservicecalldialog()


	public function  actionAddcommnetsinservicecall()
	{
		if (isset($_POST['Servicecall'])) {

			$servicecall_id=$_GET['servicecall_id'];
			$service_model=Servicecall::model()->findByPk($servicecall_id);

			$service_model->attributes = $_POST['Servicecall'];

			$comments= Setup::model()->updatenotesorcomments($service_model->comments , $service_model, 'comments');

			$servicecall_update = Servicecall::model()->updateByPk($servicecall_id,
				array(
					'comments' => $comments,

				));

			if ($servicecall_update) {
				echo "Servicecall Comments Saved";
				$this->redirect(array('servicecall/view', 'id' => $servicecall_id));
			}
			else{
				echo "Servicecall Comments  getErrors";
				$errors=$service_model->getErrors();
				$error_msg='<h5>Servicecall Comments Not Updated</h5>';
				foreach ($errors as $key=>$value)
					$error_msg.="<br>".$value[0];


				//$this->redirect(array('servicecall/view', 'id' => $servicecall_id, 'error_msg='=>$error_msg));
				$this->redirect(array('servicecall/view&id='.$servicecall_id.'&error_msg='.$error_msg.'#productbox'));
			}
			
		}

	}////end of public function addcommnetsinservicecall()




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
		$dataProvider=new CActiveDataProvider('Servicecall');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Servicecall('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Servicecall']))
			$model->attributes=$_GET['Servicecall'];

		if(Yii::app()->request->getParam('export')) 
		{
		    $this->actionExport();
		    Yii::app()->end();
		}
			
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
		$model=Servicecall::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param CModel the model to be validated
	 */
	protected function performAjaxValidation($model, $customerModel, $productModel)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='servicecall-form')
		{
			echo CActiveForm::validate(array($model, $customerModel, $productModel));
			Yii::app()->end();
		}
	}
	
	protected function performAjaxValidationForNewproductButExistingCustomer($model, $productModel)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='servicecall-addProduct-form')
		{
			echo CActiveForm::validate(array($model, $productModel));
			Yii::app()->end();
		}
	}
		
	
	
	
	public function actionExistingCustomer($customer_id)
	{
		$model=new Servicecall;
		$model->job_status_id=1;
		$notify_status = $model->job_status_id;
		
		
		if(isset($_POST['Servicecall']))
		{
			$model->attributes=$_POST['Servicecall'];
			$model->customer_id=$_GET['customer_id'];
			$model->product_id=$_GET['product_id'];
			
			if($model->save())
			{
				$internet_status = '';
				$advanceModel = AdvanceSettings::model()->findAllByAttributes(array('parameter'=>'internet_connected'));
				foreach ($advanceModel as $data)
				{
					$internet_status = $data->value;
				}
				if($internet_status == 1)
				{
					try
					{
						$service_id = $model->id;
						$status_id = $model->job_status_id;
						//$response = $this->performNotification($status_id, $service_id);
						$response = NotificationRules::model()->performNotification($status_id, $service_id);
													
					}//end of try.
					catch (Exception $e)
					{
													
					}
				}//end of if(internet Connection).
				
				$engg_id=$model->engineer_id;
				$baseUrl=Yii::app()->request->baseUrl;
				//$this->redirect($baseUrl.'/index.php?r=enggdiary/diary&id='.$model->id.'&engineer_id='.$engg_id);
				$this->redirect(array('/servicecall/view/', 'id'=>$model->id));
										
			}//end of model->save.
							
		}//end of if(isset()).
		
		
		$this->render('existingCustomer',array('model'=>$model));
		
	}//end of actionExistingCustomer().
	
		
	public function actionPrintAllJobsForDay()
	{
		$engg_id=$_GET['engg_id'];
		$visit_date=$_GET['date'];
		//$visit_date='14-3-2012';
		$mysql_visit_date=strtotime($visit_date);
		$service_id_list=Enggdiary::model()->fetchDiaryDetails($engg_id, $mysql_visit_date);
		//$config= Config::model()->findByPk(1);
		$setupModel = Setup::model()->findByPk(1);
		$mPDF1 = Yii::app()->ePdf->mPDF('', 'A4');
		
		$content='';
		foreach ($service_id_list as $data)
		{
			$servicecall_id= $data->servicecall_id;
			$model=$this->loadModel($servicecall_id);
			//$mPDF1->WriteHTML($this->renderPartial('Preview',array('model'=>$model,'config'=>$config), true));
			$mPDF1->WriteHTML($this->renderPartial('Preview',array('model'=>$model,'config'=>$setupModel), true));
		}
		
		$mPDF1->Output();
	}//end of printAllJobs.
	
	public function actionAddProduct($cust_id)
	{
		$model = new Servicecall;
		$model->job_status_id=1;
		$notify_status = $model->job_status_id;
		$productModel = new Product;
		
		$cust_id=$_GET['cust_id'];
		$customerModel=Customer::model()->findByPk($cust_id);
		 
	 	$this->performAjaxValidationForNewproductButExistingCustomer($model, $productModel);
		
		if(isset($_POST['Product']) && isset($_POST['Servicecall']))
		{
			$productModel->attributes=$_POST['Product'];
			$model->attributes=$_POST['Servicecall'];
			 		
			print_r($productModel->attributes);
			echo '<hr> ENGG ID'.$model->engineer_id;
			echo '<hr> ';
			print_r($model->attributes);
	
			
			$productModel->customer_id=$cust_id;
			$productModel->attributes=$_POST['Product'];
	
			if($productModel->save())
			{
	 
				//******* SAVING SERVICECALL DETAILS IF PRODUCT MODEL IS SAVED ************
				$model->engineer_id=$productModel->engineer_id;
		     	$model->customer_id=$cust_id;
		     	$model->product_id=$productModel->id;
		     	$model->contract_id=$productModel->contract_id;
		        $model->attributes=$_POST['Servicecall'];
		        
				if($model->save())
				{
					
					$internet_status = '';
					$advanceModel = AdvanceSettings::model()->findAllByAttributes(array('parameter'=>'internet_connected'));
					foreach ($advanceModel as $data)
					{
						$internet_status = $data->value;
					}
											
					if($internet_status == 1)
					{
						try
						{
							$service_id = $model->id;
							$status_id = $model->job_status_id;
							//$response = $this->performNotification($status_id, $service_id);
							$response = NotificationRules::model()->performNotification($status_id, $service_id);
														
						}//end of try.
						catch (Exception $e)
						{
														
						}
					}//end of if(internet Connection).
					
					//echo $model->product_id;
					$engg_id=$model->engineer_id;
					$baseUrl=Yii::app()->request->baseUrl;
					//$this->redirect($baseUrl.'/enggdiary/bookingAppointment/'.$model->id.'?engineer_id='.$engg_id);
					//$this->redirect($baseUrl.'/index.php?r=enggdiary/diary&id='.$model->id.'&engineer_id='.$engg_id);
					$this->redirect(array('/servicecall/view/', 'id'=>$model->id));
				
				}//end of SERVICECALL save
		        else 
		        {
		        	//echo "not saved";
		        }
		    
			 
			}//else 
				//echo "<br><b>Enter all mandatory fields of servicecall and product</b>";
		}//END OF IF ISSET().
		
	    $this->render('addProduct',array('model'=>$model, 'productModel'=>$productModel, 'customerModel'=>$customerModel));
	}//end of addProduct().
	
	public function actionFreeSearch()
    {
    	//WE ARE SEARCHING IN CUSTOMER TABLE, SO CREATING INSTANCE OF CUSTOMER MODEL.
        $model=new Servicecall('search');
        $this->render('freeSearch',array('model'=>$model));
    }//end of freeSearch().
    
    public function actionSearchengine($keyword)
    {
    
    	/*
          echo "THIS IS IAJAXX  ".$keyword;

            $criteria = new CDbCriteria;
            $criteria->with = array('products');
            $criteria->compare('products.serial_number', $keyword, true);
            $criteria->compare('postcode', $keyword, true, 'OR');
            $criteria->together = true;
            $customer_models = Customer::model()->findAll($criteria);

            foreach ($customer_models as $c) {
                //echo '<hr>'.$c->fullname;
                
                $no_of_produts=count($c->products);
                
                for ($i=0;$i<$no_of_produts; $i++)
                {
                	$product_sr_no=$c->products[$i]->serial_number;
					//echo '<br>'.$product_sr_no;
                }///end of for ($i=0;$i<$no_of_produts; $i++)
                
                
                //echo '-'.var_dump($c->products[0]);
                //echo '<hr>'.var_dump($c->products[1]);
                //echo '<br>-'.$c->products[0]->serial_number;
                //echo '<br>-'.$c->products[1]->serial_number;
            }
            
             $this->renderPartial('_new_ajax_search',array( 'results'=>'', 'customer_results'=>''));
			*/

        
        
        /*

        $criteria = new CDbCriteria;
        $criteria->alias = 'c';

        $criteria->join='LEFT JOIN product p ON c.id=p.customer_id';
        $criteria->compare('postcode', 'gl50 4bd', true, 'OR');

        //return new CActiveDataProvider($model, array(   'criteria'=>$criteria,  ));
        $customer_models = Customer::model()->findAll($criteria);

        foreach ($customer_models as $c) {

            echo '<hr>'.$c->fullname;
            echo '-'.var_dump($c);
        }


        $list= Yii::app()->db->createCommand("SELECT  customer.fullname AS customer_name, customer.postcode as customer_postcode, product.serial_number AS product_serial_no
FROM `customer`
LEFT JOIN  product ON customer.id=product.customer_id
WHERE     customer.postcode LIKE 'gl50 4bd'
      OR  product_serial_no = '11702900107234'
")->queryAll();

        $rs=array();
        foreach($list as $item){
            //process each item here
            //var_dump($item);
            echo '<br>'.$item['product_serial_no'];

        }

        */


      
      $model=new Servicecall();
      $model->unsetAttributes();  // clear any default values
      $results=$model->freeSearch($keyword);
      $customer_search_data = Customer::model()->freeSearch($keyword);
   
       $this->renderPartial('_ajax_search',array(
	               'results'=>$results, 'customer_results'=>$customer_search_data,
	   ));

       $cust_id_from_service_results= array();
        
 	}//end of searchEngine().
    
	public function actionGetitems()
	{
		$this->render('addToSpares');
	}//end of getItems().
	
	
	public function actionChangeengineeronly()
	{

		if(isset($_POST['Servicecall']))
		{

			$updated_engineer_id=$_POST['Servicecall']['engineer_id'];
			$id=$_POST['Servicecall']['id'];

			$servicecallmodel=$this->loadModel($id);
			$oldengineercompanyname=$servicecallmodel->engineer->company;
			
			
			$redirect_url=$_POST['Servicecall']['successfulredirectto'];
			$r=Servicecall::model()->updateengineerbyservicecallid($id,$updated_engineer_id);
			////Update engineer by PK
			if ($r==2){
				//Whenever the engg is changed, the remote chat is transferred to comments and cleared
				$clearchat=$this->clearchathistory($id, $oldengineercompanyname);
				//redirect

				//$this->redirect(array($redirect_url));
				if ($clearchat==true)
				{
					$this->redirect(array('servicecall/view','id'=>$id));

				}else
				{
					$this->redirect(array('servicecall/view&id='.$id.'&error_msg='.$clearchat));
				}
			}
			else
				echo 'cannot update engineer in either product or servicecall';

		}
		$this->renderPartial('changeEngineerOnly');
	}//end of ChangeEngineerOnly.
	
	public function actionEngineerDiary()
	{
		$model = new Servicecall('search');
//		$engg_id = $_GET['engg_id'];
//		echo "Engg id in controller = ".$engg_id;
		$this->render('engineerDiary', array('model'=>$model));
	}
	
	public function actionSelectEngineer()
	{
		//echo "in action selectEngineer, change status and create new appt here";
		$model=new Servicecall('search');
		$diary_id = $_GET['diary_id'];
		//echo "<br>Diary id in contr = ".$diary_id;
		$service_id = $_GET['service_id'];
		//echo "<br>Service id in contr = ".$service_id;
		$engg_id = '';
		$newDiaryId = '';
		
		if(isset($_GET['Servicecall']))
		{
			//echo "<br>in if loop";
			$model->attributes=$_GET['Servicecall'];
			//echo "Value in  is = ".$model->engineer_id;
			$engg_id = $model->engineer_id;
			//echo "<br>id got from view = ".$engg_id;
 
		}//getting engg id from dropdown.
		//echo "<br>Engg id outside = ".$engg_id;
		
		if ($diary_id!=0)
		{
			/******** CHANGING THE STATUS OF PREVIOUS APPOINTMENT ***********/
			Enggdiary::model()->changePreviousAppointment($diary_id);
			/***** END OF CHANGING THE STATUS OF PREVIOUS APPOINTMENT *******/
			
			/******** CREATING NEW APPOINTMENT WITH CHANGED ENGINEER *********/
		
			$diaryModel = Enggdiary::model()->findByPk($diary_id);
			
			$start_date = date('d-m-Y',$diaryModel->visit_end_date);
			
			$newEnggDiaryModel = new Enggdiary;
	    	$newEnggDiaryModel->servicecall_id=$service_id;
			$newEnggDiaryModel->engineer_id=$engg_id;
			$newEnggDiaryModel->status='3';//STATUS OF APPOINTMENT TO BOOKED(VISIT START DATE).
			$newEnggDiaryModel->visit_start_date=$start_date;
			$newEnggDiaryModel->slots = '2';
			
			//echo "<hr>START DATE OF NEW DIARY MODEL = ".$newEnggDiaryModel->visit_start_date;
			//echo "<br>END DATE OF NEW DIARY MODEL = ".$newEnggDiaryModel->visit_end_date;
			
			if($newEnggDiaryModel->save())
			{
				//echo "<br>SAVED.......!!!!!!!!!!";
				//echo "<br>New diary id to save to servicecall = ".$newEnggDiaryModel->id;
				$newDiaryId = $newEnggDiaryModel->id;
			}
			else 
			{
				//echo "<br>Problem in saving";
			}
			/******** END OF CREATING NEW APPOINTMENT WITH CHANGED ENGINEER *********/
			
			/************* CHANGING DIARY AND ENGINEER ID IN SERVICECALL ***********/
			Servicecall::model()->updateByPk($service_id,array(
													'engg_diary_id'=>$newDiaryId,
													'engineer_id'=>$engg_id
											));
			/******** CHANGING DIARY AND ENGINEER ID IN SERVICECALL ******************/
			$this->redirect(array('view','id'=>$service_id ));
			
		}///end of  if ($diary_id!=0){
		
		else
		{
			///COntrol will come here if diary id is 0 or call is in the logged state
			Servicecall::model()->updateByPk($service_id,array('engineer_id'=>$engg_id));
			
			$serviceModel=Servicecall::model()->findByPk($service_id);
			$product_id=$serviceModel->product_id;
			Product::model()->updateByPk($product_id,array('engineer_id'=>$engg_id)); 
			
			$this->redirect(array('view','id'=>$service_id ));
			
		}///end of else i.e, Servicecall is in LOGGED state. 
	}//end of actionSelectEngineer.
	


	
	public function performNotification($status_id, $service_id)
	{
		$info = '';
 		//echo "<hr>in perform validation function, follwoing data is from this func";
 		//echo "<br>Value of status_id = ".$status_id;
 		//echo "<br>Value of service_id = ".$service_id;

		$serviceModel = Servicecall::model()->findByPk($service_id);
		$setupModel = Setup::model()->findByPk(1);

		$cust_id = $serviceModel->customer_id;
		$engineer_id = $serviceModel->engineer_id;
		$contract_id = $serviceModel->product->contract_id;
		$company_name = $setupModel->company;
		$company_email = $setupModel->email;
		
		$product_type_name=$serviceModel->product->productType->name;
		$product_brand=$serviceModel->product->brand->name;
// 		echo "<br>cust id = ".$cust_id;
// 		echo "<br>engg id = ".$engineer_id;
// 		echo "<br>contract id = ".$contract_id;
		
		$notificationModel = NotificationRules::model()->findAllByAttributes(array('job_status_id'=>$status_id, 'active'=>'1'));
		
		if(count($notificationModel)!=0)
		{
			
			$serviceDetailsModel = Servicecall::model()->findByPk($service_id);
			
			//echo "<br>Service reference no = ".$serviceDetailsModel->service_reference_number;
			$reference_number = $serviceDetailsModel->service_reference_number;
			//echo "<br>Fault Desc = ".$serviceDetailsModel->fault_description;
			$fault_desc = $serviceDetailsModel->fault_description;
			//echo "<br>Customer Name = ".$serviceDetailsModel->customer->fullname;
			$customer_name = $serviceDetailsModel->customer->fullname;
			//echo "<br>Engineer Name = ".$serviceDetailsModel->engineer->fullname;
			$engineer_name = $serviceDetailsModel->engineer->company.', '.$serviceDetailsModel->engineer->fullname;
			
			$jobStatusModel = JobStatus::model()->findByPk($status_id);
			//echo "<br>Status id from job model = ".$jobStatusModel->name;
			$status = $jobStatusModel->name; 
			
			$subject = 'Service call '.$reference_number.' Status changed to '.$status;
			//echo "<br>Subject = ".$subject;
			
			$body = '<br>  The status of your '.$product_brand.' '.$product_type_name.' servicecall with reference no '.$reference_number.' is changed to '.$status."\n".'Engineer: '.$engineer_name.'<br><br>For any queries related to this call, please contact '.$company_email.'. <br><br>Regards,<br>'.$company_name;
			$smsMessage = 'Dear '.$customer_name.', The status of your '.$product_brand.' '.$product_type_name.' servicecall with reference no '.$reference_number.' is changed to '.$status."\n".'Engineer: '.$engineer_name;
		
			foreach($notificationModel as $data)
			{
				$customerNotificationCode =$data->customer_notification_code;
				$engineerNotificationCode =$data->engineer_notification_code;
				$warrantyProviderNotificationCode =$data->warranty_provider_notification_code;
				$othersNotificationCode =$data->notify_others;
				
				if($customerNotificationCode != 0)
				{
					$customerModel = Customer::model()->findByPk($cust_id);
					$receiver_email_address = $customerModel->email;
					$telephone = $customerModel->mobile;
					$name = $customerModel->fullname;
					$customer_body = 'Dear '.$name.','."<br>".$body;
						
					$response = NotificationRules::model()->notifyByEmailAndSms($receiver_email_address, $telephone, $customerNotificationCode, $customer_body, $subject, $smsMessage);
					$info.= $this->createMessage($response, 'customer');
					//echo "<br>INFO returned from func = ".$info;
					//return $response;
						
				}//end of if of CUSTOMER.
				
				if($engineerNotificationCode != 0)
				{
					$engineerModel = Engineer::model()->findByPk($engineer_id);
					$receiver_email_address = $engineerModel->contactDetails->email;
					//echo "<br>Engineer telephone = ".$engineerModel->contactDetails->mobile;
					$telephone = $engineerModel->contactDetails->mobile;
					$name = $engineerModel->fullname;
					$engineer_body = 'Dear '.$name.','."\n".$body;
						
					$response = NotificationRules::model()->notifyByEmailAndSms($receiver_email_address, $telephone, $engineerNotificationCode, $engineer_body, $subject, $smsMessage);
					$info.= $this->createMessage($response, 'engineer');
					//echo "<br>INFO returned from func = ".$info;
					//return $response;
						
				}//end of if of ENGINEER.
					
				if($warrantyProviderNotificationCode != 0)
				{
					$contractModel = Contract::model()->findByPk($contract_id);
					$receiver_email_address = $contractModel->mainContactDetails->email;
					//echo "<br>Warranty Provider telephone = ".$contractModel->mainContactDetails->mobile;
					$telephone = $contractModel->mainContactDetails->mobile;
					$warranty_body = 'Dear Recepient,'."\n".$body;
						
					$response = NotificationRules::model()->notifyByEmailAndSms($receiver_email_address, $telephone, $warrantyProviderNotificationCode, $warranty_body, $subject, $smsMessage);
					$info.= $this->createMessage($response, 'warranty provider');
					//echo "<br>INFO returned from func = ".$info;
					//return $response;
						
				}//end of if of WARRANTY PROVIDER.
					
				if($othersNotificationCode != 0)
				{
					//echo "<hr>INSIDE Others Notification code IF ELSE BLOCK = ".$othersNotificationCode;
					//echo "<br>Notification rule id = ".$data->id."<hr>";
				
					$notificationContactModel = NotificationContact::model()->findAllByAttributes(array('notification_rule_id'=>$data->id));
					foreach ($notificationContactModel as $contact)
					{
						//echo "<br>Others email address = ".$contact->email;
						$receiver_email_address = $contact->email;
						//echo "<br>Others telephone = ".$contact->mobile;
						$telephone = $contact->mobile;
						//echo "<br>Other name = ".$contact->person_name;
						$name = $contact->person_name;
						$others_body = 'Dear '.$name.','."\n".$body;
						$other_notification_code = $contact->notification_code_id;

						$response = NotificationRules::model()->notifyByEmailAndSms($receiver_email_address, $telephone, $other_notification_code, $others_body, $subject, $smsMessage);
						$info.= $this->createMessage($response, 'others');
						//echo "<br>INFO returned from func = ".$info;
						//return $response;
						
					}//end of inner foreach($contact).
					
				}//end of if of OTHERS.
				
			}//end of foreach($notificationModel).
			
		}//end of count().
		return $info;
		
	}//end of performNotification().
	
	public function createMessage($notifyStatusArray, $notifiedTo)
	{
		/* SMS API RETURNS 1 ON SUCCESFUL SMS SENT, OR RESTURNS EMPTY STRING.
		 * EMAIL SUCESSFUL SENT RETURNS 1 ELSE RETURNS 0.
		 */
		$msg = '';
		//echo "<br>SMS response in createMesg func = ".$notifyStatusArray['sms_response'];
		
		if($notifyStatusArray['sms_response'] == '1')
		{
			//echo "<br>!!!!!!!!!!!!!!!!!!!!!!!!!!.............. sms sent sucessfully ......!!!!!!!!!";
			$msg .= "<br><span style='background-color:#C9E0ED; color:#555555;   border-radius:10px 10px 10px 10px; '>SMS has been sent to ".$notifiedTo.". </span>";
		}
		elseif($notifyStatusArray['sms_response'] != 'none')
		{
			//echo "<br> SMS NOT SENT PROPERLY................!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!";
			$msg = $msg."<br><div style='background-color:#CD0000; color:white;   border-radius:10px 10px 10px 10px; '>Please check your sms settings or make sure the mobile number ".$notifiedTo." is valid. &nbsp;&nbsp;&nbsp;Server Response:<i> ".$notifyStatusArray['sms_response'].".</i></div>";
		}//end of if(sms_response)
		
		if($notifyStatusArray['email_response'] == 1)
		{
			//echo "<br>Email sent sucessfully ......!!!!!!!!!";
			$msg = $msg."<br><span style='background-color:#C9E0ED; color:#555555;   border-radius:10px 10px 10px 10px; '>Email has been sent to ".$notifiedTo.". </span>";
		}
		elseif($notifyStatusArray['sms_response'] != 'none')
		{
			//echo "<br>Error in sending email, check EMAIL settings.";
			$msg = $msg."<br><span style='background-color:red; color:#CD0000;   border-radius:10px 10px 10px 10px; '>Error in sending email to ".$notifiedTo.", check EMAIL settings.</span>";
		}
		//echo "<br> Message returned for ".$notifiedTo." = ".$msg;
		return $msg;
	}//end of createMessage().
	
	
	public function actionDisplaymap()
	{
		//echo 'dialog content here';
		$postcode = $_GET['postcode'];
		//echo "<br>Value of postcode in controller = ".$postcode;
		$this->renderPartial('displayMap', array('postcode'=>$postcode));
		
	}//end of actionDisplayMap



	public function actionChangejobstatusonly()
	{

		if (isset($_POST['Servicecall'])) {

			$updated_job_status_id = $_POST['Servicecall']['job_status_id'];
			$id = $_POST['Servicecall']['id'];
			$redirect_url = $_POST['Servicecall']['successfulredirectto'];
			$r = Servicecall::model()->updatejobstatusbyservicecallid($id, $updated_job_status_id);
			////Update engineer by PK
			if ($r == 1) {
				 //redirect
				$this->redirect(array($redirect_url));
			} else
				echo 'cannot update Job Status in servicecall. Please contact support';

		}
		$this->renderPartial('changeEngineerOnly');
	}//end of ChangeEngineerOnly.


	public function clearchathistory($servicecall_id, $oldenggname)
	{
		$systemmsg= "Clear Chat history is called servicecall_id".$servicecall_id;
		$error_msg='';
		$setupmodel=Setup::model();
		////Find the chat in mobile
		$gm_servicecallmodel=Gmservicecalls::model()->findByAttributes(array('servicecall_id'=>$servicecall_id));

		if ($gm_servicecallmodel)
		{
			$systemmsg.="<br> There is a gm data";
			$systemmsg.="<br> ".$gm_servicecallmodel->communications;
			$chats=$gm_servicecallmodel->communications;


			///Trannsfer and update chat in comments
			$servicecallmodel=Servicecall::model()->findByPk($servicecall_id);

			$systemmsg.="<br>fault_date ".$servicecallmodel->fault_date;
			$chats="<h5>Engineer Changed from ".$oldenggname."</h5><b>Previous Chats:</b><br>".$chats;
			$comments= $setupmodel->updatenotesorcomments($chats, $servicecallmodel, 'comments');






			$servicecall_update = Servicecall::model()->updateByPk($servicecall_id,
				array(
					'comments' => $comments,

				));

			if ($servicecall_update)
			{
				/// update the activity log as engineer is changed
				Servicecall::model()->updatejobstatusbyservicecallid($servicecall_id, '1'); //The job will be reset to logged


				///Clear chat history
				$gm_servicecallmodel->communications='{"chats":[]}';
				$gm_servicemodelsave=$setupmodel->savemodel($gm_servicecallmodel);

				if ($gm_servicemodelsave)
				{
					return true;
				}else
				{
					$error_msg.=$gm_servicemodelsave;
				}

			}else
			{
				$error_msg.='<br>Cannot update servicecall';
			}


		}///end of 	if ($gm_servicecallmodel)


		return $error_msg;

	}///end of 	public function clearchathistory($servicecall_id)


}//end of class.
