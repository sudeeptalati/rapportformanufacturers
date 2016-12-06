<?php
/* @var $this EngineerDataController */
/* @var $model EngineerData */

$this->breadcrumbs=array(
	'Engineer Datas'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List EngineerData', 'url'=>array('index')),
	array('label'=>'Create EngineerData', 'url'=>array('create')),
	array('label'=>'Update EngineerData', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete EngineerData', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage EngineerData', 'url'=>array('admin')),
);
?>

<h1>View EngineerData #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'engineer_id',
		'data',
	),
)); ?>
