<?php
//$this->breadcrumbs=array(
//	'Spares Lookups'=>array('index'),
//	$model->id,
//);

include 'setup_sidemenu.php';

?>

<h1>FTP Settings</h1>

<?php
// $this->widget('zii.widgets.CDetailView', array(
//	'data'=>$model,
//	'attributes'=>array(
//		'id',
//		'url',
//		'ftp_username',
//		'ftp_password',
//		'ftp_port',
//	),
//)); 

?>


<?php 

$sparesLookupModel = SparesLookup::model()->findByPk(1);

$server = $sparesLookupModel->url;
$username = $sparesLookupModel->ftp_username;
$password = $sparesLookupModel->ftp_password;
$port = $sparesLookupModel->ftp_port;

//echo $server."<hr>";
//echo $username."<hr>";
	
	
?>


	<div class="row">
		<?php echo "<b>Server</b><br>";?>
		<?php echo CHtml::textField('', $server, array('disabled'=>'disabled'));?>
	</div><br>
	
	<div class="row">
		<?php echo "<b>User Name</b><br>";?>
		<?php echo CHtml::textField('', $username, array('disabled'=>'disabled'));?>
	</div><br>
	
	<div class="row">
		<?php echo "<b>Password</b><br>";?>
		<?php echo CHtml::textField('', $password, array('disabled'=>'disabled'));?>
	</div><br>
	
	<div class="row">
		<?php echo "<b>Port</b><br>";?>
		<?php echo CHtml::textField('', $port, array('disabled'=>'disabled'));?>
	</div>


