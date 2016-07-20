<?php
$this->breadcrumbs=array(
	'Oows'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Oow', 'url'=>array('index')),
	array('label'=>'Create Oow', 'url'=>array('create')),
	array('label'=>'Update Oow', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Oow', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Oow', 'url'=>array('admin')),
);
?>

<h1>View Oow #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'serial_number',
		'model_number',
		'model_range',
		'notes',
		'created',
		'modified',
		'createdby',
		'modifiedy',
	),
)); ?>
