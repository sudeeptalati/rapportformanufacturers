<div id="sidemenu">             
<?php include('setup_sidemenu.php'); ?>   
</div>

 

<h1>Manage Notifications</h1>
<div id="submenu">   
	<li> <?php echo CHtml::link('Manage Notification Rules',array('/notificationRules/admin')); ?></li>
	<li> <?php echo CHtml::link('Create Notification Rules',array('/notificationRules/create')); ?></li>
	<li> <?php echo CHtml::link('SMS Settings',array('/setup/smsSettingsView')); ?></li>
	<li> <?php echo CHtml::link('Email Settings',array('/setup/mailSettings')); ?></li>
</div>
 

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'notification-rules-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		//'id',
		//'job_status_id',
		//array('name'=>'status_changed','value'=>'$data->jobStatus->name'),
			array(
					'name'=>'job_status_id',
					'value'=>'JobStatus::item("JobStatus",$data->job_status_id)',
					'filter'=>JobStatus::items('JobStatus'),
			),
		//'active',
		array(
			'name'=>'active',
			'value'=>'($data->active == 0) ? "No" : "Yes"',
				'filter'=>array('1'=>'Yes', '0'=>'No'),
		),
		//'customer_notification_code',
		array('name'=>'customer_notification','value'=>'$data->customerNotificationCode->notify_by', 'filter'=>false),
		//'engineer_notification_code',
		array('name'=>'engineer_notification','value'=>'$data->engineerNotificationCode->notify_by', 'filter'=>false),
		//'warranty_provider_notification_code',
		array('name'=>'warranty_provider_notification','value'=>'$data->warrantyProviderNotificationCode->notify_by', 'filter'=>false),
		//'notify_others',
		array(
			'name'=>'notify_others',
			'value'=>'($data->notify_others == 0) ? "No" : "Yes"',
			'filter'=>array('1'=>'Yes', '0'=>'No'),
		),
		array(            
            //'name'=>'custom_column',
            //call the method 'publishedMessageInGrid' from the controller
            'value'=>array($this,'publishedMessageInGrid'), 
        ),
		/*
		'created',
		'modified',
		'delete',
		*/
		array(
			'class'=>'CButtonColumn',
			'template'=>'{view}{update}',
		),
	),
)); ?>

