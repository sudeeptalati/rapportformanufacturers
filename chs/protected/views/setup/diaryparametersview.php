<div class="form">


<div id="sidemenu">             
<?php include('setup_sidemenu.php'); ?>   
</div>
<br>

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'setup-diary_parameters-form',
	'enableAjaxValidation'=>false,
));
?>

<?php 

$root = dirname(dirname(dirname(__FILE__)));
//echo $root."<br>";
$filename = $root.'/config/diary_parameters.json';
//$data = file_get_contents($filename);

if(isset($_POST['diary_parameters_values']))
{
		/***** GETTING DATA FROM smsSettingsForm *************/

		$no_next_days = $_POST['no_next_days'];
		//echo $gateway_username;
		$allowedtraveldistancebetweenpostcodes =  $_POST['allowedtraveldistancebetweenpostcodes'];
		//echo "<br>".$gateway_password;
		$totalnoofcallsperday = $_POST['totalnoofcallsperday'];
		//echo "<br>Api key = ".$gateway_apikey;
		/***** END OF GETTING DATA FROM smsSettingsForm *************/
		$workingdaysofweekstring = $_POST['workingdaysofweekstring'];
		$averagetimeperservicecall = $_POST['averagetimeperservicecall'];
		$totaldistancetobetravelledinaday = $_POST['totaldistancetobetravelledinaday'];
		
		if(file_exists($filename))
		{
			//echo "<br>File is present";
			$diarydata = file_get_contents($filename);
			$diaryDecodedData = json_decode($diarydata, true);
		
			$diaryDecodedData['no_next_days'] = $no_next_days;
			$diaryDecodedData['allowedtraveldistancebetweenpostcodes'] = $allowedtraveldistancebetweenpostcodes;
			$diaryDecodedData['totalnoofcallsperday'] = $totalnoofcallsperday;
			$diaryDecodedData['workingdaysofweekstring'] = $workingdaysofweekstring;
			$diaryDecodedData['averagetimeperservicecall'] = $averagetimeperservicecall;
			$diaryDecodedData['totaldistancetobetravelledinaday'] = $totaldistancetobetravelledinaday;
		
			$fh = fopen($filename, 'w');
			fwrite($fh, json_encode($diaryDecodedData));
			fclose($fh);
		}//end of if(file_exists()).
		else 
			echo "Diary parameters file is not found";
		 
}//end of if(isset($_POST)).***** END OF TAKING VALUES FROM FORM *******
else
	{
		if(file_exists($filename))
		{
			//echo "File exixts";
			$diarydata = file_get_contents($filename);
			$diaryDecodedData = json_decode($diarydata, true);
			
			
			//echo "<br>";
			//print_r($smsDecodedData);
			
			$no_next_days=$diaryDecodedData['no_next_days'] ;
			$allowedtraveldistancebetweenpostcodes=$diaryDecodedData['allowedtraveldistancebetweenpostcodes'];
			$totalnoofcallsperday=$diaryDecodedData['totalnoofcallsperday'];
			$workingdaysofweekstring=$diaryDecodedData['workingdaysofweekstring'] ;
			$averagetimeperservicecall=$diaryDecodedData['averagetimeperservicecall'] ;
			$totaldistancetobetravelledinaday=$diaryDecodedData['totaldistancetobetravelledinaday'];
			
		}//end of if(file_exists()).
		else
			echo "Diary Parameters file is not found";
	}//end of else.
	
	
	
?>
	
<!-- ****** END OF CODE TO REPLACE JSON FILE WITH CHANGED DATA ********* -->	
	
	
<!-- ********** DISPLAYING CHANGED DATA ************ -->
	
	<div class="row">
		<?php echo "<b>No. of days To be considered for Diary Planning</b><br>";?>
		<?php echo CHtml::textField('',$no_next_days, array('disabled'=>'disabled'));?>
	</div>
	<div class="row">
		<?php echo "<b>Allowed distance between two postcodes (in Miles)</b><br>";?>
		<?php echo CHtml::textField('',$allowedtraveldistancebetweenpostcodes, array('disabled'=>'disabled'));?>
	</div>
	<div class="row">
		<?php echo "<b>No. of calls per day</b><br>";?>
		<?php echo CHtml::textField('',$totalnoofcallsperday, array('disabled'=>'disabled'));?>
	</div>
	<div class="row">
		<?php echo "<b>Working days of week</b><br>";?>
		<?php echo CHtml::textField('',$workingdaysofweekstring, array('disabled'=>'disabled'));?>
		<br><small>Please use format 1234567 as 1 (for Monday) through 7 (for Sunday). <br>
		For Example:<br>
		For working days as Monday to Friday use 12345<br>
		For working days as Monday to Saturday use 123456<br>
		For working days as Tuesday to Sunday use 234567<br>
		</small>
		
	</div>
	
	<div class="row">
		<?php echo "<b>Average time per call (in hours)</b><br>";?>
		<?php echo CHtml::textField('',$averagetimeperservicecall, array('disabled'=>'disabled'));?>
	</div>
	
	<div class="row">
		<?php echo "<b>Maximum Distance to be travelled in a day (in Miles)</b><br>";?>
		<?php echo CHtml::textField('',$totaldistancetobetravelledinaday, array('disabled'=>'disabled'));?>
	</div>
	
	<div class="row" >
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo CHtml::button('Edit', array('submit' => array('setup/diaryparameterform'))); ?>
	</div>
	
<!-- ********** DISPLAYING CHANGED DATA ************ -->	
	

<?php $this->endWidget(); ?>

</div><!-- form -->