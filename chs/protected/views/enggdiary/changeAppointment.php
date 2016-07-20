<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'enggdiary-changeAppointment-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>
	
	<?php 
		$service_id=$_GET['serviceId'];
		//echo "service id:".$service_id;
		$enggdiary_id=$_GET['enggdiary_id'];
		//echo $enggdiary_id;
		$serviceModel=Servicecall::model()->findByPk($service_id);
		$engg_id=$serviceModel->engineer_id;
		$customerModel=Customer::model()->findByPk($serviceModel->customer_id);
		$productModel=Product::Model()->findByPk($serviceModel->product_id);
		$productTypeModel=ProductType::Model()->findByPk($productModel->product_type_id);
		$brandModel=Brand::model()->findByPk($productModel->brand_id);

		//echo "ENGINEER ID".$model->engineer_id;
		$engineerModel=Engineer::model()->findByPk($model->engineer_id);
		$contactDetailsModel=ContactDetails::model()->findByPk($engineerModel->contact_details_id);
		
		$str1=$contactDetailsModel->address_line_1." ".$contactDetailsModel->address_line_2." ".$contactDetailsModel->address_line_3."\n";
		$str2=$contactDetailsModel->town."\n";
		$str3=$contactDetailsModel->postcode_s." ".$contactDetailsModel->postcode_e;
		$address=$str1." ".$str2." ".$str3;
		$enggDetails=$engineerModel->fullname."\n".$address;
	?>
	<table>
	<tr>
		<th></th>
		<th></th>
		<th><h2>Service Ref. No.# <?php echo $serviceModel->service_reference_number;?></h2></th>
	</tr>
	<tr>
	<td style="vertical-align:top;">
			<?php $serviceModel->fault_date=date('d-M-y', $serviceModel->fault_date);?>
			<?php echo $form->labelEx($serviceModel,'fault_date'); ?>
			<?php echo $form->textField($serviceModel,'fault_date', array('disabled'=>'disabled')); ?>
			
			<?php echo $form->labelEx($serviceModel,'fault_description'); ?>
			<?php echo $form->textArea($serviceModel,'fault_description', array('disabled'=>'disabled','rows'=>4, 'cols'=>18)); ?>		
	</td>
	<td style="vertical-align:top;">
		
			<?php echo $form->labelEx($customerModel,'fullname'); ?>
			<?php echo $form->textField($customerModel,'fullname', array('disabled'=>'disabled')); ?>
			<?php echo $form->error($customerModel,'fullname'); ?>
			
			<?php echo $form->labelEx($customerModel,'town'); ?>
			<?php echo $form->textField($customerModel,'town', array('disabled'=>'disabled')); ?>
			
			<?php echo $form->labelEx($customerModel,'postcode_s'); ?>
			<?php echo $form->textField($customerModel,'postcode_s', array('size'=>6,'disabled'=>'disabled')); ?>
			<?php echo $form->textField($customerModel,'postcode_e', array('size'=>6,'disabled'=>'disabled')); ?>
		</td>
		<td style="vertical-align:top;">
			<?php echo $form->labelEx($brandModel,'name'); ?>
			<?php echo $form->textField($brandModel,'name', array('disabled'=>'disabled')); ?>
	
	
			<?php echo $form->labelEx($productTypeModel,'name'); ?>
			<?php echo $form->textField($productTypeModel,'name', array('disabled'=>'disabled')); ?>
		</td>
	</tr>
	<tr>
		<td colspan="3">
		 <hr>
		 </td>
	</tr>
	<tr>
		<td>
		<?php echo "<b>	Engineer Details</b><br>" ,
		  CHtml::textArea('Address', $enggDetails,  array('rows'=>4, 'cols'=>20,'disabled'=>'disabled')); ?>

		</td>
<!--		<td class="row" colspan="3">-->
		<td style="vertical-align:top">
		<?php $model->visit_start_date=date('d-M-y',$model->visit_start_date);?>
		<?php //echo $viewVisitData;?>
		<?php echo $form->labelEx($model,'visit_start_date'); ?>
		<?php 
			$this->widget('zii.widgets.jui.CJuiDatePicker', array(
			    'name'=>CHtml::activeName($model, 'visit_start_date'),
				'model'=>$model,
        		'value' => $model->attributes['visit_start_date'],
			    // additional javascript options for the date picker plugin
			    'options'=>array(
			        'showAnim'=>'fold',
					'dateFormat' => 'dd-mm-yy',
			    ),
			    'htmlOptions'=>array(
			        'style'=>'height:20px;'
			    ),
			));		
		?>
		</td>
		<td style="vertical-align:top;">
			<?php echo $form->labelEx($model,'slots'); ?>
			<?php echo $form->dropDownList($model,'slots', array('1'=>1, '2'=>2,'3'=>3, '4'=>4,'5'=>5, '6'=>6,'7'=>7,'8'=>8,'9'=>9,'10'=>10,'11'=>11, '12'=>12,'13'=>13, '14'=>14,'15'=>15, '16'=>16,'17'=>17,'18'=>18,'19'=>19,'20'=>20,));?>
			<small>Each Slot is of 30 Mins</small>
			<?php echo $form->error($model,'slots'); ?>
		</td>
	</tr>
	</table>
	<span style="float:right"><?php echo CHtml::submitButton($model->isNewRecord ? 'Add to Diary' : 'Modify'); ?></span><!--
	<div class="row buttons">
		<?php //echo $form->textField($model,'servicecall_id'); ?>
		<?php //echo CHtml::submitButton($model->isNewRecord ? 'Add to Diary' : 'Modify'); ?>
	</div>

--><?php $this->endWidget(); ?>
	<div>
<!-- CRAETED BY ST -->

<div class="form">
<?php 
	
	$baseUrl=Yii::app()->request->baseUrl;
	//$changeEnggUrl=$baseUrl.'/enggdiary/changeEngineerOnly/';
	$changeEnggUrl=$baseUrl.'/enggdiary/changeEngineerOnly/'.$model->id;		
	$enggdiaryform=$this->beginWidget('CActiveForm', array(
	'id'=>'enggdiary-changeEngineer-form',
	'enableAjaxValidation'=>false,
	'action'=>$changeEnggUrl,
	'method'=>'post'
	
)); ?>
<?php 
	$engg_id=$model->engineer_id;
 	$data=CHtml::listData(Engineer::model()->findAll(), 'id', 'fullname', 'company');
 	echo "<b>Select Engineer&nbsp;&nbsp;&nbsp;</b>";
	echo $enggdiaryform->DropDownList($model, 'engineer_id', $data );
	echo $enggdiaryform->hiddenField($model,'servicecall_id');
	echo $enggdiaryform->hiddenField($model,'id');
	
	echo "&nbsp;&nbsp;".CHtml::submitButton('Change');
	
?>
<?php $this->endWidget(); ?>
</div><!-- ENd of form -->
	

<!-- END CREATE BY ST -->

<hr>



<div class="form">

 

<?php 
//	$baseUrl=Yii::app()->request->baseUrl;
//	$changeEnggUrl=$baseUrl.'/enggdiary/changeAppointment/?serviceId='.$service_id.'&engineerId='.$engg_id.'&enggdiary_id='.$model->id;		
//	//$changeEnggUrl=$baseUrl.'/enggdiary/create';
//	$enggdiaryform=$this->beginWidget('CActiveForm', array(
//	'id'=>'enggdiary-changeEngineer-form',
//	//'enableAjaxValidation'=>false,
//	'action'=>$changeEnggUrl,
//	'method'=>'post'
//	
//)); ?>
<?php 

	//$odel=Engineer::model();
	//$enggModel->id=$model->engineer_id;
//	echo $enggdiaryform->labelEx($model,'fullname');
//	echo $enggdiaryform->DropDownList($model, 'engineer_id', $productModel->getAllEngineers());
//	echo $enggdiaryform->error($model,'id');
//
//	echo $form->hiddenField($model,'servicecall_id');
//	echo CHtml::submitButton('Change');
//	
?>
<?php //$this->endWidget(); ?>
</div><!-- ENd of form -->

<style type="text/css">
/* calendar */
table.calendar		{ border-left:1px solid #999; }
tr.calendar-row	{  }
td.calendar-day	{ min-height:80px; font-size:11px; position:relative; } * html div.calendar-day { height:80px; }
td.calendar-day:hover	{ background:#eceff5; }
td.calendar-day-np	{ background:#eee; min-height:80px; } * html div.calendar-day-np { height:80px; }
td.calendar-day-head { background:#ccc; font-weight:bold; text-align:center; width:120px; padding:5px; border-bottom:1px solid #999; border-top:1px solid #999; border-right:1px solid #999; }
div.day-number		{ background:#999; padding:5px; color:#fff; font-weight:bold; float:right; margin:-5px -5px 0 0; width:20px; text-align:center; }
/* shared */
td.calendar-day, td.calendar-day-np { width:120px; padding:5px; border-bottom:1px solid #999; border-right:1px solid #999; }


</style>

<?php 
	///Engineer Calender
	
	/* date settings */
if ( (isset($_GET['month'])) && (isset($_GET['year'])))
{
$month = (int) ($_GET['month'] ? $_GET['month'] : date('m'));
$year = (int)  ($_GET['year'] ? $_GET['year'] : date('Y'));
}
else
{
$month=date('m');
$year=date('Y');

	
}
$add_params='&amp;engineer_id='.$engg_id.'&amp;service_id='.$service_id.'&amp;enggdiary_id='.$enggdiary_id;

/* select month control */
$select_month_control = '<select name="month" id="month">';
for($x = 1; $x <= 12; $x++) {
	$select_month_control.= '<option value="'.$x.'"'.($x != $month ? '' : ' selected="selected"').'>'.date('F',mktime(0,0,0,$x,1,$year)).'</option>';
}
$select_month_control.= '</select>';

$hidden_fields='<input type="hidden" name="engineer_id" value="'.$engg_id.'" /> ';
$hidden_fields.='<input type="hidden" name="service_id" value="'.$service_id.'" /> ';
$hidden_fields.='<input type="hidden" name="enggdiary_id" value="'.$enggdiary_id.'" /> ';

/* select year control */
$year_range = 7;
$select_year_control = '<select name="year" id="year">';
for($x = ($year-floor($year_range/2)); $x <= ($year+floor($year_range/2)); $x++) {
	$select_year_control.= '<option value="'.$x.'"'.($x != $year ? '' : ' selected="selected"').'>'.$x.'</option>';
}
$select_year_control.= '</select>';



/* "next month" control */
$next_month_link = '<a href="?'.$add_params.'&amp;month='.($month != 12 ? $month + 1 : 1).'&amp;year='.($month != 12 ? $year : $year + 1).'" class="control">Next Month >></a>';

/* "previous month" control */
$previous_month_link = '<a href="?'.$add_params.'&amp;month='.($month != 1 ? $month - 1 : 12).'&amp;year='.($month != 1 ? $year : $year - 1).'" class="control"><< 	Previous Month</a>';

$action_url='';
/* bringing the controls together */
//$controls = '<table><tr><td>'..'<form method="get" action='.$action_url.' >'.$select_month_control.$select_year_control.'&nbsp;<input type="submit" name="submit" value="Change" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$previous_month_link.'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$next_month_link.' </form>';
$controls = '<table><tr><td>'.$previous_month_link.'</td><td><form method="get" action='.$action_url.' >'.$select_month_control.$select_year_control.$hidden_fields.'&nbsp;<input type="submit" name="submit" value="Change" /></form></td><td>'.$next_month_link.'</td></tr></table>';

//echo $controls;	

$current_month=strtotime('1-'.$month.'-'.$year);
$this_month= '<h2 style=" padding-right:30px;">'.date('F - Y',$current_month).'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</h2>';

$draw='<table><tr><td style="text-align:center;" >'.$this_month.'</td></tr>';
$draw.='<tr><td>'.$controls.'</td></tr>';
$draw.='<tr><td>'.draw_calendar($month,$year,$engg_id).'</td></tr></table>';
if($engg_id)
{
echo $draw;
}







/* draws a calendar */
function draw_calendar($month,$year,$engg_id){

	/* draw table */
	$calendar = '<table cellpadding="0" cellspacing="0" class="calendar">';

	/* table headings */
	$headings = array('Sunday','Monday','Tuesday','Wednesday','Thursday','Friday','Saturday');
	$calendar.= '<tr class="calendar-row"><td class="calendar-day-head">'.implode('</td><td class="calendar-day-head">',$headings).'</td></tr>';

	/* days and weeks vars now ... */
	$running_day = date('w',mktime(0,0,0,$month,1,$year));
	$days_in_month = date('t',mktime(0,0,0,$month,1,$year));
	$days_in_this_week = 1;
	$day_counter = 0;
	$dates_array = array();

	/* row for week one */
	$calendar.= '<tr class="calendar-row">';

	/* print "blank" days until the first of the current week */
	for($x = 0; $x < $running_day; $x++):
		$calendar.= '<td class="calendar-day-np">&nbsp;</td>';
		$days_in_this_week++;
	endfor;

	/* keep going with days.... */
	for($list_day = 1; $list_day <= $days_in_month; $list_day++):
		
			$todays_date=date('j-m-Y');
			//echo $todays_date;
			$current_date='';
			$current_date=$list_day.'-'.$month.'-'.$year;
			//echo '<br>'.$current_date.'<hr>';
			
			if ($todays_date==$current_date)
			{
				$calendar.= '<td class="calendar-day" style="background-color:#CCFF99;" >';
			}
			else 
			{
				$calendar.= '<td class="calendar-day" >';
			}
			/* add in the day number */
			$calendar.= '<div class="day-number">'.$list_day.'</div>';

			/** QUERY THE DATABASE FOR AN ENTRY FOR THIS DAY !!  IF MATCHES FOUND, PRINT THEM !! **/
			
			$mysql_date=strtotime($current_date);
			
			$day_content='';
//			$day_content.='<br>ENGGG  :'.$engg_id;
//			
			$results=Enggdiary::model()->fetchDiaryDetails($engg_id,$mysql_date);			
			foreach($results as $data)
			{
//			echo " <br>ENGINEER ID ".$data->engineer->fullname;
//			echo " <br>Servise call".$data->servicecall->service_reference_number;
			//$day_content.=" <br>Servise call".$data->servicecall->service_reference_number;
			//$day_content.="<p>";
			$link= Yii::app()->getBaseUrl()."/servicecall/".$data->servicecall_id;
			$day_content.="<a href='".$link."'>";
			$day_content.="".$data->servicecall->customer->last_name."&nbsp;".$data->servicecall->customer->postcode_s.$data->servicecall->customer->postcode_e."<span style='color:#5BA0C9; font-size:10px;'><b>(".$data->slots.")</b></span><br>"; ;
			$day_content.="</a>";
			//$day_content.="</p>";
			}

			$calendar.= str_repeat('<p>'.$day_content.'</p>',1);
			
		$calendar.= '</td>';
		if($running_day == 6):
			$calendar.= '</tr>';
			if(($day_counter+1) != $days_in_month):
				$calendar.= '<tr class="calendar-row">';
			endif;
			$running_day = -1;
			$days_in_this_week = 0;
		endif;
		$days_in_this_week++; $running_day++; $day_counter++;
	endfor;

	/* finish the rest of the days in the week */
	if($days_in_this_week < 8):
		for($x = 1; $x <= (8 - $days_in_this_week); $x++):
			$calendar.= '<td class="calendar-day-np">&nbsp;</td>';
		endfor;
	endif;

	/* final row */
	$calendar.= '</tr>';

	/* end the table */
	$calendar.= '</table>';
	
	/* all done, return result */
	return $calendar;
}

/* sample usages */
//echo '<h2>July 2009</h2>';
//echo draw_calendar(7,2009);

?>
</div>

</div><!-- form -->