
<div id="sidemenu">             
<?php include('setup_sidemenu.php'); ?>   
</div>

 

<h1>Manage Engineers</h1>

<div id="submenu">   
<li><?php echo CHtml::link('Manage Engineers',array('admin')); ?></li>
<li><?php echo CHtml::link('Add New Engineers',array('create')); ?></li>
<li><?php echo CHtml::link('Engineers Display List',array('engglistdisplay')); ?></li>
</div>



<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'engineer-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		array('name'=>'id','filter'=>false),
		'first_name',
		'last_name',
		//'active',
/*			array(
					'label'=>'active',
					'value'=>$model->active ? "Active" : "Inactive",
			),
	*/		
		'company',
	//'active',
		array(  'name'=>'active',
				'header'=>'Active',
				'value'=>'($data->active == 0)?"No":"Yes"',
				'filter'=>array('1'=>'Yes', '0'=>'No'),
			),
	
		array(	'header' => 'Email',
            	'name'=>'engineer_email',
				'value'=>'$data->contactDetails->email',
				),
			
		//array('name'=>'vat_reg_number', 'filter'=>false),
		//'created_by_user_id',
		array(
			  'name'=>'user',
			  'value'=>'$data->createdByUser->username',
				'filter'=>false
				),
		/*
		'notes',
		'inactivated_by_user_id',
		'inactivated_on',
		'contact_details_id',
		'delivery_contact_details_id',
		'created_by_user_id',
		'created',
		'modified',
		*/
		array(
			'class'=>'CButtonColumn',
			'template'=>'{view}{update}',
		),
	),
)); ?>
