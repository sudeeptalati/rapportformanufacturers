<?php include('uplifts_menu.php'); ?>   

<h4>Manage Uplifts Reports Fields</h4>

 <?php
$this->menu=array( 
	array('label'=>'Create Uplifts Reports Fields', 'url'=>array('create')),
);
?>


<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'uplifts-report-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		//'id',
		//'report_type',
		'sort_order',
		'field_label',
		'field_relation',
		array(
      		'name'=>'active',
      		'value'=>'$data->active ? "Active" : "Inactive"',
    		'type'=>'text',
			'filter'=>array('1'=>'Active','0'=>'Inactive'),
    	),
	 
	 	 array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
