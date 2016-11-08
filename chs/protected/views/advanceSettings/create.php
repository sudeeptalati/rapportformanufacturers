<?php
$this->breadcrumbs=array(
	'Advance Settings'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List AdvanceSettings', 'url'=>array('index')),
	array('label'=>'Manage AdvanceSettings', 'url'=>array('admin')),
);
?>

<h1>Create AdvanceSettings</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>