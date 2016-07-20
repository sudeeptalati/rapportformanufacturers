<?php
$this->breadcrumbs=array(
	'Notification Contacts'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List NotificationContact', 'url'=>array('index')),
	array('label'=>'Manage NotificationContact', 'url'=>array('admin')),
);
?>

<h1>Create NotificationContact</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>