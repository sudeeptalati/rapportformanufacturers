
<div id="sidemenu">             
<?php include('setup_sidemenu.php'); ?>   
</div>

<h1>Postcode Anywhere Account</h1>

<div id="submenu">   
<li> <?php echo CHtml::link('Manage',array('/setup/admin')); ?></li>
	<li> <?php echo CHtml::link('View',array('/setup/postcodeAnywhereView')); ?></li>
	<li> <?php echo CHtml::link('Update',array('/setup/postcodeAnywhereSetup')); ?></li>

</div>
 
<br><br>
 

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'setup-postcodeAnywhereSetup-form',
	'enableAjaxValidation'=>false,
)); ?>


	
	<?php echo $form->errorSummary($model); ?>
	
	<div class="row">
		<?php echo $form->labelEx($model,'postcodeanywhere_account_code'); ?>
		<?php echo $form->textField($model,'postcodeanywhere_account_code'); ?>
		<?php echo $form->error($model,'postcodeanywhere_account_code'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model,'postcodeanywhere_license_key'); ?>
		<?php echo $form->textField($model,'postcodeanywhere_license_key'); ?>
		<?php echo $form->error($model,'postcodeanywhere_license_key'); ?>
	</div>
		
	<div class="row buttons">
		<?php echo CHtml::submitButton('Update'); ?>
	</div>
	
<?php $this->endWidget(); ?>

</div><!-- form -->