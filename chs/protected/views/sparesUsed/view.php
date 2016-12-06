<?php
$this->breadcrumbs=array(
	'Spares Useds'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List SparesUsed', 'url'=>array('index')),
	array('label'=>'Create SparesUsed', 'url'=>array('create')),
	array('label'=>'Update SparesUsed', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete SparesUsed', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage SparesUsed', 'url'=>array('admin')),
);
?>

<h1>View SparesUsed #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'master_item_id',
		'servicecall_id',
		'item_name',
		'part_number',
		'unit_price',
		'quantity',
		'total_price',
		'date_ordered',
		'created',
		'modified',
	),
)); ?>
