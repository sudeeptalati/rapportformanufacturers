<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'enggdiary-appointIcalender-form',
	'enableAjaxValidation'=>false,
)); ?>

<?php 
	echo "<br>Service id from url = ".$_GET['service_id'];	
	$service_id = $_GET['service_id'];



$serviceModel = Servicecall::model()->findByPk($service_id);
		$custName = $serviceModel->customer->fullname;
		$str = $serviceModel->customer->address_line_1." ".$serviceModel->customer->address_line_2." ".$serviceModel->customer->address_line_3;
		$str1 = $serviceModel->customer->town;
		$str2 = $serviceModel->customer->postcode_s." ".$serviceModel->customer->postcode_e;
		$address = $str." \t "."Town :".$str1." \t "."Postcode :".$str2;
		$visit_date = date('Ymd',$serviceModel->enggdiary->visit_start_date);
		
		$date      = $visit_date;
$startTime = $visit_date;
$endTime   = $visit_date;
$subject   = $custName;
$desc      = 'Customer Details'.
			 '\n Name - '.$custName.
			 '\n Address - '.$address.
			 '\n Telephone - '.$serviceModel->customer->telephone."\t".'Mobile :'.$serviceModel->customer->mobile.
			 '\n Email - '.$serviceModel->customer->email.
			 '\n\n Product Details'.
			 '\n Brand - '.$serviceModel->product->brand->name.
			 '\n Product - '.$serviceModel->product->productType->name.
			 '\n Model - '.$serviceModel->product->model_number.
			 '\n\n Fault Details'.
			 '\n Fault Description - '.$serviceModel->fault_description.
			 '\n Fault report date - '.date('d-M-y', $serviceModel->fault_date);
		 
$ical = "BEGIN:VCALENDAR
VERSION:2.0
PRODID:-//hacksw/handcal//NONSGML v1.0//EN
BEGIN:VEVENT
UID:" . md5(uniqid(mt_rand(), true)) . "example.com
DTSTAMP:" . gmdate('Ymd').'T'. gmdate('His') . "Z
DTSTART:".$date."T".$startTime."00Z
DTEND:".$date."T".$endTime."00Z
SUMMARY:".$subject."
LOCATION: ". $str." ".$str1." ".$str2."  
DESCRIPTION:".$desc."
END:VEVENT
END:VCALENDAR";
 
//set correct content-type-header
header('Content-type: text/calendar; charset=utf-8');
header('Content-Disposition: inline; filename=calendar.ics');
echo $ical;
exit;

?>

<?php $this->endWidget(); ?>

</div><!-- form -->