<?php
$this->breadcrumbs=array(
	'Contract Types',
);

$this->menu=array(
	array('label'=>'Create ContractType', 'url'=>array('create')),
	array('label'=>'Manage ContractType', 'url'=>array('admin')),
);
?>

<h1>Contract Types</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
