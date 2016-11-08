<?php
$this->layout=false;
?>
 
		<?php
//echo $service_id;

$servicecallModel = Servicecall::model()->findByPk($service_id);
$reference_id=$servicecallModel->service_reference_number;




?>

 
 

<head>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
<title><?php echo $reference_id.' '.$servicecallModel->engineer->company; ?></title>
<style type="text/css">
.auto-style1 {
		font-family: Arial, Helvetica, sans-serif;
	

}
.auto-style2 {
	font-size: small;
	text-align: left;
}

.heading {
	font-size: x-large;
	text-align: left;
}
.heading2 {
	font-size: large;
	color:maroon;
	text-align: left;
}

.footer {
	clear: both;
	font-family: Arial, Helvetica, sans-serif;
	font-size:	11px;
}

.table_head {
	color:maroon;
	text-align:left;
	width:150px;
	font-size:14px;
}

.table_content {
	 
	text-align:left;
	width:150px;
	font-size:14px;
}
</style>
</head>

<body>
<table style="width: 100%" class="auto-style1">
	<tr>
		<td>
		<table style="width: 100%">
			<tr>
				<td class="auto-style2" valign="top">
				
		<?php
			echo "<br>";
			echo "To";
			echo "<br>";
			echo "<span class='heading'>".$servicecallModel->engineer->company."</span>";
			echo "<br>";

			if ($servicecallModel->engineer->contactDetails->address_line_1!="")
			{
			echo $servicecallModel->engineer->contactDetails->address_line_1;
			echo "<br>";
			}
			
			if ($servicecallModel->engineer->contactDetails->address_line_2!="")
			{
			echo $servicecallModel->engineer->contactDetails->address_line_2;
			echo "<br>";
			}
			
			if ($servicecallModel->engineer->contactDetails->address_line_3!="")
			{
			echo $servicecallModel->engineer->contactDetails->address_line_3;
			echo "<br>";
			}
			
			if ($servicecallModel->engineer->contactDetails->town!="")
			{
 			echo $servicecallModel->engineer->contactDetails->town;
			echo "<br>";
			}
			
			if ($servicecallModel->engineer->contactDetails->county!="")
			{
			echo $servicecallModel->engineer->contactDetails->county;
			echo "<br>";
			}
			echo $servicecallModel->engineer->contactDetails->postcode;

			echo "<br>";
			echo "<br>";
			echo "Telephone :".$servicecallModel->engineer->contactDetails->telephone;	
			echo "<br>";
			echo "Mobile :".$servicecallModel->engineer->contactDetails->mobile;
			echo "<br>";
//			echo "Fax :".$enggrow['fax'];

//			echo "email: ".$enggrow['email'];
		

		?>

				
				
				</td>
				<td style="text-align:right;width:450px;vertical-align:text-top;">
				<img alt=""  height="131" src="<?php echo Yii::app()->baseUrl.'/images/company_logo.png' ?>" style="float: right"   /></td>
			</tr>
		</table>
		</td>
	</tr>
	<tr><td><br/></td></tr>

	<tr><td class="heading2" align="center"> Service Reference Number : <?php echo $reference_id ?></td></tr>
	<tr>
		<td class="auto-style2"><br/><b>Model Number  :</b><?php echo $servicecallModel->product->model_number; ?></td>
	</tr>
	<tr>
		<td class="auto-style2"><b>Serial Number  :</b><?php echo $servicecallModel->product->serial_number; ?></td>
	</tr>



	<tr>
		<td class="auto-style2"><br />
		<br />
		Please find here details of the spare enclosed for the above product<br><br></td>
	</tr>



	<tr>
		<td>
		<?php $sparesModel = SparesUsed::model()->findAllByAttributes(array('servicecall_id'=> $service_id));
						?>
	 
						
						<table>
						<tr>
						<td class="table_head">Part Number</td>
						<td class="table_head">Item Name</td>
						<td class="table_head" style="width:50px;">Qty</td>
						 
						</tr>
						<?php 
						foreach ($sparesModel as $data)
						{
						$spares_id=$data->id;
							?>
							<tr>
							<td class="table_content"><?php echo $data->part_number;?></td>
							<td class="table_content"><?php echo $data->item_name;?></td>
							<td class="table_content"><?php echo $data->quantity; ?></td>
					 
							
							
							</tr>
							<?php 
						}//end of foreach.
						?>
						</table>
					
		</td>
	</tr>
</table>

 
</body>

</html>

