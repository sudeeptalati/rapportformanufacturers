<?php
$this->breadcrumbs=array(
	'Ftp Settings'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List FtpSettings', 'url'=>array('index')),
	array('label'=>'Manage FtpSettings', 'url'=>array('admin')),
);
?>

<h1>Create FtpSettings</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>