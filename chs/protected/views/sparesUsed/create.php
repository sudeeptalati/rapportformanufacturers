<?php
$this->breadcrumbs=array(
	'Spares Useds'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List SparesUsed', 'url'=>array('index')),
	array('label'=>'Manage SparesUsed', 'url'=>array('admin')),
);
?>

<h1>Create SparesUsed</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>