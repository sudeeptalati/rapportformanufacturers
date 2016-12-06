<?php
include('servicecall_sidemenu.php');

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('customer-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>


<h1>Manage Customers</h1>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'customer-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		//'id',
		//'title',
		//'first_name',
		//'last_name',
		'fullname',
		'town',
		'postcode',
		//'product_id',

		/*
		array('name'=>'product_brand','value'=>'$data->product->brand->name'),
		array('name'=>'product_type','value'=>'$data->product->productType->name'),
		array('name'=>'model_number','value'=>'$data->product->model_number'),
		array('name'=>'serial_number','value'=>'$data->product->serial_number'),
		array('name'=>'created', 'value'=>'date("d-M-Y",$data->created)', 'filter'=>false),
		*/


		//'telephone',
		//'address_line_1',
		array( 'name'=>'created_by_user', 'value'=>'$data->createdByUser->username' ),
		/*
		'address_line_2',
		'address_line_3',
		'country',
		'mobile',
		'fax',
		'email',
		'notes',
		'created_by_user_id',
		'created',
		'modified',
*/
		array(
			'class'=>'CButtonColumn',
			'template'=>'{view}{update}',
			'buttons' => array(
				'update' =>array
				(
					'url' => 'Yii::app()->createUrl("Customer/openDialog" , array("customer_id"=>$data->id, "product_id"=>$data->product_id))',
				),
			),	
		) ,


		array(
			//'name'=>'',
			'type' => 'raw',
			'value' => 'CHtml::link("Add another product",array("product/addProduct", "id"=>$data->id))',
			
		),

	),
)); 
?>




