<div id="sidemenu">             
<?php include('setup_sidemenu.php'); ?>   
</div>
<h1>View Notification Rule:  <?php echo $model->jobStatus->name; ?></h1>

<div id="submenu">   
	<li> <?php echo CHtml::link('Manage Notification Rules',array('/notificationRules/admin')); ?></li>
	<li> <?php echo CHtml::link('Create Notification Rules',array('/notificationRules/create')); ?></li>
	<li> <?php echo CHtml::link('SMS Settings',array('/setup/smsSettingsView')); ?></li>
	<li> <?php echo CHtml::link('Email Settings',array('/setup/mailSettings')); ?></li>
</div>
<br>


<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'notification-rules-viewRules-form',
	'enableAjaxValidation'=>false,
)); ?>

	
	<?php echo $form->errorSummary($model); ?>
	
	
<table style="width:100%;  background-color: #D0E9F1; border-radius: 15px; padding:10px; vertical-align: top;">
<tr>
	<td colspan="3"><div style="text-align:right;" ><b>
<?php echo CHtml::link('Edit',array('update', 'id'=>$model->id)); ?></b>
</div>
</td>
</tr>


<tr>
	<td colspan='3'>
		When job status is changed to <?php echo CHtml::textField('', $model->jobStatus->name, array('disabled'=>'disabled'));?>			
	</td>
 </tr>

 
 
 
 <tr>
	<td><b>Send Notification to</b></td>
</tr>

<tr>
			<td>
				<?php echo $form->labelEx($model,'customer_notification_code'); ?>
				<?php 
					$customer_email_checked = NotificationRules::model()->getEmailCheckBoxStatus($model->customer_notification_code);
					$customer_sms_checked = NotificationRules::model()->getSMSCheckBoxStatus($model->customer_notification_code);
				?>
				
				by <small><b>Email</b></small>&nbsp;<?php echo CHtml::checkBox('customer_email_notification', $customer_email_checked, array('uncheckValue' => 0, 'disabled'=>'disabled'));?> 
				&nbsp;&nbsp;<small><b>SMS</b></small>&nbsp;<?php echo CHtml::checkBox('customer_sms_notification', $customer_sms_checked, array('uncheckValue' => 0, 'disabled'=>'disabled'));?> 
				
				<?php echo $form->error($model,'customer_notification_code'); ?>
			</td>
			<td>
				<?php echo $form->labelEx($model,'engineer_notification_code'); ?>
				<?php 
					$engineer_email_checked = NotificationRules::model()->getEmailCheckBoxStatus($model->engineer_notification_code);
					$engineer_sms_checked = NotificationRules::model()->getSMSCheckBoxStatus($model->engineer_notification_code);
				?>
						
				by <small><b>Email</b></small>&nbsp;<?php echo CHtml::checkBox('engineer_email_notification', $engineer_email_checked, array('uncheckValue' => 0, 'disabled'=>'disabled'));?> 
				&nbsp;&nbsp;<small><b>SMS</b></small>&nbsp;<?php echo CHtml::checkBox('engineer_email_notification', $engineer_sms_checked, array('uncheckValue' => 0, 'disabled'=>'disabled'));?> 
				
				<?php echo $form->error($model,'engineer_notification_code'); ?>
			</td>
			<td>
				<?php echo $form->labelEx($model,'warranty_provider_notification_code'); ?>
				
				<?php 
					$warranty_provider_email_checked = NotificationRules::model()->getEmailCheckBoxStatus($model->warranty_provider_notification_code);
					$warranty_provider_sms_checked = NotificationRules::model()->getSMSCheckBoxStatus($model->warranty_provider_notification_code);
				?>
								
				by <small><b>Email</b></small>&nbsp;<?php echo CHtml::checkBox('warranty_provider_email_notification', $warranty_provider_email_checked, array('uncheckValue' => 0, 'disabled'=>'disabled'));?> 
				&nbsp;&nbsp;<small><b>SMS</b></small>&nbsp;<?php echo CHtml::checkBox('warranty_provider_email_notification', $warranty_provider_sms_checked, array('uncheckValue' => 0, 'disabled'=>'disabled'));?> 
						
				<?php echo $form->error($model,'warranty_provider_notification_code'); ?>
			</td>
		</tr>
		 
		<tr>
			<td colspan="3">
			
							<?php 
		
				$contactModel = NotificationContact::model()->findAllByAttributes(array(
						'notification_rule_id'=>$model->id
				));
				
				
				?>
				<?php echo $form->labelEx($model,'notify_others'); ?>
				
				<?php 
				if($model->notify_others == 0)
				{
					//echo "NONE";
					?>
					<span style="color:maroon"><b>None</b></span>
					<?php 
				}
				else 
				{
					//echo "NOTIFY";
					?>
					<table>
						<tr>
							<th style="color:maroon">Person Name</th>
							<th style="color:maroon">Person Info</th>
							<th style="color:maroon">Email</th>
							<th style="color:maroon">Mobile</th>
							<th style="color:maroon">Notify By</th>
						</tr>
						<?php 
						foreach ($contactModel as $data)
						{
							?>
								 	
							<tr>
								<td><?php echo $data->person_name;?></td>
								<td><?php echo $data->person_info;?></td>
								<td><?php echo $data->email;?></td>
								<td><?php echo $data->mobile;?></td>
								<td><?php 
									switch ($data->notification_code_id)
									{
										case 0:echo "None";
										break;

										case 1:echo "Email";
										break;
													
										case 2:echo "SMS";
										break;
													
										case 3:echo "Email and SMS";
										break;
									}//end of switch.
									?>
								</td>
							</tr>
							<?php }//end of foreach().?>
						</table>
						<?php 
				}//end of else.
				?>
			
			
			
			</td>
		</tr>
	<tr>
		<td><?php echo $form->labelEx($model,'active'); ?>
		<?php echo $form->dropDownList($model, 'active', array('1'=>'Yes','0'=>'No'), array('disabled'=>'disabled')); ?></td>
			<td>
				<?php echo $form->labelEx($model,'created'); ?>
				<?php echo CHtml::textField('', date('d-M-Y', $model->created), array('disabled'=>'disabled')); ?>
				<?php echo $form->error($model,'created'); ?>
			</td>
			<td>
				<?php echo $form->labelEx($model,'modified'); ?>
				<?php 
					if($model->modified != '')
						$modified_time = date('d-M-Y', $model->modified);
					else 
						$modified_time = '';
					echo CHtml::textField('', $modified_time, array('disabled'=>'disabled')); 
				?>
				<?php echo $form->error($model,'modified'); ?>
			</td>
		
</tr>

</table>
	
	
	 
	

<?php $this->endWidget(); ?>

</div><!-- form -->