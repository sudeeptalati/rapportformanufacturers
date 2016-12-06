<?php
$this->breadcrumbs=array(
	'Addons'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'List Addons', 'url'=>array('index')),
	array('label'=>'Create Addons', 'url'=>array('create')),
	array('label'=>'Update Addons', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Addons', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Addons', 'url'=>array('admin')),
);
?>

<h1>View Addons #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'type',
		'name',
		'information',
		
		array(  'name'=>'active',
				'header'=>'Active',
				'value'=>$model->active == 0? "Disabled":"Enabled" ,
		),
		
		
		
		'created_on',
		'created_by',
		'inactivated_on',
		'inactivated_by',
	),
)); ?>
