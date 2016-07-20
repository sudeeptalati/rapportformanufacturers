<?php include('uplifts_menu.php'); ?>   
 <?php
$this->menu=array( 
	array('label'=>'Raise Uplift Number	', 'url'=>array('create')),
);
?> 
<h4>Manage Uplifts</h4>
<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'uplifts-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		///'id',
		'uplift_number',
		array('name'=>'date_of_call', 'value'=>'date("d-M-Y",$data->date_of_call)', 'filter'=>false),
		'serial_number',
//		'request_type_id',
		array('name'=>'request_type_id', 'value'=>'$data->requestType->name', 'filter'=>false),


		'prefix_id',
		//'servicecall_id',
		//'customer_id',
		//'product_id',
		/*
		'product_type_id',
		'retailer_id',
		'retailer_contact',
		'retailer_phone',
		'distributor_id',
		'visited_engineer_id',
		'visited_engineer_name',
		'date_of_call',
		'reason_for_uplift',
		'request_type_id',
		'model_number',
		'serial_number',
		'index_number',
		'purchase_date',
		'exchange_date',
		'authorised_by',
		'price',
		'customer_claim_description',
		'notes',
		'created',
		'modified',
		'created_by',
		'modified_by',
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
