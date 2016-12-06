<?php
$this->breadcrumbs=array(
	'Spares Used Statuses'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'List SparesUsedStatus', 'url'=>array('index')),
	array('label'=>'Create SparesUsedStatus', 'url'=>array('create')),
	array('label'=>'Update SparesUsedStatus', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete SparesUsedStatus', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage SparesUsedStatus', 'url'=>array('admin')),
);
?>

<h1>View SparesUsedStatus #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'name',
		'information',
		'created_by_user_id',
		'created',
	),
)); ?>
