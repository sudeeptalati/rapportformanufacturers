<div class="form">
<style>
.first {
 	background:#94F2AB;
	border-radius:15px;  padding:10px;
	}
.second {
 	background:#B6E1FE;
	border-radius:15px;  padding:10px;
	}
	
	
</style>

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'uplifts-form',
	'enableAjaxValidation'=>true,
	'clientOptions'=>array('validateOnSubmit'=>true),
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	
<table class="first">
<tr>
	<td>	
		<?php echo $form->labelEx($model,'prefix_id'); ?>
		<?php echo $form->dropDownList($model, 'prefix_id', CHtml::listData(UpliftsNumberSeries::model()->findAll(array('order'=>"`id` ASC")), 'id', 'prefix'));?>
		<?php echo $form->error($model,'prefix_id'); ?>
		<?php echo $form->labelEx($model,'date_of_call'); ?>
		<?php //echo $form->textField($model,'date_of_call'); 
			
			if (!empty($model->date_of_call))
			{									
				$model->date_of_call=date('d-m-Y', $model->date_of_call);					
			}
			
			$this->widget('zii.widgets.jui.CJuiDatePicker', array(
			    'name'=>CHtml::activeName($model, 'date_of_call'),
				'model'=>$model,
        		'value' => $model->attributes['date_of_call'],
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
		
		
		<?php echo $form->error($model,'date_of_call'); ?>
	</td>
	<td>
		<?php echo $form->hiddenField($model,'servicecall_id'); ?>
		<?php echo $form->error($model,'servicecall_id'); ?>

		<?php echo $form->labelEx($model,'service_reference_number'); ?>
		<?php echo $form->textField($model,'service_reference_number'); ?>
		<?php echo $form->error($model,'service_reference_number'); ?>
		
	</td>
 
	<td>
		<?php echo $form->labelEx($model,'customer_id'); ?>
		<?php echo $form->hiddenField($model,'customer_id'); ?>
		<span id="Uplifts_customer_name">
		<?php 
			if (!empty($model->customer_id))
			{
				echo $model->customer->fullname;
				echo "<br>".$model->customer->town.", ".$model->customer->postcode;
			}
		?></span><br>
		
		<span id="Uplifts_customer_town_postcode"></span><br><br>
		<?php echo $form->error($model,'customer_id'); ?>	
	</td>
</tr>

</table>

<table>

<table class="second">
<tr>
	<td>
		<?php echo $form->hiddenField($model,'product_id'); ?>
		<?php echo $form->labelEx($model,'product_type_id'); ?>
		<?php echo $form->dropDownList($model, 'product_type_id', ProductType::model()->getAllProductTypesListData()); ?>
		<?php echo $form->error($model,'product_type_id'); ?>
	</td>
</tr>
<tr>
	<td>
		<?php echo $form->labelEx($model,'model_number'); ?>
		<?php 
			 	$this->widget('zii.widgets.jui.CJuiAutoComplete', array(
				    'model'=>$model,
				    'attribute'=>'model_number',
//				    'source'=>array('ac1', 'ac2', 'ac3', 'b1', 'ba', 'ba34', 'ba33'),
				    'source'=> ModelNumbers::model()->getAllModelNumbers(),
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
		<?php echo $form->error($model,'model_number'); ?>
	</td>
	<td>
		<?php echo $form->labelEx($model,'serial_number'); ?>
		<?php echo $form->textField($model,'serial_number',array('style' => 'text-transform: uppercase', )); ?>
		<?php echo $form->error($model,'serial_number'); ?>
	</td>
	<td>
		<?php echo $form->labelEx($model,'index_number'); ?>
		<?php echo $form->textField($model,'index_number'); ?>
		<?php echo $form->error($model,'index_number'); ?>
	</td>
</tr>

</table>
<table class="first">
<tr>
	<td>
		<?php echo $form->labelEx($model,'retailer_id'); ?>
		<?php //echo $form->dropDownList($model, 'retailer_id', CHtml::listData(RetailersAnddistributor_ids::model()->findAll(array('order'=>"`company` ASC")), 'id', 'company'));
				echo $form->dropDownList($model,'retailer_id',RetailersAndDistributors::model()->getListDataByType('RETAILER'), array('empty'=>array('1000000'=>'Not Known'))); ?>  <!-- 1000000 code is for RETAILERS --> 
		<?php 	echo $form->error($model,'retailer_id'); ?>
	</td>
	<td>
		<?php echo $form->labelEx($model,'retailer_contact'); ?>
		<?php echo $form->textField($model,'retailer_contact'); ?>
		<?php echo $form->error($model,'retailer_contact'); ?>
	</td>

	<td>
		<?php echo $form->labelEx($model,'retailer_phone'); ?>
		<?php echo $form->textField($model,'retailer_phone'); ?>
		<?php echo $form->error($model,'retailer_phone'); ?>
	</td>
</tr>
<tr>
	<td>
		<?php echo $form->labelEx($model,'distributor_id'); ?>
		<?php //echo $form->dropDownList($model, 'retailer_id', CHtml::listData(RetailersAnddistributor_ids::model()->findAll(array('order'=>"`company` ASC")), 'id', 'company'));
			  echo $form->dropDownList($model,'distributor_id',RetailersAndDistributors::model()->getListDataByType('DISTRIBUTOR'), array('empty'=>array('1000001'=>'Not Known'))); ?> <!-- 1000001 code is for DISTRIBUTORS --> 
		<?php echo $form->error($model,'distributor_id'); ?>
	</td>
</tr>

<tr>
	<td>
	
		<?php echo $form->labelEx($model,'purchase_date'); ?>
		<?php 
				
				if (!empty($model->purchase_date))
				{
					$model->purchase_date=date('d-m-Y',$model->purchase_date);
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
	</td>

	<td>
		<?php echo $form->labelEx($model,'exchange_date'); ?>
		<?php 
				
				if (!empty($model->exchange_date))
				{
					$model->exchange_date=date('d-m-Y',$model->exchange_date);
				}
				
				
				
				$this->widget('zii.widgets.jui.CJuiDatePicker', array(
					'name'=>CHtml::activeName($model, 'exchange_date'),
					'model'=>$model,
					'value' => $model->attributes['exchange_date'],
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
		<?php echo $form->error($model,'exchange_date'); ?>
	</td>
	<td>
		<?php echo $form->hiddenField($model,'visited_engineer_id'); ?>
		<?php echo $form->labelEx($model,'visited_engineer_name'); ?>
		<?php echo $form->textField($model,'visited_engineer_name' ); ?>
		<?php echo $form->error($model,'visited_engineer_name'); ?>
	</tr>
</tr>
</table>

<table class="second">
<tr>
	<td>

		<?php echo $form->labelEx($model,'request_type_id'); ?>
		<?php echo $form->dropDownList($model, 'request_type_id', CHtml::listData(UpliftsRequestType::model()->findAll(array('order'=>"`name` ASC")), 'id', 'name'));?>
		<?php echo $form->error($model,'request_type_id'); ?>
		
	</td>
	<td>
		<?php echo $form->labelEx($model,'price'); ?>
		<?php echo $form->textField($model,'price' ); ?>
		<?php echo $form->error($model,'price'); ?>


	</td>
</tr>


<tr>
	<td colspan="3">

	<table><tr><td>
		<?php echo $form->labelEx($model,'customer_claim_description'); ?>
		<?php echo $form->textArea($model,'customer_claim_description',array('rows'=>6, 'cols'=>35)); ?>
		<?php echo $form->error($model,'customer_claim_description'); ?>
	</td>
	<td>
		<?php echo $form->labelEx($model,'reason_for_uplift'); ?>
		<?php echo $form->textArea($model,'reason_for_uplift',array('rows'=>6, 'cols'=>35)); ?>
		<?php echo $form->error($model,'reason_for_uplift'); ?>
	</td>
	</tr>
	<tr>
	<td colspan="2">
		<?php echo $form->labelEx($model,'notes'); ?>
		<?php echo $form->textArea($model,'notes',array('rows'=>6, 'cols'=>80)); ?>
		<?php echo $form->error($model,'notes'); ?>
	</td>
	</table>
</tr>



<tr><td colspan="3">
<?php echo CHtml::submitButton($model->isNewRecord ? 'Generate the Uplift Number' : 'Save'); ?>
	</td>
	</tr>




</table>











	

		

<?php $this->endWidget(); ?>

</div><!-- form -->

<script type="text/javascript" src="<?php echo Yii::app()->baseUrl.'/js/uplifts/uplifts.js'; ?>" > </script>
