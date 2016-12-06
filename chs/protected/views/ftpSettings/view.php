<?php
$this->breadcrumbs=array(
	'Ftp Settings'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List FtpSettings', 'url'=>array('index')),
	array('label'=>'Create FtpSettings', 'url'=>array('create')),
	array('label'=>'Update FtpSettings', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete FtpSettings', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage FtpSettings', 'url'=>array('admin')),
);
?>

<h1>View FtpSettings #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'url',
		'ftp_username',
		'ftp_password',
		'ftp_port',
	),
)); ?>
