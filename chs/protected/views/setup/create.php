<?php
$this->breadcrumbs=array(
	'Setups'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Setup', 'url'=>array('index')),
	array('label'=>'Manage Setup', 'url'=>array('admin')),
);
?>

<h1>Create Setup</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>