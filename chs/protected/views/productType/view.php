<div id="sidemenu">             
<?php include('setup_sidemenu.php'); ?>   
</div>

 

<h1>View Product Type :<?php echo $model->name; ?></h1>

<div id="submenu">   
<li><?php echo CHtml::link('Manage Product Types',array('admin')); ?></li>
<li><?php echo CHtml::link(' New Product Types',array('create')); ?></li>
</div>
<br>


<div style="text-align:right;" >
<?php echo CHtml::link('Edit',array('update', 'id'=>$model->id)); ?>
</div>
<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		//'id',
		'name',
		'information',
		//'created_by_user_id',
		array(
			'label'=>'active',
			'value'=>$model->active ? "Yes" : "No",
		),
		//'createdByUser.username',
		array( 'name'=>'created_by_user_id', 'value'=>$model->created_by_user_id==null ? "":$model->createdByUser->username),
		//'created',
		array( 'name'=>'created', 'value'=>$model->created==null ? "":date("d-M-Y",$model->created)),
		//'modified',
		array( 'name'=>'modified', 'value'=>$model->modified==null ? "":date("d-M-Y",$model->modified)),
		//'inactivated',
		array( 'name'=>'inactivated', 'value'=>$model->inactivated==null ? "":date("d-M-Y",$model->inactivated)),
		//'server_product_type_id',
	),
)); ?>
