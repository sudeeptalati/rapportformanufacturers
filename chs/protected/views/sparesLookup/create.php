<?php
$this->breadcrumbs=array(
	'Spares Lookups'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List SparesLookup', 'url'=>array('index')),
	array('label'=>'Manage SparesLookup', 'url'=>array('admin')),
);
?>

<h1>Create SparesLookup</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>