<?php
$this->breadcrumbs=array(
	'Contact Details'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List ContactDetails', 'url'=>array('index')),
	array('label'=>'Manage ContactDetails', 'url'=>array('admin')),
);
?>

<h1>Create ContactDetails</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
