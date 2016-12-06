<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('url')); ?>:</b>
	<?php echo CHtml::encode($data->url); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ftp_username')); ?>:</b>
	<?php echo CHtml::encode($data->ftp_username); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ftp_password')); ?>:</b>
	<?php echo CHtml::encode($data->ftp_password); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ftp_port')); ?>:</b>
	<?php echo CHtml::encode($data->ftp_port); ?>
	<br />


</div>