<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('job_status_id')); ?>:</b>
	<?php echo CHtml::encode($data->job_status_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('active')); ?>:</b>
	<?php echo CHtml::encode($data->active); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('customer_notification_code')); ?>:</b>
	<?php echo CHtml::encode($data->customer_notification_code); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('engineer_notification_code')); ?>:</b>
	<?php echo CHtml::encode($data->engineer_notification_code); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('warranty_provider_notification_code')); ?>:</b>
	<?php echo CHtml::encode($data->warranty_provider_notification_code); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('notify_others')); ?>:</b>
	<?php echo CHtml::encode($data->notify_others); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('created')); ?>:</b>
	<?php echo CHtml::encode($data->created); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('modified')); ?>:</b>
	<?php echo CHtml::encode($data->modified); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('delete')); ?>:</b>
	<?php echo CHtml::encode($data->delete); ?>
	<br />

	*/ ?>

</div>