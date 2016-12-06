<?php
$this->breadcrumbs=array(
	'Spares Lookups',
);

$this->menu=array(
	array('label'=>'Create SparesLookup', 'url'=>array('create')),
	array('label'=>'Manage SparesLookup', 'url'=>array('admin')),
);
?>

<h1>Spares Lookups</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
