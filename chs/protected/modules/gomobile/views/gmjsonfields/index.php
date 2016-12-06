<?php
/* @var $this GmJsonFieldsController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Gm Json Fields',
);

$this->menu=array(
	array('label'=>'Create GmJsonFields', 'url'=>array('create')),
	array('label'=>'Manage GmJsonFields', 'url'=>array('admin')),
);
?>

<h1>Gm Json Fields</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
