<?php
$this->breadcrumbs=array(
	'Enggdiaries'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Enggdiary', 'url'=>array('index')),
	array('label'=>'Manage Enggdiary', 'url'=>array('admin')),
);
?>

<h1>Add to Diary</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>