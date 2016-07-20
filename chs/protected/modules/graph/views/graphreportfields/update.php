 <?php
$this->menu=array(
	array('label'=>'Manage CSV Report Fields', 'url'=>array('admin')),
	array('label'=>'Create CSV Report Fields', 'url'=>array('create')),
);
?>

<h1>Update CSV Report Fields </h1>
<h3><?php echo $model->field_label; ?></h3>



 
<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'graph-reportfields-form',
	'htmlOptions'=>array('onsubmit'=>"return validateForm()"),
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
//	'clientOptions'=>array('validateOnSubmit'=>true),
));
  ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>
	
	<!--
	<div class="row">
		<?php echo $form->labelEx($model,'report_type'); ?>
		<?php echo $form->textField($model,'report_type'); ?>
		<?php echo $form->error($model,'report_type'); ?>
	</div>
	

	<div class="row">
		<?php echo $form->labelEx($model,'field_name'); ?>
		<?php echo $form->textField($model,'field_name',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'field_name'); ?>
	</div>
	-->
	<div class="row">
		<?php echo $form->labelEx($model,'field_type'); ?>
		<?php echo $form->dropDownList($model,'field_type', array('TEXT'=>'TEXT', 'DATETIME'=>'DATETIME')); ?>
		<?php echo $form->error($model,'field_type'); ?>
	</div>

	
	
	<div class="row">
		<?php echo $form->labelEx($model,'field_label'); ?>
		<?php echo $form->textField($model,'field_label',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'field_label'); ?>
	</div>
	
	<div id='field_relation_div' style='padding:1em;border-radius: 1em;' class="row">
		
		<span id='field_relation_span_text'></span>
		<?php echo $form->labelEx($model,'field_relation'); ?>
		<?php echo $form->hiddenField($model,'field_relation',array( 'style'=>'width:300px;')); ?>
		<div id="field_relation">
			<?php echo $model->field_relation; ?>
		</div>
		
		 
	
	</div>
	
	


	<div class="row">
		<?php echo $form->labelEx($model,'sort_order'); ?>
		<?php echo $form->textField($model,'sort_order'); ?>
		<?php echo $form->error($model,'sort_order'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'active'); ?>
		<?php echo $form->dropDownList($model,'active', array('1'=>'Active', '0'=>'Inactive')); ?>
		<?php echo $form->error($model,'active'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->

 