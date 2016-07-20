
<div id="sidemenu">             
<?php include('setup_sidemenu.php'); ?>   
</div>

 


<h1>View Contract :<?php echo $model->name; ?></h1>
<div id="submenu">   
<li><?php echo CHtml::link('Manage Contracts',array('admin')); ?></li>
<li><?php echo CHtml::link('Add New Contracts',array('create')); ?></li>
 </div>


<br>
<div style="text-align:right;" >
<b><?php echo CHtml::link('Edit',array('update', 'id'=>$model->id)); ?></b>
</div>
	

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		//'id',
		//'contract_type_id',
		'name',
		'contractType.name',

//		'main_contact_details_id',
		'management_contact_details',
		'spares_contact_details',
		//'accounts_contact_details',
		//'technical_contact_details',
		'vat_reg_number',
		'notes',
//		'active',
		//'inactivated_by_user_id',
		//'inactivated_on',
		//'created_by_user_id',
		'createdByUser.user.username',
		//'created',
		array( 'name'=>'created', 'value'=>$model->created==null ? "":date("d-M-Y",$model->created)),
		//'modified',
		array( 'name'=>'modified', 'value'=>$model->modified==null ? "":date("d-M-Y",$model->modified)),
		
	),
)); ?>
