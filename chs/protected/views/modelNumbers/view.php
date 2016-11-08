<div id="sidemenu">             
<?php include('setup_sidemenu.php'); ?>   
</div>

 <h1>Model Numbers	</h1>
 

<div id="submenu">   
<li><?php echo CHtml::link('Manage Model Numbers',array('admin')); ?></li>
<li><?php echo CHtml::link('Add New Model Numbers',array('create')); ?></li>
</div>

<br>
<br>


<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		//'id',
		'model_number',
		array(
			'label'=>'brand_id',
			'value'=>$model->brand_id ? $model->brand->name : "Not Known",
		),
		array(
			'label'=>'product_type_id',
			'value'=>$model->product_type_id ? $model->productType->name : "Not Known",
		),
 
	),
)); ?>
