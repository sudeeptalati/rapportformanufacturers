<?php

$this->breadcrumbs=array(
	'Contract Types'=>array('index'),
	$model->name,
	
);

$this->menu=array(
	array('label'=>'List ContractType', 'url'=>array('index')),
	array('label'=>'Create ContractType', 'url'=>array('create')),
	array('label'=>'Update ContractType', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete ContractType', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage ContractType', 'url'=>array('admin')),
);
?>

<h1>View ContractType #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	
	'attributes'=>array(
		'id',
		'name',
		'information',
		//'created_by_user_id',
		//'createdByUser.username',
		array( 'name'=>'created_by_user_id', 'value'=>$model->createdByUser->username, 'filter'=>false),
		'created',
	),
)); ?>
