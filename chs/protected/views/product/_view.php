<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('contract_id')); ?>:</b>
	<?php echo CHtml::encode($data->contract_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('brand_id')); ?>:</b>
	<?php echo CHtml::encode($data->brand_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('product_type_id')); ?>:</b>
	<?php echo CHtml::encode($data->product_type_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('customer_id')); ?>:</b>
	<?php echo CHtml::encode($data->customer_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('engineer_id')); ?>:</b>
	<?php echo CHtml::encode($data->engineer_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('purchased_from')); ?>:</b>
	<?php echo CHtml::encode($data->purchased_from); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('purchase_date')); ?>:</b>
	<?php echo CHtml::encode($data->purchase_date); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('warranty_date')); ?>:</b>
	<?php echo CHtml::encode($data->warranty_date); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('model_number')); ?>:</b>
	<?php echo CHtml::encode($data->model_number); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('serial_number')); ?>:</b>
	<?php echo CHtml::encode($data->serial_number); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('production_code')); ?>:</b>
	<?php echo CHtml::encode($data->production_code); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('enr_number')); ?>:</b>
	<?php echo CHtml::encode($data->enr_number); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fnr_number')); ?>:</b>
	<?php echo CHtml::encode($data->fnr_number); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('discontinued')); ?>:</b>
	<?php echo CHtml::encode($data->discontinued); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('warranty_for_months')); ?>:</b>
	<?php echo CHtml::encode($data->warranty_for_months); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('purchase_price')); ?>:</b>
	<?php echo CHtml::encode($data->purchase_price); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('notes')); ?>:</b>
	<?php echo CHtml::encode($data->notes); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('created_by_user_id')); ?>:</b>
	<?php echo CHtml::encode($data->created_by_user_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('created')); ?>:</b>
	<?php echo CHtml::encode($data->created); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('modified')); ?>:</b>
	<?php echo CHtml::encode($data->modified); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('cancelled')); ?>:</b>
	<?php echo CHtml::encode($data->cancelled); ?>
	<br />

	*/ ?>

</div>