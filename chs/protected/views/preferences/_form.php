<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'preferences-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>
	
	<div class="row">
		<?php echo $form->labelEx($model,'feature'); ?>
		<?php echo $form->textField($model,'feature', array('disabled'=>'disabled')); ?>
		<br><small>(System set name, cannot be changed)</small>
		<?php echo $form->error($model,'feature'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'state'); ?>
		<?php //echo $form->textField($model,'state'); ?>
		<?php echo $form->dropdownList($model, 'state', array('0'=>'No','1'=>'Yes')); ?>
		<?php echo $form->error($model,'state'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->