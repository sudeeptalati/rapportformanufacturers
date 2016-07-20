<?php
/* @var $this EngineerDataController */
/* @var $model EngineerData */

$this->breadcrumbs=array(
	'Engineer Datas'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List EngineerData', 'url'=>array('index')),
	array('label'=>'Create EngineerData', 'url'=>array('create')),
	array('label'=>'View EngineerData', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage EngineerData', 'url'=>array('admin')),
);
?>

<h1>Update EngineerData <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>