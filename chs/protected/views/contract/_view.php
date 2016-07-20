<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('contract_type_id')); ?>:</b>
	<?php echo CHtml::encode($data->contract_type_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('name')); ?>:</b>
	<?php echo CHtml::encode($data->name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('main_contact_details_id')); ?>:</b>
	<?php echo CHtml::encode($data->main_contact_details_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('management_contact_details')); ?>:</b>
	<?php echo CHtml::encode($data->management_contact_details); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('spares_contact_details')); ?>:</b>
	<?php echo CHtml::encode($data->spares_contact_details); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('accounts_contact_details')); ?>:</b>
	<?php echo CHtml::encode($data->accounts_contact_details); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('technical_contact_details_id')); ?>:</b>
	<?php echo CHtml::encode($data->technical_contact_details_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('vat_reg_number')); ?>:</b>
	<?php echo CHtml::encode($data->vat_reg_number); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('notes')); ?>:</b>
	<?php echo CHtml::encode($data->notes); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('active')); ?>:</b>
	<?php echo CHtml::encode($data->active); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('inactivated_by_user_id')); ?>:</b>
	<?php echo CHtml::encode($data->inactivated_by_user_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('inactivated_on')); ?>:</b>
	<?php echo CHtml::encode($data->inactivated_on); ?>
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