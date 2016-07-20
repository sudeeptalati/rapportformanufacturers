

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'servicecall-addProduct-form',
	'enableAjaxValidation'=>true,
		'clientOptions'=>array(
				'validateOnSubmit'=>true,
				'afterValidate'=>"js:function(form,data,hasError){
                        if(hasError){
							 $('html, body').animate({ scrollTop: 0 }, 'slow');
						}
						else
						{
							return true;
						}
						}", 
		),
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php 
		$cust_id=$_GET['cust_id'];
		//echo $cust_id;
		$customerModel=Customer::model()->findByPk($cust_id);
		$str = $customerModel->address_line_1." ".$customerModel->address_line_2." ".$customerModel->address_line_3."\n";
		$str1 =  $customerModel->town."\n";
		$str2 = $customerModel->postcode_s." ".$customerModel->postcode_e;
		$address = $str." ".$str1." ".$str2;
		
		$productModel = Product::model();
	?>
	
	<?php 
		echo $form->errorSummary($model);
		echo $form->errorSummary($productModel);
	?>
	

<table>
	<tr>
		<td style="background-color: #C7E8FD; border-radius: 15px; vertical-align: top; width:90%">
			<table>
			<tr colspan='2'>
				<td>
					<h3><?php echo "Customer Details";?></h3>
				</td>
			</tr>
			<tr>
				<td style="vertical-align: top;">
					<?php echo $form->labelEx($customerModel,'fullname'); ?>
					<?php echo CHtml::textField('',  $customerModel->fullname, array('disabled'=>'disabled')); ?>
					
				</td>
				<td style="vertical-align: top;">
					<b><?php echo "Address";?></b>
					<br>
					<?php echo CHtml::textArea('',   $address , array('disabled'=>'disabled', 'rows'=>4, 'cols'=>40)); ?>
		 
				</td>
			</tr>
			<tr>
				<td style="vertical-align: top;">
					<?php echo $form->labelEx($customerModel,'email'); ?>
					<?php echo CHtml::textField('',  $customerModel->email, array('disabled'=>'disabled')); ?>
				</td>
				<td style="vertical-align: top;">
					<b><?php echo "Telephone/Mobile";?></b>
					<br>
					<?php echo CHtml::textField('',  $customerModel->telephone, array('disabled'=>'disabled')); ?>					<br>
					<?php echo CHtml::textField('',  $customerModel->mobile, array('disabled'=>'disabled')); ?>

				</td>
			</tr>
			
			
			</table>
		</td>
	</tr>
	<tr><td></td></tr>
	<tr>
		<td style="background-color: #FFD8B3; border-radius: 15px; vertical-align: top; width:90%">
			<table>
			<tr>
			<td><h3 style="margin-bottom:0.01px;">Service Call Details</h3></td>
			</tr>
 			<tr>
				<td style="vertical-align: top;">	
					<?php echo $form->labelEx($model,'fault_date'); ?>
					<?php 
				
					$model->fault_date=date('d-m-Y');
					$this->widget('zii.widgets.jui.CJuiDatePicker', array(
				    'name'=>CHtml::activeName($model, 'fault_date'),
					'model'=>$model,
		       		'value' => $model->attributes['fault_date'],
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
					<?php echo $form->error($model,'fault_date'); ?>

					<?php echo $form->labelEx($model,'fault_description'); ?>
					<?php echo $form->textArea($model,'fault_description',array('rows'=>3, 'cols'=>40)); ?>
					<?php echo $form->error($model,'fault_description'); ?>
					
					<br><br><br>
					<?php echo $form->labelEx($model,'comments'); ?>
					<?php echo $form->textArea($model,'comments',array('rows'=>4, 'cols'=>40)); ?>
					<br><small>Not Visible on call Sheet</small>
					<?php echo $form->error($model,'comments'); ?>
				</td>
				<td style="vertical-align: top;">
					<?php echo $form->labelEx($model,'fault_code'); ?>
					<?php echo $form->textField($model,'fault_code'); ?>
					<?php echo $form->error($model,'fault_code'); ?>
					
					
					<?php echo $form->labelEx($model,'insurer_reference_number'); ?>
					<?php echo $form->textField($model,'insurer_reference_number'); ?>
					<?php echo $form->error($model,'insurer_reference_number'); ?>
					
									
					<?php echo $form->labelEx($model,'recalled_job'); ?>
					<?php echo $form->dropDownList($model,'recalled_job',array( '0'=>'No', '1'=>'Yes')); ?>
					<?php echo $form->error($model,'recalled_job'); ?>
					

					<?php echo $form->labelEx($model,'notes'); ?>
					<?php echo $form->textArea($model,'notes',array('rows'=>4, 'cols'=>40)); ?>
					<?php echo $form->error($model,'notes'); ?>
			
				</td>
			</tr>
			</table>
		</td>
	</tr>
	</tr>
	<tr><td></td></tr>
	<tr>
		<td style="background-color: #ADEBAD; border-radius: 15px; vertical-align: top; width:90%">
			<table>
			<tr colspan='3'>
				<td><h3 style="margin-bottom:0.01px;">Product Details</h3></td>
			</tr>
			<tr>
				<td>
					<?php echo $form->labelEx($productModel,'brand_id'); ?><small><b><a href="index.php?r=brand/admin"  target="_blank">Click here to acivate More Brands</a> </b></small>
					<?php echo CHtml::activeDropDownList($productModel, 'brand_id', $productModel->getAllBrands());?>
					<?php echo $form->error($productModel,'brand_id'); ?>
				</td>
				<td>
					<?php echo $form->labelEx($productModel,'product_type_id'); ?>
					<?php echo CHtml::activeDropDownList($productModel, 'product_type_id', ProductType::model()->getActiveProductTypesListData(), array('empty'=>array('1000000'=>'Not Known')));?>
					<?php echo $form->error($productModel,'product_type_id'); ?>
				</td>	
				<td>
					<?php echo $form->labelEx($productModel,'model_number'); ?>
					<?php //echo $form->textField($productModel,'model_number',array('size'=>30)); ?>
					<?php echo $form->error($productModel,'model_number'); ?>
					<?php 
						$this->widget('zii.widgets.jui.CJuiAutoComplete', array(
							'model'=>$productModel,
							'attribute'=>'model_number',
							//'source'=>$this->createUrl('jui/autocompleteTest'),
							//'source'=>array('ac1', 'ac2', 'ac3', 'b1', 'ba', 'ba34', 'ba33'),
							'source'=>ModelNumbers::model()->getAllModelNumbers(),
							// additional javascript options for the autocomplete plugin
							'options' => array(
								'showAnim' => 'fold',
								//'select' => 'js:function(event, ui){ alert(ui.item.value) }',
							),
							'htmlOptions' => array(
								'style'=>'height:20px;',
							   // 'onClick' => 'document.getElementById("test1_id").value=""'
							),
							'cssFile'=>false,
						));
						
					
					?>
					
				</td>
			</tr>
			
			<tr>

				<td >
					<?php echo $form->labelEx($productModel,'serial_number'); ?>
					<?php echo $form->textField($productModel,'serial_number',array('size'=>30	)); ?>
					<?php echo $form->error($productModel,'serial_number'); ?>
				</td>	
		 
				<td>
					<?php echo $form->labelEx($productModel,'enr_number'); ?>
					<?php echo $form->textField($productModel,'enr_number',array('size'=>30)); ?>
					<?php echo $form->error($productModel,'enr_number'); ?>
				</td>
				<td>
					<?php echo $form->labelEx($productModel,'fnr_number'); ?>
					<?php echo $form->textField($productModel,'fnr_number',array('size'=>30)); ?>
					<?php echo $form->error($productModel,'fnr_number'); ?>
				</td>
				
			</tr>

			<tr><td colspan="3"><br><b><i>Warranty Details</i></b></td></tr>
			<tr>
					<td>
						<?php echo $form->labelEx($productModel,'contract_id'); ?>
						<?php echo CHtml::activeDropDownList($productModel, 'contract_id', $productModel->getAllContract(), array('empty'=>array('1000000'=>'Not Known')));?>
						<?php echo $form->error($productModel,'contract_id'); ?>
				</td>
				<td>			
					<?php echo $form->labelEx($productModel,'warranty_date'); ?>
					<?php 
						$this->widget('zii.widgets.jui.CJuiDatePicker', array(
							'name'=>CHtml::activeName($productModel, 'warranty_date'),
							'model'=>$productModel,
							'value' => $productModel->attributes['warranty_date'],
							// additional javascript options for the date picker plugin
							'options'=>array(
								'showAnim'=>'fold',
								'dateFormat' => 'dd-mm-yy',
								'onSelect'=> 'js:function(selectedDate) {console.log("Hiiiii "+selectedDate);document.getElementById("Product_purchase_date").value=selectedDate}',

							),
							'htmlOptions'=>array(
								'style'=>'height:20px;'
							),
						));	
					?>
					<?php //echo $form->textField($productModel,'warranty_date'); ?>
					<?php echo $form->error($productModel,'warranty_date'); ?>
				</td>
				<td>
						<?php echo $form->labelEx($productModel,'warranty_for_months'); ?>
						<?php //echo $form->textField($productModel,'warranty_for_months',array('size'=>30)); ?>
						<?php 	$range=array();
								$range=range(0, 120);
								echo $form->dropDownList($productModel,'warranty_for_months',array($range)); ?>

						<?php echo $form->error($productModel,'warranty_for_months'); ?>
				</td>
				

			</tr>

			<tr><td colspan="3"><br><b><i>Purchase Details</i></b></td></tr>

			<tr>
				<td>
					<?php echo $form->labelEx($productModel,'purchased_from'); ?>
					<?php //echo $form->textField($productModel,'purchased_from',array('size'=>30)); ?>
					<?php 
						$this->widget('zii.widgets.jui.CJuiAutoComplete', array(
							'model'=>$productModel,
							'attribute'=>'purchased_from',
							//'source'=>$this->createUrl('jui/autocompleteTest'),
							//'source'=>array('ac1', 'ac2', 'ac3', 'b1', 'ba', 'ba34', 'ba33'),
							'source'=>Engineer::model()->getAllCompanyNamesArray(),
							// additional javascript options for the autocomplete plugin
							'options' => array(
								'showAnim' => 'fold',
								//'select' => 'js:function(event, ui){ alert(ui.item.value) }',
							),
							'htmlOptions' => array(
								'style'=>'height:20px;',
							   // 'onClick' => 'document.getElementById("test1_id").value=""'
							),
							'cssFile'=>false,
						));
						
					
					?>
					
					
					
					<?php echo $form->error($productModel,'purchased_from'); ?>
				</td>
				<td>
						<?php echo $form->labelEx($productModel,'purchase_date'); ?>
						<?php 
							$this->widget('zii.widgets.jui.CJuiDatePicker', array(
								'name'=>CHtml::activeName($productModel, 'purchase_date'),
								'model'=>$productModel,
								'value' => $productModel->attributes['purchase_date'],
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
						<?php //echo $form->textField($productModel,'purchase_date'); ?>
						<?php echo $form->error($productModel,'purchase_date'); ?>
				</td>
				

				
				<td>
						<?php echo $form->labelEx($productModel,'purchase_price'); ?>
						<?php echo $form->textField($productModel,'purchase_price',array('size'=>5)); ?>
						<?php echo $form->error($productModel,'purchase_price'); ?>
				</td>
			</tr>
			 <tr>
				<td>
					<?php echo $form->labelEx($productModel,'discontinued'); ?>
					<?php echo $form->dropDownList($productModel,'discontinued', array('0'=>'No', '1'=>'Yes')); ?>
					<?php echo $form->error($productModel,'discontinued'); ?>
				</td>
				
				<td>
				<?php echo $form->labelEx($productModel,'notes'); ?>
				<?php echo $form->textArea($productModel,'notes',array('rows'=>4, 'cols'=>40)); ?>
				<?php echo $form->error($productModel,'notes'); ?>
				</td>
			 </tr>
			</table>
		</td>
	</tr>
		
	<tr><td></td></tr>
 
		
	<tr><td style="background-color: #F3B6B7; border-radius: 15px; vertical-align: top;">
	<!-- CODE FOR MASTER TABLE TO CHANGE COLOR END -->

	<table style="width:400px; margin:10px;">
		<tr><td colspan="2"><h3 style="margin-bottom:0.01px;color:#555;"><label>Assign Engineer</label></h3></td></tr>
		<tr>
		<td>
			<?php echo $form->labelEx($productModel,'engineer_id'); ?>
			<?php //echo $form->textField($model,'engineer_id'); ?>
			<?php echo CHtml::activeDropDownList($productModel, 'engineer_id', Engineer::model()->getAllEnggAndCompany(), array('empty'=>array('90000000'=>'Not Assigned')));?>
			<?php //CHtml::listData(Engineer::model()->findAll(array('order'=>"`company` ASC")), 'id', 'company');?>
			<br><small><b><a href="index.php?r=engineer/create"  target="_blank">Click here to add More Engineers</a> </b></small><br>
			
			<?php echo $form->error($productModel,'engineer_id'); ?>
		</td>
		<td> 
			<?php echo CHtml::submitButton($model->isNewRecord ? 'Raise Call' : 'Save'); ?>
		</td>
		</tr>
	</table>
	
</tr>

		
</table>
	
 
	

<?php $this->endWidget(); ?>

</div><!-- form -->


