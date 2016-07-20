<?php
$this->breadcrumbs=array(
	'Preferences'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Preferences', 'url'=>array('index')),
	array('label'=>'Manage Preferences', 'url'=>array('admin')),
);
?>

<h1>Create Preferences</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>