

<?php include('gomobile_menu.php'); 
$gomobile_server_url=Gmservicecalls::model()->getserverurl();
$gomobile_account_id=Gmservicecalls::model()->getaccountid();
 
?>
<h2>Get Data From The GoMobile Server</h2>
<h4>Getting Data from Server for Following Engineers</h4>
<pre>
Your GoMobile Account Id: <?php echo $gomobile_account_id; ?>
</pre>


<?php

$enggs=Engineer::model()->findAll(array('condition' => 'active=1'));
$engineer_emails_array=array();

foreach ($enggs as $e)
{
	echo '<br>'.$e->fullname.' - '.$e->contactDetails->email;
	array_push($engineer_emails_array,$e->contactDetails->email);
}
 

//print_r($engineer_emails_array);


?>  
<br>

<button id='getdatabutton' onclick="receive_data();">Get Data</button>
<script>

$(document).ready ( function(){
	
   receive_data();

  });

var engg_emails=<?php echo json_encode($engineer_emails_array); ?>;
//console.log('Engg EMails :'+engg_emails);
var gomobile_account_id='<?php echo  $gomobile_account_id; ?>';
console.log('gomobile_account_id 	 :'+gomobile_account_id);


function receive_data() 
{

document.getElementById("getdatabutton").style.visibility='hidden';

$.ajax({
	///url:'http://127.0.0.1/purva/call_handling/not_to_be_shipped_with_chs/modules/gomobile/gomobileServer/gomobile/index.php?r=server/getdatafordesktop',
	url:'<?php echo $gomobile_server_url."index.php?r=server/getdatafordesktop"?>', 
	type: 'post',
	data: {'gomobile_account_id':gomobile_account_id, 'engineer_emails':engg_emails}, 
	success: function(data, status) {   
				//alert("Following data has been received from Mobile:"+data);
				console.log(data);
				//setServicecallsStatus(data);

      },
      error: function(xhr, desc, err) {
      console.log(xhr);
	  alert("Details: " + desc + "\nError:" + err);
      }
	  
	})
}///end of function

function setServicecallsStatus(data)
{
$.ajax({
      url: 'index.php?r=gomobile/gmservicecalls/servicecallreceivedfromgomobileserver',
      type: 'post',
	  data: {'data':data},
	  success: function(data, status) {
				alert("Success"+data);
				window.location='<?php echo Yii::app()->request->baseUrl."/index.php?r=gomobile/gmservicecalls/receivedcalls" ?>';
      },
      error: function(xhr, desc, err) {
        console.log(xhr);
		alert("Details: " + desc + "\nError:" + err);
      }
    }); // end ajax call
}

</script>