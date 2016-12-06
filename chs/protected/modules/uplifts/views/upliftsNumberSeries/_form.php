<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'uplifts-config-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'prefix'); ?>
		<?php echo $form->textField($model,'prefix',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'prefix'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'start_from'); ?>
		<?php echo $form->textField($model,'start_from'); ?>
		<?php echo $form->error($model,'start_from'); ?>
	</div>

 
	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->