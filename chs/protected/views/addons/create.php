<?php
$this->breadcrumbs=array(
	'Addons'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Addons', 'url'=>array('index')),
	array('label'=>'Manage Addons', 'url'=>array('admin')),
);
?>

<h1>Create Addons</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>