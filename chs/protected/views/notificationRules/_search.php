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
		<?php echo $form->label($model,'job_status_id'); ?>
		<?php echo $form->textField($model,'job_status_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'active'); ?>
		<?php echo $form->textField($model,'active'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'customer_notification_code'); ?>
		<?php echo $form->textField($model,'customer_notification_code'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'engineer_notification_code'); ?>
		<?php echo $form->textField($model,'engineer_notification_code'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'warranty_provider_notification_code'); ?>
		<?php echo $form->textField($model,'warranty_provider_notification_code'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'notify_others'); ?>
		<?php echo $form->textField($model,'notify_others'); ?>
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
		<?php echo $form->label($model,'delete'); ?>
		<?php echo $form->textField($model,'delete'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->