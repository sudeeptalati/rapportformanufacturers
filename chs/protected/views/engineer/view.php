
<div id="sidemenu">             
<?php include('setup_sidemenu.php'); ?>   
</div>


<h1>View Engineer : <?php echo $model->fullname; ?></h1>
<div id="submenu">   
<li><?php echo CHtml::link('Manage Engineers',array('admin')); ?></li>
<li><?php echo CHtml::link('Add New Engineers',array('create')); ?></li>
<li><?php echo CHtml::link('Engineers Display List',array('engglistdisplay')); ?></li>
</div>
<br>
<div style="text-align:right;" >
<b><?php echo CHtml::link('Edit',array('update', 'id'=>$model->id)); ?></b>
</div>
<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		//'id',
		'first_name',
		'last_name',
		//'active',
		array(
			'label'=>'active',
			'value'=>$model->active ? "Yes" : "No",
		),
		'company',
		'vat_reg_number',
		'notes',
		'contactDetails.telephone',
		'contactDetails.mobile',
		'contactDetails.email',
		'contactDetails.postcode',
		//'created',
		array( 'name'=>'created', 'value'=>$model->created==null ? "":date("d-M-Y",$model->created)),
		//'created_by_user_id',
		array( 'name'=>'created_by_user_id', 'value'=>$model->createdByUser->username),
		//'modified',
		array( 'name'=>'modified', 'value'=>$model->modified==null ? "":date("d-M-Y",$model->modified)),
		//'inactivated_by_user_id',
		array( 'name'=>'inactivated_by_user_id', 'value'=>$model->inactivated_by_user_id==null ? '':'inactivatedByUser.username'),
		//'inactivated_on',
		array( 'name'=>'inactivated_on', 'value'=>$model->inactivated_on==null ? "":date("d-M-Y",$model->inactivated_on)),


// 		'contact_details_id',
// 		'delivery_contact_details_id',
// 		//'created_by_user_id',
//		'createdByUser.username',

		
	),
)); ?>
