<?php
$this->breadcrumbs=array(
	'Tasks To Dos'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List TasksToDo', 'url'=>array('index')),
	array('label'=>'Create TasksToDo', 'url'=>array('create')),
	array('label'=>'View TasksToDo', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage TasksToDo', 'url'=>array('admin')),
);
?>

<h1>Update TasksToDo <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>