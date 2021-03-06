<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'product-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>
	
	<!-- FIRST PART TO DISPLAY CUSTOMER DETAILS. -->
	<?php 
	$customerId=$_GET['id'];
	//$model->customer_id=$customerId;
	//echo "ID FROM URL".$productId;
	$model->customer_id=$customerId;
	//$model->lockcode=0;
	//echo "<hr>CUSTOMER ID IN FORM FROM MODEL :".$model->customer_id;
	
	$customerModel=Customer::model()->findByPk($customerId);
	
	$str1=$customerModel->address_line_1." ".$customerModel->address_line_2." ".$customerModel->address_line_3."\n";
	$address=$str1." ".$customerModel->town."\n ".$customerModel->postcode_s;
	
	?>
	
	<table><tr>
	
	<td>
		<?php echo $form->labelEx($customerModel,'title'); ?>
		<?php echo $form->textField($customerModel,'title',array('disabled'=>'disabled')); ?>
		<?php echo $form->error($customerModel,'title'); ?>
	</td>

	<td>
		<?php echo $form->labelEx($customerModel,'fullname'); ?>
		<?php echo $form->textField($customerModel,'fullname',array('disabled'=>'disabled')); ?>
		<?php echo $form->error($customerModel,'fullname'); ?>
	</td>

	<td>
		<?php echo "<br>Address<br>" ,
		  		 CHtml::textArea('Address', $address,  array('rows'=>4, 'cols'=>20,'disabled'=>'disabled')); ?>
	</td>
	</tr>
	
	<!--  SECOND PART TO DISPLAY FIELDS OF PRODUCT FORM.  -->
	
	<tr><td colspan="2" style="text-align:center">
		<h2>Product Details</h2>
		</td>
	</tr>
	
	<tr> 
	<td>
		<?php echo $form->labelEx($model,'contract_id'); ?>
		<?php //echo $form->textField($model,'contract_id'); ?>
		<?php echo CHtml::activeDropDownList($model, 'contract_id', $model->getAllContract());?>
		<?php echo $form->error($model,'contract_id'); ?>
	</td>
	
	<td>
		<?php echo $form->labelEx($model,'engineer_id'); ?>
		<?php //echo $form->textField($model,'engineer_id'); ?>
		<?php echo CHtml::activeDropDownList($model, 'engineer_id', Engineer::model()->getAllEnggAndCompany());?>
		<?php echo $form->error($model,'engineer_id'); ?>
	</td>
		<?php //echo $form->labelEx($model,'customer_id'); ?>
		<?php //HIDDEN FIELD OF CUSTOMER ID, WHICH HAS THE VALUE OF EXISTING CUSTOMER ID.?>
		<?php echo $form->hiddenField($model,'customer_id'); ?>
		<?php echo $form->error($model,'customer_id'); ?>
	<td>
		
	</td>
	</tr>
	
	<tr>

	<td>
		<?php echo $form->labelEx($model,'brand_id'); ?>
		<?php //echo $form->textField($model,'brand_id'); ?>
		<?php echo CHtml::activeDropDownList($model, 'brand_id', $model->getAllBrands());?>
		<?php echo $form->error($model,'brand_id'); ?>
	</td>

	<td>
		<?php echo $form->labelEx($model,'product_type_id'); ?>
		<?php //echo $form->textField($model,'product_type_id'); ?>
		<?php echo CHtml::activeDropDownList($model, 'product_type_id', $model->getProductTypes());?>
		<?php echo $form->error($model,'product_type_id'); ?>
	</td>
	
	</tr>
	
	<tr>
		<td>
		<table>
		<tr>
			<?php echo $form->labelEx($model,'model_number'); ?>
			<?php echo $form->textField($model,'model_number',array('rows'=>6, 'cols'=>50)); ?>
			<?php echo $form->error($model,'model_number'); ?>
		</tr>
		<tr>
			<?php echo $form->labelEx($model,'serial_number'); ?>
			<?php echo $form->textField($model,'serial_number',array('rows'=>6, 'cols'=>50)); ?>
			<?php echo $form->error($model,'serial_number'); ?>
		</tr>
		<tr>
			<?php echo $form->labelEx($model,'enr_number'); ?>
			<?php echo $form->textField($model,'enr_number',array('rows'=>6, 'cols'=>50)); ?>
			<?php echo $form->error($model,'enr_number'); ?>
		</tr>
		<tr>
			<?php echo $form->labelEx($model,'fnr_number'); ?>
			<?php echo $form->textField($model,'fnr_number',array('rows'=>6, 'cols'=>50)); ?>
			<?php echo $form->error($model,'fnr_number'); ?>
		</tr>
		<tr>
			<?php echo $form->labelEx($model,'production_code'); ?>
			<?php echo $form->textField($model,'production_code',array('rows'=>6, 'cols'=>50)); ?>
			<?php echo $form->error($model,'production_code'); ?>
		</tr>
		<tr>
			<?php echo $form->labelEx($model,'purchase_price'); ?>
			<?php echo $form->textField($model,'purchase_price'); ?>
			<?php echo $form->error($model,'purchase_price'); ?>
		</tr>
		<tr>
			<?php echo $form->labelEx($model,'discontinued'); ?>
			<?php echo $form->textField($model,'discontinued'); ?>
			<?php echo $form->error($model,'discontinued'); ?>
		</tr>
		</table>
		</td>
		<td>
		<table>
		<tr>
			<?php echo $form->labelEx($model,'purchased_from'); ?>
			<?php echo $form->textField($model,'purchased_from',array('rows'=>6, 'cols'=>50)); ?>
			<?php echo $form->error($model,'purchased_from'); ?>
		</tr>
		<tr>
			<?php echo $form->labelEx($model,'purchase_date'); ?>
			<?php //echo $form->textField($model,'purchase_date'); ?>
			<?php 
				if(!empty($model->purchase_date))
				{
					$model->purchase_date=date('d-m-Y');
				}
				$this->widget('zii.widgets.jui.CJuiDatePicker', array(
				    'name'=>CHtml::activeName($model, 'purchase_date'),
					'model'=>$model,
	        		'value' => $model->attributes['purchase_date'],
				    // additional javascript options for the date picker plugin
				    'options'=>array(
				        'showAnim'=>'fold',
						'dateFormat' => 'dd-mm-yy',
				    ),
				    'htmlOptions'=>array(
				        'style'=>'height:20px;'
				    ),
				));
			?>
			<?php echo $form->error($model,'purchase_date'); ?>
		</tr>
		<tr>
			<?php echo $form->labelEx($model,'warranty_date'); ?>
			<?php //echo $form->textField($model,'warranty_date'); ?>
			<?php
				 if(!empty($model->warranty_date))
				{
					$model->warranty_date=date('d-m-Y');
				} 
				
				$this->widget('zii.widgets.jui.CJuiDatePicker', array(
				    'name'=>CHtml::activeName($model, 'warranty_date'),
					'model'=>$model,
	        		'value' => $model->attributes['warranty_date'],
				    // additional javascript options for the date picker plugin
				    'options'=>array(
				        'showAnim'=>'fold',
						'dateFormat' => 'dd-mm-yy',
				    ),
				    'htmlOptions'=>array(
				        'style'=>'height:20px;'
				    ),
				));
			?>
			<?php echo $form->error($model,'warranty_date'); ?>
		</tr>
		<tr>
			<?php echo $form->labelEx($model,'warranty_for_months'); ?>
			<?php echo $form->textField($model,'warranty_for_months'); ?>
			<?php echo $form->error($model,'warranty_for_months'); ?>
		</tr>
		
		<tr>
			<?php echo $form->labelEx($model,'notes'); ?>
			<?php echo $form->textArea($model,'notes',array('rows'=>5, 'cols'=>20)); ?>
			<?php echo $form->error($model,'notes'); ?>
		</tr>
		
		</table>
		</td>
	</tr>

	<!--<div class="row">
		<?php //echo $form->labelEx($model,'created_by_user_id'); ?>
		<?php //echo $form->textField($model,'created_by_user_id'); ?>
		<?php //echo $form->error($model,'created_by_user_id'); ?>
	</div>

	<div class="row">
		<?php //echo $form->labelEx($model,'created'); ?>
		<?php //echo $form->textField($model,'created'); ?>
		<?php //echo $form->error($model,'created'); ?>
	</div>

	<div class="row">
		<?php //echo $form->labelEx($model,'modified'); ?>
		<?php //echo $form->textField($model,'modified'); ?>
		<?php //echo $form->error($model,'modified'); ?>
	</div>

	<div class="row">
		<?php //echo $form->labelEx($model,'cancelled'); ?>
		<?php //echo $form->textField($model,'cancelled'); ?>
		<?php //echo $form->error($model,'cancelled'); ?>
	</div>

	-->
	</table>
	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->