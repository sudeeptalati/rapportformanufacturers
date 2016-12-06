
<div id="sidemenu">             
<?php include('setup_sidemenu.php'); ?>   
</div>

<h1>Tasks Lifetime value</h1>

<div id="submenu">   
<li><?php echo CHtml::link('Perform Tasks',array('/tasksToDo/completeTasks')); ?></li>
<li><?php echo CHtml::link('Manage Tasks',array('/tasksToDo/admin')); ?></li>
<li><?php echo CHtml::link('Tasks Lifetime',array('/tasksToDo/tasksLifetime')); ?></li>
</div>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'tasks-to-do-updateTasksLifetime-form',
	'enableAjaxValidation'=>false,
)); ?>

	
	<?php
	
		$lifetime_val = '';
		$advancedModel = AdvanceSettings::model()->findAllByAttributes(array('parameter'=>'notification_lifetime'));
		foreach($advancedModel as $lifetime)
		{
			$lifetime_val = $lifetime->value;
			//echo "<br>Lifetime val = ".$lifetime_val;
		}//end of advanced foreach.
	
	?>

	<div class="row">
		<br><br>
		<b>Tasks Lifetime </b>&nbsp;(in Days)<br>
		<?php echo CHtml::textField('lifetime_update_value', $lifetime_val, array('id'=>'lifetime_update_value', 'type'=>'number')); ?><br>
		<small>This is the life time of tasks, until when tasks are held in the system. Any Task older than the provided value will be automatically deleted. Currenty the System have Major task of notifying customers by email and sms.</small>
		<?php //echo CHtml::CheckBox('delivery_checkbox', $delivery_checkbox_status, array ('value'=>'', 'id'=>'delivery-checkbox-id')); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::button('Submit', array('submit' => array('tasksToDo/tasksLifetime'))); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->