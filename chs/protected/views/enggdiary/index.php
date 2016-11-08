<?php
$this->breadcrumbs=array(
	'Enggdiaries',
);

$this->menu=array(
	//array('label'=>'Create Enggdiary', 'url'=>array('create')),
	array('label'=>'Manage Enggdiary', 'url'=>array('admin')),
);
?>

<h1>Enggdiaries</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
