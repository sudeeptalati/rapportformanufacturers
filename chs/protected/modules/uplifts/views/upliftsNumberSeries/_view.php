<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('prefix')); ?>:</b>
	<?php echo CHtml::encode($data->prefix); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('start_from')); ?>:</b>
	<?php echo CHtml::encode($data->start_from); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('available_code')); ?>:</b>
	<?php echo CHtml::encode($data->available_code); ?>
	<br />


</div>