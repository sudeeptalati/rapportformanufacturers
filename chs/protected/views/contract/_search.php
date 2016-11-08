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
		<?php echo $form->label($model,'contract_type_id'); ?>
		<?php echo $form->textField($model,'contract_type_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'name'); ?>
		<?php echo $form->textArea($model,'name',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'main_contact_details_id'); ?>
		<?php echo $form->textField($model,'main_contact_details_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'management_contact_details'); ?>
		<?php echo $form->textField($model,'management_contact_details'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'spares_contact_details'); ?>
		<?php echo $form->textField($model,'spares_contact_details'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'accounts_contact_details'); ?>
		<?php echo $form->textField($model,'accounts_contact_details'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'technical_contact_details'); ?>
		<?php echo $form->textField($model,'technical_contact_details'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'vat_reg_number'); ?>
		<?php echo $form->textArea($model,'vat_reg_number',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'notes'); ?>
		<?php echo $form->textArea($model,'notes',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'active'); ?>
		<?php echo $form->textField($model,'active'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'inactivated_by_user_id'); ?>
		<?php echo $form->textField($model,'inactivated_by_user_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'inactivated_on'); ?>
		<?php echo $form->textField($model,'inactivated_on'); ?>
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

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->