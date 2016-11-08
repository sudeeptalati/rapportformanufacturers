<?php
$this->breadcrumbs=array(
	'Notification Codes'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List NotificationCode', 'url'=>array('index')),
	array('label'=>'Manage NotificationCode', 'url'=>array('admin')),
);
?>

<h1>Create NotificationCode</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>