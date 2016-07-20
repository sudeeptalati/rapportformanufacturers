<div id="sidemenu">             
<?php include('setup_sidemenu.php'); ?>   
</div>

 <h1>Model Numbers	</h1>
 

<div id="submenu">   
<li><?php echo CHtml::link('Manage Model Numbers',array('admin')); ?></li>
<li><?php echo CHtml::link('Add New Model Numbers',array('create')); ?></li>
</div>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'model-numbers-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		//'id',
		//'model_number',
		array(	'name'=>'model_number',
				'value' => 'CHtml::link($data->model_number, array("modelnumbers/update&id=".$data->id))',
		 		'type'=>'raw',
        ),
		array(	'name'=>'brand_id',
				'value'=>'$data->brand->name'),
        
		array(	'name'=>'product_type_id',
				'value'=>'$data->productType->name'),
		 
 
		//'brand_id',
		//'product_type_id',
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
