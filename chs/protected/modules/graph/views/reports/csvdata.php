<?php
 

$csv_header=array();
$selected_fields_of_reports=array();
$results=array();

$report_fields=Graphreportfields::model()->findAll(array('condition'=>'active=1',	'order'=>'sort_order ASC'));
foreach($report_fields as $e)
{	
	array_push($csv_header,$e->field_label);
	$fields=array();
	$fields['field_relation']=$e->field_relation;
	$fields['field_label']=$e->field_label;
	$fields['field_type']=$e->field_type;
	$fields['active']=$e->active;
	array_push($selected_fields_of_reports,$fields);
}//end of foreach ($report_fields as $e) 

$total_fields_in_report=count($selected_fields_of_reports);

	
 
array_push($results,$csv_header);

$dataArray = $active_data_for_csv->getData(); 

foreach($dataArray as $row)
{
	$row_array=array();
	$service_id=$row['id'];
	for($i=0;$i<$total_fields_in_report;$i++)
	{	
		$relation= $selected_fields_of_reports[$i]['field_relation'];
		$type=$selected_fields_of_reports[$i]['field_type'];
		
		
		////This is specifically altereted for AMICA as they have the invoice column 
		if (strpos($relation,'invoice') !== false) {
 		   
 		   $row_data=getinvoicedatabyrefno($relation,$service_id);
			

		}else
		{
			$row_data=processmyrowdata($row,$relation);
		}
		
		
		$row_data=processDataFormat($row_data,$type);
		
		array_push($row_array,$row_data);
		
	}//end of f
	
	 
	array_push($results,$row_array);

	//echo "<hr>".$d->service_reference_number;

}///end of foreach($dataArray as $d)

//echo json_encode($results);

$csv_filename='servicecall_reports.csv';


 
 
?>


 
<div id="json" style='display:none;'><?php echo json_encode($results);?> </div>
	 


<script>

var json = document.getElementById("json").innerHTML;
document.onload=JSONToCSVConvertor(json,'servicereport',false);

function callme()
{ 
	/*
	var divdata=document.getElementById("kruthikaxls").innerHTML;
	console.log(divdata);
	var dynxls=document.getElementById("dynamicxls");
	var xlsdata="data:text/html;charset=utf-8,"+divdata;
	dynxls.setAttribute('href',xlsdata );
	*/
}


function JSONToCSVConvertor(JSONData, ReportTitle, ShowLabel) {
    //If JSONData is not an object then JSON.parse will parse the JSON string in an Object
    var arrData = typeof JSONData != 'object' ? JSON.parse(JSONData) : JSONData;
    
    var CSV = '';    
    //Set Report title in first row or line
    
    CSV += ReportTitle + '\r\n\n';

    //This condition will generate the Label/Header
    if (ShowLabel) {
        var row = "";
        
        //This loop will extract the label from 1st index of on array
        for (var index in arrData[0]) {
            
            //Now convert each value to string and comma-seprated
            row += index + ',';
        }

        row = row.slice(0, -1);
        
        //append Label row with line break
        CSV += row + '\r\n';
    }
    
    //1st loop is to extract each row
    for (var i = 0; i < arrData.length; i++) {
        var row = "";
        
        //2nd loop will extract each column and convert it in string comma-seprated
        for (var index in arrData[i]) {
            row += '"' + arrData[i][index] + '",';
        }

        row.slice(0, row.length - 1);
        
        //add a line break after each row
        CSV += row + '\r\n';
    }

    if (CSV == '') {        
        alert("Invalid data");
        return;
    }   
    
    //Generate a file name
    var fileName = "";
    //this will remove the blank-spaces from the title and replace it with an underscore
    fileName += ReportTitle.replace(/ /g,"_");   
    
    //Initialize file format you want csv or xls
    var uri = 'data:text/csv;charset=utf-8,' + escape(CSV);
    
    // Now the little tricky part.
    // you can use either>> window.open(uri);
    // but this will not work in some browsers
    // or you will not get the correct file extension    
    
    //this trick will generate a temp <a /> tag
    var link = document.createElement("a");    
    link.href = uri;
    
    //set the visibility hidden so it will not effect on your web-layout
    link.style = "visibility:hidden";
    link.download = fileName + ".csv";
    
    //this part will append the anchor tag and remove it after automatic click
    document.body.appendChild(link);
    link.click();
    document.body.removeChild(link);
}
 

</script>
 
 
 
 
 

<?php
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


function processmyrowdata($d,$relation)
{
	$return_data='';

	if ($relation!='blank_field') 
	{
		$length='0';
		$relation = preg_replace('/\s+/', '', $relation);///to remove any whitespaces
		$a = explode( '|', $relation);
		$length=count($a);
		
		switch ($length) {
			case 0:
					//$excel_data .= "BY 0 LEN".$d->$f;
					break;
			case 1:
					//$excel_data .= "By Lenth 1";		
					if (isset($d->$a[0]))
					{
						$return_data .= $d->$a[0];
					}
					break;
					
			case 2:
					if (isset($d->$a[0]->$a[1]))
					{
						$return_data.= $d->$a[0]->$a[1] ;							
					}
					break;
			
			case 3:
					if (isset($d->$a[0]->$a[1]->$a[2])) {
						$return_data .= $d->$a[0]->$a[1]->$a[2];
					}
					break;
				
			case 4:
					if (isset($d->$a[0]->$a[1]->$a[2]->$a[3]))
					{
						$return_data .= $d->$a[0]->$a[1]->$a[2]->$a[3];
					}	
					break;
				
			case 5:
					if (isset($d->$a[0]->$a[1]->$a[2]->$a[3]->$a[4]))
					{
						$return_data .= $d->$a[0]->$a[1]->$a[2]->$a[3]->$a[4];
					}
					break;
			}///end of switch
		
	}else
	{
		$return_data='';///for blank fields
	}
	
	return $return_data;
	
	
}///end of processmyrowdata
 
 
function processDataFormat ($data,$type)
	{
		switch ($type) {
	
		case "TEXT":
					return $data;			
					 
				 
		case "DATETIME":
					if (!empty($data))
					{
						return date("d-M-Y",$data);			
					}
					else
					{
						return "";
					}
					
		
		//$data = mb_check_encoding($data, 'UTF-8') ? $data : utf8_encode($value);
		return $data;
		
		
		}///end of SWICTCH
}/// end of 	public processDataForReports($data,$type)




function  getinvoicedatabyrefno($relation,$service_id )
{

$invoicemodel=Invoice::model()->findByAttributes(array('servicecall_id'=>$service_id));
$a = explode( '|', $relation);
return $invoicemodel[$a[1]];

}/////function  getinvoicedatabyrefno($relation,$ref_no );

	?>
