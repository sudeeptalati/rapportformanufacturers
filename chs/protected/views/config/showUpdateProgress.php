


 

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="en" />

	<!-- blueprint CSS framework -->
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/screen.css" media="screen, projection" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/print.css" media="print" />
	<!--[if lt IE 8]>
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/ie.css" media="screen, projection" />
	<![endif]-->

	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/main.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/form.css" />

	<title><?php echo CHtml::encode($this->pageTitle); ?></title>

</head>

<body>
<?php
$company_logo=Yii::app()->request->baseUrl."/images/company_logo.png";
$rapport_logo=Yii::app()->request->baseUrl."/images/rapport_logo.png";


//$header_name= CHtml::encode(Yii::app()->name);
$config=Config::model()->findByPk(1);
$header_name=$config->company;
$baseUrl= Yii::app()->request->baseUrl; 
?>

<div class="container" id="page">
	
	<table style="width:100%;">
	<tr>
		
		<td style="margin:50px; text-align:left;" >
			<?php //echo CHtml::image($company_logo,"ballpop",array("width"=>"200", "height"=>"75")); ?>
			<?php echo CHtml::image($company_logo); ?>
		</td>
		
		<td style="margin:20px; text-align:right;" ><div id="logo" >
			<?php echo $header_name; ?><br><small>Call Handling</small></div>
		
		</td>
		
	</tr>
	</table>
	
	
	<div id="header">
		</div><!-- header -->


	<div id="mainmenu" style="height:25px;">
	
	<span style="color:white; margin:25px;">

			<center><b style="margin:25px;"><small>Update in Progress, Please do not Close the Browser Until it finishes or click Anywhere. Just sit and Relax</b></center></small>
	</span>
	
		<?php $this->widget('zii.widgets.CMenu',array(
			'items'=>array(
				
				//array('label'=>'Update in Progress, Please do not Close the Browser Until it finishes or click Anywhere. Just sit and Relax', 'url'=>array('')),
			 
				),
		)); ?>
	</div><!-- mainmenu -->
	<?php if(isset($this->breadcrumbs)):?>
		<?php $this->widget('zii.widgets.CBreadcrumbs', array(
			'links'=>$this->breadcrumbs,
		)); ?><!-- breadcrumbs -->
	<?php endif?>


<div style="margin:20px;">
	<?php 
	
	$request='http://www.rapportsoftware.co.uk/versions/rapport_callhandling.txt';	
	$available_version = Config::model()->curl_file_get_contents($request);
	
	?>
	
	<?php echo "Updating Software to ".$available_version."<br><br><br>";
		$message=$step_info[1];
		$currentStep = $step_info[0];
		$progressBarValue=$currentStep*100;
		
	?>
	
<div style="background-color: green; width:<?php echo $progressBarValue; ?>px; height:20px;">


</div><?php $percentage_complete= $currentStep*15;
				if ($percentage_complete>100)
				$percentage_complete=100;
				
				echo $percentage_complete;
				?>%

 
 

	<!-- MY PROGRESS BAR WND -->


<?php 
if(empty($_SESSION['message']))
{
	$_SESSION['message'] = '';
}


$_SESSION['message']=$_SESSION['message'].$message;
echo $_SESSION['message'];


if($currentStep != 0 && $currentStep < 7 )
{
	$next_step = $currentStep+1;
	$url=Yii::app()->baseUrl.'/Config/showUpdateProgress/?curr_step='.$next_step;
	//echo $url;
	echo "<SCRIPT LANGUAGE='javascript'>location.href='$url';</SCRIPT>";
}
else
{
	/*After printing the messages We are clearing the message variable, so that when update run again for next time gives us no error*/
	$_SESSION['message']='';
	echo "<br>";
	echo CHTml::link('Restart Browser',array('../chs/'));
}

?>


	



</div><!-- content -->








<div id="footer">
	
	<table><tr><td>
	<?php echo CHtml::image($rapport_logo,"ballpop", array("width"=>"170", "height"=>"56.6")); ?>
	</td>
	<td style="text-align:right;">
		Copyright &copy; <?php echo date('Y'); ?> by UK Whitegoods Ltd.<br/>

			
	</td></tr></table>
</div><!-- footer -->
</div><!-- page -->

</body>
</html>