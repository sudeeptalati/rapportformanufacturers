<?php
/* @var $this GraphReporttypeController */
/* @var $model GraphReporttype */

$this->breadcrumbs=array(
	'Graph Reporttypes'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List GraphReporttype', 'url'=>array('index')),
	array('label'=>'Create GraphReporttype', 'url'=>array('create')),
	array('label'=>'Update GraphReporttype', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete GraphReporttype', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage GraphReporttype', 'url'=>array('admin')),
);
?>

<h1>View GraphReporttype #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'report_type',
		'model',
		'active',
	),
)); ?>
