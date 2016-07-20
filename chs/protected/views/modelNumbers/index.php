<?php
$this->breadcrumbs=array(
	'Model Numbers',
);

$this->menu=array(
	array('label'=>'Create ModelNumbers', 'url'=>array('create')),
	array('label'=>'Manage ModelNumbers', 'url'=>array('admin')),
);
?>

<h1>Model Numbers</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
