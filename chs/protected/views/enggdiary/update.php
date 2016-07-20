<?php
$this->breadcrumbs=array(
	'Enggdiaries'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Enggdiary', 'url'=>array('index')),
	//array('label'=>'Create Enggdiary', 'url'=>array('create')),
	array('label'=>'View Enggdiary', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Enggdiary', 'url'=>array('admin')),
);
?>

<h1>Update Enggdiary <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>