<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('company')); ?>:</b>
	<?php echo CHtml::encode($data->company); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('address')); ?>:</b>
	<?php echo CHtml::encode($data->address); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('town')); ?>:</b>
	<?php echo CHtml::encode($data->town); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('postcode_s')); ?>:</b>
	<?php echo CHtml::encode($data->postcode_s); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('postcode_e')); ?>:</b>
	<?php echo CHtml::encode($data->postcode_e); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('county')); ?>:</b>
	<?php echo CHtml::encode($data->county); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('country')); ?>:</b>
	<?php echo CHtml::encode($data->country); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('email')); ?>:</b>
	<?php echo CHtml::encode($data->email); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('telephone')); ?>:</b>
	<?php echo CHtml::encode($data->telephone); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('mobile')); ?>:</b>
	<?php echo CHtml::encode($data->mobile); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('alternate')); ?>:</b>
	<?php echo CHtml::encode($data->alternate); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fax')); ?>:</b>
	<?php echo CHtml::encode($data->fax); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('postcodeanywhere_account_code')); ?>:</b>
	<?php echo CHtml::encode($data->postcodeanywhere_account_code); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('postcodeanywhere_license_key')); ?>:</b>
	<?php echo CHtml::encode($data->postcodeanywhere_license_key); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('custom1')); ?>:</b>
	<?php echo CHtml::encode($data->custom1); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('custom2')); ?>:</b>
	<?php echo CHtml::encode($data->custom2); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('custom3')); ?>:</b>
	<?php echo CHtml::encode($data->custom3); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('custom4')); ?>:</b>
	<?php echo CHtml::encode($data->custom4); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('custom5')); ?>:</b>
	<?php echo CHtml::encode($data->custom5); ?>
	<br />

	*/ ?>

</div>