<?php
/* @var $this GmServicecallsController */
/* @var $model GmServicecalls */

 //include('gomobile_menu.php'); 


$this->layout='column1';

	$selected_statuses=array(
							'31'=>'Job Sent to Engineer', 
							'35'=>'Engineer Claim Received & Waiting for Review', 
							'37'=>'Message Recieved From Engineer', 
							
							'32'=>'Unable to Sent to Engineer', 
							'34'=>'Engineer Claim Approved', 
							'54'=>'Claim Rejected', 
							'36'=>'Message Sent to Engineer', 
							
							//'101'=>'Invoiced - Serviced'
							);

?>
 

 
<style>
ul#menu li {
    display:inline;
}
</style>
</head>
<body>

 

 


<table>

<?php $i=0; ?>
<?php foreach ($selected_statuses as $js_id=>$js) {	?>
			<?php $data= $model->getservicecallsbystatusescount($js_id);?>
			<tr><td><?php echo $data['html_name'];?></td></tr>
			<?php $i++; ?>
			<?php if ($i==3) break;//{ echo "</tr><tr>";} ?>
			

<?php }///end of foreach ?>

 </table>  
<h2>Admin-GoMobile</h2>


<?php $this->widget('zii.widgets.grid.CGridView', array(
    'id'=>'gmservicecalls-grid',
    'dataProvider'=>$model->search(),

	'selectableRows'=>1,
	'selectionChanged'=>'function(id){ location.href = "'.$this->createUrl('view').'/id/"+$.fn.yiiGridView.getSelection(id);}',

    'filter'=>$model,
    'columns'=>array(
    
		array(	'name'=>'service_reference_number',
				//'value'=>'$data->servicecall_id',
			     'value' => 'CHtml::link($data->service_reference_number, array("/servicecall/view&id=".$data->servicecall_id))',
				'type'=>'raw',
				//'filter'=>true,
				'header' => 'Service Ref No#'
		),

		array(	'name'=>'server_status_id',
				'value'=>'$data->servicecall->jobStatus->name',
				'type'=>'raw',
				'filter'=>false,
				//'filter'=>JobStatus::model()->getAllPublishedListdata(),
		),

		/*
		array('name'=>'server_status_id',
			'value'=>'$data->jobstatus->html_name',
			'type'=>'raw',
			
			'filter'=>$selected_statuses,
			),

		*/


		array(	'header' => 'CustomerFullName',
            	//'name'=>'customer_name',
				'value'=>'$data->servicecall->customer->fullname',
				
				 
				),
		
	 
		array(	'header' => 'FullPostcode',
            	//'name'=>'customer_address',
				'value'=>'$data->servicecall->customer->postcode',	 
				),
	
	
		array(	'header' => 'Engineer',
            	//'name'=>'customer_address',
				'value'=>'$data->servicecall->engineer->company',		 
			),
			
		
		array(	'header' => 'JobPaymentDate',
            	//'name'=>'customer_address',
				 'value'=>'$data->servicecall->job_payment_date==null ? "":date("d-M-Y",$data->servicecall->job_payment_date)', 
			),
		//array('name'=>'created', 'value'=>'$data->created==null ? "":date("d-M-Y",$data->created)', 'filter'=>false),

		 
		array(	'header' => 'ReportedDate',
            	//'name'=>'fault_reported_date',
				 'value'=>'$data->servicecall->fault_date==null ? "":date("d-M-Y",$data->servicecall->fault_date)', 
			),
		array('header' => 'LastChanged', 'name'=>'modified', 'value'=>'$data->modified==null ? "":date("d-M-Y H:i:s l",$data->modified)', 'filter'=>false),

		array('name'=>'server_status_id',

			'header'=>'Last Server Activity',
			'value'=>'$data->jobstatus->html_name',
			'type'=>'raw',
			'filter'=>$selected_statuses,
		),

    	/*
        'id',
        'servicecall_id',
        'service_reference_number',
        'server_status_id',
        'created',
        'modified',
        
        'comments',
        'data_sent',
        'data_recieved',
        'communications',
        'event_log',

 		array(
			'class'=>'CButtonColumn',
			'template'=>'{view}',
		),  */
    ),
)); ?>