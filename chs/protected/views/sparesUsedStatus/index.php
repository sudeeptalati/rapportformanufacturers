<?php
$this->breadcrumbs=array(
	'Spares Used Statuses',
);

$this->menu=array(
	array('label'=>'Create SparesUsedStatus', 'url'=>array('create')),
	array('label'=>'Manage SparesUsedStatus', 'url'=>array('admin')),
);
?>

<h1>Spares Used Statuses</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
