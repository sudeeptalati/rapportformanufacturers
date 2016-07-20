<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('task')); ?>:</b>
	<?php echo CHtml::encode($data->task); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('status')); ?>:</b>
	<?php echo CHtml::encode($data->status); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('msgbody')); ?>:</b>
	<?php echo CHtml::encode($data->msgbody); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('subject')); ?>:</b>
	<?php echo CHtml::encode($data->subject); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('send_to')); ?>:</b>
	<?php echo CHtml::encode($data->send_to); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('created')); ?>:</b>
	<?php echo CHtml::encode($data->created); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('scheduled')); ?>:</b>
	<?php echo CHtml::encode($data->scheduled); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('executed')); ?>:</b>
	<?php echo CHtml::encode($data->executed); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('finished')); ?>:</b>
	<?php echo CHtml::encode($data->finished); ?>
	<br />

	*/ ?>

</div>