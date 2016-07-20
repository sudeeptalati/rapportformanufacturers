<?php
$this->breadcrumbs=array(
	'Uplifts',
);

$this->menu=array(
	array('label'=>'Create Uplifts', 'url'=>array('create')),
	array('label'=>'Manage Uplifts', 'url'=>array('admin')),
);
?>

<h1>Uplifts</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
