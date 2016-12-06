<?php
$this->breadcrumbs=array(
	'Oows',
);

$this->menu=array(
	array('label'=>'Create Oow', 'url'=>array('create')),
	array('label'=>'Manage Oow', 'url'=>array('admin')),
);
?>

<h1>Oows</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
