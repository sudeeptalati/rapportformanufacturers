

<?php 

$url=Yii::app()->request->getBaseUrl().'/index.php?r=reports/enggProdExport&engg_id='.$engg_id;
 

$excel=Yii::app()->request->baseUrl."/images/excel.png";

?>
			<a href='<?php echo $url;?>' style='color:#555;text-decoration:none;' >
			<?php echo CHtml::image($excel,"ballpop",array('width'=>'50px','height'=>'50px')); ?>
			</a><br>
<b><?php
	echo CHtml::link('Export to Excel',$url);
?></b>

<?php


$this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'product-grid',
	'dataProvider'=>$model->enggProductReport($engg_id),
	//'filter'=>$model,
	'columns'=>array(
		//'id',
		//'contract_id',
		array( 'header'=>'Contracter Name', 'value'=>'$data->contract->name' ),
		//'brand_id',
		array( 'header'=>'Brand Name', 'value'=>'$data->brand->name' ),
		//'product_type_id',
		array( 'header'=>'Product Name', 'value'=>'$data->productType->name' ),
		//'customer_id',
		array('header'=>'Customer Name', 'value'=>'$data->customer->fullname'),
		array('header'=>'Town', 'value'=>'$data->customer->town'),
		array('header'=>'Postcode', 'value'=>'$data->customer->postcode'),
		//'engineer_id',
		array( 'header'=>'Engineer Name', 'value'=>'$data->engineer->fullname' ),
		//'created_by_user',
		array( 'name'=>'created_by_user', 'value'=>'$data->createdByUser->username' ),
	),
));



?>
