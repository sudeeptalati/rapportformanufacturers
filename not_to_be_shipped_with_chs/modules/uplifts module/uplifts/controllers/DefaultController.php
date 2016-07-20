<?php

class DefaultController extends Controller
{
	public function actionIndex()
	{
		//$this->render('index');
		$this->redirect('index.php?r=uplifts/manage/admin');
	}
	
	public function actionSearchServicecall()
	{
		$service_reference_number=$_GET['service_reference_number'];
		
		///echo "********* <br>".$servicecall_id;
		$servicecall=Servicecall::model()->findByAttributes(array('service_reference_number'=>$service_reference_number));
	
		$result_array=array();
		
		//print_r($servicecall);
		if ($servicecall)
		{		
			$result_array['searchstatus']='1';
			$result_array['searchstatustext']='Found';
			
			$result_array['servicecall_id']=$servicecall->id;
			$result_array['service_reference_number']=$servicecall->service_reference_number;
			
			$result_array['customer_id']=$servicecall->customer->id;
			$result_array['customer_name']=$servicecall->customer->fullname;
			$result_array['customer_town_postcode']=$servicecall->customer->town.",  ".$servicecall->customer->postcode;
			$result_array['product_id']=$servicecall->product_id;
			$result_array['productType_id']=$servicecall->product->productType->id;
			$result_array['productType_name']=$servicecall->product->productType->name;
			
			$result_array['product_model_number']=$servicecall->product->model_number;	
			$result_array['product_serial_number']=$servicecall->product->serial_number;
			$result_array['product_index_number']=$servicecall->product->enr_number;
			
			$result_array['product_date_of_purchase']=date('d-m-Y',$servicecall->product->purchase_date);
 			$result_array['product_retailer']=$servicecall->product->purchased_from;
			$result_array['product_distributor']=$servicecall->product->distributor;
						
			$result_array['visited_engineer_name']=$servicecall->product->engineer->fullname;
			$result_array['visited_engineer_id']=$servicecall->product->engineer->id;
			$result_array['fault_description']=$servicecall->fault_description;
			$result_array['reason_for_uplift']=$servicecall->work_carried_out;
			
			$result_json= json_encode($result_array);
			echo json_encode($result_array);	
			 
		}
		
		
	}////public function actionSearchServicecall()
	
	
	public function actionUpLiftsreport()
	{
	
		$uplifts_report=UpliftsReport::model()->findAll(array('condition'=>'active=1',	'order'=>'sort_order ASC'));
		
		$selected_fields_of_reports=array();
		
		$selected_fields_of_uplifts=array();
		foreach ($uplifts_report as $e )
		{
			//echo "<br>".$e->field_name;
			$fields=array();
			$fields['field_relation']=$e->field_relation;
			$fields['field_label']=$e->field_label;
			$fields['field_type']=$e->field_type;
			$fields['active']=$e->active;
			array_push($selected_fields_of_reports,$fields);
			array_push($selected_fields_of_uplifts,$fields['field_relation']);
			
		}
		



		$fields =( implode( ',', $selected_fields_of_uplifts) );
		
		$criteria = new CDbCriteria;
		$criteria->select = $fields ; // select fields which you want in output	
			
		$upliftsModel = Uplifts::model();
		$upliftsTable = Yii::app()->getDb()->getSchema()->getTable($upliftsModel->tableName());
		$upliftsColumns = $upliftsTable->getColumnNames();
		$data = $upliftsModel->findAll();
		//print_r(	$upliftsColumns);
			
		$excel_data="";
		
		$excel_data .= "<table>";
			$excel_data .= "<tr>";
			foreach ($selected_fields_of_reports as $s)////runs for headers
			{
				$excel_data .= "<th>";
				$excel_data .= $s['field_label'];
				$excel_data .= "</th>";
			}
			$excel_data .= "</tr>";
			
		foreach ($data as $d)/////runs for each row
		{
			$excel_data .= "<tr>";
			foreach ($selected_fields_of_reports as $s)////runs for each column
			{
				$excel_data .= "<td>";
//				if (in_array($s['field_relation'], $upliftsColumns)) {
					if ($s['field_relation']!='blank_field') {
					$f=$s['field_relation'];
					
					$length='0';
						$f = preg_replace('/\s+/', '', $f);
						$a = explode( '|', $f);
						$length=count($a);
						
						switch ($length) {
						case 0:
							//$excel_data .= "BY 0 LEN".$d->$f;
							break;
						case 1:
							//$excel_data .= "By Lenth 1";
							
							if (isset($d->$a[0]))
							{
								$excel_data .= $this->processDataForReports($d->$a[0],$s['field_type']);
							}
							break;
						case 2:
							if (isset($d->$a[0]->$a[1]))
							{
								$excel_data .= $this->processDataForReports($d->$a[0]->$a[1],$s['field_type']);							
							}
							break;
						case 3:
							if (isset($d->$a[0]->$a[1]->$a[2])) {
								$excel_data .= $this->processDataForReports($d->$a[0]->$a[1]->$a[2],$s['field_type']);
							}
							break;
						case 4:
							if (isset($d->$a[0]->$a[1]->$a[2]->$a[3]))
							{
								$excel_data .= $this->processDataForReports($d->$a[0]->$a[1]->$a[2]->$a[3],$s['field_type']);
							}
							break;
						case 5:
							if (isset($d->$a[0]->$a[1]->$a[2]->$a[3]->$a[4]))
							{
								$excel_data .= $this->processDataForReports($d->$a[0]->$a[1]->$a[2]->$a[3]->$a[4],$s['field_type']);
							}
							break;
						}
				}
				else
				{
					$excel_data .= "";////leaving Blank Space if no Value
				}
				$excel_data .= "</td>";
			}
			$excel_data .= "</tr>";
 		}
		$excel_data .= "</table>";
		
		echo $excel_data;
	}/////end 	public function actionUpLiftsreport()
	
	
	
	
	
	public function actionGetRelationsAndFieldsListByModelName()
	{
		$modelname= $_GET['modelname'];
		$list_data=UpliftsReport::model()->getRelationsAndFieldsListByModelName($modelname);
		echo json_encode($list_data);		

	}
	
	
	public function actionCheckFieldOrRelationByModelNameAndValue()
	{
		
		$modelname= $_GET['modelname'];
		$selected_value= $_GET['selected_value'];
		
		/*
		$modelname="Uplifts";
		$selected_value="servicecall";
		*/
		
		$fieldslist = UpliftsReport::model()->getFieldsListByModelName($modelname);
		$relationslist = UpliftsReport::model()->getOneToOneRelationListByModelName($modelname);
		$newmodel=
		
		$response=array();
		
		if (in_array($selected_value, $relationslist)) {
		
			$response['value_type']='relation';
			$response['value_selected']=$selected_value;	
			
			$newmodel=UpliftsReport::model()->getNewModelNameBySelectedValueAndCurrentModelName($modelname,$selected_value);
			$newmodellistdata=UpliftsReport::model()->getRelationsAndFieldsListByModelName($newmodel);
			$response['newmodel']=$newmodel;
			$response['list_data']=$newmodellistdata;
		}
		
		
		if (in_array($selected_value, $fieldslist)) {
		
			$response['value_type']='field';
			$response['value_selected']=$selected_value;	
		}
		
				
		echo json_encode($response);		

	}
	
	
	
	

	
	
	
	
	
}///end of class