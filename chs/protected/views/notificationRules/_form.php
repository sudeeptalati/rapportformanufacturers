
<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'notification-rules-form',
	'enableAjaxValidation'=>false,
)); 

if (isset($_GET['showDialogue']))
{
$showDialogue = $_GET['showDialogue'];
//echo "!!!!!!!!!!!!!!!!!!!!!! Show valoue = ".$showDialogue;

if ($showDialogue==1)
{
	/***** CODE TO GET DIALOGUE BOX OF FORM TO ENTER PERSON DETAILS ****/
	$this->beginWidget('zii.widgets.jui.CJuiDialog', array(
		'id'=>'formdialog',
		// additional javascript options for the dialog plugin
		'options'=>array(
		'title'=>'Person Details',
		'autoOpen'=>$showDialogue,
		'modal'=>'true',
		'show' => 'blind',
		'hide' => 'explode',
		),
	));
			
?>

	<div class="divForForm"></div>
						
	<?php $this->endWidget('zii.widgets.jui.CJuiDialog'); ?>

<script type="text/javascript">

	function addContact()
	{
		//alert('IN ADD CONTACT FUNC'+<?php echo $model->id;?> );
		
		<?php 
				
		echo CHtml::ajax(array(
	   'url'=>array('notificationContact/create', 'id'=>$model->id),
	   'data'=> "js:$(this).serialize()",
	   'type'=>'post',
	   'dataType'=>'json',
	   'success'=>"function(data)
	   {
			if (data.status == 'failure')
		   {
			$('#formdialog div.divForForm').html(data.div);
		   // Here is the trick: on submit-> once again this function!
		   $('#dialogClassroom div.divForForm form').submit(addContact);
		   }
	   else
	   {
			$('#formdialog div.divForForm').html(data.div);
		   setTimeout(\"$('#formdialog').dialog('close') \",3000);
	   }

	   } ",
	   ))
	  ?>;
	  return false;
	}//end of function addContact().

	 function openAddPersonDialogueHandler()
	 {
		 addContact();
		$('#formdialog').dialog('open');
	 }

	window.onload = openAddPersonDialogueHandler;
	//myElement.onclick= openAddPersonDialogueHandler;
	 
 
</script>
<?php
}/////end of if showDialogue
}////end of iff isset
else 
	$showDialogue = 0;
?>



<script type="text/javascript">
/**** CODE TO DISPLAY EMAIL AND SMS ON CHECK OF CHECKBOX, FOR ALL CHECKBOXES ******/

$(function() {//code inside this function will run when the document is ready
    if($('#customer-checkbox-id').is(':checked'))
    {
        $('.customer-form').show();
    }
    if($('#engineer-checkbox-id').is(':checked'))
    {
        $('.engineer-form').show();
    }
    if($('#warranty-provider-checkbox-id').is(':checked'))
    {
        $('.warranty-provider-form').show();
    }

});
/**** END OF CODE TO DISPLAY EMAIL AND SMS ON CHECK OF CHECKBOX, FOR ALL CHECKBOXES ******/
 
</script>

	
<?php 
if($model->notify_others == 1)
{
	?>
	<script type="text/javascript">
	$(function()
	{//code inside this function will run when the document is ready
	   $('.others-form').show();
	});
	</script>
<?php }//end of of($model->notify_others == 1).?>



<?php
 $jobstatuslist = JobStatus::model()->getAllStatuses();//listdata for dropdown
?>


<table style="width:100%;  background-color: #D0E9F1; border-radius: 15px; padding:10px; vertical-align: top;">
<tr>
	<td colspan='3'>
		When job status is changed to 
		<?php 
			echo $form->dropDownList($model, 'job_status_id', $jobstatuslist ,
				 array(
						'prompt' => 'Please Select job status (required)',
						'value' => '0',
						'ajax'  => array(
								'type'  => 'POST',
								'url' => CController::createUrl('NotificationRules/notificationPresent/'),
								'data' => array("job_id" => "js:this.value"),
								'success'=> 'function(data) {
										if(data != "NULL")
										{
											alert(data);
											$("#form_save_button").attr("disabled", true);
										}
										else
										{
											$("#form_save_button").attr("disabled", false);
										}
									}',
								'error'=> 'function(){alert("AJAX call error..!!!!!!!!!!");}',
						)//end of ajax array().
			)//end of array
		);//end of dropDownList.

// echo $form->dropDownList($model, 'job_status_id', $jobstatuslist ,
// 		array('empty'=>'Please Select job status (required)', 'onchange'=>'js:validate_dropdown(this.value)')
// );
		?>
	</td>
 
</tr>

<tr>
	<td><b>Send Notification to</b></td>
</tr>

<tr>
	<td>
	
		<?php 
			//EVENT LISTENER FOR CUSTOMER FIELD.
			Yii::app()->clientScript->registerScript('my-customer-listener',"
			$('#customer-checkbox-id').click(function() {
			    $('.customer-form')[this.checked ? 'show' : 'hide']();
			});
			");
			
		?>
		
		Customer&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		<?php 
				$customer_checked;
				
				$customer_email_checked=NotificationRules::model()->getEmailCheckBoxStatus($model->customer_notification_code);
				$customer_sms_checked=NotificationRules::model()->getSMSCheckBoxStatus($model->customer_notification_code);
				
				if ($customer_email_checked || $customer_sms_checked)
					$customer_checked=true;
				else 
					$customer_checked=false;
		?>
		
		<?php echo $form->checkbox($model, 'customer_notification_code', array('checked'=>$customer_checked,'id'=>'customer-checkbox-id')); ?>		
		
		<div class="customer-form" style="display:none">
		by 
		<small><b>Email</b></small>&nbsp;<?php echo CHtml::checkBox('customer_email_notification', $customer_email_checked, array('uncheckValue' => 0)); ?>
		&nbsp;&nbsp;<small><b>SMS</b></small>&nbsp;<?php echo CHtml::checkBox('customer_sms_notification', $customer_sms_checked, array('uncheckValue' => 0)); ?>
		</div>
	 
	</td>
	<td>
		<?php 
			//EVENT LISTENER FOR ENGINEER FIELD.
			Yii::app()->clientScript->registerScript('my-engineer-listener',"
			$('#engineer-checkbox-id').click(function() {
			    $('.engineer-form')[this.checked ? 'show' : 'hide']();
			});
			");
		?>
		
		Engineer&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		<?php 
			$engineer_checked;
				
			$engineer_email_checked=NotificationRules::model()->getEmailCheckBoxStatus($model->engineer_notification_code);
			$engineer_sms_checked=NotificationRules::model()->getSMSCheckBoxStatus($model->engineer_notification_code);
				
			if ($engineer_email_checked || $engineer_sms_checked)
				$engineer_checked=true;
			else 
				$engineer_checked=false;
		?>
		<?php echo $form->checkbox($model, 'engineer_notification_code', array('checked'=>$engineer_checked,'id'=>'engineer-checkbox-id')); ?>
		
		<div class="engineer-form" style="display:none">
		by <small><b>Email</b></small>&nbsp;<?php echo CHtml::checkBox('engineer_email_notification', $engineer_email_checked, array('uncheckValue' => 0)); ?>
		&nbsp;&nbsp;<small><b>SMS</b></small>&nbsp;<?php echo CHtml::checkBox('engineer_sms_notification', $engineer_sms_checked, array('uncheckValue' => 0)); ?>
		</div>
	
	</td>
	<td>
		
		<?php 
			//EVENT LISTENER FOR WARRANTY PROVIDER FIELD.
			Yii::app()->clientScript->registerScript('my-warranty-provider-listener',"
			$('#warranty-provider-checkbox-id').click(function() {
			    $('.warranty-provider-form')[this.checked ? 'show' : 'hide']();
			});
			");
		?>
		
		Warranty Provider&nbsp;&nbsp;
		<?php 
			$warranty_provider_checked;
				
			$warranty_provider_email_checked=NotificationRules::model()->getEmailCheckBoxStatus($model->warranty_provider_notification_code);
			$warranty_provider_sms_checked=NotificationRules::model()->getSMSCheckBoxStatus($model->warranty_provider_notification_code);
				
			if ($warranty_provider_email_checked || $warranty_provider_sms_checked)
				$warranty_provider_checked=true;
			else 
				$warranty_provider_checked=false;
		?>
		<?php echo $form->checkbox($model, 'warranty_provider_notification_code', array('checked'=>$warranty_provider_checked,'id'=>'warranty-provider-checkbox-id')); ?>
		<div class="warranty-provider-form" style="display:none">
		by <small><b>Email</b></small>&nbsp;<?php echo CHtml::checkBox('warranty_provider_email_notification', $warranty_provider_email_checked, array('uncheckValue' => 0)); ?>
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<small><b>SMS</b></small>&nbsp;<?php echo CHtml::checkBox('warranty_provider_sms_notification', $warranty_provider_sms_checked, array('uncheckValue' => 0)); ?>
		</div>
	
	</td>
</tr>
<tr>
	<td colspan="3">
		
		<b>Also send notification to </b>&nbsp;&nbsp;
		<?php
			if($model->notify_others == 0)
			{
				echo CHtml::submitButton('Add Details', array('name'=>'others_person_details'));
			}
			
		?>
        
        <div class="others-form" style="display:none">
		
		<!-- *** FORM OF OTHERS CHECKBOX, TO DISPLAY FORM AND DIALOGUE BOX TO ENTER DETAILS *** -->
		
		<?php 
			
			$baseUrl=Yii::app()->request->baseUrl;
			//$changeEnggUrl=$baseUrl.'/enggdiary/changeEngineerOnly/';
			$othersDetailsUrl=$baseUrl.'/notificationContact/addNotificationContact/';		
			$othersPersonDetailsForm=$this->beginWidget('CActiveForm', array(
			'id'=>'others-contactDetails-form',
			'enableAjaxValidation'=>false,
			'action'=>$othersDetailsUrl,
			'method'=>'post'
			
		)); ?>
		
		<?php 
		$contactModel = NotificationContact::model()->findAllByAttributes(array(
														'notification_rule_id'=>$model->id
													));
													
		//echo "<hr>count of result = ".count($contactModel)."<hr>";
		/*********** CODE TO DISPLAY FORM TO ENTER OTHER PERSONS DETAILS **********/
		if(count($contactModel) != '0')
		{
			?>
			<table style="margin-bottom:0px;"> 
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
				<!-- START OF SECOND COLUMN -->
				<td>
				<?php echo CHtml::link('Delete', array('/notificationContact/delete','id'=>$data->id));?>
				</td>
				<!-- END OF SECOND COLUMN -->
				</tr>
				<?php 
			}//end of foreach().
			?>
			
			<tr>
				 <td colspan="5"><?php
					//the link for open the contact dialog, to enter more other details
					echo CHtml::link('Add More', "",
					array(
						'style'=>'cursor: pointer; text-decoration: underline;',
						'onclick'=>"{addContact(); $('#formdialog').dialog('open');}"
					));
				?>
				</td>
			 </tr>
			</table>
			
			<?php 
			/***** CODE TO GET DIALOGUE BOX OF FORM TO ENTER PERSON DETAILS ****/
				$this->beginWidget('zii.widgets.jui.CJuiDialog', array(
					'id'=>'formdialog',
					// additional javascript options for the dialog plugin
					'options'=>array(
					'title'=>'Person Details',
					//'title'=>Yii::t('notificationContact','Create Job'),
					'autoOpen'=>$showDialogue,
					'modal'=>'true',
					'show' => 'blind',
					'hide' => 'explode',
					),
				));
			?>
						
			<div class="divForForm"></div>
						
			<?php $this->endWidget('zii.widgets.jui.CJuiDialog'); ?>
			
			<script type="text/javascript">
				function addContact()
			   {
				//alert('IN ADD CONTACT FUNC'+<?php //echo $model->id;?> );
				<?php 
				echo CHtml::ajax(array(
				   'url'=>array('notificationContact/create', 'id'=>$model->id),
				   'data'=> "js:$(this).serialize()",
				   'type'=>'post',
				   'dataType'=>'json',
				   'success'=>"function(data)
				   {
					if (data.status == 'failure')
					   {
						$('#formdialog div.divForForm').html(data.div);
						   // Here is the trick: on submit-> once again this function!
						   $('#dialogClassroom div.divForForm form').submit(addContact);
					   }
					   else
					   {
						$('#formdialog div.divForForm').html(data.div);
						   setTimeout(\"$('#formdialog').dialog('close') \",3000);
					   }

				   } ",
				   ))
				   ?>;
				   return false;
			   }//end of function addContact().
			</script>
			<?php

			/***** END OF CODE TO GET DIALOGUE BOX OF FORM TO ENTER PERSON DETAILS ****/
	
		}//end of if(Printing data from db).
		
		/********* END OF CODE TO DISPLAY PERSON DETAILS FROM DATABASE *************/
		
		?>
		<?php $this->endWidget(); ?>
		
		<!-- *** END OF FORM OF OTHERS CHECKBOX, TO DISPLAY FORM AND DIALOGUE BOX TO ENTER DETAILS *** -->
		</div><!-- end of others form div -->
	</td>
</tr>

	
<tr>
	<td  colspan="3">
	<table style="width:30%; margin-bottom:0px;"><tr><td><b>Enable This Rule</b></td>
	<td><?php echo $form->dropDownList($model, 'active', array('1'=>'Yes','0'=>'No')); ?></td></tr></table>
	</td>
</tr>

 <tr>
	<td colspan="3"><?php echo CHtml::submitButton($model->isNewRecord ? 'Set up this New rule' : 'Save the Rule', 
															array('id'=>'form_save_button')); ?>
	</td>
 </tr>

 </table>	
 
 
 <?php //echo "<br>Notify others value now = ".$model->notify_others; ?>
 

<?php $this->endWidget(); ?>
	
</div><!-- form -->