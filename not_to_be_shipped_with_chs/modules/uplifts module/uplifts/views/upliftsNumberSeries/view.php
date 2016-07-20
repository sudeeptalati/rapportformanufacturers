  
<?php
$this->menu=array( 
	array('label'=>'Manage Uplifts Series', 'url'=>array('admin')),
);
?>

<?php include('uplifts_menu.php'); ?>



<h4>Uplifts Series #  <?php echo $model->prefix; ?></h4>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		//'id',
		'prefix',
		'start_from',
		'available_code',
	),
)); ?>
