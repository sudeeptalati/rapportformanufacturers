<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'notification-contact-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>
	
	<div class="row">
		<?php //echo $form->labelEx($model,'notification_rule_id'); ?>
		<?php echo $form->hiddenField($model,'notification_rule_id'); ?>
		<?php echo $form->error($model,'notification_rule_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'person_name'); ?>
		<?php echo $form->textField($model,'person_name',array('size'=>30)); ?>
		<?php echo $form->error($model,'person_name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'person_info'); ?>
		<?php echo $form->textField($model,'person_info',array('size'=>30)); ?>
		<?php echo $form->error($model,'person_info'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'email'); ?>
		<?php echo $form->textField($model,'email',array('size'=>30)); ?>
		<?php echo $form->error($model,'email'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'mobile'); ?>
		<?php echo $form->textField($model,'mobile', array('size'=>30)); ?>
		<br><small>(Please enter the number with code, like 44 for UK or 91 for India.)</small>
		<?php echo $form->error($model,'mobile'); ?>
	</div>
	
	<div class="row">
	<small><b>Email</b></small>&nbsp;<?php echo CHtml::checkBox('others_email_notification', false, array('uncheckValue' => 0)); ?>
	&nbsp;&nbsp;<small><b>SMS</b></small>&nbsp;<?php echo CHtml::checkBox('others_sms_notification', false, array('uncheckValue' => 0)); ?>
	</div>

	
	<div class="row buttons">
		<?php //echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
		<?php echo CHtml::ajaxSubmitButton('Save',CHtml::normalizeUrl(array('notificationContact/create','render'=>true)),array('success'=>'js: function(data) {
                        $("#formdialog").dialog("close");
                    }'),array('id'=>'closeJobDialog'));
					//$("#Person_jid").append(data);
		 ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->