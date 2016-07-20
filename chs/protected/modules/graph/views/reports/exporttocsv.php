<?php
/* @var $this ServicecallController */
/* @var $model Servicecall */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'servicecall-exporttocsv-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// See class documentation of CActiveForm for details on this,
	// you need to use the performAjaxValidation()-method described there.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'fault_description'); ?>
		<?php echo $form->textField($model,'fault_description'); ?>
		<?php echo $form->error($model,'fault_description'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'recalled_job'); ?>
		<?php echo $form->textField($model,'recalled_job'); ?>
		<?php echo $form->error($model,'recalled_job'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'created_by_user_id'); ?>
		<?php echo $form->textField($model,'created_by_user_id'); ?>
		<?php echo $form->error($model,'created_by_user_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'service_reference_number'); ?>
		<?php echo $form->textField($model,'service_reference_number'); ?>
		<?php echo $form->error($model,'service_reference_number'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'customer_id'); ?>
		<?php echo $form->textField($model,'customer_id'); ?>
		<?php echo $form->error($model,'customer_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'product_id'); ?>
		<?php echo $form->textField($model,'product_id'); ?>
		<?php echo $form->error($model,'product_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'contract_id'); ?>
		<?php echo $form->textField($model,'contract_id'); ?>
		<?php echo $form->error($model,'contract_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'engineer_id'); ?>
		<?php echo $form->textField($model,'engineer_id'); ?>
		<?php echo $form->error($model,'engineer_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'job_status_id'); ?>
		<?php echo $form->textField($model,'job_status_id'); ?>
		<?php echo $form->error($model,'job_status_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'spares_used_status_id'); ?>
		<?php echo $form->textField($model,'spares_used_status_id'); ?>
		<?php echo $form->error($model,'spares_used_status_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'total_cost'); ?>
		<?php echo $form->textField($model,'total_cost'); ?>
		<?php echo $form->error($model,'total_cost'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'vat_on_total'); ?>
		<?php echo $form->textField($model,'vat_on_total'); ?>
		<?php echo $form->error($model,'vat_on_total'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'net_cost'); ?>
		<?php echo $form->textField($model,'net_cost'); ?>
		<?php echo $form->error($model,'net_cost'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'engineer_name'); ?>
		<?php echo $form->textField($model,'engineer_name'); ?>
		<?php echo $form->error($model,'engineer_name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'product_serial_number'); ?>
		<?php echo $form->textField($model,'product_serial_number'); ?>
		<?php echo $form->error($model,'product_serial_number'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'number_of_visits'); ?>
		<?php echo $form->textField($model,'number_of_visits'); ?>
		<?php echo $form->error($model,'number_of_visits'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'customer_town'); ?>
		<?php echo $form->textField($model,'customer_town'); ?>
		<?php echo $form->error($model,'customer_town'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'customer_postcode'); ?>
		<?php echo $form->textField($model,'customer_postcode'); ?>
		<?php echo $form->error($model,'customer_postcode'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'activity_log'); ?>
		<?php echo $form->textField($model,'activity_log'); ?>
		<?php echo $form->error($model,'activity_log'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'insurer_reference_number'); ?>
		<?php echo $form->textField($model,'insurer_reference_number'); ?>
		<?php echo $form->error($model,'insurer_reference_number'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'fault_date'); ?>
		<?php echo $form->textField($model,'fault_date'); ?>
		<?php echo $form->error($model,'fault_date'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'fault_code'); ?>
		<?php echo $form->textField($model,'fault_code'); ?>
		<?php echo $form->error($model,'fault_code'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'engg_diary_id'); ?>
		<?php echo $form->textField($model,'engg_diary_id'); ?>
		<?php echo $form->error($model,'engg_diary_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'work_carried_out'); ?>
		<?php echo $form->textField($model,'work_carried_out'); ?>
		<?php echo $form->error($model,'work_carried_out'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'job_payment_date'); ?>
		<?php echo $form->textField($model,'job_payment_date'); ?>
		<?php echo $form->error($model,'job_payment_date'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'job_finished_date'); ?>
		<?php echo $form->textField($model,'job_finished_date'); ?>
		<?php echo $form->error($model,'job_finished_date'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'notes'); ?>
		<?php echo $form->textField($model,'notes'); ?>
		<?php echo $form->error($model,'notes'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'modified'); ?>
		<?php echo $form->textField($model,'modified'); ?>
		<?php echo $form->error($model,'modified'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'cancelled'); ?>
		<?php echo $form->textField($model,'cancelled'); ?>
		<?php echo $form->error($model,'cancelled'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'closed'); ?>
		<?php echo $form->textField($model,'closed'); ?>
		<?php echo $form->error($model,'closed'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'comments'); ?>
		<?php echo $form->textField($model,'comments'); ?>
		<?php echo $form->error($model,'comments'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'model_number'); ?>
		<?php echo $form->textField($model,'model_number'); ?>
		<?php echo $form->error($model,'model_number'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'serial_number'); ?>
		<?php echo $form->textField($model,'serial_number'); ?>
		<?php echo $form->error($model,'serial_number'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'notify_flag'); ?>
		<?php echo $form->textField($model,'notify_flag'); ?>
		<?php echo $form->error($model,'notify_flag'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'pervious_job_status'); ?>
		<?php echo $form->textField($model,'pervious_job_status'); ?>
		<?php echo $form->error($model,'pervious_job_status'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'work_summary'); ?>
		<?php echo $form->textField($model,'work_summary'); ?>
		<?php echo $form->error($model,'work_summary'); ?>
	</div>


	<div class="row buttons">
		<?php echo CHtml::submitButton('Submit'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->