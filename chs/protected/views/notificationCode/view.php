<?php
$this->breadcrumbs=array(
	'Notification Codes'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List NotificationCode', 'url'=>array('index')),
	array('label'=>'Create NotificationCode', 'url'=>array('create')),
	array('label'=>'Update NotificationCode', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete NotificationCode', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage NotificationCode', 'url'=>array('admin')),
);
?>

<h1>View NotificationCode #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'notify_by',
	),
)); ?>
