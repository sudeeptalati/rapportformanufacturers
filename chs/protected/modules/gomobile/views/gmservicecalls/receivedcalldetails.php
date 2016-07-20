
<div id='gmcontainer'>

<?php include('gomobile_menu.php'); ?>  

<?php
$servicecallmodel=Servicecall::model()->findByPk($model->servicecall_id);
$data=json_decode($model->comments);

$gomobile_server_url=Gmservicecalls::model()->getserverurl();
$wd=json_decode($data->work_carried_out);
$img=json_decode($data->images);
//print_r($img);



//echo $gomobile_server_url.'imagesfrommobile/'.$img->product;

?>


<table style='width:75%'>
	<tr>
		<td style='width:30%'></td>
		<td></td>
	</tr>
	<tr>
		<td><b>Servicecall Ref No:</b></td>
		<td><?php echo $model->service_reference_number; ?></td>
	</tr>
	<tr>
		<td><b>Customer Name:</b></td>
		<td><?php echo $servicecallmodel->customer->fullname; ?></td>
	</tr>
	<tr>
		<td><b>Work Carried Out:</b></td>
		<td><?php echo $wd->workdone; ?></td>
	</tr>
	<tr>
		<td><b>Report Findings:</b></td>
		<td><?php echo $wd->report_findings; ?></td>
	</tr>
	<tr>
		<td><b>Parts Used:</b></td>
		<td>
			<table style='width:25%'><tr><th>Item</th><th>Qty</th></tr>
			<?php
			foreach ($wd->parts as $parts)
			{
				echo '<tr>';
				echo '<td>'.$parts->partused."</td>";
				echo '<td>'.$parts->quantity."</td>";
				echo '</tr>';
			}

			?>
			</table>
		</td>
		 
	</tr>
</table>



<table style='width:75%'>
	<tr>
		<td><b>Product Image</b></td>
		<td><b>Findings Image</b></td>
	</tr>
	<tr>
		<td>
		 	<?php 
			 	if ($img->product!='NOIMAGE')
				{	$img_url=$gomobile_server_url.'imagesfrommobile/'.$img->product;
					echo '<img src='.$img_url.' height="300px" width="300px">';
				}
		 	?>
		</td>
		<td>
		 	<?php  
			 	if ($img->findings!='NOIMAGE')
				{	$img_url=$gomobile_server_url.'imagesfrommobile/'.$img->findings;
					echo '<img src='.$img_url.' height="300px" width="300px">';
				}
		 	?>
		</td>
	</tr>
</table>
	
	




</div>