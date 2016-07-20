<?php
$this->breadcrumbs=array(
	'Retailers And Distributors',
);

$this->menu=array(
	array('label'=>'Create RetailersAndDistributors', 'url'=>array('create')),
	array('label'=>'Manage RetailersAndDistributors', 'url'=>array('admin')),
);
?>

<h1>Retailers And Distributors</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
