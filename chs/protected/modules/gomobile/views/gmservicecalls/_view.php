<?php
/* @var $this GmServicecallsController */
/* @var $data GmServicecalls */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('servicecall_id')); ?>:</b>
	<?php echo CHtml::encode($data->servicecall_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('mobile_status')); ?>:</b>
	<?php echo CHtml::encode($data->mobile_status_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('created')); ?>:</b>
	<?php echo CHtml::encode($data->created); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('modified')); ?>:</b>
	<?php echo CHtml::encode($data->modified); ?>
	<br />


</div>