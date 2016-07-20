
<div id="sidemenu">             
<?php include('setup_sidemenu.php'); ?>   
</div>
<h1>Notifications: SMS Settings</h1>
 
<div id="submenu">   
	<li> <?php echo CHtml::link('Manage Notification Rules',array('/notificationRules/admin')); ?></li>
	<li> <?php echo CHtml::link('Create Notification Rules',array('/notificationRules/create')); ?></li>
	<li> <?php echo CHtml::link('SMS Settings',array('/setup/smsSettingsView')); ?></li>
	<li> <?php echo CHtml::link('Email Settings',array('/setup/mailServer')); ?></li>
</div>

<br>
<?php 

$gateway_username = ''; 
$gateway_password = '';
$gateway_clientid = '';


$root = dirname(dirname(dirname(__FILE__)));
//echo $root."<br>";

$filename = $root.'/config/smsgateway_settings.json';

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
	
}



?>


 <br><br>
Before using this service, you need to have account with Third Party Service Clikatell <br>
<a href="https://www.clickatell.com/register/" target="_blank">Create account with Clikatell here</a><br><br><br>

<form action="<?php echo Yii::app()->createUrl('setup/smsSettingsView')?>" method="post">
	
	<b>User Name</b><br><input type="text" name="gateway_username" value=<?php echo $gateway_username;?>><br><br>
	
	<b>Password</b><br><input type="text" name="gateway_password" required="required" value=<?php echo $gateway_password;?>><br><br>
	
	<b>Api Key</b><br><input type="text" name="gateway_apikey" value=<?php echo $gateway_apikey;?>><br><br>
	
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input name="smsgateway_setting_values"  type="submit" style="width:100px">
	
</form>	
	

