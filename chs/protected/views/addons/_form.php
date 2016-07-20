<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'addons-form',
	'enableAjaxValidation'=>false,
)); ?>

	<br>
	
	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'type'); ?>
		<?php echo $form->textField($model,'type',array( 'disabled'=>'disabled')); ?>
		<?php echo $form->error($model,'type'); ?>.
		

	</div>

	<div class="row">

		<?php echo $form->labelEx($model,'active'); ?>
		<?php 
		
		echo $form->dropDownList($model,
			'active',
			array(0 => 'Disabled', 1 => 'Enabled')
			);
 	
		?>
		<?php echo $form->error($model,'active'); ?>
		<p class="note">If addons is <span class="required">disabled</span> you will not be able to use it or see in menu</p>

	 
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'name'); ?>
		<?php echo $form->textField($model,'name',array(  'disabled'=>'disabled')); ?>
		<?php echo $form->error($model,'name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'addon_label'); ?>
		<?php echo $form->textField($model,'addon_label',array(  'disabled'=>'disabled')); ?>
		<?php echo $form->error($model,'addon_label'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'information'); ?>
		<?php echo $form->textArea($model,'information',array('rows'=>6, 'cols'=>50, 'disabled'=>'disabled')); ?>
		<?php echo $form->error($model,'information'); ?>
	</div>

	 


	 

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->