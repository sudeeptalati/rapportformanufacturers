<div class="form">


<div id="sidemenu">             
<?php include('setup_sidemenu.php'); ?>   
</div>
<h1>Notifications: SMS Settings</h1>
 
<div id="submenu">   
	<li> <?php echo CHtml::link('Manage Notification Rules',array('/notificationRules/admin')); ?></li>
	<li> <?php echo CHtml::link('Create Notification Rules',array('/notificationRules/create')); ?></li>
	<li> <?php echo CHtml::link('SMS Settings',array('/setup/smsSettingsView')); ?></li>
	<li> <?php echo CHtml::link('Email Settings',array('/setup/mailSettings')); ?></li>
</div>

<br>

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'setup-smsSettingsView-form',
	'enableAjaxValidation'=>false,
));
?>

<?php 

$root = dirname(dirname(dirname(__FILE__)));
//echo $root."<br>";
$filename = $root.'/config/smsgateway_settings.json';
//$data = file_get_contents($filename);

	if(isset($_POST['smsgateway_setting_values']))
	{
		/***** GETTING DATA FROM smsSettingsForm *************/
		$gateway_username = $_POST['gateway_username'];
		//echo $gateway_username;
		$gateway_password =  $_POST['gateway_password'];
		//echo "<br>".$gateway_password;
		$gateway_apikey = $_POST['gateway_apikey'];
		//echo "<br>Api key = ".$gateway_apikey;
		/***** END OF GETTING DATA FROM smsSettingsForm *************/
		
		if(file_exists($filename))
		{
			//echo "<br>File is present";
			$smsdata = file_get_contents($filename);
			$smsDecodedData = json_decode($smsdata, true);
		
			$smsDecodedData['gateway_username'] = $gateway_username;
			$smsDecodedData['gateway_password'] = $gateway_password;
			$smsDecodedData['gateway_apikey'] = $gateway_apikey;
		
			$fh = fopen($filename, 'w');
			fwrite($fh, json_encode($smsDecodedData));
			fclose($fh);
		}//end of if(file_exists()).
		else 
			echo "SMS Settings file is not found";
		 
	}//end of if(isset($_POST)).***** END OF TAKING VALUES FROM FORM *******
	else
	{
		if(file_exists($filename))
		{
			//echo "File exixts";
			$smsdata = file_get_contents($filename);
			$smsDecodedData = json_decode($smsdata, true);
			//echo "<br>";
			//print_r($smsDecodedData);
			
			$gateway_username = $smsDecodedData['gateway_username'];
			//echo "<br>user name = ".$gateway_username;
			$gateway_password = $smsDecodedData['gateway_password'];
			//echo "<br>password = ".$gateway_password;
			$gateway_apikey = $smsDecodedData['gateway_apikey'];
			//echo "<br>Api key = ".$gateway_apikey;
			
		}//end of if(file_exists()).
		else
			echo "SMS Settings file is not found";
	}//end of else.
	
	
	
?>

<!-- ****** CODE TO REPLACE JSON FILE WITH CHANGED DATA ********* -->

<?php 
/*


if(file_exists($filename))
{
	//echo "<br>File is present";
	$smsdata = file_get_contents($filename);
	$smsDecodedData = json_decode($smsdata, true);
	
	$smsDecodedData['gateway_username'] = $gateway_username;
	$smsDecodedData['gateway_password'] = $gateway_password;
	$smsDecodedData['gateway_apikey'] = $gateway_apikey;
	
	$fh = fopen($filename, 'w');
	fwrite($fh, json_encode($smsDecodedData));
	fclose($fh);
}
*/

?>
	
<!-- ****** END OF CODE TO REPLACE JSON FILE WITH CHANGED DATA ********* -->	
	
	
<!-- ********** DISPLAYING CHANGED DATA ************ -->
	
	<div class="row">
		<?php echo "<b>User Name</b><br>";?>
		<?php echo CHtml::textField('',$gateway_username, array('disabled'=>'disabled'));?>
	</div>
	
	<div class="row">
		<?php echo "<b>Password</b><br>";?>
		<?php echo CHtml::textField('',$gateway_password, array('disabled'=>'disabled'));?>
	</div>
	
	<div class="row">
		<?php echo "<b>Api Key</b><br>";?>
		<?php echo CHtml::textField('',$gateway_apikey, array('disabled'=>'disabled'));?>
	</div>
	
	<div class="row" >
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo CHtml::button('Edit', array('submit' => array('setup/smsSettingsForm'))); ?>
	</div>
	
<!-- ********** DISPLAYING CHANGED DATA ************ -->	
	

<?php $this->endWidget(); ?>

</div><!-- form -->