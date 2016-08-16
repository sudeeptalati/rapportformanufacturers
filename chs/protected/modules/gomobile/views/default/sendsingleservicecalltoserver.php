<?php

function getthevalue($obj_model, $arr) {
    //echo '<hr>';
    //echo '<br> length of array'.count($arr);
    $arr_len = count($arr);
    $return_value = '';

    switch ($arr_len) {
        case "0":
            $return_value = '';
            break;
        case "1":
            $return_value = $obj_model->$arr[0];
            break;
        case "2":
            $return_value = $obj_model->$arr[0]->$arr[1];
            break;
        case "3":
            $return_value = $obj_model->$arr[0]->$arr[1]->$arr[2];
            break;
        case "4":
            $return_value = $obj_model->$arr[0]->$arr[1]->$arr[2]->$arr[3];
            break;
        case "5":
            $return_value = $obj_model->$arr[0]->$arr[1]->$arr[2]->$arr[3]->$arr[4];
            break;
    }//end of switch
    //echo '<br> return Value'.$return_value;

    return $return_value;
}

///end of function getthevalue()
?>


<?php
$servicecall_id = $_GET['id'];
//echo $servicecall_id;
$foreacharray = array(); //declaring a blank array for storing all fields
?>
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


    <?php
    $servicecall_model = Servicecall::model()->findByPk($servicecall_id);
    $service_reference_number = $servicecall_model->service_reference_number;
    $job_status_id = $servicecall_model->job_status_id;
    $created_by = $servicecall_model->created_by_user_id;
    $modified = $servicecall_model->modified;
    $created = $servicecall_model->created;
    $fault_description = $servicecall_model->fault_description;

    /////paasing the values to array
    
    
    $servicecall = array();
    $customer = array();
    $customer['name'] = $servicecall_model->customer->fullname;
    $customer['postcode'] = $servicecall_model->customer->postcode;

    $gm_json_fields_model = Gmjsonfields::model()->findAll();
    foreach ($gm_json_fields_model as $p) {
        $key = $p['field_relation'];
        $label = $p['field_label'];
        $type = $p['field_type'];
        if (strpos($key, '|') !== false) {
            $str_array = explode('|', $key);
            $value = getthevalue($servicecall_model, $str_array);
            //print_r($str_array);
            //$value=$servicecall_model->$str_array[0]->$str_array[1];	
            $servicecall[$label] = Gmjsonfields::model()->processDataFormat($value, $type);
            //echo $servicecall_model->customer->town;			
        } else {
            //echo "<br>Its a FIELS ";
            $value = $servicecall_model->$p['field_relation'];
            //$servicecall[$key]=$value;///disabled to be visible as label			
            $servicecall[$label] = Gmjsonfields::model()->processDataFormat($value, $type);
        }
    }

    //$engineer_id=$servicecall_model->engineer_id;
    $engineer_email = $servicecall_model->engineer->contactDetails->email;
   
    $myarray['service_reference_number'] = $service_reference_number;
    $myarray['gomobile_sentcall_id'] = $servicecall_model->id;
    
    
    ///VISIT DATE FORMAT FOR UNIVERSAL USE YYYY-MM-DD
    $vsd_int= time();
    $vsd=date('Y-m-d',$vsd_int);
    $myarray['visit_start_date'] = $vsd;

    $ved_int= time();
    $ved=date('Y-m-d',$ved_int);
    
    $myarray['visit_end_date'] = $ved;
    
    $myarray['gomobile_account_id'] = Gmservicecalls::model()->getaccountid();
   
    $myarray['engineer_email'] = $engineer_email;
    $myarray['customer_fullname'] = $servicecall_model->customer->fullname;
    $myarray['customer_postcode'] = $servicecall_model->customer->postcode;
    $myarray['customer_address'] = $servicecall_model->customer->address_line_1 . " " . $servicecall_model->customer->address_line_2 . " " . $servicecall_model->customer->address_line_3 . " " . $servicecall_model->customer->town . " " . $servicecall_model->customer->postcode;
    $gomobile_account_id = Gmservicecalls::model()->getaccountid();
    $myarray['gomobile_account_id'] = $gomobile_account_id;
    //$myarray['engineer_id']=$engineer_id;
    $myarray['servicecall'] = $servicecall;
    $myarray['customer'] = $customer;

    $myarray['time']= date( 'l jS \of F Y h:i:s A' );
    $myarray['type']= 'servicecall_data';


    $chatarray['chats']=array();
    $amica_chat_array = array();
    $amica_chat_array['date'] = date( 'l jS \of F Y h:i:s A' );
    $amica_chat_array['person'] = 'AMICA';
    $amica_chat_array['message'] ='Please see details attached';
    $chatarray['chats']= $amica_chat_array ;

    $communications['communications']=$chatarray;

    $myarray['allchatmessage'] = $chatarray;



    ////passing data to json format
    array_push($foreacharray, $myarray);
    //echo "<br>";	
    /////WE WILL PRINT VALUES HERE 
    ?>
    <tr>
        <td><a href="<?php echo Yii::app()->request->baseUrl . "/index.php?r=Servicecall/view&id=" . $servicecall_model->id; ?>"><?php echo $servicecall_model->service_reference_number; ?></a></td>
        
        <td><?php echo $vsd; ?></td>
        
        <td><?php echo $servicecall_model->customer->fullname; ?></td>
        <td><?php echo $servicecall_model->customer->town; ?></td>
        <td><?php echo $servicecall_model->customer->postcode; ?></td>
        <td><?php echo $servicecall_model->fault_description; ?></td>
        <td><?php echo $servicecall_model->engineer->company . " - " . $servicecall_model->engineer->fullname; ?></td>
        <td><?php echo $servicecall_model->engineer->contactDetails->email; ?></td>
    </tr>
<?php
//echo $myarray['customer']['name'];
$json_data = array('Details' => $foreacharray);
//echo json_encode($json_data);
$gomobile_server_url = Gmservicecalls::model()->getserverurl();
?>


</table>

<br><br>
Please wait for <span id="countdown" class="timer"></span> seconds. If window is not closed automatically please 
<a href=# onclick="post_data();">click here.</a>



<script>
    var seconds = 20;
    function secondPassed() {
        var minutes = Math.round((seconds - 30) / 60);
        var remainingSeconds = seconds % 60;
        if (remainingSeconds < 10) {
            remainingSeconds = "0" + remainingSeconds;
        }
        document.getElementById('countdown').innerHTML = minutes + ":" + remainingSeconds;
        if (seconds == 0) {
            clearInterval(countdownTimer);
            document.getElementById('countdown').innerHTML = "Buzz Buzz";
            //window.close();
        } else {
            seconds--;
        }
    }

    var countdownTimer = setInterval('secondPassed()', 1000);
</script>





<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>

<script>

    $(document).ready(function () {
        post_data();
    });

    function post_data()
    {
        var data = <?php echo json_encode($json_data) ?>;
        json_data = JSON.stringify(data);
        console.log(json_data);
        $.ajax({
            url: '<?php echo $gomobile_server_url . "?r=server/getdatafromodule" ?>',
            ///  url: 'http://127.0.0.1/purva/call_handling/not_to_be_shipped_with_chs/modules/gomobile/gomobileServer/gomobile/index.php?r=server/Getdatafromodule', 

            type: 'post',
            /// data: {'start_date': '24-Jul-2014', 'end_date': '30-Jul-2014', 'weekdays':showweekdays},
            data: {'jsonData': json_data},
            success: function (data, status) {
                //alert("Following Servicecalls has been sent to server:"+data);
                //console.log(data);
                console.log('<?php echo $gomobile_server_url . "?r=server/getdatafromodule" ?>');

                ///Call a Javascript Function
                setServicecallsStatus(data);
            },
            error: function (xhr, desc, err) {
                console.log(xhr);
                alert("Details: " + desc + "\nError:" + err);
            }
        }); // end ajax call
//$.post("proto2.php", {'jsonData': json_data},function(data) {alert(data);});
    }///end of function

    function setServicecallsStatus(servicecalls)
    {
         servicecalls = servicecalls.replace(/\\/g, "");




        //var chatarraydata = <?php echo json_encode($communications) ?>;
        //chat_data_jstr = JSON.stringify(chatarraydata);
        var data_sent = <?php echo json_encode($json_data) ?>;
         var data_sent_string=json_data = JSON.stringify(data_sent);
        //data_sent = data_sent.replace(/\\/g, "");
        console.log('THIS WASS SENT---'+data_sent_string);


        console.log('Sert Servicecall status called --'+servicecalls);


        var servicecalls_json = JSON.parse(servicecalls);

        console.log('Total Servicecalls Recieved SERVER'+servicecalls_json.data.sent_servicecalls.length);

        if (servicecalls_json.data.unsent_servicecalls.length > 0)
        {
        	console.log('*******'+servicecalls);
            alert(servicecalls_json.data.unsent_servicecalls[0].message);
            alert('Please check engineer email for any white spaces.');

	        window.close();
        } else
        {
            console.log('Setting up the sent stattuses');
            $.ajax({
                url: 'index.php?r=gomobile/gmservicecalls/servicecallsenttogomobileserver',
                type: 'post',
                // data: {'start_date': '24-Jul-2014', 'end_date': '30-Jul-2014', 'weekdays':showweekdays},
                data: {'servicecall_ids': servicecalls, 'data_sent':data_sent },
                success: function (data, status) {
                    alert("Successfully sent");
                    console.log(data);
                    window.close();
                    refreshParent();
                },
                error: function (xhr, desc, err) {
                    console.log(xhr);
                    alert("Details: " + desc + "\nError:" + err);
                }
            }); // end ajax call
        }///end of setServicecallsStatus(servicecalls)
    }//end of if (servicecalls_json.unsent_servicecalls.length > 0)


    function refreshParent() {
        window.opener.location.reload();
    }

</script>