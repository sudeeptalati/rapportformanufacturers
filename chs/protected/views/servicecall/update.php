<?php
$this->breadcrumbs=array(
	'Servicecalls'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Servicecall', 'url'=>array('index')),
	array('label'=>'Create Servicecall', 'url'=>array('create')),
	array('label'=>'View Servicecall', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Servicecall', 'url'=>array('admin')),
);
?>

<!--<h1>Update Servicecall <?php echo $model->id; ?></h1>

--><?php echo $this->renderPartial('_form', array('model'=>$model)); ?>