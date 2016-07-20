<?php
/* @var $this EngineerDataController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Engineer Datas',
);

$this->menu=array(
	array('label'=>'Create EngineerData', 'url'=>array('create')),
	array('label'=>'Manage EngineerData', 'url'=>array('admin')),
);
?>

<h1>Engineer Datas</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>