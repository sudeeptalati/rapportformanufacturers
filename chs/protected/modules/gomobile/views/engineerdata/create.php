<?php
/* @var $this EngineerDataController */
/* @var $model EngineerData */

$this->breadcrumbs=array(
	'Engineer Datas'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List EngineerData', 'url'=>array('index')),
	array('label'=>'Manage EngineerData', 'url'=>array('admin')),
);
?>

<h1>Create EngineerData</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>