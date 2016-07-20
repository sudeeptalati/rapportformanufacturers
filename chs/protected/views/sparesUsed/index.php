<?php
$this->breadcrumbs=array(
	'Spares Useds',
);

$this->menu=array(
	array('label'=>'Create SparesUsed', 'url'=>array('create')),
	array('label'=>'Manage SparesUsed', 'url'=>array('admin')),
);
?>

<h1>Spares Useds</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
