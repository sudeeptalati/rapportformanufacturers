<div class="form">

<?php 
	
	
	
$model=Setup::model()->findByPk('1');
	
 
	


$form=$this->beginWidget('CActiveForm', array(
	'id'=>'setup-sendTestEmail-form',
	'enableAjaxValidation'=>false,
	'action'=>'index.php?r=setup/sendTestEmail',
)); ?>
 
	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

 
	<h3>Send a Test Email</h3>

	<div class="row">
		<?php echo $form->labelEx($model,'email'); ?>
		<?php echo $form->textField($model,'email', array('style'=>'width:330px;')); ?>
		<?php echo $form->error($model,'email'); ?>
	</div>

	 
	<div class="row">
		<b>Message</b><br>
		<?php 
		$model->alternate="This is a test email from Rapport Call Handling Software on ".date('d-M-Y H:i:s');
		echo $form->textArea($model,'alternate',array('rows'=>5, 'cols'=>40)); ?>
		<?php echo $form->error($model,'alternate'); ?>
	</div>
 

	<div class="row buttons">
		<?php echo CHtml::submitButton('Send Test Email'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->