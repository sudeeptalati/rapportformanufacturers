<?php
/* @var $this GmServicecallsController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Gm Servicecalls',
);

$this->menu=array(
	array('label'=>'Create GmServicecalls', 'url'=>array('create')),
	array('label'=>'Manage GmServicecalls', 'url'=>array('admin')),
);
?>

<h1>Gm Servicecalls</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
