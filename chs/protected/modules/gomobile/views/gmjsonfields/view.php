
<?php include('gomobile_menu.php');  
 
 

$this->menu=array(
		array('label'=>'Create GmJsonFields', 'url'=>array('create')),
		array('label'=>'Manage GmJsonFields', 'url'=>array('admin')),
);
?>

<h1>View GmJsonFields #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'field_type',
		'field_relation',
		'field_label',
		'sort_order',
		'active',
		'created',
	),
)); ?>
