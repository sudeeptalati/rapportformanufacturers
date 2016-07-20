<?php

  //echo "<hr>engr id from contr = ".$future_engg_id."<hr>";

  /*To import the client script*/
  $baseUrl = Yii::app()->baseUrl; 
  $cs = Yii::app()->getClientScript();
  $dataUrl=$baseUrl.'/index.php?r=api/currentAppointments&id='.$future_engg_id;
  
  $cs->registerScriptFile($baseUrl.'/js/fullcalendar/jquery-1.7.1.min.js');
  $cs->registerScriptFile($baseUrl.'/js/fullcalendar/jquery-ui-1.8.17.custom.min.js');
  $cs->registerScriptFile($baseUrl.'/js/fullcalendar/fullcalendar.min.js');
  $cs->registerScriptFile($baseUrl.'/js/fullcalendar/jquery.ui.touch-punch.js');
  
?>

<!-- ************* CODE OF BUTTON TO DISPLAY ALL APPOINTMENTS ************* -->
<form method ="Post">
<!--<input type = "checkbox" name = "appointments" value = "all" onclick="javascript:showAll();">Show all Appointments-->
<span style="float:right"><input type = "Submit" name = "show_all" value = "Show all Appointments"><br><small>(Please be patient, it may take sometime to load depending on number of appointments)</small></span>

</form>

<?php

if(isset($_POST['show_all']))
{
	//echo "<br>Show all clicked";
	$dataUrl = $baseUrl.'/index.php?r=api/ViewFullDiaryJsonData&engg_id='.$future_engg_id;
}
?>

<!-- ********** END OF CODE OF BUTTON TO DISPLAY ALL APPOINTMENTS ************* -->

<br><br><br><br>

<!-- ************* DROPDOWN FORM TO CHANGE ENGINEER ************* -->

<div class="form">
<?php 

	//echo $model->engineer_id;
	$baseUrl=Yii::app()->request->baseUrl;
	$changeEnggUrl=$baseUrl.'/index.php?r=Enggdiary/currentAppointments&id='.$future_engg_id;		

	$futureAppointmentsform=$this->beginWidget('CActiveForm', array(
	'id'=>'future-appointments-form',
	'enableAjaxValidation'=>false,
	'action'=>$changeEnggUrl,
	//'method'=>'post'
	'method'=>'get'
	
)); 
?>


<?php 
	
	//$model = Enggdiary::model();
	//$engg_id=$model->engineer_id;
 	$data=CHtml::listData(Engineer::model()->findAll(array('order'=>"fullname ASC")), 'id', 'fullname','company');
 	
	
	echo "<b>Change Engineer&nbsp;&nbsp;&nbsp;</b>";
	//echo CHtml::dropDownList('','engineer_id',$data);
	echo $futureAppointmentsform->dropDownList($model, 'engineer_id', $data,
									array('empty'=>array(0=>'All Engineers')) 
								);
	echo "&nbsp;&nbsp;".CHtml::submitButton('Change');
	echo "<br><small>(List is arranged by engineers name)</small>";
	
?>
<?php $this->endWidget(); ?>
</div><!-- ENd of form -->

<!-- ************* DROPDOWN FORM TO CHANGE ENGINEER ************* -->




<script type='text/javascript'>

var dataUrl = '';

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
	//var engg_id = '<?php //echo $future_engg_id;?>//';
	//var dataUrl = baseUrl;
	//alert(engg_id);
	//var dataUrl  =  baseUrl+'/api/currentAppointments';
	var dataUrl = '<?php echo $dataUrl;?>';
	
	
	//alert(dataUrl);
	
	$(document).ready(function() 
	{
		
		$('#calendar').fullCalendar({
		
			header: {
				left: 'prev,next today',
				center: 'title',
				right: 'month,agendaWeek,agendaDay'
			},

			
			events:dataUrl,
		
			editable: true,
			selectable: true,
			minTime:'8',
			maxTime:'18',
			weekends:true,
			
			
			eventResize: function(event,dayDelta,minuteDelta,revertFunc) /*EVENT FOR CHANGING ONLY END_DATE*/
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
			

			eventDrop: function (event,delta, minuteDelta) /**EVENT FOR CHANGING APPOINTMENT.**/
			{
				
				//alert(event.title + ' was moved ' + delta + ' days\n' +
					//'(should probably update your database)');
				
				//alert ('Add Logic here to call and change database');	

				//alert (document.location.hostname);
				
				days_moved=delta;
				console.info("DAYS MOVED"+days_moved);
				//alert('ID = '+event.engineer_id);
				
				//alert('event end date = '+event.end)
				end_date = event.end;
				diary_id = event.id;
				minutes_moved = minuteDelta;
				 
				
				////CALL UPDATE STATEMNET HERE 
				updateAppointmentDay();
				//alert(delta);
				
				
				/////end of logic to move
				//location.reload();		

				},//end of eventDrop.

				
				/*
				dayClick: function(date, allDay, jsEvent, view) 
				{
					var clicked_date=date;
					var today = new Date();

					/*		
					if(clicked_date>today)
					  {
					  alert("Today is before "+clicked_date);
					  }
					else
					  {
					  alert("Today is after"+clicked_date);
					  }
					*/

					/*
					var curr_date = date.getDate();
					
					var curr_month = date.getMonth()+1;//getMonth() method starts from 0 to 11 so +1 to get correct month value.

					var curr_year = date.getFullYear();

					//window.alert(curr_date + "-" + curr_month + "-" + curr_year);

					var normal_format = curr_date + "-" + curr_month + "-" + curr_year;
					//alert("normal date = "+normal_format);
					
					/*
					var today = new Date();
					var dd = today.getDate();
					var mm = today.getMonth()+1; //January is 0!

					var yyyy = today.getFullYear();

					today = dd+'-'+mm+'-'+yyyy;
					 */

					
					
//					if(clicked_date>today)
//					{
//						var retVal = confirm("Do you want to book appointment for "+date+" ?");
//						if( retVal == true )
//						{
//							engg_id = '<?php //echo $engg_id;?>//';
//							//alert("engg_id = "+ engg_id);
//	
//							service_id = '<?php //echo $service_id;?>//';
//							//alert('service id = '+service_id);
//							
//							createNewDiaryEntry(normal_format, engg_id, service_id);
//							return true;
//						}
//						else
//						{
//							//alert("User does not want to continue!");
//							return false;
//						}
//					}//end of if.
//					else
//					{
//						alert("Cannot book appointment for previous days");
//					}	
					
			        // change the day's background color just for fun
			        //$(this).css('background-color', 'pink');

			        

			    //},//end of dayClick function().
				
			
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
	
	function updateAppointmentDay()
    {
	    model = 'Enggdiary';
	    //alert("EVENT END DATE IN FUNC = "+end_date);
	   	//alert("diary ID IN FUNC = "+diary_id);
	    //alert("DAYS MOVED IN FUNC = "+days_moved);

	    //var updateUrl= baseUrl+'/api/UpdateDiary?engg_id='+diary_id+'&days_moved='+days_moved;
	     var updateUrl= baseUrl+'/index.php?r=api/UpdateDiary&diary_id='+diary_id+'&days_moved='+days_moved+'&minutes_moved='+minutes_moved;
	    //model = 'Enggdiary';
	    $.ajax({
        	type: 'POST',
            url: updateUrl ,
            
          
          success: function(data) 
          { 
	          alert('Appointment updated');
	      },
          error: function()
          {
	       	//alert("Error in updating");
  	       	alert('Cannot update previous Appointments'); 
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
		        alert("ERROR in updating"); 
	        }
	     });//end of AJAX.
	    
	}//end of updateEndDateTime().

	/*
	function createNewDiaryEntry(event_date, engg_id, service_id)
	{
//		alert("DATE IN createNewDiaryEntry FUNC = "+event_date);
//		alert("ENGG_ID IN createNewDiaryEntry FUNC = "+engg_id);
//		alert("SERVICE_ID IN createNewDiaryEntry FUNC = "+service_id);

		var urlToCreate = baseUrl+'/api/createNewDiaryEntry/?start_date='+event_date+'&engg_id='+engg_id+'&service_id='+service_id;
		//alert(urlToCreate);
	
			
		 $.ajax
		 ({
	     	type: 'POST',
	        url: urlToCreate ,
	        success: function(data) 
	        { 
		    	alert('Appointment Created');
		    	location.href="../viewFullDiary?engg_id="+engg_id;
		    },
	        error: function()
	        {
		        alert("ERROR"); 
	        }
	     });//end of AJAX.

	}//end of createNewDiaryEntry().
    */

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

