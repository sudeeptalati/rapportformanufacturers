<?php
$this->breadcrumbs=array(
	'Spares Useds'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List SparesUsed', 'url'=>array('index')),
	array('label'=>'Create SparesUsed', 'url'=>array('create')),
	array('label'=>'View SparesUsed', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage SparesUsed', 'url'=>array('admin')),
);
?>

<h1>Update SparesUsed <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>