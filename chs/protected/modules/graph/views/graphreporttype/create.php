<?php
/* @var $this GraphReporttypeController */
/* @var $model GraphReporttype */

$this->breadcrumbs=array(
	'Graph Reporttypes'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List GraphReporttype', 'url'=>array('index')),
	array('label'=>'Manage GraphReporttype', 'url'=>array('admin')),
);
?>

<h1>Create GraphReporttype</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>