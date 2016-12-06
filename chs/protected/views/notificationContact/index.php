<?php
$this->breadcrumbs=array(
	'Notification Contacts',
);

$this->menu=array(
	array('label'=>'Create NotificationContact', 'url'=>array('create')),
	array('label'=>'Manage NotificationContact', 'url'=>array('admin')),
);
?>

<h1>Notification Contacts</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
