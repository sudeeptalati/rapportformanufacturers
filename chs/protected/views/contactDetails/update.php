<?php
$this->breadcrumbs=array(
	'Contact Details'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List ContactDetails', 'url'=>array('index')),
	array('label'=>'Create ContactDetails', 'url'=>array('create')),
	array('label'=>'View ContactDetails', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage ContactDetails', 'url'=>array('admin')),
);
?>

<h1>Update ContactDetails <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>