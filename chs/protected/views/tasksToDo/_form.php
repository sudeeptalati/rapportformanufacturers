<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'tasks-to-do-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'task'); ?>
		<?php echo $form->textArea($model,'task',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'task'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'status'); ?>
		<?php echo $form->textArea($model,'status',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'status'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'msgbody'); ?>
		<?php echo $form->textArea($model,'msgbody',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'msgbody'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'subject'); ?>
		<?php echo $form->textArea($model,'subject',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'subject'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'send_to'); ?>
		<?php echo $form->textArea($model,'send_to',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'send_to'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'created'); ?>
		<?php echo $form->textField($model,'created'); ?>
		<?php echo $form->error($model,'created'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'scheduled'); ?>
		<?php echo $form->textField($model,'scheduled'); ?>
		<?php echo $form->error($model,'scheduled'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'executed'); ?>
		<?php echo $form->textField($model,'executed'); ?>
		<?php echo $form->error($model,'executed'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'finished'); ?>
		<?php echo $form->textField($model,'finished'); ?>
		<?php echo $form->error($model,'finished'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->