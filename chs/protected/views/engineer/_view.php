<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('first_name')); ?>:</b>
	<?php echo CHtml::encode($data->first_name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('last_name')); ?>:</b>
	<?php echo CHtml::encode($data->last_name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('active')); ?>:</b>
	<?php echo CHtml::encode($data->active); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('company')); ?>:</b>
	<?php echo CHtml::encode($data->company); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('vat_reg_number')); ?>:</b>
	<?php echo CHtml::encode($data->vat_reg_number); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('notes')); ?>:</b>
	<?php echo CHtml::encode($data->notes); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('inactivated_by_user_id')); ?>:</b>
	<?php echo CHtml::encode($data->inactivated_by_user_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('inactivated_on')); ?>:</b>
	<?php echo CHtml::encode($data->inactivated_on); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('contact_details_id')); ?>:</b>
	<?php echo CHtml::encode($data->contact_details_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('delivery_contact_details_id')); ?>:</b>
	<?php echo CHtml::encode($data->delivery_contact_details_id); ?>
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

	*/ ?>

</div>