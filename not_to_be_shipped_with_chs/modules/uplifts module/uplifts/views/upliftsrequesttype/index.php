<?php
$this->breadcrumbs=array(
	'Uplifts Types',
);

$this->menu=array(
	array('label'=>'Create UpliftsRequestType', 'url'=>array('create')),
	array('label'=>'Manage UpliftsRequestType', 'url'=>array('admin')),
);
?>

<h1>Uplifts Types</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
