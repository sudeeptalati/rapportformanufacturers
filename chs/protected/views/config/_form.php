<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'config-form',
	'enableAjaxValidation'=>false,
)); ?>


<h4>Company Details</h4>
<table>
<tr>	
	<td>
		<?php echo $form->labelEx($model,'company'); ?>
	</td>
	<td>
		<?php echo $form->textField($model,'company',array('size'=>30)); ?>
		<?php echo $form->error($model,'company'); ?>
	</td>
</tr>
<tr>
	<td>
		<?php echo $form->labelEx($model,'address'); ?>
	</td>
	<td>
		<?php echo $form->textArea($model,'address',array('rows'=>6, 'cols'=>25)); ?>
		<?php echo $form->error($model,'address'); ?>
	</td>
</tr>

<tr>	
	<td>
		<?php echo $form->labelEx($model,'town'); ?>
	</td>
	<td>
		<?php echo $form->textField($model,'town',array('size'=>30)); ?>
		<?php echo $form->error($model,'town'); ?>
	</td>
</tr>

<tr>	
	<td>
		<?php echo $form->labelEx($model,'postcode_s'); ?>
	</td>
	<td>
		<?php echo $form->textField($model,'postcode_s',array('size'=>5)); ?>
		<?php echo $form->error($model,'postcode_s'); ?>
		<?php echo $form->textField($model,'postcode_e',array('size'=>5)); ?>
		<?php echo $form->error($model,'postcode_e'); ?>
	</td>
</tr>



<tr>	
	<td>
		<?php echo $form->labelEx($model,'county'); ?>
	</td>
	<td>
		<?php echo $form->textField($model,'county',array('size'=>30)); ?>
		<?php echo $form->error($model,'county'); ?>
	</td>
</tr>
<tr>	
	<td>
		<?php echo $form->labelEx($model,'country'); ?>
	</td>
	<td>
		<?php echo $form->textField($model,'country',array('size'=>30)); ?>
		<?php echo $form->error($model,'country'); ?>
	</td>
</tr>
<tr>	
	<td>
		<?php echo $form->labelEx($model,'email'); ?>
	</td>
	<td>
		<?php echo $form->textField($model,'email',array('size'=>30)); ?>
		<?php echo $form->error($model,'email'); ?>
	</td>
</tr>
<tr>	
	<td>
		<?php echo $form->labelEx($model,'telephone'); ?>
	</td>
	<td>
		<?php echo $form->textField($model,'telephone',array('size'=>30)); ?>
		<?php echo $form->error($model,'telephone'); ?>
	</td>
</tr>
<tr>	
	<td>
		<?php echo $form->labelEx($model,'mobile'); ?>
	</td>
	<td>
		<?php echo $form->textField($model,'mobile',array('size'=>30)); ?>
		<?php echo $form->error($model,'mobile'); ?>
	</td>
</tr><tr>	
	<td>
		<?php echo $form->labelEx($model,'alternate'); ?>
	</td>
	<td>
		<?php echo $form->textField($model,'alternate',array('size'=>30)); ?>
		<?php echo $form->error($model,'alternate'); ?>
	</td>
</tr><tr>	
	<td>
		<?php echo $form->labelEx($model,'fax'); ?>
	</td>
	<td>
		<?php echo $form->textField($model,'fax',array('size'=>30)); ?>
		<?php echo $form->error($model,'fax'); ?>
	</td>
</tr><tr>	
	<td>
		<?php echo $form->labelEx($model,'website'); ?>
	</td>
	<td>
		<?php echo $form->textField($model,'website',array('size'=>30)); ?>
		<?php echo $form->error($model,'website'); ?>
	</td>
</tr><tr>	
	<td>
		<?php echo $form->labelEx($model,'vat_reg_no'); ?>
	</td>
	<td>
		<?php echo $form->textField($model,'vat_reg_no',array('size'=>30)); ?>
		<?php echo $form->error($model,'vat_reg_no'); ?>
	</td>
</tr>


<tr>	
	<td>
		<?php echo $form->labelEx($model,'company_number'); ?>
	</td>
	<td>
		<?php echo $form->textField($model,'company_number',array('size'=>30)); ?>
		<?php echo $form->error($model,'company_number'); ?>
	</td>
</tr>
</table>


<h4>Postcode Anywhere Setup</h4>
<table>
<tr>	
	<td>
		<?php echo $form->labelEx($model,'postcodeanywhere_account_code'); ?>
	</td>
	<td>
		<?php echo $form->textField($model,'postcodeanywhere_account_code',array('size'=>30)); ?>
		<?php echo $form->error($model,'postcodeanywhere_account_code'); ?>
	</td>
</tr>
<tr>	
	<td>
		<?php echo $form->labelEx($model,'postcodeanywhere_license_key'); ?>
	</td>
	<td>
		<?php echo $form->textField($model,'postcodeanywhere_license_key',array('size'=>30)); ?>
		<?php echo $form->error($model,'postcodeanywhere_license_key'); ?>
	</td>
</tr>


<tr>	
	<td colspan="2">
	<small>
<i>To use Postcode Anywhere to look up postal addresses automatically please click on the <a href="../admin" target="_blank">SET ME UP</a> link and create an account for the Postcode Anywhere service.</i>
</small>
	</td>
</tr>
</table>






<h4>Live Call Setup</h4>
<table>
 
<tr>	
	<td>
		<?php //echo $form->labelEx($model,'custom4'); ?>
	</td>
	<td>
		<?php //echo $form->textField($model,'custom4',array('size'=>30)); ?>
		<?php //echo $form->error($model,'custom4'); ?>
	</td>
</tr>

<tr>	
	<td colspan="2">
	<small>
<i>To use the rapport Live Call service please enter your ID in the text box above.</i>
</small>
	</td>
</tr>
</table>









 
 

 <!-- 

	<div class="row">
		<?php //echo $form->labelEx($model,'custom4'); ?>
		<?php //echo $form->textField($model,'custom4',array('rows'=>6, 'cols'=>50)); ?>
		<?php //echo $form->error($model,'custom4'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'custom5'); ?>
		<?php echo $form->textField($model,'custom5',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'custom5'); ?>
	</div>
 -->
	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->