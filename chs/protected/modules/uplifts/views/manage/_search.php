<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'id'); ?>
		<?php echo $form->textField($model,'id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'uplift_number'); ?>
		<?php echo $form->textArea($model,'uplift_number',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'prefix_id'); ?>
		<?php echo $form->textField($model,'prefix_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'servicecall_id'); ?>
		<?php echo $form->textField($model,'servicecall_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'customer_id'); ?>
		<?php echo $form->textField($model,'customer_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'product_id'); ?>
		<?php echo $form->textField($model,'product_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'product_type_id'); ?>
		<?php echo $form->textArea($model,'product_type_id',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'retailer_id'); ?>
		<?php echo $form->textField($model,'retailer_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'retailer_contact'); ?>
		<?php echo $form->textArea($model,'retailer_contact',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'retailer_phone'); ?>
		<?php echo $form->textArea($model,'retailer_phone',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'distributor_id'); ?>
		<?php echo $form->textArea($model,'distributor_id',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'visited_engineer_id'); ?>
		<?php echo $form->textField($model,'visited_engineer_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'visited_engineer_name'); ?>
		<?php echo $form->textArea($model,'visited_engineer_name',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'date_of_call'); ?>
		<?php echo $form->textField($model,'date_of_call'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'reason_for_uplift'); ?>
		<?php echo $form->textArea($model,'reason_for_uplift',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'request_type_id'); ?>
		<?php echo $form->textField($model,'request_type_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'model_number'); ?>
		<?php echo $form->textArea($model,'model_number',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'serial_number'); ?>
		<?php echo $form->textArea($model,'serial_number',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'index_number'); ?>
		<?php echo $form->textArea($model,'index_number',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'purchase_date'); ?>
		<?php echo $form->textField($model,'purchase_date'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'exchange_date'); ?>
		<?php echo $form->textField($model,'exchange_date'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'authorised_by'); ?>
		<?php echo $form->textField($model,'authorised_by'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'price'); ?>
		<?php echo $form->textArea($model,'price',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'customer_claim_description'); ?>
		<?php echo $form->textArea($model,'customer_claim_description',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'notes'); ?>
		<?php echo $form->textArea($model,'notes',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'created'); ?>
		<?php echo $form->textField($model,'created'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'modified'); ?>
		<?php echo $form->textField($model,'modified'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'created_by'); ?>
		<?php echo $form->textField($model,'created_by'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'modified_by'); ?>
		<?php echo $form->textField($model,'modified_by'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->