<?php 
	
$curMonth = date('n');
$curYear  = date('Y');
	
if ($curMonth == 12)
    $nextmonth = mktime(0, 0, 0, 0, 0, $curYear+1);
else
    $nextmonth = mktime(0, 0, 0, $curMonth+1, 1);

$firstDateNextMonth=  date('d-M-Y', $nextmonth); 
$lastDateNextMonth =  date('t-M-Y', $nextmonth);
    
$baseUrl=Yii::app()->request->baseUrl;
$exportUrl = $baseUrl.'/index.php?r=reports/export/';

if(isset($date_error))
{
	if($date_error == 1)
		$msg = "Please enter start date";
	elseif($date_error == 2)
		$msg = "End date is earlier to start date..!!! Please change end date";
	
	
	$this->beginWidget('zii.widgets.jui.CJuiDialog',array(
			'id'=>'date_error',
			// additional javascript options for the dialog plugin
			'options'=>array(
					'title'=>'Enter start date',
					'autoOpen'=>true,
			),
	));
	
	echo $msg;
	
	$this->endWidget('zii.widgets.jui.CJuiDialog');

}



$enggStatusForm=$this->beginWidget('CActiveForm', array(
	'id'=>'engg-status-dropdown-form',
	'enableAjaxValidation'=>false,
	'action'=>$exportUrl,
	'method'=>'get'
)); 	
	
?>

<div id="container" style="width:1200px;height:300px;text-align: center ;">

<div id="menu" style="padding:1em;background-color:#D0F2FF;height:300px;float:left;border-top-left-radius: 25px;border-bottom-left-radius: 25px;">

<table>

<tr>

<td colspan="2" style="padding-top:1px; padding-bottom:10	px;"> <b>Job Payment Date</b>  </td> 
</tr>
<tr>
<td>Start Date*
	<?php 						  
	$this->widget('zii.widgets.jui.CJuiDatePicker', array(
	    'name'=>'startDate',
	     'value'=>$firstDateNextMonth,
	    // additional javascript options for the date picker plugin
	    'options'=>array(
	        'showAnim'=>'fold',
			'dateFormat' => 'd-M-y',
	    ),
	    'htmlOptions'=>array(
	        'style'=>'height:20px;'
	    ),
	));
	
	?>
 
	End Date*
	<?php
	$today = date('d-M-y', time()); 
	
	$this->widget('zii.widgets.jui.CJuiDatePicker', array(
	    'name'=>'endDate',
		'value'=>$lastDateNextMonth,
		// additional javascript options for the date picker plugin
	    'options'=>array(
	        'showAnim'=>'fold',
			'dateFormat' => 'd-M-y',
			
	    ),
	    'htmlOptions'=>array(
	        'style'=>'height:20px;'
	    ),
	));			
	?>
</td>
</tr>


<tr>

<td> <b>Engineers</b> 
	
	<?php 
	$engg_data = Engineer::model()->getAllEnggAndCompany();
	
	echo CHtml::dropDownList('engglist','engineer_id', $engg_data,
									array('empty'=>array(0=>'All Engineers'))
									);
	?>
</td>

</tr>
<tr>
<td>
<b>Job Status</b>
	<?php 								
	

	$job_status_data = JobStatus::model()->getAllPublishedListdata();	
	echo CHtml::dropDownList('statuslist','job_status_id', $job_status_data,
									array('empty'=>array(0=>'All Status')) 
									);
	?>
</td>
</tr>

<tr>
<td colspan="2" style="text-align:left">
<?php  
	echo CHtml::submitButton('View Report');
	//echo CHtml::Button('Change', array('submit' => $baseUrl.'/Servicecall/export/')); 
 	$this->endWidget();
 	?>
</td>
</tr>
</table>

</div><!-- End of first Content -->




<div id="content-2" style="padding:1em;background-color:#FFE1BB;height:300px; width:300px;float:left;border-top-right-radius: 25px;border-bottom-right-radius: 25px;">

 
	<?php 
	 
	$baseUrl=Yii::app()->request->baseUrl;
	$prodReportUrl = $baseUrl.'/index.php?r=reports/enggProductReport/';
	 
	 $enggProductForm=$this->beginWidget('CActiveForm', array(
		'id'=>'engg-status-dropdown-form',
		'enableAjaxValidation'=>false,
		'action'=>$prodReportUrl,
		'method'=>'get'
	)); 
	
	?>
<table>

<tr style="text-align:center;"><td><b>Product Report</b></td></tr>
<tr><td>&nbsp;</td></tr>
<tr>
<td colspan='2'><b>Engineers : </b><br>
	<?php 
	
	echo CHtml::dropDownList('enggprodlist','engg_prod_id', $engg_data,
									array('empty'=>array(0=>'All Engineers'))
									 
									);
	?>
</td>
</tr>


<tr><td style="text-align:right;"><?php echo CHtml::submitButton('View Report'); ?></td></tr>


<?php $this->endWidget(); ?>
 
 </table>
 </div><!-- End of second Content -->
 </div><!-- END OF DIV Container -->
 
 
 
 
 

 
 
 
 
 
 
 
 
 
 
 