<?php
/* @var $this GmServicecallsController */
/* @var $model GmServicecalls */

$this->breadcrumbs=array(
	'Gm Servicecalls'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List GmServicecalls', 'url'=>array('index')),
	array('label'=>'Manage GmServicecalls', 'url'=>array('admin')),
);
?>

<h1>Create GmServicecalls</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>