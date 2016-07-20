<?php include('graph_menu.php'); ?>   
 
 
<?php
$this->menu=array(
	array('label'=>'List GraphReportfields', 'url'=>array('admin')),
	array('label'=>'Create GraphReportfields', 'url'=>array('create')),
);
?>

<h1> Report Fields #<?php echo $model->field_name; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		//'id',
		//'report_type',
		//'field_name',
		'field_type',
		'field_relation',
		'field_label',
		'sort_order',
		'active',
	),
)); ?>
