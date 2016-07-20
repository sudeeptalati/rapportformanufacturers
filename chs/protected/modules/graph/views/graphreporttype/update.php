<?php
/* @var $this GraphReporttypeController */
/* @var $model GraphReporttype */

$this->breadcrumbs=array(
	'Graph Reporttypes'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List GraphReporttype', 'url'=>array('index')),
	array('label'=>'Create GraphReporttype', 'url'=>array('create')),
	array('label'=>'View GraphReporttype', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage GraphReporttype', 'url'=>array('admin')),
);
?>

<h1>Update GraphReporttype <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>