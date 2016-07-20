<?php
$this->breadcrumbs=array(
	'Oows'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Oow', 'url'=>array('index')),
	array('label'=>'Create Oow', 'url'=>array('create')),
	array('label'=>'View Oow', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Oow', 'url'=>array('admin')),
);
?>

<h1>Update Oow <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>