<?php
$this->breadcrumbs=array(
	'Notification Contacts'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List NotificationContact', 'url'=>array('index')),
	array('label'=>'Create NotificationContact', 'url'=>array('create')),
	array('label'=>'Update NotificationContact', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete NotificationContact', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage NotificationContact', 'url'=>array('admin')),
);
?>

<h1>View NotificationContact #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'notification_rule_id',
		'person_name',
		'person_info',
		'email',
		'mobile',
		'notification_code_id',
		'created',
		'modified',
		'deleted',
	),
)); ?>
