<?php
$this->breadcrumbs=array(
	'Servicecalls',
);

$this->menu=array(
	array('label'=>'Create Servicecall', 'url'=>array('create')),
	array('label'=>'Manage Servicecall', 'url'=>array('admin')),
);
?>

<h1>Servicecalls</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
