<?php

//$this->breadcrumbs=array(
//	'Ftp Settings'=>array('index'),
//	$model->id=>array('view','id'=>$model->id),
//	'Update',
//);
//
//$this->menu=array(
//	array('label'=>'List FtpSettings', 'url'=>array('index')),
//	array('label'=>'Create FtpSettings', 'url'=>array('create')),
//	array('label'=>'View FtpSettings', 'url'=>array('view', 'id'=>$model->id)),
//	array('label'=>'Manage FtpSettings', 'url'=>array('admin')),
//);

include 'setup_sidemenu.php';


?>

<h1>FTP Settings</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>