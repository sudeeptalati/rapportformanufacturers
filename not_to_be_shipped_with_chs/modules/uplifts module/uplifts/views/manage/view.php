<?php include('uplifts_menu.php'); ?>   
 <?php
$this->menu=array( 
	array('label'=>'Manage Uplifts', 'url'=>array('admin')),
);
?>


 
 
<h4>Uplift Number # <?php echo $model->uplift_number; ?></h4>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		//'id',
		'uplift_number',
		'service_reference_number',
		array( 'name'=>'customer_id', 'value'=>$model->customer_id==null ? "":$model->customer->fullname),
		//'product_id',
		'product_type_id',
		array( 'name'=>'product_type_id', 'value'=>$model->product_type_id==null ? "":$model->productType->name),
		array( 'name'=>'retailer_id', 'value'=>$model->retailer_id==null ? "":$model->retailer->company),
		'retailer_id',
		'retailer_contact',
		'retailer_phone',
		array( 'name'=>'distributor_id', 'value'=>$model->distributor_id==null ? "":$model->distributor->company),
		array( 'name'=>'visited_engineer_id', 'value'=>$model->visited_engineer_id==null ? "":$model->visitedEngineer->fullname),
		'visited_engineer_id',
		'visited_engineer_name',
		array( 'name'=>'date_of_call', 'value'=>$model->date_of_call==null ? "":date("d-M-Y",$model->date_of_call)),
		'reason_for_uplift',
		'request_type_id',
		'model_number',
		'serial_number',
		'index_number',
		'purchase_date',
		'exchange_date',
		'authorised_by',
		array( 'name'=>'authorised_by', 'value'=>$model->authorised_by==null ? '':$model->authorisedByUser->name),
		
		'price',
		'customer_claim_description',
		'notes',
		array( 'name'=>'created', 'value'=>$model->created==null ? "":date("d-M-Y",$model->created)),
		array( 'name'=>'modified', 'value'=>$model->modified==null ? "":date("d-M-Y",$model->modified)),
		'created_by',
		'modified_by',
	),
)); ?>
