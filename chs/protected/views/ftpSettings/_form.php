<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'ftp-settings-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'url'); ?>
		<?php echo $form->textField($model,'url',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'url'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'ftp_username'); ?>
		<?php echo $form->textField($model,'ftp_username',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'ftp_username'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'ftp_password'); ?>
		<?php echo $form->textField($model,'ftp_password',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'ftp_password'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'ftp_port'); ?>
		<?php echo $form->textField($model,'ftp_port',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'ftp_port'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->