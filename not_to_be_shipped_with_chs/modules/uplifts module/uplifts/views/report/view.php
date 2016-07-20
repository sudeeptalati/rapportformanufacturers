<?php include('uplifts_menu.php'); ?>   

 <?php
$this->menu=array( 
	array('label'=>'Manage Reports Fields', 'url'=>array('admin')),
);
?>
<h4>Report Field #  <?php echo $model->field_label; ?></h4>


<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		//'id',
		//'report_type',
		'sort_order',
		'field_label',
		'field_relation',
		array(
      		'name'=>'active',
      		'value'=>$model->active ? "Active" : "Inactive",
    		'type'=>'text',
    	),
	),
)); ?>
