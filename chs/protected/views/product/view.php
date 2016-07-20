<?php
 
$this->menu=array(
	array('label'=>'Manage Customers', 'url'=>array('/customer/admin')),
);
?>

<h1>View Product #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		//'id',
		//'contract_id',
		'contract.name',
		//'brand_id',
		'brand.name',
		//'product_type_id',
		'productType.name',
		//'customer_id',
		'customer.fullname',
		'customer.postcode',
		//'engineer_id',
		'engineer.fullname',
		'purchased_from',
		//'purchase_date',
		array(
			'name'=>'Purchase Date',
			//'value'=>date('d-M-y',$model->purchase_date),
			'value'=>(!empty($model->purchase_date)) ? CHtml::encode(date('d-M-y',$model->purchase_date)) : '',
		),
		//'warranty_date',
		array(
			'name'=>'Warranty Date',
			//'value'=>date('d-M-y',$model->warranty_date),
			'value'=>(!empty($model->warranty_date)) ? CHtml::encode(date('d-M-y',$model->warranty_date)) : '',
		),
		'model_number',
		'serial_number',
		'production_code',
		'enr_number',
		'fnr_number',
		//'discontinued',
		array(
			'label'=>'Product discontinued',
			'value'=>$model->discontinued ? "Yes" : "No",
		),
		'warranty_for_months',
		'purchase_price',
		//'notes',
		//'created_by_user_id',
		//'createdByUser.username',
		array( 'name'=>'created_by_user_id', 'value'=>$model->createdByUser->username, 'filter'=>false),
		//'created',
		array(
				'name'=>'Created',
				'value'=>date('d-M-y',$model->created),
		),
// 		'modified',
// 		'cancelled',
	),
)); ?>
