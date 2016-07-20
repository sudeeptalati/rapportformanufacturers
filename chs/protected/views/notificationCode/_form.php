<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'notification-code-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'notify_by'); ?>
		<?php echo $form->textArea($model,'notify_by',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'notify_by'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->