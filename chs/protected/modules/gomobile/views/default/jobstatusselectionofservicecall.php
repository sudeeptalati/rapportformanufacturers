
<?php include('gomobile_menu.php'); ?>  

 <td>
						<h4><b>Job Status</b></h4>
 </td>
 
<?php

echo CHtml::beginForm('index.php?r=gomobile/default/postdatatoserver','get'); 
if(isset( $_GET['start_date']))
{
$start_date_starttime=$_GET['start_date']." 00:00";
echo $start_date_starttime;
$sd=strtotime($start_date_starttime);
echo $sd;
echo "<br>";
$start_date_endtime=$_GET['start_date']." 23:59";
echo $start_date_endtime;
$ed=strtotime($start_date_endtime);
echo $ed;
//$end_date=$_GET['end_date'];
$enggdiary_model=new Enggdiary();

	$criteria=new CDbCriteria();
	$criteria->select="servicecall_id";
	$criteria->addBetweenCondition('visit_start_date', $sd, $ed);

	$active_data_for_csv=new CActiveDataProvider($enggdiary_model, array(
										'criteria'=>$criteria,
										'pagination'=>false,
										
										));	
	
	$fd=$active_data_for_csv->getData();
	
	$servicecall_id_array=array();
	foreach ($fd as $f)
	 //echo "<br>".$f->servicecall_id;
	array_push($servicecall_id_array,$f->servicecall_id);
	print_r($servicecall_id_array);
		
}

$jobstatusmodel = Jobstatus::model()->findAll(
                 "published=1");
$published_jobstatus_list = CHtml::listData($jobstatusmodel, 
                'id', 'name');


echo CHtml::dropDownList('jobstatus_postdatatoserver','',$published_jobstatus_list);
echo "<br><br>";
echo CHtml::submitButton('Send To Server',array('name' => 'send_to_server'));
			
echo CHtml::endForm();

?>