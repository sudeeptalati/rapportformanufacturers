<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('engineer_id')); ?>:</b>
	<?php echo CHtml::encode($data->engineer_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('visit_start_date')); ?>:</b>
	<?php echo CHtml::encode($data->visit_start_date); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('visit_end_date')); ?>:</b>
	<?php echo CHtml::encode($data->visit_end_date); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('slots')); ?>:</b>
	<?php echo CHtml::encode($data->slots); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('servicecall_id')); ?>:</b>
	<?php echo CHtml::encode($data->servicecall_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('user_id')); ?>:</b>
	<?php echo CHtml::encode($data->user_id); ?>
	<br />
	
	<b><?php echo CHtml::encode($data->getAttributeLabel('notes')); ?>:</b>
	<?php echo CHtml::encode($data->user_id); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('created')); ?>:</b>
	<?php echo CHtml::encode($data->created); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('modified')); ?>:</b>
	<?php echo CHtml::encode($data->modified); ?>
	<br />

	*/ ?>

</div>