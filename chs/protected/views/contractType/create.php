<?php
$this->breadcrumbs=array(
	'Contract Types'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List ContractType', 'url'=>array('index')),
	array('label'=>'Manage ContractType', 'url'=>array('admin')),
);
?>

<h1>Create ContractType</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>