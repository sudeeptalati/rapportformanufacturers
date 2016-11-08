<div class="form">

<?php 

$this->menu=array(
	array('label'=>'Register Customer', 'url'=>array('create')),
	array('label'=>'Manage Customers', 'url'=>array('admin'))
);

?>


<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'customer-viewProduct-form',
	'enableAjaxValidation'=>false,
)); ?>

<?php 

	$customer_id=$_GET['customer_id'];
	//echo $customer_id;
	$product_id=$_GET['product_id'];
	//echo $product_id;
	
	$customerModel=Customer::model()->findByPk($customer_id);
	$productModel=Product::model()->findByPk($product_id);
	$user=$customerModel->createdByUser->username;
	$brand=$productModel->brand->name;
	$type=$productModel->productType->name;
	$contract=$productModel->contract->name;
	$engineer=$productModel->engineer->fullname;
	$productUser=$productModel->createdByUser->username;

?>

<table>

	<tr>
		<td colspan="3" style="text-align:right"><b>
		<?php echo CHtml::link('Edit Details', array('Customer/openDialog', 'customer_id'=>$customer_id,'product_id'=>$product_id));?>
			
		</b></td>
	</tr>
	
	<tr>
		<td colspan="3" style="text-align:center"><h2>Customer Details</h2></td>
	</tr>
	<tr>
		<td>
			<?php echo $form->labelEx($model,'title'); ?>
			<?php echo $form->dropDownList($model,'title',array('Mr'=>'Mr', 'Miss'=>'Miss', 'Mrs'=>'Mrs','Mrs'=>'Mrs', 'Dr'=>'Dr',),array('disabled'=>'disabled')); ?>
			<?php echo $form->error($model,'title'); ?>
		</td>
		<td>
			<?php echo $form->labelEx($customerModel,'first_name'); ?>
			<?php echo $form->textField($customerModel,'first_name',array('disabled'=>'disabled')); ?>
			<?php echo $form->error($customerModel,'first_name'); ?>
		</td>
		<td>
			<?php echo $form->labelEx($customerModel,'last_name'); ?>
			<?php echo $form->textField($customerModel,'last_name',array('disabled'=>'disabled')); ?>
			<?php echo $form->error($customerModel,'last_name'); ?>
			
		</td>
	</tr>
	<tr>	
		<td>
			<?php echo $form->labelEx($customerModel,'address_line_1'); ?>
			<?php echo $form->textField($customerModel,'address_line_1',array('disabled'=>'disabled')); ?>
			<?php echo $form->error($customerModel,'address_line_1'); ?>
		</td>	
		<td>
			<?php echo $form->labelEx($customerModel,'address_line_2'); ?>
			<?php echo $form->textField($customerModel,'address_line_2',array('disabled'=>'disabled')); ?>
			<?php echo $form->error($customerModel,'address_line_2'); ?>
		</td>
		<td>	
			<?php echo $form->labelEx($customerModel,'address_line_3'); ?>
			<?php echo $form->textField($customerModel,'address_line_3',array('disabled'=>'disabled')); ?>
			<?php echo $form->error($customerModel,'address_line_3'); ?>
		</td>
	</tr>
	
		<tr>
		<td>
			<?php echo $form->labelEx($customerModel,'town'); ?>
			<?php echo $form->textField($customerModel,'town',array('disabled'=>'disabled')); ?>
			<?php echo $form->error($customerModel,'town'); ?>
		</td>
		<td>
			<?php echo $form->labelEx($customerModel,'country'); ?>
			<?php echo $form->textField($customerModel,'country',array('disabled'=>'disabled')); ?>
			<?php echo $form->error($customerModel,'country'); ?>
		</td>
		<td>
			<?php echo $form->labelEx($customerModel,'postcode'); ?>
			<?php echo $form->textField($customerModel,'postcode',array('disabled'=>'disabled')); ?>
			<?php echo $form->error($customerModel,'postcode'); ?>
		</td>
	</tr>
	<tr>
		<td>
			<?php echo $form->labelEx($customerModel,'telephone'); ?>
			<?php echo $form->textField($customerModel,'telephone',array('disabled'=>'disabled')); ?>
			<?php echo $form->error($customerModel,'telephone'); ?>
		</td>
		<td>
			<?php echo $form->labelEx($customerModel,'mobile'); ?>
			<?php echo $form->textField($customerModel,'mobile',array('disabled'=>'disabled')); ?>
			<?php echo $form->error($customerModel,'mobile'); ?>
		</td>
		<td>
			<?php echo $form->labelEx($customerModel,'fax'); ?>
			<?php echo $form->textField($customerModel,'fax',array('disabled'=>'disabled')); ?>
			<?php echo $form->error($customerModel,'fax'); ?>
		</td>
	</tr>
	<tr>
		<td>
			<?php echo $form->labelEx($customerModel,'email'); ?>
			<?php echo $form->textField($customerModel,'email',array('disabled'=>'disabled')); ?>
			<?php echo $form->error($customerModel,'email'); ?>
		</td>
		<td>
			<?php echo "Created by<br>";?>
			<?php echo CHtml::textField('',$user,array('disabled'=>'disabled')); ?>
		</td>
		<td>
			<?php echo $form->labelEx($customerModel,'notes'); ?>
			<?php echo Setup::model()->printjsonnotesorcommentsinhtml($customerModel->notes); ?>
		</td>
	</tr>
	<!-- ************************ END OF CUSTOMER DETAILS ******************** -->
		<tr>
		<td colspan="3" style="text-align:center"><h2>Product Details</h2></td>
	</tr>
	<tr>
		<td>
			<?php echo "<b>Contract Type</b><br>";?>
			<?php echo CHtml::textField('',$contract,array('disabled'=>'disabled')); ?>
		</td>
		<td>
			<?php echo "<b>Engineer Name</b><br>";?>
			<?php echo CHtml::textField('',$engineer,array('disabled'=>'disabled')); ?>
		</td>
	</tr>
	<tr>
		<td>
			<?php echo "<b>Brand Name</b><br>";?>
			<?php echo CHtml::textField('',$brand,array('disabled'=>'disabled')); ?>
		</td>
		<td>
			<?php echo "<b>Product Type</b><br>";?>
			<?php echo CHtml::textField('',$type,array('disabled'=>'disabled')); ?>
		</td>
		<td>
			<?php echo $form->labelEx($productModel,'purchased_from'); ?>
			<?php echo $form->textField($productModel,'purchased_from',array('disabled'=>'disabled')); ?>
			<?php echo $form->error($productModel,'purchased_from'); ?>
		</td>
	</tr>
	<tr>
		<td>
			<?php if(!empty($productModel->purchase_date))
					$productModel->purchase_date=date('d-M-y', $productModel->purchase_date);
			?>
			<?php echo $form->labelEx($productModel,'purchase_date'); ?>
			<?php echo $form->textField($productModel,'purchase_date',array('disabled'=>'disabled')); ?>
		</td>
		<td>
			<?php if(!empty($productModel->warranty_date))
					$productModel->warranty_date=date('d-M-y', $productModel->warranty_date);
			?>
			<?php echo $form->labelEx($productModel,'warranty_date'); ?>
			<?php echo $form->textField($productModel,'warranty_date',array('disabled'=>'disabled')); ?>
		</td>
		<td>
			<?php echo $form->labelEx($productModel,'warranty_for_months'); ?>
			<?php echo $form->textField($productModel,'warranty_for_months',array('disabled'=>'disabled')); ?>
		</td>
	</tr>
	<tr>
		<td>
			<?php echo $form->labelEx($productModel,'model_number'); ?>
			<?php echo $form->textField($productModel,'model_number',array('disabled'=>'disabled')); ?>
		</td>
		<td>
			<?php echo $form->labelEx($productModel,'serial_number'); ?>
			<?php echo $form->textField($productModel,'serial_number',array('disabled'=>'disabled')); ?>
		</td>
		<td>
			<?php echo $form->labelEx($productModel,'production_code'); ?>
			<?php echo $form->textField($productModel,'production_code',array('disabled'=>'disabled')); ?>
		</td>
	</tr>
	<tr>
		<td>
			<?php echo $form->labelEx($productModel,'enr_number'); ?>
			<?php echo $form->textField($productModel,'enr_number',array('disabled'=>'disabled')); ?>
		</td>
		<td>
			<?php echo $form->labelEx($productModel,'fnr_number'); ?>
			<?php echo $form->textField($productModel,'fnr_number',array('disabled'=>'disabled')); ?>
		</td>
		<td>
			<?php echo $form->labelEx($productModel,'purchase_price'); ?>
			<?php echo $form->textField($productModel,'purchase_price',array('disabled'=>'disabled')); ?>
		</td>
	</tr>
	<tr>
		<td>
			<?php 
				if($productModel->discontinued == 0)
					$discontinued_value = 'No';
				else 
					$discontinued_value = 'Yes';
			?>
			<?php echo $form->labelEx($productModel,'discontinued'); ?>
			<?php //echo $form->textField($productModel,'discontinued',array('disabled'=>'disabled')); ?>
			<?php echo CHtml::textField('', $discontinued_value, array('disabled'=>'disabled'));?>
		</td>
		<td>
			<?php echo $form->labelEx($productModel,'created_by_user_id'); ?>
			<?php echo CHtml::textField('',$productUser,array('disabled'=>'disabled')); ?>
		</td>
		<td>
			<?php echo $form->labelEx($productModel,'notes'); ?>
			<?php echo $form->textArea($productModel,'notes',array('rows'=>2, 'cols'=>20,'disabled'=>'disabled')); ?>
		</td>
	</tr>
</table>
	

<?php $this->endWidget(); ?>

</div><!-- form -->