<div class="form">

	<?php if(isset($_GET['error_msg'])):?>
		<div class="error">
			ERRORS
			<?php echo $_GET['error_msg']; ?>
		</div>

	<?php endif;?>



<?php $newsparemodel=new SparesUsed();?>

	<?php  $newsparemodel->master_item_id=0; ?>
	<?php  $newsparemodel->servicecall_id=$service_id; ?>

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'spares-used-addSpares-form',
	'action' => Yii::app()->createUrl('sparesused/addspares&servicecall_id=' .$service_id),
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($newsparemodel); ?>

	<div class="row">
		<?php //echo $form->labelEx($model,'master_item_id'); ?>
		<?php //echo $form->textField($model,'master_item_id'); ?>
		<?php echo $form->hiddenField($newsparemodel,'master_item_id'); ?>
		<?php echo $form->error($newsparemodel,'master_item_id'); ?>
	</div>

	<div class="row">
		<?php //echo $form->labelEx($model,'servicecall_id'); ?>
		<?php //echo $form->textField($model,'servicecall_id'); ?>
		<?php echo $form->hiddenField($newsparemodel,'servicecall_id'); ?>
		<?php echo $form->error($newsparemodel,'servicecall_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($newsparemodel,'part_number'); ?>
		<?php echo $form->textField($newsparemodel,'part_number'); ?>
		<?php echo $form->error($newsparemodel,'part_number'); ?>
	</div>
	<div class="row">
		<?php echo $form->labelEx($newsparemodel,'item_name'); ?>
		<?php echo $form->textField($newsparemodel,'item_name'); ?>
		<?php echo $form->error($newsparemodel,'item_name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($newsparemodel,'quantity'); ?>
		<?php echo $form->textField($newsparemodel,'quantity'); ?>
		<?php echo $form->error($newsparemodel,'quantity'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($newsparemodel,'unit_price'); ?>
		<?php echo $form->textField($newsparemodel,'unit_price'); ?>
		<?php echo $form->error($newsparemodel,'unit_price'); ?>
	</div>
	

	<div class="row">
		<?php echo $form->labelEx($newsparemodel,'date_ordered'); ?>
		<?php echo $form->textField($newsparemodel,'date_ordered', array('readonly'=>'readonly')); ?>
		<?php echo $form->error($newsparemodel,'date_ordered'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($newsparemodel,'date_ordered_from_manufacturer'); ?>
		<?php echo $form->textField($newsparemodel,'date_ordered_from_manufacturer', array('readonly'=>'readonly')); ?>
		<?php echo $form->error($newsparemodel,'date_ordered_from_manufacturer'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($newsparemodel,'date_posted'); ?>
		<?php echo $form->textField($newsparemodel,'date_posted', array('readonly'=>'readonly')); ?>
		<?php echo $form->error($newsparemodel,'date_posted'); ?>
	</div>


	<div class="row">
		<?php echo $form->labelEx($newsparemodel,'notes'); ?>
		<?php echo $form->textField($newsparemodel,'notes'); ?>
		<?php echo $form->error($newsparemodel,'notes'); ?>
	</div>


	<div class="row buttons">
		<?php 
			echo CHtml::submitButton('Submit');
			/*
		echo CHtml::ajaxSubmitButton('Save',CHtml::normalizeUrl(array('sparesUsed/addSpares','render'=>false)),array('success'=>'js: function(data) {
                        $("#formdialog").dialog("close");
                    }'),array('id'=>'closeJobDialog'));
			*/
			?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->





<script>


	var SparesUsed_date_ordered = new Pikaday(
		{
			numberOfMonths: 3,
			///mainCalendar: 'right',
			field: document.getElementById('SparesUsed_date_ordered'),
		});


	var SparesUsed_date_ordered_from_manufacturer = new Pikaday(
		{
			numberOfMonths: 3,
			field: document.getElementById('SparesUsed_date_ordered_from_manufacturer'),

		});
	var SparesUsed_date_posted = new Pikaday(
		{
			numberOfMonths: 3,
			field: document.getElementById('SparesUsed_date_posted'),

		});



</script>