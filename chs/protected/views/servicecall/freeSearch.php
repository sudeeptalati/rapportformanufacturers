<body onload="document.search_form.query.focus()">
 
<?php
include('servicecall_sidemenu.php');
?>


<?php 
  /*To import the client script*/
  $baseUrl = Yii::app()->baseUrl; 
  $cs = Yii::app()->getClientScript();
  $cs->registerScriptFile($baseUrl.'/js/jquery.js');
  
?>
  
   <div class="admin">
 
  <script type="text/javascript">
 
  function stopRKey(evt) { 
	  var evt = (evt) ? evt : ((event) ? event : null); 
	  var node = (evt.target) ? evt.target : ((evt.srcElement) ? evt.srcElement : null); 
	  if ((evt.keyCode == 13) && (node.type=="text"))  {return false;} 
	} 

	document.onkeypress = stopRKey; 

	
$(document).ready(function() {
 
 
$("#faq_search_input").keyup(function()
{
	var faq_search_input = $(this).val();
	var dataString = 'keyword='+ faq_search_input;
	 
//	var ref_id = $('#ref_id').val(); 
//	var cust_id = $('#cust_id').val(); 
	var current_url = $('#current_url').val(); 

	/*This is the minimum size of search string. Search will be only done when at-least 3 characters are provided in input*/
	if(faq_search_input.length>3)
	{
		$.ajax({
		type: "GET",
		url: current_url+"/searchengine",
		data: dataString,
		/*Uncomment this if you want to send the additional data*/
		//data: dataString+"&refid="+ref_id+"&custid="+cust_id,
		beforeSend:  function() 
		{
 			$('input#faq_search_input').addClass('loading');
 		},
 		success: function(server_response)
 		{
 		 
 			$('#searchresultdata').html(server_response).show();
 			$('span#faq_category_title').html(faq_search_input);

 			if ($('input#faq_search_input').hasClass("loading")) 
 	 		{
 				 $("input#faq_search_input").removeClass("loading");
 			}

 		}//end of success
		});//end of $.ajax
	}//end of if.
	return false;
});//end of keyup function.
});//end of ready function.
</script>

 

<?php
 
/*You need to change the URL as per your requirements, else this will show error page*/
$model_name=Yii::app()->controller->id;
$current_url=$baseUrl."/index.php?r=".$model_name;

/*To Send the additional data if needed*/
//$reference_id = 88;
//$customer_id = 77;
//echo "Search   :".$current_url."<br>";
?>

<input type="hidden" id="current_url" value="<?php echo $current_url;?>"/> 
        <!-- if YOU WANT TO SEND ADDITIONAL HIDDEN VARIABLES-->
<!--        <input type="hidden" id="ref_id" value="<?php //echo $reference_id ;?>"/> -->
<!--        <input type="hidden" id="cust_id" value="<?php //echo $customer_id ;?>"/>  -->
        
              Search by Customer Name or Postcode or Phone number or Reference Number<br><br>
                <!-- The Searchbox Starts Here  -->
                <form  name="search_form">
                 <input  name="query" type="text" id="faq_search_input" style="background-color: #FFFFFF" />
                </form>
                <!-- The Searchbox Ends  Here  -->
        <div id="searchresultdata" class="faq-articles"> </div>
     </div>
     <p align="right">
     <?php //echo CHtml::link('New Customer Service', array('servicecall/create'));
       		$service_img_url = Yii::app()->request->baseUrl.'/images/service.gif';
			$service_img_html = CHtml::image($service_img_url,'Raise Service Call',array('width'=>30,'height'=>30, 'title'=>'Raise Service Call')); 

			?>
		
       <?php echo CHtml::link('New Customer Service', array('servicecall/create')); ?>
       <?php echo CHtml::link($service_img_html, array('Servicecall/create'));?>	
       </p>
        <br>
  <br>
  
  <!-- ***********************************END OF SEARCH FORM ****************************** -->
     
     
            
<!-- ***********************************DASHBOARD ****************************** -->

        
<style type="text/css">

#dashboard_container {
	width: 700px;
	margin: 0 auto;
	
}


#first_column {
	float: left;
	width: 50%;
	background-color:#B7D6E7;
	border-radius: 15px;
	vertical-align:top;

}
#second_column_top {
	float: left;
	width: 50%;
	background-color:#B7E6D7;
	border-radius: 15px;
	vertical-align:top;
}

#second_column_bottom {
	float: left;
	width: 50%;
	background-color:#FAF88D;
border-radius: 15px;
vertical-align:top;
}

td,th{
vertical-align:top;
}
 
</style>
        
<div id="dashboard_container">

<table >
	<tr>
		<td id="first_column"><br>
		
 
		<span style="float:left"><b><?php echo CHtml::link('Recent Servicecalls', array('servicecall/admin'));?></b></span>
		
	<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'servicecall-grid',
	//'dataProvider'=>Servicecall::model()->search(),
	'dataProvider'=>Servicecall::model()->latestTenResults(),
	//'filter'=>Servicecall::model(),
	'columns'=>array(
		array(	'name'=>'service_reference_number',
				'value'=>'$data->service_reference_number',
			    'value' => 'CHtml::link($data->service_reference_number, array("Servicecall/view&id=".$data->id))',
		 		'type'=>'raw',
				'header' => 'Ref No#'
		),
 		array('name'=>'customer_name','value'=>'$data->customer->fullname','header' => 'Customer',),
 		//array('name'=>'customer_town','value'=>'$data->customer->town'),
 		array('name'=>'postcode','value'=>'$data->customer->postcode_s." ".$data->customer->postcode_e'),
 		array('header' => 'Product',
             	'name'=>'product_name',
 				'value'=>'$data->product->brand->name." ".$data->product->productType->name',
 				),
 		array( 	'header' => 'Engineer', 
				'type'=>'raw',     	
				'name'=>'engineer_name',
				'value'=>'$data->engineer->fullname',
				 
				
			),
	),
)); ?>
		</td>
		
		
		<td style="	vertical-align:top;">		
		<table>
		<tr><td id="second_column_top">
		<br>
		<span><b>&nbsp;&nbsp;Service Calls</b></span><br><br>
		
		<table>
			
			
			
			<?php
			
			
			
//EVENT LISTENER FOR MANAGEMENT FIELD.
?>

<?php 

$allStatus = JobStatus::model()->findAll( array(
												'condition'=>'dashboard_display=1',
												'order'=>'dashboard_prority_order ASC',
												 //'limit' => 3
												));
				foreach ($allStatus as $data)
				{
					
					$anchor_var=$data->id.'anchor';
					$div_var=$data->id.'div';
					
					?>
					<script type="text/javascript">
 						$(document).ready(function(){
						        $(".<?php echo $div_var; ?>").hide();
						        $(".<?php echo $anchor_var; ?>").show();
						    $('.<?php echo $anchor_var; ?>').click(function(){
						    $(".<?php echo $div_var; ?>").slideToggle();
						    });
						 
						});
					</script>
					
					<?php
					//echo $data->name."<br>";
					$result = Servicecall::model()->findAll(array(
																'condition'=>'job_status_id='.$data->id,
																'limit' => 10,
																'order' => 'id DESC'
															)
														);
					if(count($result)>0)
					{?>
						<tr style="background:<?php echo $data->backgroundcolor;?>;">
						<td style="border-radius:15px;  padding:10px;">
						<span style="margin-left:20px;margin-top:10px;  ">
						<?php 
						echo "<b>".$data->name."&nbsp;&nbsp;&nbsp;(".count($result).")"."</b>";
						?>
						
						<a href="#" class="<?php echo $anchor_var; ?>">
						
						<?php 
						$down_arrow_img = Yii::app()->request->baseUrl.'/images/arrow_down.png';
						echo CHtml::image($down_arrow_img,'Raise Service Call',array('width'=>16,'height'=>16, 'title'=>'Show Service Calls')); 
						?>
						</a>
						<div class="<?php echo $div_var; ?>">
 						
 						<table><tr><td></td></tr>
						<tr style="background: #B7D6E7;">
							<th>Ref. No#</th>
							<th>Customer</th>
							<th style="width:7em;">Postcode</th>
							<th>Product</th>
							</tr>
							
						<?php 
						foreach ($result as $row)
						{?>
							  
							<tr><td>							
								<?php echo CHtml::link($row->service_reference_number, array("Servicecall/view&id=".$row->id)); ?>
							</td><td>
								<?php echo $row->customer->fullname; ?>							
							</td><td style="width:25px;">
								<?php echo $row->customer->postcode; ?>							
							</td><td>
								<?php echo $row->product->productType->name; ?>							
							
							</td></tr>
						<?php }//end of foreach(). 
						
						?> 
						</table>
						</div>
						<?php 
					}//end of if count.
					 									
				
					?>
					</span>	
					</td></tr>
					
					<?php 
				
				}///end of foreeach													   	
			?>			
			</td></tr>
		
		</table>
		
		
		</td></tr>
		
		<tr><td></td></tr>
		<tr><td id="second_column_bottom">
		<br>
		<span><b>&nbsp;&nbsp;Notifications</b></span><br><br>
		
		<div style="margin-left:20px;">
		<ul>
		<?php 
	
		$setupModel = Setup::model()->findByPk(1);
		
		$internet_connected =  AdvanceSettings::model()->findByAttributes(array('parameter'=>'internet_connected'));
		if ($internet_connected->value==1)
		{
		
			if($conn = @fsockopen("google.com", 80, $errno, $errstr, 30))
			{
				
 
				
				$update_url_from_db = $setupModel->version_update_url;
				//$request='http://www.rapportsoftware.co.uk/versions/rapport_callhandling.txt';
				$request = $update_url_from_db.'/latest_callhandling_version.txt';	
				$available_version = curl_file_get_contents($request, true);
				$installed_version=Yii::app()->params['software_version'];
				
			 
				if ( $available_version>$installed_version )
				{	
					?>
					
					<li style="text-align:justify; margin-left:10px;">
					<span style="color:red;">
					Your current version is <?php echo $installed_version; ?>
					There is a new updated version <?php echo $available_version ?> available for this software. Please go to rapportsoftware.co.uk to download and update the package
					</span>
					</li>
					
					
				<?php 
				}//end if inner if(version compare).
				
				?>
				<li style="text-align:justify; margin-left:10px;">	
					<?php
						$server_msg_url='http://www.rapportsoftware.co.uk/versions/rapport_callhandling_general_message.txt';	
							$server_msg = curl_file_get_contents($server_msg_url, true);
			
							echo $server_msg; 
					?>
				</li>
				<?php
				
				
				
				
				
			}//end of if(internet from Google).
			else
			{
				echo "<span style='color:red'><b>No Internet. All internet features like notifications, email, sms have been disabled.</b></span>";
				//We will set the settings in the database back to offline so that the performance is not affected
				disableInternetConnection();
			}
		
		}// end of if internet from database
		else
			{
			echo "<span style='color:red'><b>Internet connection not available.You will not be able to use any internet serivce like emails, sms or notifications<br>Please Connect to Internet and enable connection from here.</b></span><br><br>";
			echo '<a href="?enable_internet=yes">Enable Internet</a><br><br>'; 
			
			if(isset($_GET['enable_internet']))
			{
			enableInternetConnection();
			};
			
			}
		
			?>
	
		</span>
		
		</ul>
		</td>
		
		</tr>

	</table>
		</td>
		
		
	</tr>
	</table>

	</div>

    
     <?php

function curl_file_get_contents($request)
{
$curl_req = curl_init($request);

curl_setopt($curl_req, CURLOPT_RETURNTRANSFER, TRUE);
curl_setopt($curl_req, CURLOPT_HEADER, FALSE);

$contents = curl_exec($curl_req);

curl_close($curl_req);

return $contents;
}///end of functn curl File get contents

function enableInternetConnection()
{
	////since at id 10001 in table advance settings have the parameter for the internet connectios
	AdvanceSettings::model()->updateByPk(10001, array('value'=>'1'));
	$url= Yii::app()->getBaseUrl(true);
	Yii::app()->controller->redirect($url);
	
	}	

function disableInternetConnection()
{
	////since at id 10001 in table advance settings have the parameter for the internet connectios
	AdvanceSettings::model()->updateByPk(10001, array('value'=>'0'));
	
	$url= Yii::app()->getBaseUrl(true);
	Yii::app()->controller->redirect($url);
	
	
	}	


?>
      
     
      
