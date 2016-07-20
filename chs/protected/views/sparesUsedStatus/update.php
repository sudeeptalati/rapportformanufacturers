<?php
$this->breadcrumbs=array(
	'Spares Used Statuses'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List SparesUsedStatus', 'url'=>array('index')),
	array('label'=>'Create SparesUsedStatus', 'url'=>array('create')),
	array('label'=>'View SparesUsedStatus', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage SparesUsedStatus', 'url'=>array('admin')),
);
?>

<h1>Update SparesUsedStatus <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>