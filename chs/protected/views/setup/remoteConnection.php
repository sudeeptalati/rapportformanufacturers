
<div id="sidemenu">             
<?php include('setup_sidemenu.php'); ?>   
</div>



<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'setup-remoteConnection-form',
	'enableAjaxValidation'=>false,
)); ?>

<h1>Mobile and Other Devices</h1>

	<p class="note">
	If you want to access this rapport system from other devices like mobile phone, tablet or other PC, 
	open a new browser and point to the following url.
	</p>
	
	<div class="row buttons">
		<?php
			$url = gethostbyname(trim(`hostname`)).Yii::app()->baseUrl;
			echo CHtml::textArea('', $url, array('cols'=>40, 'disabled'=>'disabled')); 
		?>
	</div>
	
	<small>
	<p class="note">Conditions:<br>
	1. All Devices should be in same Wi-Fi network. Specially the Mobile phones and tablets are connected through WIFI and not 3G.<br>
	2. Check if firewall is not blocking this connection with other device. Check the firewall settings of the the current machine and routers.<br>
	</small></p>
	
	<img src="<?php echo Yii::app()->request->baseUrl.'/images/otherdevices.png';?>" width="350" height="250"/>
	
	
<?php $this->endWidget(); ?>

</div><!-- form -->
		
	
		
		
		