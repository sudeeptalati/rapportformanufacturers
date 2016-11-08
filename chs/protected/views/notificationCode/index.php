<?php
$this->breadcrumbs=array(
	'Notification Codes',
);

$this->menu=array(
	array('label'=>'Create NotificationCode', 'url'=>array('create')),
	array('label'=>'Manage NotificationCode', 'url'=>array('admin')),
);
?>

<h1>Notification Codes</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
