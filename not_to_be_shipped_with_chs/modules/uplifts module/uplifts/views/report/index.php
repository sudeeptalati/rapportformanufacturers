<?php include('uplifts_menu.php'); ?>   

 
<h4>Uplifts Reports</h4>
<?php 
	
$baseUrl=Yii::app()->request->baseUrl;
$exportUrl = $baseUrl.'/index.php?r=uplifts/report/index';

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

<div id="container" style="width:900px;text-align: center ;">
<!-- FOR TWO COLUMNS
<div id="menu" style="padding:1em;background-color:#D0F2FF;height:150px;float:left;border-top-left-radius: 25px;border-bottom-left-radius: 25px;">
-->
<div id="menu" style="padding:1em;background-color:#D0F2FF;height:150px;border-radius: 25px;width:500px;">

<table>

<!--<tr><td colspan="2" style="text-align:left;"><b><br><br></b></td></tr>-->
<tr>
<td>Start Date*
	<?php 			

$today = date('d-M-y', time()); 	
	$this->widget('zii.widgets.jui.CJuiDatePicker', array(
	    'name'=>'startDate',
		'value'=>$today,
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
	
	
	$this->widget('zii.widgets.jui.CJuiDatePicker', array(
	    'name'=>'endDate',
		'value'=>$today,
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

<td colspan="2" style="padding-top:1px; padding-bottom:10	px;"> <small>* The Start date and End Date are the dates of Call</small></td> 
</tr>

<tr>

<td> Uplift Number Series 
	<?php echo CHtml::dropDownList('upliftnumberseries_id', 'upliftnumberseries_id', CHtml::listData(UpliftsNumberSeries::model()->findAll(array('order'=>"`id` ASC")), 'id', 'prefix'), array('empty'=>array(''=>'All')));?>
</td>

</tr>
<tr>
<td>
	Request Type
	<?php echo CHtml::dropDownList('requesttype_id', 'requesttype_id', CHtml::listData(UpliftsRequestType::model()->findAll(array('order'=>"`id` ASC")), 'id', 'name'), array('empty'=>array(''=>'All')));?>
</tr>

<tr>
<td colspan="2" style="text-align:left">
<?php  
	echo CHtml::submitButton('View Report');
	//echo CHtml::Button('Change', array('submit' => $baseUrl.'/Servicecall/export/')); 
 	$this->endWidget();
	$excel_data='';
 	?>
</td>
</tr>
</table>
<br>
<br>
<br>
</div><!-- End of first Content -->

<?php
	$excel_filename=' Uplifts Reports '.date('M-Y').'.xls';
	
	if (isset($_GET['upliftnumberseries_id']))
	{	
		if (!empty($_GET['upliftnumberseries_id']))
		{
		$upliftseries=UpliftsNumberSeries::model()->findByPk($_GET['upliftnumberseries_id']);
		$excel_filename=$upliftseries->prefix.$excel_filename;
		}
	}
	
?>	



<div id="sudeepxls" style="text-align:right">
<a id="dynamicxls" download="<?php echo $excel_filename?>" href='#' onclick="javascript:callme()" >Export To Excel</a>
<script>

function callme()
{
var divdata=document.getElementById("kruthikaxls").innerHTML;
console.log(divdata);
var dynxls=document.getElementById("dynamicxls");
var xlsdata="data:application/csv;charset=utf-8,"+divdata;
dynxls.setAttribute('href',xlsdata );
}
</script>



</div> 






 <?php
		$uplifts_report=UpliftsReport::model()->findAll(array('condition'=>'active=1',	'order'=>'sort_order ASC'));
		
		$selected_fields_of_reports=array();
		$selected_fields_of_uplifts=array();
		foreach ($uplifts_report as $e )
		{
			//echo "<br>".$e->field_name;
			$fields=array();
			$fields['field_relation']=$e->field_relation;
			$fields['field_label']=$e->field_label;
			$fields['field_type']=$e->field_type;
			$fields['active']=$e->active;
			array_push($selected_fields_of_reports,$fields);
			array_push($selected_fields_of_uplifts,$fields['field_relation']);
			
		}
		



		$fields =( implode( ',', $selected_fields_of_uplifts) );
		
		$criteria = new CDbCriteria;
		$criteria->select = $fields ; // select fields which you want in output	
			
		$upliftsModel = Uplifts::model();
		$upliftsTable = Yii::app()->getDb()->getSchema()->getTable($upliftsModel->tableName());
		$upliftsColumns = $upliftsTable->getColumnNames();
		$data = $upliftsModel->findAll();
		//print_r(	$upliftsColumns);
			
		$excel_data="";
		
		$excel_data .= "<table>";
			$excel_data .= "<tr>";
			foreach ($selected_fields_of_reports as $s)////runs for headers
			{
				$excel_data .= "<th>";
				$excel_data .= $s['field_label'];
				$excel_data .= "</th>";
			}
			$excel_data .= "</tr>";
			
		foreach ($reportsdata as $d)/////runs for each row
		{
			$excel_data .= "<tr>";
			foreach ($selected_fields_of_reports as $s)////runs for each column
			{
				$excel_data .= "<td>";
//				if (in_array($s['field_relation'], $upliftsColumns)) {
					if ($s['field_relation']!='blank_field') {
					$f=$s['field_relation'];
					
					$length='0';
						$f = preg_replace('/\s+/', '', $f);
						$a = explode( '|', $f);
						$length=count($a);
						
						switch ($length) {
						case 0:
							//$excel_data .= "BY 0 LEN".$d->$f;
							break;
						case 1:
							//$excel_data .= "By Lenth 1";
							
							if (isset($d->$a[0]))
							{
								$excel_data .= $model->processDataForReports($d->$a[0],$s['field_type']);
							}
							break;
						case 2:
							if (isset($d->$a[0]->$a[1]))
							{
								$excel_data .= $model->processDataForReports($d->$a[0]->$a[1],$s['field_type']);							
							}
							break;
						case 3:
							if (isset($d->$a[0]->$a[1]->$a[2])) {
								$excel_data .= $model->processDataForReports($d->$a[0]->$a[1]->$a[2],$s['field_type']);
							}
							break;
						case 4:
							if (isset($d->$a[0]->$a[1]->$a[2]->$a[3]))
							{
								$excel_data .= $model->processDataForReports($d->$a[0]->$a[1]->$a[2]->$a[3],$s['field_type']);
							}
							break;
						case 5:
							if (isset($d->$a[0]->$a[1]->$a[2]->$a[3]->$a[4]))
							{
								$excel_data .= $model->processDataForReports($d->$a[0]->$a[1]->$a[2]->$a[3]->$a[4],$s['field_type']);
							}
							break;
						}
				}
				else
				{
					$excel_data .= "";////leaving Blank Space if no Value
				}
				$excel_data .= "</td>";
			}
			$excel_data .= "</tr>";
 		}
		$excel_data .= "</table>";
		
		//echo $excel_data;
 
 
		/*
			foreach ($reportsdata as $r)
			{
				echo "<br>".$r->uplift_number;
				//echo "Request Type  :".$r->request_type_id;
				//echo "PREFIX Type  :".$r->prefix_id;
				echo "*****Date Type  :".date('d-M-y',$r->date_of_call);
				
			}
			
		*/
 ?>
 
<div id="kruthikaxls">
<?php echo $excel_data; ?>
</div>
<a download="<?php echo $excel_filename?>" href="data:application/csv;charset=utf-8,<?php echo $excel_data; ?>">Export to Excel</a>
</div><!-- END OF DIV Container -->
 
 
 

 
 
 
 
 
 
 
 
 
 
 