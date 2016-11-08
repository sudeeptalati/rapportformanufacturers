<?php
$this->breadcrumbs=array(
	'Notification Codes'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List NotificationCode', 'url'=>array('index')),
	array('label'=>'Create NotificationCode', 'url'=>array('create')),
	array('label'=>'View NotificationCode', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage NotificationCode', 'url'=>array('admin')),
);
?>

<h1>Update NotificationCode <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>