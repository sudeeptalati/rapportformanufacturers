<script>
function validateForm() {
  
  
    var x = document.forms["gomobilesenddataform"]["engg_id"].value;
	var y = document.forms["gomobilesenddataform"]["start_date"].value;
	
	if ((x==null || x=="") && (y==null || y=="")) {
        alert("Please Select the Engineer & Appointment Date");
        return false;
    }
	
	if (x==null || x=="") {
        alert("Please Select the Engineer");
        return false;
    }
	 if (y==null || y=="") {
        alert("Please Select the Appointment Date");
        return false;
    }
	
	
}
</script>


<div id='gmcontainer'>
	<?php include('gomobile_menu.php'); ?>
	
	<h2>Send Data To Engineer's Device</h2>	
	
	<?php
		 echo CHtml::beginForm('index.php?r=gomobile/default/postdatatoserver',
								'get',
								 array(
								  	'onsubmit'=>"return validateForm()",
								  	 'id'=>'gomobilesenddataform',
								  	 'name'=>'gomobilesenddataform',
								  	)						
								); 
	?>
	
	<!--<form id='gomobilesenddata' action='index.php?r=gomobile/default/postdatatoserver' method='get' onsubmit="return validateForm()">
 	-->
	<table style='width:70%;'>
		<tr>
			<td style='width:20%;'>
				<h4><b>Engineer:</b></h4>
			</td>
			<td>
			<?php 
				$engglist=Engineer::model()->getactiveengineerslist();
				//$engglist=CHtml::listData(Engineer::model()->findAll(),	'id', 'fullname');

				$engglist[101]='All Engineers';
				$engglist = array_reverse($engglist, true);
				echo CHtml::dropDownList('engg_id', 
											'', 
											$engglist,
											 array('empty' => 'Select an Engineer')
										);
					
			 ?>
			</td>
		</tr>
		<tr>
			<td><h4><b>Appointment Date:</b></h4></td>
			<td>
			<?php 								
					$this->widget('zii.widgets.jui.CJuiDatePicker', array(
								'name'=>'start_date',
								//'value'=>$first_date_of_year,
								// additional javascript options for the date picker plugin
								'options'=>array(
									'showAnim'=>'fold',
									'dateFormat' => 'd-m-yy',
									'timeFormat'=>'hh:mm',
									
								),
								'htmlOptions'=>array(
									'style'=>'height:20px;',
									
								),
							));
						
					
					$today=date('d-m-Y');
					$datetime = new DateTime(date('d-m-Y', time()));
					$datetime->modify('+1 day');
					$tomorrow=$datetime->format('d-m-Y');
					?>
			</td>
		</tr>
		<tr>
			<td>
			<a href='#' onclick='return today()'><input type='button' value='Show Appointments for Today'></a>
			</td>
			
			<td>
			<?php
				echo CHtml::submitButton('Show Servicecalls');				
				
			?>
			
			</td>
		</tr>
		<tr>
			<td>
			<a href='#' onclick='return tomorrow()'><input type='button' value='Show Appointments for Tomorrow'></a>
			</td>
			<script type='text/javascript'>

			function today()
			{
				var today = new Date();
				var today_date=today.getDate();
				var today_month=today.getMonth()+1;
				var today_year=today.getFullYear();
				var today_date_string=today_date+'-'+today_month+'-'+today_year;
				console.log(today_date_string);
				document.getElementById("start_date").value=today_date_string;
				if(validateForm()!=false)
				{
					document.getElementById("gomobilesenddataform").submit();
				}
							
			
			}
			function tomorrow()
			{
				
				 
				var tomorrow = new Date();
				var numberOfDaysToAdd = 1;
				tomorrow.setDate(tomorrow.getDate() + numberOfDaysToAdd); 
				
				 
				var tomorrow_date=tomorrow.getDate();
				var tomorrow_month=tomorrow.getMonth()+1;
				var tomorrow_year=tomorrow.getFullYear();
				var tomorrow_date_string=tomorrow_date+'-'+tomorrow_month+'-'+tomorrow_year;
				console.log(tomorrow_date_string);
				document.getElementById("start_date").value=tomorrow_date_string;
				if(validateForm()!=false)
				{
					document.getElementById("gomobilesenddataform").submit();
				}
							
			
			}
		

			</script>
			
			<td>
			</td>
		</tr>
		
	<table>
 	<?php echo CHtml::endForm();?>

 </div>