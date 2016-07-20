<?php
$this->breadcrumbs=array(
	'Ftp Settings',
);

$this->menu=array(
	array('label'=>'Create FtpSettings', 'url'=>array('create')),
	array('label'=>'Manage FtpSettings', 'url'=>array('admin')),
);
?>

<h1>Ftp Settings</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
