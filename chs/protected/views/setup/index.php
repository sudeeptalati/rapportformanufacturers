<?php
$this->breadcrumbs=array(
	'Setups',
);

$this->menu=array(
	//array('label'=>'Create Setup', 'url'=>array('create')),
	array('label'=>'Manage Setup', 'url'=>array('admin')),
);
?>

<h1>Setups</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>

