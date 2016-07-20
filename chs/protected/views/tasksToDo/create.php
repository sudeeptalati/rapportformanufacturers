<?php
$this->breadcrumbs=array(
	'Tasks To Dos'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List TasksToDo', 'url'=>array('index')),
	array('label'=>'Manage TasksToDo', 'url'=>array('admin')),
);
?>

<h1>Create TasksToDo</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>