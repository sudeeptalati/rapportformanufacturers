<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'id'); ?>
		<?php echo $form->textField($model,'id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'service_reference_number'); ?>
		<?php echo $form->textField($model,'service_reference_number'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'customer_id'); ?>
		<?php echo $form->textField($model,'customer_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'product_id'); ?>
		<?php echo $form->textField($model,'product_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'contract_id'); ?>
		<?php echo $form->textField($model,'contract_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'engineer_id'); ?>
		<?php echo $form->textField($model,'engineer_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'insurer_reference_number'); ?>
		<?php echo $form->textArea($model,'insurer_reference_number',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'job_status_id'); ?>
		<?php echo $form->textField($model,'job_status_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'fault_date'); ?>
		<?php echo $form->textField($model,'fault_date'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'fault_code'); ?>
		<?php echo $form->textArea($model,'fault_code',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'fault_description'); ?>
		<?php echo $form->textArea($model,'fault_description',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'engg_diary_id'); ?>
		<?php echo $form->textField($model,'engg_diary_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'work_carried_out'); ?>
		<?php echo $form->textArea($model,'work_carried_out',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'spares_used_status_id'); ?>
		<?php echo $form->textField($model,'spares_used_status_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'total_cost'); ?>
		<?php echo $form->textField($model,'total_cost'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'vat_on_total'); ?>
		<?php echo $form->textField($model,'vat_on_total'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'net_cost'); ?>
		<?php echo $form->textField($model,'net_cost'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'job_payment_date'); ?>
		<?php echo $form->textField($model,'job_payment_date'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'job_finished_date'); ?>
		<?php echo $form->textField($model,'job_finished_date'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'notes'); ?>
		<?php echo $form->textArea($model,'notes',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'created_by_user_id'); ?>
		<?php echo $form->textField($model,'created_by_user_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'created'); ?>
		<?php echo $form->textField($model,'created'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'modified'); ?>
		<?php echo $form->textField($model,'modified'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'cancelled'); ?>
		<?php echo $form->textField($model,'cancelled'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'closed'); ?>
		<?php echo $form->textField($model,'closed'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->