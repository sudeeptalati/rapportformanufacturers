<?php include('graph_menu.php'); ?>   
 
 
 <?php
$this->menu=array(
	array('label'=>'Manage CSV Report Fields', 'url'=>array('admin')),
	array('label'=>'Create CSV Report Fields', 'url'=>array('create')),
);
?>

 

<h1><font color="#0094EF"> Manage Reports Fields</font> </h1> 


<p>In this section you add more fields to your CSV report. You can also change the order you want your fields by changing the value of sort order<p>
<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'graph-reportfields-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		//'id',
		//'report_type',
		'field_label',
		//'field_name',
		'field_type',
		'field_relation',
		'sort_order',
		
		array(  'name'=>'active',
				'header'=>'Active',
				'value'=>'($data->active == 0)?"No":"Yes"',
				'filter'=>array('1'=>'Yes', '0'=>'No'),
		),
		
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
