<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'spares-used-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>
	
	<?php 
		//echo "SERVICE ID FROM SERACH DATA FORM &nbsp;&nbsp;&nbsp;";
		//echo $_GET['service_id']."<hr>";
		$service_id = $_GET['service_id'];
		//echo "MASTER ID FROM SEARCH &nbsp;&nbsp;&nbsp;";
		//echo $_GET['master_id']."<hr>";
		$master_id = $_GET['master_id'];
		
		$db = new PDO('sqlite:../master_database/api/master_database.db');
		
		$result = $db->query("SELECT * FROM master_items WHERE id = $master_id ");
		
		foreach ($result as $data)
		{
			//echo "Item name from search done in view &nbsp;&nbsp;&nbsp;";
			//echo $data['name']."&nbsp;&nbsp;&nbsp;".$data['id'];
		
			$model->master_item_id=$master_id;
			$model->item_name= $data['name'];
			$model->part_number = $data['part_number'];
			$model->servicecall_id = $service_id;
		}
	?>


	<div class="row">
		<?php //echo $form->labelEx($model,'master_item_id'); ?>
		<?php echo $form->hiddenField($model,'master_item_id'); ?>
		<?php echo $form->error($model,'master_item_id'); ?>
	</div>

	<div class="row">
		<?php //echo $form->labelEx($model,'servicecall_id'); ?>
		<?php echo $form->hiddenField($model,'servicecall_id'); ?>
		<?php echo $form->error($model,'servicecall_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'item_name'); ?>
		<?php echo $form->textArea($model,'item_name',array('rows'=>2, 'cols'=>20)); ?>
		<?php echo $form->error($model,'item_name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'part_number'); ?>
		<?php echo $form->textField($model,'part_number'); ?>
		<?php echo $form->error($model,'part_number'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'unit_price'); ?>
		<?php echo $form->textField($model,'unit_price'); ?>
		<?php echo $form->error($model,'unit_price'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'quantity'); ?>
		<?php echo $form->textField($model,'quantity'); ?>
		<?php echo $form->error($model,'quantity'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'total_price'); ?>
		<?php echo $form->textField($model,'total_price'); ?>
		<?php echo $form->error($model,'total_price'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'date_ordered'); ?>
		<?php echo $form->textField($model,'date_ordered'); ?>
		<?php echo $form->error($model,'date_ordered'); ?>
	</div>

	<!--<div class="row">
		<?php //echo $form->labelEx($model,'created'); ?>
		<?php //echo $form->textField($model,'created'); ?>
		<?php //echo $form->error($model,'created'); ?>
	</div>

	<div class="row">
		<?php //echo $form->labelEx($model,'modified'); ?>
		<?php //echo $form->textField($model,'modified'); ?>
		<?php //echo $form->error($model,'modified'); ?>
	</div>

	--><div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->