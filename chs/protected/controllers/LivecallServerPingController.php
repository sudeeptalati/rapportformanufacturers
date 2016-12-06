<?php

class LivecallServerPingController extends RController
{


	public function actionPingToServer($engg_id, $cust_postcode)
	{
		?>
		<br>
		<br> Live CALL Id <input type="text" name="live_call_id" id="live_call_id" value="90001"><br>
		
		<div id="searchresultdata" class="faq-articles"></div>
		<b>Said by Rapport Client</b>
		
		<div id="rapportclientdata" class="faq-articles"></div>
		<br><b>MY JSON DATA </b>
	
		<div id="myjsondata" class="faq-articles"></div>
		<div id="myjsondataresponse" class="faq-articles"></div>
		<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3/jquery.min.js"></script>
	 	
		// jQuery Document
		<script type="text/javascript">
		var live_call_id= $("#live_call_id").val();
		
		//console.log("Live Call Id "+live_call_id);
	
		$(document).ready(function () 
		{
			var title = "Rapport Client";
			var dataString = "onlineflag=true&live_call_id="+live_call_id+"&title="+ title;
			var baseurl = '<?php echo Yii::app()->baseUrl;?>';
			
			setInterval (connectToUKWServer, 10000);	//Reload file every 10 seconds
			connectToUKWServer();
			
			function connectToUKWServer() 
			{
				//console.log(" Rapport trying to connect to UKW serevr");
				//console.log("  request url IS :ukwserver.php"+dataString);
		
				$.ajax({
					type: "POST",
					//url: "../../ukwserver.php",
					//url: "http://localhost/Kruthika/call_handling/ukwserver.php",
					url: "http://192.168.1.200/livecall/ukwserver.php",
					
					data: dataString,
					async: false,
					success: function (server_response) 
					{
						//console.log('****************SERVER RESPONDED***********************');
						//console.log(server_response);
						var parsedJSON = eval('('+server_response+')');
						var status=parsedJSON.status;
						var status_text=parsedJSON.status_text;
						var query_postcode=parsedJSON.query_postcode;
						//console.log('********status_text:'+status_text+'********query_postcode:'+query_postcode);
		
						var displayText='';
						if (query_postcode!="none")
						{
							displayText="Looking for Postcode ............"+query_postcode;
							$('#searchresultdata').html(displayText).show();
							$('#rapportclientdata').html("Sure let me search my diary - I will call another diary API which will give me data. Once I recieved Data I will return back").show();
							var available_slots =getDiaryData(query_postcode);
							//$('#myjsondata').html();
							//console.log("RECIEVD DIATRY SAT AS IS : ********* "+available_slots);
							sendDiaryDataToUKWServer(live_call_id,available_slots);
						}
						else
						{
							displayText="NO Postcode found....!!!!!!!!, Please enter postcode";
							alert(displayText);
						}
						
					}//end of success().
				}); ///end of $.ajax Variable
		
			} ////end of connectToUkwServer
			
			function getDiaryData(query_postcode) 
			{
				//console.log("get Diary Data called");
				//var recieved_data;
				//url = "diary_data.php";
				var engg_id = '<?php echo $engg_id;?>';
				var cust_postcode = '<?php echo $cust_postcode;?>';
				var result = null;
				//var scriptUrl = "../../diary_data.php";
				//var scriptUrl = "http://192.168.1.200/livecall/diary_data.php";
				var scriptUrl = baseurl+'/routePlanner/getEngineerDiary?engg_id='+engg_id+'&cust_postcode='+cust_postcode;
				 
				$.ajax({
					url: scriptUrl,
					type: 'POST',
					dataType: 'html',
					async: false,
					success: function(data) {
						result = data;
					}
				});
					 
				return result;
		
			} ///end of getDiaryData
		

		
			function sendDiaryDataToUKWServer(live_call_id,available_slots) 
			{
				//console.log("sendDiaryDataToUKWServer called");
		
				//var recieved_data;
				var dataString = "status=5&live_call_id="+live_call_id+"&available_slots="+ available_slots;
				var result = null;
				//var scriptUrl = "../../ukwserver.php";
				 var scriptUrl= "http://192.168.1.200/livecall/ukwserver.php";

				 
				$.ajax({
					url: scriptUrl,
					data: dataString,
					type: 'POST',
					dataType: 'html',
					async: false,
					success: function(server_response) {
						//	alert(server_response);
						$('#myjsondataresponse').html(server_response).show();
						result = server_response;
					}
				});
					 
				return result;
		
			} ///end of sendDiaryDataToUKWServer Variable
			
		}); //////end of  $(document).ready(function () 

		</script>
	
		<!-- CALL BACK FUNCTION -->
		<script type="text/javascript">
		
		function someAction(x, y, someCallback) {
			return someCallback(x, y);
		}
		
		function findProduct(x, y) {
			return x * y;
		}
		
		function findSum(x, y) {
			return x + y;
		}
		
		// alerts 75, the product of 5 and 15
		// alert(someAction(5, 15, findProduct));
		// alerts 20, the sum of 5 and 15
		// alert(someAction(5, 15, findSum));
		</script>
	
	<?php 
	
	}//end of pingToServer().
	
	public function actionIndex()
	{
		$this->render('index');
	}

	// Uncomment the following methods and override them if needed
	/*
	public function filters()
	{
		// return the filter configuration for this controller, e.g.:
		return array(
			'inlineFilterName',
			array(
				'class'=>'path.to.FilterClass',
				'propertyName'=>'propertyValue',
			),
		);
	}

	public function actions()
	{
		// return external action classes, e.g.:
		return array(
			'action1'=>'path.to.ActionClass',
			'action2'=>array(
				'class'=>'path.to.AnotherActionClass',
				'propertyName'=>'propertyValue',
			),
		);
	}
	*/
}