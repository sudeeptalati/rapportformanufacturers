<div class="form">

<?php
$model->management_contact_details='Same as main contact';
$model->spares_contact_details='Same as main contact';
$model->accounts_contact_details='Same as main contact';
$model->technical_contact_details='Same as main contact';

//EVENT LISTENER FOR MANAGEMENT FIELD.
Yii::app()->clientScript->registerScript('my-management-listener',"
$('#management-checkbox-id').change(function(){
$('.management-form').toggle();
	return false;
});
");

//EVENT LISTENER FOR SPARES FIELD.
Yii::app()->clientScript->registerScript('my-spares-listener',"
$('#spares-checkbox-id').change(function(){
$('.spares-form').toggle();
	return false;
});
");

//EVENT LISTENER FOR ACCOUNTS FIELD.
Yii::app()->clientScript->registerScript('my-accounts-listener',"
$('#accounts-checkbox-id').change(function(){
$('.accounts-form').toggle();
	return false;
});
");

//EVENT LISTENER FOR TECHNICAL FIELD.
Yii::app()->clientScript->registerScript('my-technical-listener1',"
$('#technical-checkbox-id').change(function(){
$('.technical-form').toggle();
	return false;
});
");

?>



<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'contract-form',
	'enableAjaxValidation'=>true,
	'clientOptions'=>array('validateOnSubmit'=>true),
)); ?>

	<?php 
	
	$display_na = '';
	
	if (!empty($model->main_contact_details_id))
	{
		$contactDetailsModel=ContactDetails::model()->findByPk($model->main_contact_details_id);
	}
	else 
	{
		//echo "<br> main contact id = 0";
		//********* DISPLAY N/A FOR MAIN CONTACT ID 0 **********
		if($model->name != '' && $model->main_contact_details_id == 0)
		{
			//echo "<br>Address is not applicable here";
			$display_na = 1;
		}//end of inner if.
		//********* END OF DISPLAY N/A FOR MAIN CONTACT ID 0 **********
		
		$contactDetailsModel=ContactDetails::model();
	}//end of else.
	?>
	
	<?php 
		echo $form->errorSummary($model);
		echo $form->errorSummary($contactDetailsModel);
	?>
	<br><br>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php //echo $form->errorSummary($model); ?>
	
	<table style="width:700px; margin:10px; background-color: #C7E8FD;  border-radius: 15px; padding:15px;">
	<tr>
		<td>
			<?php echo $form->labelEx($model,'contract_type_id'); ?>
			<?php //echo $form->textField($model,'contract_type_id'); ?>
			<?php echo CHtml::activeDropDownList($model, 'contract_type_id', $model->getContractType());?>
			<?php echo $form->error($model,'contract_type_id'); ?>
		</td>
		<td>
			<?php echo $form->labelEx($model,'name'); ?>
			<?php echo $form->textField($model,'name',array('rows'=>6, 'cols'=>50)); ?>
			<?php echo $form->error($model,'name'); ?>
		</td>
		<td>
			<?php echo $form->labelEx($model,'short_name'); ?>
			<?php echo $form->textField($model,'short_name',array('rows'=>6, 'cols'=>50)); ?>
			<?php echo $form->error($model,'short_name'); ?>
				<br><small>Short name is like nick name with which you can quickly remember which contract it is.</small>
		</td>
	</tr>
	
	<tr>
		<?php 
				$years_range=array();
				$years_range=range(0, 5);
				
				$months_range=array();
				$months_range=range(0, 120);
		?>
		<td>
			<?php //$labour_year = ($model->labour_warranty_months_duration)/12; ?>
			<?php echo $form->labelEx($model,'labour_warranty_months_duration'); ?> <small>Years &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Months</small><br>
			
			<?php echo CHtml::dropDownList('labour_years', '', array($years_range)); //Dropdown of years. ?>
			
			<?php 	
				echo $form->dropDownList($model, 'labour_warranty_months_duration', array($months_range));//Dropdown of months.
			?>
			<?php echo $form->error($model,'labour_warranty_months_duration'); ?>
		</td>
		
		<td>
			<?php echo $form->labelEx($model,'parts_warranty_months_duration'); ?><small>Years &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Months</small><br>
			
			<?php echo CHtml::dropDownList('parts_years', '', array($years_range));//Dropdown of years.?>
			
			<?php 	
				echo $form->dropDownList($model, 'parts_warranty_months_duration', array($months_range));//Dropdown of months.
			?>
			<?php echo $form->error($model,'parts_warranty_months_duration'); ?>
		</td>
		
		<td>
			<?php echo $form->labelEx($model,'vat_reg_number'); ?>
			<?php echo $form->textField($model,'vat_reg_number',array('rows'=>6, 'cols'=>50)); ?>
			<?php echo $form->error($model,'vat_reg_number'); ?>
		</td>
		
	</tr>
	
	<tr>
		<td colspan="2">
			<?php echo $form->labelEx($model,'active'); ?>
			<small>(Active means, this will be displayed in the call handling.If you no longer require this type of contract you can chande it to No)</small><br>
			<?php echo $form->dropDownList($model,'active', array('1'=>'Yes', '0'=>'No')); ?>
			<?php echo $form->error($model,'active'); ?>
		</td>
		
	</tr>
	
	<tr>
		<td colspan="2">
			<?php echo $form->labelEx($model,'notes'); ?>
			<?php echo $form->textArea($model,'notes',array('rows'=>6, 'cols'=>50)); ?>
			<?php echo $form->error($model,'notes'); ?>
		</td>
	</tr>
	<tr></tr>
	</table>
	
	<!-- *************** START OF FIELDS OF CONTACT DETAILS FORM *********************** -->
	

	<table style="width:700px; margin:10px; background-color: #ADEBAD;  border-radius: 15px;padding:15px;">
	
	<tr>
		<td colspan="3"><h3 style="margin-bottom:0.01px;color:#555;"><label>Address Details</label></h3></td>
	</tr>
	
	<tr>
		<td>
			<?php 
			
			if($display_na == 1)
			{
				$contactDetailsModel->address_line_1 = 'N/A';
			}
			
			?>
			<?php echo $form->labelEx($contactDetailsModel,'address_line_1'); ?>
			<?php echo $form->textField($contactDetailsModel,'address_line_1',array('rows'=>6, 'cols'=>50)); ?>
			<?php echo $form->error($contactDetailsModel,'address_line_1'); ?>
		</td>
		<td>
			<?php echo $form->labelEx($contactDetailsModel,'address_line_2'); ?>
			<?php echo $form->textField($contactDetailsModel,'address_line_2',array('rows'=>6, 'cols'=>50)); ?>
			<?php echo $form->error($contactDetailsModel,'address_line_2'); ?>
		</td>
		<td>
			<?php echo $form->labelEx($contactDetailsModel,'address_line_3'); ?>
			<?php echo $form->textField($contactDetailsModel,'address_line_3',array('rows'=>6, 'cols'=>50)); ?>
			<?php echo $form->error($contactDetailsModel,'address_line_3'); ?>
		</td>
	</tr>
	<tr>
		<td>
			<?php 
			if($display_na == 1)
			{
				$contactDetailsModel->town = 'N/A';
			}
			?>
			<?php echo $form->labelEx($contactDetailsModel,'town'); ?>
			<?php echo $form->textField($contactDetailsModel,'town',array('rows'=>6, 'cols'=>50)); ?>
			<?php echo $form->error($contactDetailsModel,'town'); ?>
		</td>
		<td>
		<?php 
			if($display_na == 1)
			{
				$contactDetailsModel->postcode_s = 'N/A';
				$contactDetailsModel->postcode_e = 'N/A';
			}
			?>
			<?php echo $form->labelEx($contactDetailsModel,'postcode',array('size'=>3, 'maxlength'=>5, 'style'=>'width:2.5em;display: inline')); ?><span class="required">*</span><br>
			<?php echo $form->textField($contactDetailsModel,'postcode_s',array('size'=>3, 'maxlength'=>5, 'style'=>'width:2.5em')); ?>
			<?php echo $form->error($contactDetailsModel,'postcode_s'); ?>
			<?php echo $form->textField($contactDetailsModel,'postcode_e',array('size'=>3,'maxlength'=>5,'style'=>'width:2.5em' )); ?>
			<?php echo $form->error($contactDetailsModel,'postcode_e'); ?>
		
		</td>
		<td>
			<?php echo $form->labelEx($contactDetailsModel,'country'); ?>
			<?php echo $form->textField($contactDetailsModel,'country',array('rows'=>6, 'cols'=>50)); ?>
			<?php echo $form->error($contactDetailsModel,'country'); ?>
		</td>
	</tr>
	<tr>
		<td>
			<?php 
			if($display_na == 1)
			{
				$contactDetailsModel->telephone = 'N/A';
			}
			?>
			<?php echo $form->labelEx($contactDetailsModel,'telephone'); ?>
			<?php echo $form->textField($contactDetailsModel,'telephone',array('rows'=>6, 'cols'=>50)); ?>
			<?php echo $form->error($contactDetailsModel,'telephone'); ?>
		</td>
		<td>
			<?php echo $form->labelEx($contactDetailsModel,'mobile'); ?>
			<?php echo $form->textField($contactDetailsModel,'mobile',array('rows'=>6, 'cols'=>50)); ?>
			<?php echo $form->error($contactDetailsModel,'mobile'); ?>
		</td>
		<td>
			<?php echo $form->labelEx($contactDetailsModel,'fax'); ?>
			<?php echo $form->textField($contactDetailsModel,'fax',array('rows'=>6, 'cols'=>50)); ?>
			<?php echo $form->error($contactDetailsModel,'fax'); ?>
		</td>
	</tr>
	
	<tr>
		<td>
			<?php 
			if($display_na == 1)
			{
				$contactDetailsModel->email = 'N/A';
			}
			?>
			<?php echo $form->labelEx($contactDetailsModel,'email'); ?>
			<?php echo $form->textField($contactDetailsModel,'email',array('rows'=>6, 'cols'=>50)); ?>
			<?php echo $form->error($contactDetailsModel,'email'); ?>
		</td>
		<td>
			<?php echo $form->labelEx($contactDetailsModel,'website'); ?>
			<?php echo $form->textField($contactDetailsModel,'website',array('rows'=>6, 'cols'=>50)); ?>
			<?php echo $form->error($contactDetailsModel,'website'); ?>
		</td>
	</tr>
	</table>
	
	<table style="width:700px; margin:10px; background-color: #F3B6B7;  border-radius: 15px;padding:15px;">
		<tr>
		
			<!-- ***********  MANAGEMENT TEXTFIELD ********** -->
			<td>
				<?php echo $form->labelEx($model,'management_contact_details'); ?>
				<?php //echo $form->textField($model,'management_details',array('rows'=>6, 'cols'=>50)); ?>
				<?php echo $form->checkBox($model,'management_contact_details',array('checked'=>'checked','id'=>'management-checkbox-id')); ?>
				<?php echo "Same as above";?>
				<?php echo $form->error($model,'management_contact_details'); ?>
				<div class="management-form" style="display:none">
					<?php echo $form->textArea($model,'management_contact_details'); ?>
					<?php echo $form->error($model,'management_contact_details'); ?>
				</div>		
			</td>
			
			
			<!-- ***********  SPARES TEXTFIELD ********** -->
			<td>
				<?php echo $form->labelEx($model,'spares_contact_details'); ?>
				<?php //echo $form->textField($model,'spares_contact_details',array('rows'=>6, 'cols'=>50)); ?>
				<?php echo $form->checkBox($model,'spares_contact_details',array('checked'=>'checked','id'=>'spares-checkbox-id')); ?>
				<?php echo "Same as above";?>
				<?php echo $form->error($model,'spares_contact_details'); ?>
				<div class="spares-form" style="display:none">
					<?php echo $form->textArea($model,'spares_contact_details'); ?>
					<?php echo $form->error($model,'spares_contact_details'); ?>
				</div>
			</td>
			
		</tr>
		
		<tr>
			<!-- ***********  ACCOUNTS TEXTFIELD ********** -->
			<td>
				<?php echo $form->labelEx($model,'accounts_contact_details'); ?>
				<?php //echo $form->textField($model,'spares_contact_details',array('rows'=>6, 'cols'=>50)); ?>
				<?php echo $form->checkBox($model,'accounts_contact_details',array('checked'=>'checked','id'=>'accounts-checkbox-id','name'=>'myCheckBox')); ?>
				<?php echo "Same as above";?>
				<?php echo $form->error($model,'accounts_contact_details'); ?>
				<div class="accounts-form" style="display:none">
					<?php echo $form->textArea($model,'accounts_contact_details'); ?>
					<?php echo $form->error($model,'accounts_contact_details'); ?>
				</div>
			</td>
		
			<!-- ***********  TECHNICAL TEXTFIELD ********** -->
			<td>
				<?php echo $form->labelEx($model,'technical_contact_details'); ?>
				<?php //echo $form->textField($model,'technical_contact_details',array('rows'=>6, 'cols'=>50)); ?>
				<?php echo $form->checkBox($model,'technical_contact_details',array('checked'=>'checked','id'=>'technical-checkbox-id','name'=>'myCheckBox')); ?>
				<?php echo "Same as above";?>
				<?php echo $form->error($model,'technical_contact_details'); ?>
				<div class="technical-form" style="display:none">
					<?php echo $form->textArea($model,'technical_contact_details'); ?>
					<?php echo $form->error($model,'technical_contact_details'); ?>
				</div>
			</td>
		</tr>
		
		<tr>
			<td colspan="2">
				<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
			</td>
		</tr>
			
	</table>
		
	<div class="row buttons">
		
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->