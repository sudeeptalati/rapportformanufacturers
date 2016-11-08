<?php
$this->breadcrumbs=array(
	'Spares Used Statuses'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List SparesUsedStatus', 'url'=>array('index')),
	array('label'=>'Manage SparesUsedStatus', 'url'=>array('admin')),
);
?>

<h1>Create SparesUsedStatus</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>