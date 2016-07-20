<?php
$this->breadcrumbs=array(
	'Notification Rules',
);

$this->menu=array(
	array('label'=>'Create NotificationRules', 'url'=>array('create')),
	array('label'=>'Manage NotificationRules', 'url'=>array('admin')),
);
?>

<h1>Notification Rules</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
