
<?php
$this->menu=array( 
	array('label'=>'Create New Uplifts Series', 'url'=>array('create')),
);
?>

<?php include('uplifts_menu.php'); ?>

<h4>Manage Uplifts Series</h4>

 
<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'uplifts-config-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		//'id',
		'prefix',
		'start_from',
		'available_code',
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
