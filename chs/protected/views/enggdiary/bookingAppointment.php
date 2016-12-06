
<!-- <input id="test" type="submit" value="Show Dialog" /> -->


<div id="confirmation_box" style="display:none; cursor: default">
<div id='confirmation_box_msg' style="color:black;"></div>
<input type="button" id="yes" value="Yes" />
<input type="button" id="no" value="No" />
</div>

 
 
<?php

  /*To import the client script*/
  $baseUrl = Yii::app()->baseUrl; 
  $cs = Yii::app()->getClientScript();
    
  $cs->registerScriptFile($baseUrl.'/js/fullcalendar/jquery-1.7.1.min.js');
  $cs->registerScriptFile($baseUrl.'/js/fullcalendar/jquery-ui-1.8.17.custom.min.js');
  $cs->registerScriptFile($baseUrl.'/js/fullcalendar/fullcalendar.min.js');
  $cs->registerScriptFile($baseUrl.'/js/fullcalendar/jquery.ui.touch-punch.js');
  $cs->registerScriptFile($baseUrl.'/js/jquery.blockUI.js');
 
  
//  echo "ENGG ID IN VIEWFULLDIARY FORM = ".$engg_id."<br>";
//  
//  echo "SERVICECALL ID IN VIEWFULLDIARY FORM = ".$service_id;
?>

<?php 

//echo "ENGG ID IN VIEWFULLDIARY FORM = ".$engg_id;
//echo "<br>SERVICECALL ID IN VIEWFULLDIARY FORM = ".$service_id;

$serviceModel = Servicecall::model()->findByPk($service_id);

$customer_name = $serviceModel->customer->fullname;
$custAddress = $serviceModel->customer->town." ".$serviceModel->customer->postcode;
$prodType = $serviceModel->product->productType->name;
$prodBrand = $serviceModel->product->brand->name;
$faultDesrc = $serviceModel->fault_description;
$faultDate = date('d-m-Y',$serviceModel->fault_date);

$engineerModel  =Engineer::model()->findByPk($engg_id);
$enggName = $engineerModel->fullname; 
$companyName = $engineerModel->company; 

$enggAddress = $engineerModel->contactDetails->town." ".$engineerModel->contactDetails->postcode;

$diaryModel = Enggdiary::model()->findAllByAttributes(
                                array('servicecall_id'=>$service_id), 
                                "status = 3" 
                            );	
foreach ($diaryModel as $data)
{                                                        
	$appointment_date = date('d-M-Y', $data->visit_start_date);                           
}
?>

<br><br>
<table style="width:900px;">

<tr>
	<?php if($engineerModel!=null){?>
	<th>Engineer</th>
	<?php }//end of if !null of enggmodel.?>
	<th>Customer</th>
	
	<th>Product</th>
	<th>Fault</th>
	<?php if($diaryModel!= null){?>
	<th>Current Appointment</th>
	<?php }//end of if.?>
</tr>

<tr><td>
		<?php echo $enggName;?><br>
		<?php echo $enggAddress;?>
	</td>
	<td>
		<?php echo $customer_name;?><br>
		<?php echo $custAddress;?>
	</td>
	<?php if($engineerModel!= null){?>

	<?php }//end if if !null of enggmodel.?>
	<td>
		<?php echo $prodBrand;?><br>
		<?php echo $prodType;?>
	</td>
	<td>
		<?php echo $faultDate;?><br>
		<?php echo $faultDesrc;?>
	</td>
	<?php if($diaryModel!= null){?>
	<td>
		<?php echo $appointment_date; ?>
	</td>
	<?php }//end of if.?>
</tr>

</table>

<br><br><br>
<div class="form">

<?php 
	//echo $model->engineer_id;
	$baseUrl=Yii::app()->request->baseUrl;
	$changeEnggUrl=$baseUrl.'/index.php?r=Enggdiary/viewFullDiary/';	

	$enggdiaryform=$this->beginWidget('CActiveForm', array(
	'id'=>'enggdiary-changeEngineer-form',
	'enableAjaxValidation'=>false,
	//'action'=>$changeEnggUrl,
	'method'=>'get'
	
)); 
?>

<?php //echo "BEFORE DROP ENGG ID IN VIEWFULLDIARY FORM = ".$engg_id."<br>"; ?>

<?php 
	
	//$engg_id=$model->engineer_id;
 	$data=CHtml::listData(Engineer::model()->findAll(array('order'=>"`company` ASC")), 'id', 'fullname', 'company');
 	echo "<b>Select to Change Engineer&nbsp;&nbsp;&nbsp;</b>";
	echo $enggdiaryform->dropDownList($model, 'engineer_id', $data,
								array('empty'=>array(0=>'All Engineers')) 
								
							  );
	echo "&nbsp;&nbsp;".CHtml::submitButton('Change');
	echo "<br><small>(List is arranges by Engineers names)</small>"
	
?>
<?php $this->endWidget(); ?>
</div><!-- ENd of form -->

<script type='text/javascript'>


function isTouchDevice()
{
    var ua = navigator.userAgent;
    var isTouchDevice = (
        ua.match(/iPad/i) ||
        ua.match(/iPhone/i) ||
        ua.match(/iPod/i) ||
        ua.match(/Android/i)
    );

    return isTouchDevice;
}
	//var url = 'http://localhost/KRUTHIKA/rapport_chs_experiment/chs/api/DisplayDiary';
	
	
	var baseUrl='<?php echo $baseUrl; ?>';
	//alert(baseUrl);
	var engg_id = '<?php echo $engg_id;?>';
	//var dataUrl = baseUrl;
	//alert(engg_id);
	var dataUrl  =  baseUrl+'/index.php?r=api/ViewFullDiaryJsonData&engg_id='+engg_id;
	//alert(dataUrl);
	
	
	$(document).ready(function() 
	{
								
		$('#calendar').fullCalendar({
		
			header: {
				left: 'prev,next today',
				center: 'title',
				right: 'month,agendaWeek,agendaDay'
			},

			editable: true,
			events:dataUrl,
			selectable: true,
			minTime:'8',
			maxTime:'18',
			weekends:true,
			
			
			eventResize: function(event,dayDelta,minuteDelta,revertFunc) 
		    {
//				alert(
//		            "The end date of " + event.title + "has been moved " +
//		            dayDelta + " days and " +
//		            minuteDelta + " minutes."
//		        );

		        //alert("Engg diary id = "+event.id);
		        diary_id = event.id;

				////CALL UPDATE STATEMNET HERE 
				updateEndDateTime(diary_id, dayDelta, minuteDelta);

//		        if (!confirm("is this okay?")) 
//				{
//		            revertFunc();
//		        }

		    },//end of eventResize.
			
/*
			eventDrop: function (event,delta) 
			{
				
//				alert(event.title + ' was moved ' + delta + ' days\n' +
//					'(should probably update your database)');
				
				//alert ('Add Logic here to call and change database');	

				//alert (document.location.hostname);
				
				days_moved=delta;
				console.info("DAYS MOVED"+days_moved);
				//alert('ID = '+event.id);
				
				//alert('event end date = '+event.end)
				end_date = event.end;
				engg_id = event.id;
				 
				
				////CALL UPDATE STATEMNET HERE 
				updateAppointmentDay();
				//alert(delta);
				
				
				/////end of logic to move
				//location.reload();		

				},//end of eventDrop.
				
	*/				

				dayClick: function(date, allDay, jsEvent, view) 
				{
					//$.blockUI({ message: "Please wait....."});
					var today = new Date();

					//var curr_date = today.getDate();
					//var curr_month = today.getMonth()+1;//getMonth() method starts from 0 to 11 so +1 to get correct month value.
					//var curr_year = today.getFullYear();

					//var today = curr_date + "-" + curr_month + "-" + curr_year;
					//var today = '18-4-2013';
					
					today.setHours(0,0,0,0);
					today = today.getTime();
					
					//alert("Today is = "+today);

					var clicked_cal_date = date.getDate();
					//var clicked_month = date.getMonth()+1;//getMonth() method starts from 0 to 11 so +1 to get correct month value.
					var clicked_month = getMonthName(date.getMonth());
					var clicked_year = date.getFullYear();
					
					
					var clicked_date_to_display = clicked_cal_date + "-" + clicked_month + "-" + clicked_year;
					var clicked_date = date.getTime();
					//var clicked_date = '3-4-2013';
					//alert("Date clicked = "+clicked_date.getTime());
					//alert("Date clicked = "+clicked_date);

					
					if(clicked_date>=today)
					{
							engg_id = '<?php echo $engg_id;?>';	 
							service_id = '<?php echo $service_id;?>';
							
							var conf_box_msg="Do you want to book appointment on "+clicked_date_to_display+"?";
							var r=confirm("Do you want to book appointment on "+clicked_date_to_display+"?")
							
							if (r==true)
							  {
							  console.log("You pressed OK!");
							  createNewDiaryEntry(clicked_date_to_display, engg_id, service_id);	
							  }
							else
							  {
								console.log("You pressed Cancel!");
							  }							  
					}//end of Booking appointment.
					else
					{
						//alert("Cant book...........");
						
						$.blockUI({ message: ("Cannot book calls for previous days"),
							css: { 
					            border: 'none', 
					            padding: '15px', 
					            backgroundColor: '#c3D9FF', 
					            '-webkit-border-radius': '10px', 
					            '-moz-border-radius': '10px', 
					            opacity: 1, 
					            color: 'black' //text color
					        } 
						});
						setTimeout($.unblockUI, 1000);
						
						
					}
				
					// change the day's background color just for fun
			        //$(this).css('background-color', 'pink');
			        
				},//end of dayClick function().
				
			
				loading: function(isLoading)
				{
				    if(!isLoading && isTouchDevice())
				    {
				        // Since the draggable events are lazy(bind)loaded, we need to
				        // trigger them all so they're all ready for us to drag/drop
				        // on the iPad. w00t!
				        $('.fc-event-draggable').each(function(){
				            var e = jQuery.Event("mouseover", {
				                target: this.firstChild,
				                _dummyCalledOnStartup: true
				            });
				            $(this).trigger(e);
				        });
				    }
				}

			/* 
			loading: function(bool) {
				if (bool) $('#loading').show();
				else $('#loading').hide();
			}
			*/
		});
	});

	function getMonthName(date)
	{
		var month=new Array();
		month[0]="January";
		month[1]="February";
		month[2]="March";
		month[3]="April";
		month[4]="May";
		month[5]="June";
		month[6]="July";
		month[7]="August";
		month[8]="September";
		month[9]="October";
		month[10]="November";
		month[11]="December";

		//var d = new Date();
		//var x = document.getElementById("demo");
		//x.innerHTML=month[d.getMonth()];
		return month[date];
	}
	
	function updateAppointmentDay()
    {
	    model = 'Enggdiary';
	    //alert("EVENT END DATE IN FUNC = "+end_date);
	   	//alert("EVENT ID IN FUNC = "+engg_id);
	    //alert("DAYS MOVED IN FUNC = "+days_moved);

	    var updateUrl= baseUrl+'/index.php?r=api/UpdateDiary&engg_id='+engg_id+'&days_moved='+days_moved;
	    //model = 'Enggdiary';
	    $.ajax({
        	type: 'POST',
            url: updateUrl ,
            
          
          success: function(data) 
          { 
	          //alert(updateUrl);
	      },
          error: function()
          {
	       	alert("ERROR"); 
          }
          });

    }//end of getResponse func().


    function updateEndDateTime(diary_id, dayDelta, minuteDelta)
    {
		//alert('In updateMinutes func');

		//alert("MINUTES IN updateMinutes func = "+minuteDelta);

		//alert("ENGG ID IN updateMinutes func = "+engg_id);

		 var updateUrl= baseUrl+'/index.php?r=api/UpdateEndDateTime&diary_id='+diary_id+'&minutes='+minuteDelta;
		 //model = 'Enggdiary';
		 $.ajax
		 ({
	     	type: 'POST',
	        url: updateUrl ,
	        success: function(data) 
	        { 
		    	alert('SUCESS');
		    },
	        error: function()
	        {
		        alert("ERROR"); 
	        }
	     });//end of AJAX.
	    
	}//end of updateEndDateTime().

	function createNewDiaryEntry(event_date, engg_id, service_id)
	{
		
		//alert("DATE IN createNewDiaryEntry FUNC = "+event_date);
		//alert("ENGG_ID IN createNewDiaryEntry FUNC = "+engg_id);
		//alert("SERVICE_ID IN createNewDiaryEntry FUNC = "+service_id);

		var urlToCreate = baseUrl+'/index.php?r=api/createNewDiaryEntry&start_date='+event_date+'&engg_id='+engg_id+'&service_id='+service_id;
		//alert(urlToCreate);
	
		$.ajax
		 ({
	     	type: 'POST',
	        url: urlToCreate ,
	        cache: false,
	        modal: true,
	        success: function(data) 
	        { 
		    	alert('Appointment Created');
		    	//$.blockUI({ message: "Appointmant is created"});
		    	//setTimeout($.unblockUI, 7000);
				
	 
				
				
				//setTimeout(function(){$.blockUI({ message: "******Appointmant is created"});},7000);	
				//setTimeout(location.href="baseUrl+'/index.php?r=servicecall/view&id="+service_id, 7000);
		    	//location.href="../viewFullDiary?engg_id="+engg_id;
				location.href="baseUrl+'/index.php?r=servicecall/view&id="+service_id;
				//location.href="../../servicecall/"+service_id;
		    },
	        error: function()
	        {
		        alert("ERROR"); 
				//$.blockUI({ message: "Error in creating"});
	        },
	        
	     });//end of AJAX.
	     

	}//end of createNewDiaryEntry().
    

</script>
<style type='text/css'>

	body {
		margin-top: 40px;
		text-align: center;
		font-size: 14px;
		font-family: "Lucida Grande",Helvetica,Arial,Verdana,sans-serif;
		}
		
	#loading {
		position: absolute;
		top: 5px;
		right: 5px;
		}

	#calendar {
		width: 900px;
		margin: 0 auto;
		}

</style>


<div id='loading' style='display:none'>loading...</div>
<div id='calendar'></div>

