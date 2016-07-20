<?php
/* @var $this GmJsonFieldsController */
/* @var $model GmJsonFields */

$this->breadcrumbs=array(
	'Gm Json Fields'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List GmJsonFields', 'url'=>array('index')),
	array('label'=>'Create GmJsonFields', 'url'=>array('create')),
	array('label'=>'View GmJsonFields', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage GmJsonFields', 'url'=>array('admin')),
);
?>

<h1>Update GmJsonFields <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>