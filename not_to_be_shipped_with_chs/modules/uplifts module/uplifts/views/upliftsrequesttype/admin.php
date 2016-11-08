            
<?php include('uplifts_menu.php'); ?>   
 <?php
$this->menu=array( 
	array('label'=>'Create New Uplifts Request Type', 'url'=>array('create')),
);
?>
<h4>Manage Uplifts Types</h4>

 

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'uplifts-type-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'name',
		'info',
		'created',
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
