<?php
$this->breadcrumbs=array(
	'Notification Contacts'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List NotificationContact', 'url'=>array('index')),
	array('label'=>'Create NotificationContact', 'url'=>array('create')),
	array('label'=>'View NotificationContact', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage NotificationContact', 'url'=>array('admin')),
);
?>

<h1>Update NotificationContact <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>