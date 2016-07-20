<?php
$this->breadcrumbs=array(
	'Tasks To Dos',
);

$this->menu=array(
	array('label'=>'Create TasksToDo', 'url'=>array('create')),
	array('label'=>'Manage TasksToDo', 'url'=>array('admin')),
);
?>

<h1>Tasks To Dos</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
