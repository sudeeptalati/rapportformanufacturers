 
<?php include('oow_menu.php'); ?>   
<h4>Out of Warranty Products</h4>
<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'oow-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		//'id',
		'serial_number',
		'model_number',
		'model_range',
		'notes',
 
		array('name'=>'created', 'value'=>'date("d-M-Y",$data->created)', 'filter'=>true),
	
		/*
		'modified',
		'createdby',
		'modifiedy',
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
