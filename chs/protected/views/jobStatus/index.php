<?php
$this->breadcrumbs=array(
	'Job Statuses',
);

$this->menu=array(
	array('label'=>'Create JobStatus', 'url'=>array('create')),
	array('label'=>'Manage JobStatus', 'url'=>array('admin')),
);
?>

<h1>Job Statuses</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
