
<div id="sidemenu">             
<?php include('setup_sidemenu.php'); ?>   
</div>

<h1>Contracts</h1>
<div id="submenu">   
<li><?php echo CHtml::link('Manage Contracts',array('admin')); ?></li>
<li><?php echo CHtml::link('Add New Contracts',array('create')); ?></li>
</div>


 

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'contract-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
	//	'id',
		//'contract_type_id',
		array('name'=>'name'),
		//array('header'=>'Contract Type','name'=>'contract_name','value'=>'$data->contractType->name'),
		array(
				'name'=>'contract_type_id',
				'value'=>'ContractType::item("ContractType",$data->contract_type_id)',
				'filter'=>ContractType::items('ContractType'),
		),

		array('name'=>'created_by_user','value'=>'$data->createdByUser->username', 'filter'=>false),
		//'active',
		array(  'name'=>'active',
				'header'=>'Active',
				'value'=>'($data->active == 0)?"No":"Yes"',
				'filter'=>array('1'=>'Yes', '0'=>'No'),
			),
		
		
		
// 		'main_contact_details_id',
// 		'management_contact_details',
// 		'spares_contact_details',
		/*
		'accounts_contact_details',
		'technical_contact_details',
		'vat_reg_number',
		'notes',
		'active',
		'inactivated_by_user_id',
		'inactivated_on',
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
 
