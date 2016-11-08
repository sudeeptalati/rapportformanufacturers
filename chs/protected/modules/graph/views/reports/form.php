<?php include('graph_menu.php'); ?>   

<h1><font color="#0094EF"> Service Calls Reports</font> </h1>


<?php
if (isset($_GET['engineer_id']))
	$engineer_id=$_GET['engineer_id'];
else
	$engineer_id='';


if (isset($_GET['brand_id']))
	$brand_id=$_GET['brand_id'];
else
	$brand_id='';





if (isset($_GET['product_type_id']))
	$product_type_id=$_GET['product_type_id'];
else
	$product_type_id='';
	

	
if (isset($_GET['product_model_number']))
	$product_model_number=$_GET['product_model_number'];
else
	$product_model_number='';
	
	
	
if (isset($_GET['job_status_id']))
	$job_status_id=$_GET['job_status_id'];
else
	$job_status_id='';

	

///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
$fault_dateStartDate='';
if (isset($_GET['fault_dateStartDate']))
	$fault_dateStartDate=$_GET['fault_dateStartDate'];

$fault_dateEndDate='';
if (isset($_GET['fault_dateEndDate']))
	$fault_dateEndDate=$_GET['fault_dateEndDate'];
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////



///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
$jobPaymentStartDate='';
if (isset($_GET['jobPaymentStartDate']))
	$jobPaymentStartDate=$_GET['jobPaymentStartDate'];

$jobPaymentEndDate='';
if (isset($_GET['jobPaymentEndDate']))
	$jobPaymentEndDate=$_GET['jobPaymentEndDate'];
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////



///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
$jobFinishedStartDate='';
if (isset($_GET['jobFinishedStartDate']))
	$jobFinishedStartDate=$_GET['jobFinishedStartDate'];

$jobFinishedEndDate='';
if (isset($_GET['jobFinishedEndDate']))
	$jobFinishedEndDate=$_GET['jobFinishedEndDate'];
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////




$csvdata='';


//get servicecall model
//get lavbel
$servicecall_label=Servicecall::model()->attributeLabels();
$job_status_data = JobStatus::model()->getAllPublishedListdata();
$engg_data = Engineer::model()->getactiveengineerslist();	
$today = date('d-M-y', time()); 


$brand_list=Brand::model()->getAllActiveBrands();
$product_type_list=ProductType::model()->getActiveProductTypesListData();


?> 
 

<div style="padding:1em;background-color:#D0F2FF; width:60em;   border-top-left-radius: 25px;border-bottom-left-radius: 25px;">
<?php echo CHtml::beginForm('index.php?r=graph/reports/form','get'); 
?>

<input type='hidden' id='todays_date' name='todays_date' value='<?php echo $today; ?>'/>

<table>

	<tr>
		<td colspan='4'><hr><b><?php echo $servicecall_label['engineer_id']; ?></b>
		<?php
			echo CHtml::dropDownList('engineer_id',$engineer_id, $engg_data, array('empty'=> 'All Engineers'));
		?>
		</td>
	</tr>
	
	<tr>
		<td colspan='4'><hr><b><?php echo $servicecall_label['product_id']; ?> </b></td>
	</tr>
	<tr>
		<td>Brand 
			<?php
				echo CHtml::dropDownList('brand_id',$brand_id, $brand_list, array('empty'=> 'All Brands'));
			?>	
		</td>
		<td>
			Product Type 
			<?php
				echo CHtml::dropDownList('product_type_id',$product_type_id, $product_type_list, array('empty'=> 'All Products'));
			?>	
		</td>
		<td>
	 		Model Number 
			<?php
				echo CHtml::textField('product_model_number');
			?>
		
		</td>
		<td></td>
	</tr>	
	
	<tr>
		<td colspan='4'>	<hr><b><?php echo $servicecall_label['fault_date']; ?></b></td>
	</tr>
	<tr>
		<td>Start Date*
			<?php 						  
			$this->widget('zii.widgets.jui.CJuiDatePicker', array(
				'name'=>'fault_dateStartDate',
				'value'=>$fault_dateStartDate,	
				// additional javascript options for the date picker plugin
				'options'=>array(
					'showAnim'=>'fold',
					'dateFormat' => 'd-M-y',
				),
				'htmlOptions'=>array(
					'style'=>'height:20px;',
					'onChange'=>'javascript:setTodaysDateInTextField("fault_dateEndDate");'
				),
			));
			
			?>
		</td><td>
		End Date*
		<?php
		
		
		$this->widget('zii.widgets.jui.CJuiDatePicker', array(
			'name'=>'fault_dateEndDate',
			'value'=>$fault_dateEndDate,
			// additional javascript options for the date picker plugin
			'options'=>array(
				'showAnim'=>'fold',
				'dateFormat' => 'd-M-y',
				
			),
			'htmlOptions'=>array(
				'style'=>'height:20px;'
			),
		));			
		?>
		</td>
		<td></td>
		<td></td>
	</tr>
	<tr>
		<td colspan='4' ><hr><b><?php echo $servicecall_label['job_status_id']; ?></b>
		<?php			
				echo CHtml::dropDownList('job_status_id',$job_status_id, $job_status_data, array('empty'=> 'All Status'));
				//echo CHtml::dropDownList('job_status_id',$job_status_id, $job_status_data );
		?>
		</td>
	</tr>
 
	
	<tr>
		<td colspan='4'><hr> <b><?php echo $servicecall_label['job_payment_date']; ?></b></td>
	</tr>
	<tr>
		<td>Start Date
			<?php 						  
			$this->widget('zii.widgets.jui.CJuiDatePicker', array(
				'name'=>'jobPaymentStartDate',
				'value'=>$jobPaymentStartDate,
				// additional javascript options for the date picker plugin
				'options'=>array(
					'showAnim'=>'fold',
					'dateFormat' => 'd-M-y',
				),
				'htmlOptions'=>array(
					'style'=>'height:20px;',
					'onChange'=>'javascript:setTodaysDateInTextField("jobPaymentEndDate");'
				),
			));
			
			?>
		</td><td>
		End Date
		<?php
	 
		
		$this->widget('zii.widgets.jui.CJuiDatePicker', array(
			'name'=>'jobPaymentEndDate',
			'value'=>$jobPaymentEndDate,
			// additional javascript options for the date picker plugin
			'options'=>array(
				'showAnim'=>'fold',
				'dateFormat' => 'd-M-y',
				
			),
			'htmlOptions'=>array(
				'style'=>'height:20px;'
			),
		));			
		?>
		</td>
		<td></td>
		<td></td>
	</tr>
	<tr>
		<td colspan='4'><hr> <b><?php echo $servicecall_label['job_finished_date']; ?></b></td>
	</tr>
	<tr>
		<td>Start Date
			<?php 						  
			$this->widget('zii.widgets.jui.CJuiDatePicker', array(
				'name'=>'jobFinishedStartDate',
				'value'=>$jobFinishedStartDate,
				// additional javascript options for the date picker plugin
				'options'=>array(
					'showAnim'=>'fold',
					'dateFormat' => 'd-M-y',
				),
				'htmlOptions'=>array(
					'style'=>'height:20px;',
					'onChange'=>'javascript:setTodaysDateInTextField("jobFinishedEndDate");'
				),
			));
			
			?>
		</td><td>
		End Date
		<?php
		 
		
		$this->widget('zii.widgets.jui.CJuiDatePicker', array(
			'name'=>'jobFinishedEndDate',
			'value'=>$jobFinishedEndDate,
			// additional javascript options for the date picker plugin
			'options'=>array(
				'showAnim'=>'fold',
				'dateFormat' => 'd-M-y',
				
			),
			'htmlOptions'=>array(
				'style'=>'height:20px;'
			),
		));			
		?>
		</td>
		<td></td>
		<td></td>
	</tr>
	
	

	
	
	<tr>
		<td colspan='4'><hr>
		<?php 
			echo CHtml::submitButton('Generate Report',array('name' => 'generate_report'));
			echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
			echo CHtml::link('Reset',array('/graph/reports/form')); 
			
		?>
		</td>
	</tr>
	
	
	
	
	
</table>

<?php echo CHtml::endForm(); ?>
</div><!-- END OF FORM DIV -->

<br><br>
<?php


if(isset($_GET['generate_report']))///////SHOW THE FOLLOWING GRID ONLY IF FORM IS SUBMITTED
{
		echo CHtml::beginForm('index.php?r=graph/reports/exporttocsv','get',  array('target'=>'_blank')); 
		
		echo CHtml::hiddenField('brand_id', $brand_id);
		echo CHtml::hiddenField('product_type_id', $product_type_id);
		echo CHtml::hiddenField('product_model_number', $product_model_number);
		
		//echo CHtml::textArea('json_data_for_csv', json_encode($active_data_for_csv), array('id'=>'json_data_for_csv'));
		echo CHtml::hiddenField('fault_dateStartDate', $fault_dateStartDate);
		echo CHtml::hiddenField('fault_dateEndDate', $fault_dateEndDate);
		echo CHtml::hiddenField('job_status_id', $job_status_id);
		echo CHtml::hiddenField('engineer_id', $engineer_id);
		echo CHtml::hiddenField('jobPaymentStartDate', $jobPaymentStartDate);
		echo CHtml::hiddenField('jobPaymentEndDate', $jobPaymentEndDate);
		echo CHtml::hiddenField('jobFinishedStartDate', $jobFinishedStartDate);
		echo CHtml::hiddenField('jobFinishedEndDate', $jobFinishedEndDate);	
		echo CHtml::submitButton('Export as CSV'); 
		echo CHtml::endForm(); 
		echo 'You can save the following data in the CSV format and later convert it to excel. Just click on Export as CSV ';



		$this->widget('zii.widgets.grid.CGridView',
						array(
							'dataProvider' => $active_data,
							'columns' => array(
								//'id', 
								//'id',
		//'service_reference_number',
		array(	'name'=>'service_reference_number',
				'value' => 'CHtml::link($data->service_reference_number, array("/Servicecall/view&id=".$data->id))',
		 		'type'=>'raw',
        ),
		//'customer_id',
		array('header' => 'Customer','name'=>'customer_name','value'=>'$data->customer->fullname'),
		array('name'=>'customer_town','value'=>'$data->customer->town'),
		array('header' => 'Postcode','name'=>'customer_postcode','value'=>'$data->customer->postcode'),
		//'product_id',
		array(	'header' => 'Product',
            	'name'=>'product_name',
				'value'=>'$data->product->brand->name." ".$data->product->productType->name',
				'filter'=>false
				),
			
		array('name'=>'model_number','value'=>'$data->product->model_number'),
		array('name'=>'serial_number','value'=>'$data->product->serial_number'),
		
		//'contract_id',
		//array('name'=>'contract_name','value'=>'$data->contract->name'),
		
		//'engineer_id',
		
	
		array(
			'name'=>'job_status_id',
			'value'=>'JobStatus::published_item("JobStatus",$data->job_status_id)',
		),

		array(
			'name'=>'engineer_id',
			'value'=>'Engineer::item("Engineer",$data->engineer_id)',
			'filter'=>Engineer::items('Engineer'),
		),
		
		array('name'=>'fault_date', 'value'=>'date("d-M-Y",$data->fault_date)'),
		array('name'=>'job_payment_date', 'value'=>'($data->job_payment_date)?date("d-M-Y",$data->job_payment_date):""' ),
		array('name'=>'job_finished_date', 'value'=>'($data->job_finished_date)?date("d-M-Y",$data->job_finished_date):""' ),
 
		
		
		),
			
		
			
		));
		
		//print_r($active_data_for_csv);
		
	 	 
			
			
	 
		 
		


	 
		
		 
		
}////end of if(isset($_GET['generate_report']))		




 
?>
 

 

<script>

function setTodaysDateInTextField(field_id)
{
	document.getElementById(field_id).value=document.getElementById("todays_date").value;
}///end of setTodaysDateInTextField("fault_dateEndDate")


 

</script>
 
