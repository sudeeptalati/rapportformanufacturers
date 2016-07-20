<h1>Merge Customers</h1>

<?php

if(isset($_GET['merged']))
{
	$merged_status = $_GET['merged'];
	if($merged_status == 1)
	{
		echo "<br>Customers merged";
	}
	else
	{
		echo "<br>ERROR: Customers not merged, Try again";
	}
	
}//end if if isset().
//else
	//echo "<br>not merged";


?>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'customer-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
//		array(	'name'=>'fullname',
//				'value' => 'CHtml::link($data->fullname, array("default/selectedPostcodeCustomers&primary_id=".$data->id."&postcode=".$data->postcode))',
//		 		'type'=>'raw',
//        ),
		'fullname',
		'town',
		'postcode',
//		array('name'=>'product_brand','value'=>'$data->product->brand->name', 'filter'=>false),
//		array('name'=>'product_type','value'=>'$data->product->productType->name', 'filter'=>false),
//		array('name'=>'model_number','value'=>'$data->product->model_number'),
//		array('name'=>'serial_number','value'=>'$data->product->serial_number'),

		array('name'=>'created', 'value'=>'date("d-M-Y",$data->created)', 'filter'=>false),
	),
)); 
?>
