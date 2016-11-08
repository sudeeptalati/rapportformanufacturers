 
<?php include('uplifts_menu.php'); ?>   
 <?php
$this->menu=array( 
	array('label'=>'Manage Uplifts Request Type', 'url'=>array('admin')),
);
?>

<h4>Uplifts Request Type # <?php echo $model->name; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		//'id',
		'name',
		'info',
		array( 'name'=>'created', 'value'=>$model->created==null ? "":date("d-M-Y",$model->created)),
		
	),
)); ?>
