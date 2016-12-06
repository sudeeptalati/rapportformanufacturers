<?php
/* @var $this GmServicecallsController */
/* @var $model GmServicecalls */

$this->breadcrumbs=array(
	'Gm Servicecalls'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List GmServicecalls', 'url'=>array('index')),
	array('label'=>'Create GmServicecalls', 'url'=>array('create')),
	array('label'=>'View GmServicecalls', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage GmServicecalls', 'url'=>array('admin')),
);
?>

<h1>Update GmServicecalls <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>