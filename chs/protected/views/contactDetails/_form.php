<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'contact-details-form',
	'enableAjaxValidation'=>true,
)); ?>



	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'address_line_1'); ?>
		<?php echo $form->textField($model,'address_line_1',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'address_line_1'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'address_line_2'); ?>
		<?php echo $form->textField($model,'address_line_2',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'address_line_2'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'address_line_3'); ?>
		<?php echo $form->textField($model,'address_line_3',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'address_line_3'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'town'); ?>
		<?php echo $form->textField($model,'town',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'town'); ?>
	</div>
<div class="row">
		<?php echo $form->labelEx($model,'postcode_s'); ?>
		<?php echo $form->textField($model,'postcode_s',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'postcode_s'); ?>
	</div>
	<div class="row">
		<?php echo $form->labelEx($model,'postcode_e'); ?>
		<?php echo $form->textField($model,'postcode_e',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'postcode_e'); ?>
	</div>
	<div class="row">
		<?php echo $form->labelEx($model,'country'); ?>
		<?php echo $form->textField($model,'country',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'country'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'latitudes'); ?>
		<?php echo $form->textField($model,'latitudes',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'latitudes'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'longitudes'); ?>
		<?php echo $form->textField($model,'longitudes',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'longitudes'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'mobile'); ?>
		<?php echo $form->textField($model,'mobile',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'mobile'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'telephone'); ?>
		<?php echo $form->textField($model,'telephone',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'telephone'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'fax'); ?>
		<?php echo $form->textField($model,'fax',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'fax'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'email'); ?>
		<?php echo $form->textField($model,'email',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'email'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'website'); ?>
		<?php echo $form->textField($model,'website',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'website'); ?>
	</div>

	<!--<div class="row">
		<?php echo $form->labelEx($model,'created'); ?>
		<?php echo $form->textField($model,'created'); ?>
		<?php echo $form->error($model,'created'); ?>
	</div>

	--><div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->