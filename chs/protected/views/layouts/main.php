

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
 

<!-- MY CALENDER STYLE SHEETS -->

<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/fullcalendar/fullcalendar.css" />
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/fullcalendar/fullcalendar.print.css" />

	<!-- FONT AWESOME-->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">




 <?php Yii::app()->bootstrap->register(); ?>
 
	<title><?php echo CHtml::encode($this->pageTitle); ?></title>

</head>

<body>
<?php

 
$company_logo=Yii::app()->request->baseUrl."/images/company_logo.png";
$rapport_logo=Yii::app()->request->baseUrl."/images/rapport_logo.png";


//$header_name= CHtml::encode(Yii::app()->name);
//$config=Config::model()->findByPk(1);
$setupModel = Setup::model()->findByPk(1);
$header_name=$setupModel->company;
$baseUrl= Yii::app()->request->baseUrl; 
?>

<div class="container" id="page">
	
	<table style="width:100%;">
	<tr>
		
		<td style="padding-left:20px; padding-top:12px;text-align:left;">
			<a href='<?php echo $baseUrl;?>' style='color:#555;text-decoration:none;' >
			<?php echo CHtml::image($company_logo,"ballpop",array()); ?>
			</a>
		</td>
		
		<td style="margin:20px; text-align:right;" ><div id="logo" >
		<a href='<?php echo $baseUrl;?>' style='color:#555;text-decoration:none;' >
			<?php echo $header_name; ?><br><small>Call Handling</small></div>
		</a>
		
		</td>
		
	</tr>
	</table>
	
	
	<div id="header">
		</div><!-- header -->

	<div id="mainmenu">
		<?php $this->widget('zii.widgets.CMenu',array(
			'items'=>array(
				//array('label'=>'Home', 'class'=>'fa fa-camera-retro' ,'url'=>array('/servicecall/freeSearch')),
				//array('label'=>'Diary', 'url'=>array('/enggdiary/changeEngineer/?month='.date('m').'&year='.date('y'))),
				//array('label'=>'Diary', 'url'=>array('/enggdiary/currentAppointments')),
				array('label'=>'All Calls', 'url'=>array('/servicecall/admin')),
				array('label'=>'New Cust', 'url'=>array('/customer/create')),
				array('label'=>'Product', 'url'=>array('/product/admin')),

				array('label'=>'Reports', 'url'=>array('/reports/displayDropdown'),  'visible'=>Yii::app()->user->checkAccess('Admin')),
 				//array('label'=>'Contract', 'url'=>array('/contract/admin')),
				
					
				//array('label'=>'Config', 'url'=>array('/config/1')),
				array('label'=>'SetUp', 'url'=>array('/setup/view&id=1'),  'visible'=>Yii::app()->user->checkAccess('Admin')),
				array('label'=>'BackUp', 'url'=>array('/site/backup'), 'visible'=>!Yii::app()->user->isGuest),
				array('label'=>'Login', 'url'=>array('/site/login'), 'visible'=>Yii::app()->user->isGuest),
				array('label'=>'Logout ('.Yii::app()->user->name.')', 'url'=>array('/site/logout'), 'visible'=>!Yii::app()->user->isGuest, 'linkOptions'=>array('confirm'=>'Are you sure you want to Logout?'))
			),
		)); ?>
	</div><!-- mainmenu -->

	<div id='submenu' style="text-align:center">
		<?php
		
			$addons_list=Addons::model()->findAll(array('condition'=>'active=1'));
			foreach ($addons_list as $addon)
			{	
				echo "<li>";
			 
				echo CHtml::link($addon->addon_label,array('/'.$addon->name)); 
				echo "</li>";
			
			}
		
		?>
	</div>
	
	<?php
					/////////TASK TO PERFORM NOTIFICATION////
				
				/////get the count of Task to Perform List
				$cntCriteria = new CDbCriteria();
				$cntCriteria->compare('status','pending',true);
				$tasksCount = TasksToDo::model()->count($cntCriteria);
				 
				if ($tasksCount>0)
				{
				
				$notifyUrl= $baseUrl.'/index.php?r=TasksToDo/admin';
				
				?>
				<div style="text-align:justify; margin:10px;background-color:#FAF88D">
					<span style="margin-left:10px;color:">
					<b><a href="<?php echo $notifyUrl; ?>">Tasks Pending: Click Here</a>  :There are some notification tasks pending about the Status Updates of Service Calls.</b>
					
					</span>
				</div>
				<?php
				}
				
				/////// END OF TASK TO PERFORM NOTIFICATION////
				?>
	
	
	
	<?php if(isset($this->breadcrumbs)):?>
		<?php $this->widget('zii.widgets.CBreadcrumbs', array(
			'links'=>$this->breadcrumbs,
		)); ?><!-- breadcrumbs -->
	<?php endif?>

	<?php echo $content; ?>

	<div id="footer">
	
	<table><tr><td>
	<?php echo CHtml::image($rapport_logo,"ballpop", array("width"=>"170", "height"=>"56.6")); ?>
	</td>
	<td style="text-align:right;">
		Copyright &copy; <?php echo date('Y'); ?> by UK Whitegoods Ltd.<br/>
	</td></tr></table>
	
 
 

</div><!-- footer -->
</div><!-- page -->
 
<!-- Google Address Lookup Start -->
	<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBCxU9WGQ-qZ0AY7cE_TP5timk7sb2cQZ4&signed_in=true&libraries=places&callback=initAutocomplete"
		async defer></script>
	<script src="js/googleaddresslookup.js"></script>
<!-- Google Address Lookup End -->

 <?php 
 
	if (is_dir(Yii::getPathOfAlias('application.modules.oow.assets')))	
	{
		$oow_url =	Yii::app()->getAssetManager()->publish(Yii::getPathOfAlias('application.modules.oow.assets'));	
		Yii::app()->getClientScript()->registerScriptFile($oow_url.'/js/oow.js', CClientScript::POS_END); 
	}
	
 ?>

</body>
</html>
