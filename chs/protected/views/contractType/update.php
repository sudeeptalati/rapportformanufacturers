<?php
$this->breadcrumbs=array(
	'Contract Types'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List ContractType', 'url'=>array('index')),
	array('label'=>'Create ContractType', 'url'=>array('create')),
	array('label'=>'View ContractType', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage ContractType', 'url'=>array('admin')),
);
?>

<h1>Update ContractType <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>