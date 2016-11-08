<?php
function getthevalue($obj_model,$arr)
{
	//echo '<hr>';
	//echo '<br> length of array'.count($arr);
	$arr_len=count($arr);
	$return_value='';
 
	switch ($arr_len) {
		case "0":
			$return_value='';	
			break;
		case "1":
			$return_value=$obj_model->$arr[0];	
			break;
		case "2":
			$return_value=$obj_model->$arr[0]->$arr[1];	
			break;
		case "3":
			$return_value=$obj_model->$arr[0]->$arr[1]->$arr[2];	
			break;
		case "4":
			$return_value=$obj_model->$arr[0]->$arr[1]->$arr[2]->$arr[3];	
			break;
		case "5":
			$return_value=$obj_model->$arr[0]->$arr[1]->$arr[2]->$arr[3]->$arr[4];	
			break;
	}//end of switch
	
	//echo '<br> return Value'.$return_value;
	
	return $return_value;
}///end of function getthevalue()


?>

<div id='gmcontainer'>
<?php include('gomobile_menu.php'); ?>  
<table>
<tr>
<th>Ref No.</th>

<th>Visit Date</th>
        
<th>Customer Name</th>
<th>Customer Town</th>
<th>Customer Postcode</th>
<th>Fault Description</th>
<th>Engineer</th>
<th>Engineer Email</th>
</tr>
<h3>Date:</h3>
<?php
//checking if the value is set to get
if(isset( $_GET['start_date']))
{
	//echo $_GET['start_date'];
	$start_date_starttime=$_GET['start_date']." 00:00";
	$sd=strtotime($start_date_starttime);
	echo '<h1>'.date('l, j-F-Y',$sd).'</h1>';
	$datetime = new DateTime($_GET['start_date']);
	$datetime->modify('+1 day');
	$start_date_endtime=$_GET['start_date']." 23:59";
	$ed=strtotime($start_date_endtime);
	////end of today

 
	$foreacharray=array();//declaring a blank array for storing all fields
	
	
	$engg_id=$_GET['engg_id'];
	 
	 ///if enggid==101 it means show all engineers
	if ($engg_id=='101')
	{
		$engglist=CHtml::listData(Engineer::model()->findAll(),	'id', 'id');
		foreach ($engglist as $e_id)
		{	
			$foreacharray=getservicecallsdatafromenggdiary($e_id, $sd, $ed, $foreacharray );

		}///end of foreach ($engglist as $e)
		
	}///end of if ($engg_id=='101')
	else
	{
		$foreacharray=getservicecallsdatafromenggdiary($engg_id, $sd, $ed, $foreacharray );
	
	}//end of else if ($engg_id=='101')
	
	
		
	//echo $myarray['customer']['name'];
	$json_data=array('Details'=>$foreacharray);
	//echo json_encode($json_data);
	$gomobile_server_url=Gmservicecalls::model()->getserverurl();
}///end of if(isset( $_GET['start_date']))







function getservicecallsdatafromenggdiary($engg_id, $sd, $ed,  $foreacharray )
{
	$fd=Enggdiary::model()->getData($engg_id, $sd, $ed);
        $gomobile_account_id=Gmservicecalls::model()->getaccountid();

	foreach ($fd as $f)	
	{
		$servicecall_model=Servicecall::model()->findByPk($f->servicecall_id);
		$service_reference_number=$servicecall_model->service_reference_number;
		$job_status_id=$servicecall_model->job_status_id;
		$created_by=$servicecall_model->created_by_user_id;
		$modified=$servicecall_model->modified;
		$created= $servicecall_model->created;
		$fault_description=$servicecall_model->fault_description;

		/////paasing the values to array
		$servicecall=array();
		$customer=array();
		$customer['name']=$servicecall_model->customer->fullname;
		$customer['postcode']=$servicecall_model->customer->postcode;
		
		$gm_json_fields_model=Gmjsonfields::model()->findAll();
		foreach($gm_json_fields_model as $p)
		{
			$key=$p['field_relation'];
			$label=$p['field_label'];
			$type=$p['field_type'];
			if (strpos($key, '|')!== false)
			{
				$str_array = explode( '|', $key);
				$value=getthevalue($servicecall_model, $str_array);
				//print_r($str_array);
				//$value=$servicecall_model->$str_array[0]->$str_array[1];	
				$servicecall[$label]=Gmjsonfields::model()->processDataFormat($value,$type);			
				//echo $servicecall_model->customer->town;			
				
			
			}
			else
			{
				//echo "<br>Its a FIELS ";
				$value=$servicecall_model->$p['field_relation'];
				//$servicecall[$key]=$value;///disabled to be visible as label			
				$servicecall[$label]=Gmjsonfields::model()->processDataFormat($value,$type);
			}
		}
		
		//$engineer_id=$servicecall_model->engineer_id;
		$engineer_email=$servicecall_model->engineer->contactDetails->email;
                
                
                
                $myarray['service_reference_number'] = $service_reference_number;
                $myarray['gomobile_sentcall_id'] = $servicecall_model->id;
                   ///VISIT DATE FORMAT FOR UNIVERSAL USE YYYY-MM-DD
    $vsd_int= $servicecall_model->enggdiary->visit_start_date;
    $vsd=date('Y-m-d',$vsd_int);
    $myarray['visit_start_date'] = $vsd;

    $ved_int= $servicecall_model->enggdiary->visit_end_date;
    $ved=date('Y-m-d',$ved_int);
    $myarray['visit_end_date'] = $ved; $myarray['gomobile_account_id'] = Gmservicecalls::model()->getaccountid();
    
    
    
                $myarray['engineer_email']=$engineer_email;	
                $myarray['customer_fullname']=$servicecall_model->customer->fullname;	
                $myarray['customer_postcode']=$servicecall_model->customer->postcode;
                $myarray['customer_address']=$servicecall_model->customer->address_line_1." ".$servicecall_model->customer->address_line_2." ".$servicecall_model->customer->address_line_3." ".$servicecall_model->customer->town." ".$servicecall_model->customer->postcode;        
		
		//$myarray['engineer_id']=$engineer_id;
		$myarray['servicecall']=$servicecall;
		$myarray['customer']=$customer;
		
		////passing data to json format
		array_push($foreacharray,$myarray);
		//echo "<br>";	
		/////WE WILL PRINT VALUES HERE 

		?>
		<tr>
			<td><a href="<?php echo Yii::app()->request->baseUrl."/index.php?r=Servicecall/view&id=".$servicecall_model->id;?>"><?php echo $servicecall_model->service_reference_number;?></a></td>
			   <td><?php echo $vsd; ?></td>
                        <td><?php echo $servicecall_model->customer->fullname; ?></td>
			<td><?php echo $servicecall_model->customer->town;?></td>
			<td><?php echo $servicecall_model->customer->postcode; ?></td>
			<td><?php echo $servicecall_model->fault_description; ?></td>
			<td><?php echo $servicecall_model->engineer->company." - ".$servicecall_model->engineer->fullname; ?></td>
			<td><?php echo $servicecall_model->engineer->contactDetails->email; ?></td>
		</tr>
		<?php
		}///end of foreach

		return  $foreacharray;
}///end of function getservicecallsdatafromenggdiary
?>

</table>

<br><br><button onclick="post_data();">Sent To Mobile</button>

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>

<script>
function post_data() 
{
var data = <?php echo json_encode($json_data)?>;
json_data = JSON.stringify(data);
console.log(json_data);
$.ajax({
   url: '<?php echo $gomobile_server_url."index.php?r=server/getdatafromodule"?>',
 ///  url: 'http://127.0.0.1/purva/call_handling/not_to_be_shipped_with_chs/modules/gomobile/gomobileServer/gomobile/index.php?r=server/Getdatafromodule', 
		 
	  type: 'post',
	/// data: {'start_date': '24-Jul-2014', 'end_date': '30-Jul-2014', 'weekdays':showweekdays},
	  data: {'jsonData':json_data},
	  success: function(data, status) {   
				alert("Following Servicecalls has been sent to server:"+data);
				console.log(data);
				///Call a Javascript Function
				setServicecallsStatus(data);
      },
      error: function(xhr, desc, err) {
        console.log(xhr);
		alert("Details: " + desc + "\nError:" + err);
      }
    }); // end ajax call
//$.post("proto2.php", {'jsonData': json_data},function(data) {alert(data);});
}///end of function

function setServicecallsStatus(servicecalls)
{
$.ajax({
      url: 'index.php?r=gomobile/gmservicecalls/servicecallsenttogomobileserver',
      type: 'post',
	 // data: {'start_date': '24-Jul-2014', 'end_date': '30-Jul-2014', 'weekdays':showweekdays},
	  data: {'servicecall_ids':servicecalls},
	  success: function(data, status) {   
				alert("Success");
				window.location='<?php echo Yii::app()->request->baseUrl."/index.php?r=gomobile/gmservicecalls/admin" ?>';
      },
      error: function(xhr, desc, err) {
        console.log(xhr);
		alert("Details: " + desc + "\nError:" + err);
      }
    }); // end ajax call
}
</script>

</div>


