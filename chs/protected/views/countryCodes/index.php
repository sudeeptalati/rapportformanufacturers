<?php
$this->breadcrumbs=array(
	'Country Codes',
);

$this->menu=array(
	array('label'=>'Create CountryCodes', 'url'=>array('create')),
	array('label'=>'Manage CountryCodes', 'url'=>array('admin')),
);
?>

<h1>Country Codes</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
