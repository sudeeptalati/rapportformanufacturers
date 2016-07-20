
<div id="sidemenu">             
<?php include('setup_sidemenu.php'); ?>   
</div>

<h1>Job Status : Manage</h1>
<div id="submenu">   
<li><?php echo CHtml::link('Change Dashboard Priority Order', array('JobStatus/dashboardorder'));?></li>
<li><?php echo CHtml::link('Manage JobStatus', array('JobStatus/admin'));?></li>
<li><?php echo CHtml::link('Change Drop Down View Order', array('JobStatus/dropdownorder'));?></li>
</div><!-- END OF DIV SUBMENU -->

 
<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		//'id',
		'name',
		'information',
	 
 		array(
      		'label'=>'Published',
      		'value'=>$model->published ? "Yes" : "No",
    	),	
		'view_order',
		
		//'updatedByUser.name',
    	
		 array(  'name'=>'updated_by_user_id',
				 'value'=>$model->updated_by_user_id==null ? "":$model->updatedByUser->username),
    	
    	
    	array(  'name'=>'updated',
					'value'=>(date('d-M-Y H:i',$model->updated)),
			),
	),
)); ?>
