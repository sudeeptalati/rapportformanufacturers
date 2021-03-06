<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'product-type-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'name'); ?>
		<?php echo $form->textField($model,'name',array('rows'=>6, 'cols'=>50));  ?>
		<?php echo $form->error($model,'name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'information'); ?>
		<?php echo $form->textField($model,'information',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'information'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model,'active'); ?>
		<?php //echo $form->textField($model,'active'); ?>
		<?php echo $form->dropDownList($model,
			'active',
			array(0 => 'No', 1 => 'Yes')
			); 
		?>
		<?php echo $form->error($model,'active'); ?>
	</div>

	
	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->