<?php
$this->breadcrumbs=array(
	'Advance Settings',
);

$this->menu=array(
	array('label'=>'Create AdvanceSettings', 'url'=>array('create')),
	array('label'=>'Manage AdvanceSettings', 'url'=>array('admin')),
);
?>

<h1>Advance Settings</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
