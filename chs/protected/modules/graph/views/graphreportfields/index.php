<?php
/* @var $this GraphReportfieldsController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Graph Reportfields',
);

$this->menu=array(
	array('label'=>'Create GraphReportfields', 'url'=>array('create')),
	array('label'=>'Manage GraphReportfields', 'url'=>array('admin')),
);
?>

<h1>Graph Reportfields</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
