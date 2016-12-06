<?php
//$this->breadcrumbs=array(
//	'Spares Lookups'=>array('index'),
//	$model->id=>array('view','id'=>$model->id),
//	'Update',
//);

//$this->menu=array(
//	array('label'=>'List SparesLookup', 'url'=>array('index')),
//	array('label'=>'Create SparesLookup', 'url'=>array('create')),
//	array('label'=>'View SparesLookup', 'url'=>array('view', 'id'=>$model->id)),
//	array('label'=>'Manage SparesLookup', 'url'=>array('admin')),
//);

include 'setup_sidemenu.php';

?>


<h1>FTP Settings</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>