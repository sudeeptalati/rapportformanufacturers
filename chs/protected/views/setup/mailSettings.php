<div class="form">

<?php 
include 'setup_sidemenu.php';
?>
<h2>Mail Settings</h2>
 
 
  
<div id="submenu">   
	<li> <?php echo CHtml::link('Manage Notification Rules',array('/notificationRules/admin')); ?></li>
	<li> <?php echo CHtml::link('Create Notification Rules',array('/notificationRules/create')); ?></li>
	<li> <?php echo CHtml::link('SMS Settings',array('/setup/smsSettingsView')); ?></li>
	<li> <?php echo CHtml::link('Email Settings',array('/setup/mailSettings')); ?></li>
</div>

<br>
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'setup-mailSettings-form',
	'enableAjaxValidation'=>false,
)); ?>

	<h2>Mail Settings</h2>
	

<?php 

$root = dirname(dirname(dirname(__FILE__)));
//echo $root."<br>";
$filename = $root.'/config/mail_server.json';
$data = file_get_contents($filename);
	
	if(isset($_POST['mail_server_values']))
	{
		$smtp_host = $_POST['smtp_host'];
		//echo $smtp_host."<br>";
		$smtp_username =  $_POST['username'];
		//echo $smtp_username."<br>";
		$smtp_password = $_POST['password'];
		//echo $smtp_password."<br>";
		$smtp_encryption =  $_POST['encryption'];
		//echo $smtp_encryption."<br>";
		$smtp_port = $_POST['port'];
		//echo $smtp_port."<br>";
		$smtp_auth = $_POST['auth'];
		//echo "<br>Auth value = ".$smtp_auth;
		
		if(file_exists($filename))
		{
			//echo "File is present<br>";
			$data = file_get_contents($filename);
			$decodedata = json_decode($data, true);
				
			$decodedata['smtp_host'] = $smtp_host;
			$decodedata['smtp_username'] = $smtp_username;
			$decodedata['smtp_password'] = $smtp_password;
			$decodedata['smtp_encryption'] = $smtp_encryption;
			$decodedata['smtp_port'] = $smtp_port;
			$decodedata['smtp_auth'] = $smtp_auth;
		
			$fh = fopen($filename, 'w');
			fwrite($fh, json_encode($decodedata));
			fclose($fh);
		
		}//end of if file present.
		else
			echo "Mail settings file is not found";
	
	}//end of if(isset()). ***** END OF SAVING VALUES TO JSON FILE *******
	else //********* TAKING VALUES FROM JSON FILE **********
	{
		if(file_exists($filename))
		{
			//echo "File is present<br>";
			$data = file_get_contents($filename);
			$decodedata = json_decode($data, true);
			//echo "host = ".$decodedata['smtp_host']."<br>";
		
			$smtp_host = $decodedata['smtp_host'];
			//echo "<br>host value = ".$smtp_host;
			$smtp_username = $decodedata['smtp_username'];
			//echo "<br>user name = ".$smtp_username;
			$smtp_password = $decodedata['smtp_password'];
			//echo "<br>passowrd = ".$smtp_password;
			$smtp_encryption = $decodedata['smtp_encryption'];
			//echo "<br>encryption = ".$smtp_encryption;
			$smtp_port = $decodedata['smtp_port'];
			//echo "<br>port = ".$smtp_port;
			$smtp_auth = $decodedata['smtp_auth'];
			//echo "<br>SMTP authentication = ".$smtp_auth;
		}//end of if file exists.
		else 
			echo "Mail settings file is not found";
		
	}//end of else.
	
?>

 


<!-- ***** END OF SAVING VALUES TO JSON FILE ********* -->



	<div class="row">
		<?php echo "<b>SMTP Host</b><br>";?>
		<?php echo CHtml::textField('',$smtp_host, array('disabled'=>'disabled'));?>
	</div>
	
	<div class="row">
		<?php echo "<b>User Name</b><br>";?>
		<?php echo CHtml::textField('',$smtp_username, array('disabled'=>'disabled'));?>
	</div>
	
	<div class="row">
		<?php echo "<b>Password</b><br>";?>
		<?php echo CHtml::passwordField('',$smtp_password, array('disabled'=>'disabled'));?>
	</div>
	
	<div class="row">
		<?php echo "<b>Encryption</b><br>";?>
		<?php 
			if (empty($smtp_encryption))
			{
			?>
				<input name="server_encryption" value="none" disabled="disabled" type="input" >
			<?php
			}
			else
			{
				echo CHtml::textField('',$smtp_encryption, array('disabled'=>'disabled'));
			}
			
				
			?>
	</div>

	<div class="row">
		<?php echo "<b>Port</b><br>";?>
		<?php echo CHtml::textField('',$smtp_port, array('disabled'=>'disabled'));?>
	</div>
	
	
	<div class="row">
		<?php echo "<b>SMTP Authentication</b><br>";?>
		<?php 
			if (empty($smtp_auth))
			{
			?>
				<input name="smtp_authentication" value="none" disabled="disabled" type="input" >
			<?php
			}
			else
			{
				echo CHtml::textField('',$smtp_auth, array('disabled'=>'disabled'));
			}
			
				
			?>
	</div>
	
	<div class="row" >
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo CHtml::button('Edit', array('submit' => array('setup/mailServer'))); ?>
	</div>

	
<?php $this->endWidget(); ?>



<div style="float: right; margin-top: -478px;">
	<div>
		<b>Make sure all user emails have supports this SMTP authentication. <br>The mail will be sent using this method.  </b> 
	</div>
	<br><br><br>
	<?php $this->renderPartial('sendTestEmail'); ?>
</div><!-- END OF TEST EMAIL -->

</div><!-- form -->




