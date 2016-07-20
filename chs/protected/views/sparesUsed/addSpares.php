<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'spares-used-addSpares-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php //echo $form->labelEx($model,'master_item_id'); ?>
		<?php //echo $form->textField($model,'master_item_id'); ?>
		<?php echo $form->hiddenField($model,'master_item_id'); ?>
		<?php echo $form->error($model,'master_item_id'); ?>
	</div>

	<div class="row">
		<?php //echo $form->labelEx($model,'servicecall_id'); ?>
		<?php //echo $form->textField($model,'servicecall_id'); ?>
		<?php echo $form->hiddenField($model,'servicecall_id'); ?>
		<?php echo $form->error($model,'servicecall_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'part_number'); ?>
		<?php echo $form->textField($model,'part_number'); ?>
		<?php echo $form->error($model,'part_number'); ?>
	</div>
	<div class="row">
		<?php echo $form->labelEx($model,'item_name'); ?>
		<?php echo $form->textField($model,'item_name'); ?>
		<?php echo $form->error($model,'item_name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'quantity'); ?>
		<?php echo $form->textField($model,'quantity'); ?>
		<?php echo $form->error($model,'quantity'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'unit_price'); ?>
		<?php echo $form->textField($model,'unit_price'); ?>
		<?php echo $form->error($model,'unit_price'); ?>
	</div>
	

	<div class="row">
		<?php echo $form->labelEx($model,'date_ordered'); ?>
		<?php echo $form->textField($model,'date_ordered'); ?>
		<br>
		<small>Date Format (24-02-1986)</small>
		<?php echo $form->error($model,'date_ordered'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model,'date_posted'); ?>
		<?php echo $form->textField($model,'date_posted'); ?>
		<br>
		<small>Date Format (24-02-1986)</small>

		<?php echo $form->error($model,'date_posted'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model,'date_ordered_from_manufacturer'); ?>
		<?php echo $form->textField($model,'date_ordered_from_manufacturer'); ?>
		<br>
		<small>Date Format (24-02-1986)</small>

		<?php echo $form->error($model,'date_ordered_from_manufacturer'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'notes'); ?>
		<?php echo $form->textField($model,'notes'); ?>
		<?php echo $form->error($model,'notes'); ?>
	</div>


	<div class="row buttons">
		<?php 
			//CHtml::submitButton('Submit'); 
			echo CHtml::ajaxSubmitButton('Save',CHtml::normalizeUrl(array('sparesUsed/addSpares','render'=>false)),array('success'=>'js: function(data) {
                        $("#formdialog").dialog("close");
                    }'),array('id'=>'closeJobDialog'));
		?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->





