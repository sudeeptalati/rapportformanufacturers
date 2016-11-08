<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'brand-form',
	'enableAjaxValidation'=>false,
)); ?>
	
	<br><br>
	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'name'); ?>
		
		<?php 
			if($model->id>1000000)
			{
				echo $form->textField($model,'name',array('rows'=>6, 'cols'=>50));
			}
			else 
			{
				echo $form->textField($model,'name',array('disabled'=>'disabled'));
				echo "<br><small>This is system data, cannot be edited</small>";
			} 
		?>
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