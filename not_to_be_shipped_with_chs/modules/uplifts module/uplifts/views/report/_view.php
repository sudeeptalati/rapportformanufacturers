<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('report_type')); ?>:</b>
	<?php echo CHtml::encode($data->report_type); ?>
	<br />
 

	<b><?php echo CHtml::encode($data->getAttributeLabel('field_relation')); ?>:</b>
	<?php echo CHtml::encode($data->field_relation); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('field_label')); ?>:</b>
	<?php echo CHtml::encode($data->field_label); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('sort_order')); ?>:</b>
	<?php echo CHtml::encode($data->sort_order); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('active')); ?>:</b>
	<?php echo CHtml::encode($data->active); ?>
	<br />


</div>