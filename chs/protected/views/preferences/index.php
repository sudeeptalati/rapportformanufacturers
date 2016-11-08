<?php
$this->breadcrumbs=array(
	'Preferences',
);

$this->menu=array(
	array('label'=>'Create Preferences', 'url'=>array('create')),
	array('label'=>'Manage Preferences', 'url'=>array('admin')),
);
?>

<h1>Preferences</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
