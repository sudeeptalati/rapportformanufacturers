<div id="sidemenu">             
<?php include('setup_sidemenu.php'); ?>   
</div>
<h1>View Brand #<?php echo $model->name; ?></h1>
 

<div id="submenu">   
<li><?php echo CHtml::link('Manage Brands',array('admin')); ?></li>
<li><?php echo CHtml::link('Add New Brand',array('create')); ?></li>
</div>



<div style="text-align:right;" >
<?php echo CHtml::link('Edit',array('update', 'id'=>$model->id)); ?>
</div>
<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
//		'id',
		'name',
		'information',
		//'active',
		array(  'name'=>'active',
				'header'=>'Active',
				'value'=>$model->active == 0?"No":"Yes",
		),
		
		
		'created_by_user_id',
		
		
		array( 'name'=>'created_by_user_id', 'value'=>$model->createdByUser->username),
		
		//'createdByUser.name',
		array( 'name'=>'created', 'value'=>$model->created==null ? "":date("d-M-Y",$model->created)),
		//'modified',
		array( 'name'=>'modified', 'value'=>$model->modified==null ? "":date("d-M-Y",$model->modified)),
		//'inactivated'
		array( 'name'=>'inactivated', 'value'=>$model->inactivated==null ? "":date("d-M-Y",$model->inactivated)),
		
	
	),
)); 

?>
