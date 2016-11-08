
<div id="sidemenu">             
<?php include('setup_sidemenu.php'); ?>   
</div>

 

<h1>Create Notification Rule</h1>
 
<div id="submenu">   
	<li> <?php echo CHtml::link('Manage Notification Rules',array('/notificationRules/admin')); ?></li>
	<li> <?php echo CHtml::link('Create Notification Rules',array('/notificationRules/create')); ?></li>
	<li> <?php echo CHtml::link('SMS Settings',array('/setup/smsSettingsView')); ?></li>
	<li> <?php echo CHtml::link('Email Settings',array('/setup/mailSettings')); ?></li>
</div>

<br>
<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>