<?php
$this->layout=false;
?>

 
	
<style type="text/css">

hr {color:sienna;}
p {margin-left:20px;}
body {
 
background-color: transparent;
font-family:"Helvetica";
}
table { 
/*
border: 8px outset green; 
*/
}

td { 	vertical-align:top;
		font-size:10px;
 		
 		/*
 		border: 3px dotted green; 
 		*/
 		}

</style>

<table style="width:100%;    ">
	<tr>
		<td align="left">
			<h3>Service Call ID</h3>
			<h2><?php echo $model->	service_reference_number; ?></h2>
			<br><b><small>Attending Engineer:</small></b><br>
			<?php echo $model->engineer->company;?><br>
			<?php echo $model->engineer->fullname;?>
			<br>
			<?php echo $model->engineer->contactDetails->town;?>&nbsp;
			<?php echo $model->engineer->contactDetails->postcode;?>
			<br>
			Phone:
			<?php if($model->engineer->contactDetails->telephone!="")
					echo $model->engineer->contactDetails->telephone;
			?> <?php if($model->engineer->contactDetails->mobile!="")
					echo ",".$model->engineer->contactDetails->mobile;
			?><br>
			<?php echo $model->engineer->contactDetails->email;?>
			
		</td>
		<td align="right" style="font-size:8px;">
			<?php 
			$company_logo=Yii::app()->request->baseUrl.'/images/company_logo.png';
			 
			  //echo CHtml::image($company_logo,"ballpop",array("width"=>"65", "height"=>"65"));
			echo CHtml::image($company_logo,"ballpop");
			?>
			<br>
			<?php 

			$company_name=$company_details->company;
			$company_address=$company_details->address;
			$company_town=$company_details->town;
			$company_postcode_s=$company_details->postcode_s;
			$company_postcode_e=$company_details->postcode_e;
			
			$company_email=$company_details->email;
			$company_telephone=$company_details->telephone;
			$company_mobile=$company_details->mobile;
			$company_alternate=$company_details->alternate;
			$company_fax=$company_details->fax;
			$company_website=$company_details->website;
			$company_vat_no=$company_details->vat_reg_no;
			$company_reg_no=$company_details->company_number;
 
			echo $company_name."<br>".$company_address." ,".$company_town."&nbsp;".$company_postcode_s."&nbsp;".$company_postcode_e;
			echo "<br> Phone:".$company_telephone."&nbsp;&nbsp;&nbsp;&nbsp; Fax:".$company_fax."&nbsp;&nbsp;&nbsp;&nbsp;Email:".$company_email;
			echo "<br>";
			if (!empty($company_vat_no))
			echo "VAT No:".$company_vat_no;
			if (!empty($company_reg_no))
			echo  " &nbsp;&nbsp;&nbsp;&nbsp; Company No.:".$company_reg_no;
			
			?>
		</td>
</tr>
<tr><td colspan="2"><hr></td></tr>
</table>

<!-- THIS TABLE HAVE 4 COLUMNS -->
<table style="width:100%; ">
<tr><td colspan="2"><h3><i>Customer Details</i></h3></td></tr>
<tr >
	<td style="width:70%; ">
		<table style="width:450px;">
		<tr>
			<td><small><b>Name</b></small><br>
				<?php echo $model->customer->title?>&nbsp;
				<?php echo $model->customer->fullname?>
			</td>
			<td></td>
			<td></td>
		</tr>
		<tr>
			<td colspan="3"><small><b>Address</b></small><br>
			<?php echo $model->customer->address_line_1." ".$model->customer->address_line_2." ".$model->customer->address_line_3.", ".$model->customer->town; ?>
			</td>
		</tr>
		<tr>
		<td><small><b>Postcode</b></small><br>
			<?php echo $model->customer->postcode; ?>
		</td>		
		
		<td><!-- 
			<small><b>County (District)</b></small>
			<br>
			<?php //echo $model->customer->postcode?>
			 -->
		</td>
		 
		<td>
		<!--
		<small><b>Country</b></small>
			<br>
			<?php echo $model->customer->country?>
		 -->
		
		</td>
		
		
		</tr>
		
		</table>
	</td>
	<td style="width:30%; vertical-align:top;">
			<small><b>Telephone</b></small>
			<br>
			<?php echo $model->customer->telephone; ?>
			<br><br>			
			<small><b>Mobile</b></small>
			<br>
			<?php echo $model->customer->mobile; ?><br><small>(Please replace 44 by 0 at start to call)</small> 
			<br><br>
			<small><b>Alternate</b></small>
			<br>
			<?php echo $model->customer->fax; ?>
			<br><br>
			<!--
			<small><b>E-Mail</b></small>
			<br>
			<?php echo $model->customer->email; ?>
			 -->
	</td>
</tr>
<tr><td colspan="2">

<!-- THESE ARE  NOTES FROM THE SERVICE CALL TABLE  -->

<b><small>Call Requirement / Instruction Notes</small></b>
<br><i><?php echo $model->notes?></i>
</td></tr>
<tr><td colspan="2"><hr></td></tr>
</table>

<table style="width:100%">
<tr><td colspan="4"><h3><i>Product Details</i></h3></td></tr>
<tr>

			<td width=25%><small><b>Product</b></small>
			<br>
			<?php echo $model->product->brand->name; ?>&nbsp;
			<?php echo $model->product->productType->name; ?>
			</td >
			<td width=25%><small><b>Model</b></small>
			<br>
			<?php echo $model->product->model_number; ?>
			</td>
			<td width=25%><small><b>Serial Number</b></small>
				<br>
				<?php echo $model->product->serial_number; ?>
			</td>
			<td width=25%><small><b>Product Code</b></small>
				<br>
				<?php echo $model->product->production_code; ?>
			</td>
		</tr>

		<tr>
			<td><small><b>Retailer</b></small>
			<br>
			<?php echo $model->product->purchased_from; ?>
			</td>			
			<td ><small><b>Date of Purchase</b></small>
			<br>
			<?php 
					if ($model->product->purchase_date!='')
				echo date ('d-M-Y',$model->product->purchase_date); ?>
			</td>			
			<td></td>
			<td></td>
		</tr>
		
		<tr><td colspan="4"><hr></td></tr>
</table>		
		
	 	
	<!-- 
		<td style="width:30%; vertical-align:top; ">
		<small><b>Product Notes</b></small>
		<br><?php echo $model->product->notes?>
		</td>
	 -->
	
<table style="width:100%">
<tr><td colspan="4"><h3><i>Fault Reported Detail</h3></i></td></tr>
		<tr>
			<td><small><b>Contract</b></small>
			<br>
			<?php echo $model->product->contract->name; ?>
			</td>			
			<td><small><b>Start</b></small>
			<br>
			<?php 	if ($model->product->warranty_date!='')
					{
						
						$php_warranty_date=$model->product->warranty_date;
						$warranty_months=$model->product->warranty_for_months;
						$end_date = strtotime(date("Y-m-d",$php_warranty_date) . " + ".$warranty_months." month");
	 					echo date('d-M-Y',$model->product->warranty_date); 
	 		 	 					
						 
	 				}
			?>
			</td>			
			<td><small><b>End</b></small>
			<br>
			<?php 
			if ($model->product->warranty_date!='')
					{
						
						echo date('d-M-Y',$end_date );
	 				}
					
			?>
			</td>
			<td></td>
			</tr>
			
		<tr>
			<td ><small><b>Reported </b></small>
			<br>
			<?php 
				if(!empty($model->fault_date))
				{
					//echo $model->fault_date;
					$fault_date=date('d-M-Y', $model->fault_date);		
					echo $fault_date;
					
				}
			
			?>
			
			</td >
			<td><small><b>Fault code</b></small>
			<br>
			<?php echo $model->fault_code; ?>
			</td>
			<td ><small><b>Refrence No#</b></small>
			<br>
			<?php echo $model->insurer_reference_number; ?>
			</td>
			<td></td>
		</tr>
		
		<tr>
		<td colspan="4" style="width:30%; vertical-align:top;"><small><b>Issue Reported</b></small>
			<br><?php echo $model->fault_description?><br><br><br>
		</td>
		</tr>
		
		<tr><td colspan="4"><hr></td></tr>
		</table>

	
<table style="width:100%;heipadding:-5;" >
<tr><td colspan="4"><h3><i>Technician Report</i></h3></td></tr>
		<tr><td colspan="4">
			<small><b>Work Carried out or Inspection</b></small>
			<br><b><small>Please detail any test or results carried out</small></b>
			<br><?php echo $model->work_carried_out; ?>
			<br><br><br><br><br><br><br><br>
			
			<br><br>
			<br><br>
			</td>
		 	</tr>
<tr><td colspan="4"><small><b>Spares</b>
		 	

</small>
<table style="width:650px;border-collapse:collapse;">
<tr>
	<td width=10% style="border:1px solid black;">Qty.</td>
	<td width=20% style="border:1px solid black;">Part Number</td>
	<td width=30% style="border:1px solid black;">Description</td>

</tr>

<?php //for ($i=1;$i<7;$i++){?>

<?php 
if($model->spares_used_status_id == 1)
{
	echo "<br>Spares are used";
	$sparesModel = SparesUsed::model()->findAllByAttributes(array('servicecall_id'=> $model->id));
	foreach ($sparesModel as $data)
	{
		//echo "<br>".$data->id."&nbsp;&nbsp;&nbsp;";
// 		echo "Quantity = ".$data->quantity;
// 		echo "Paert Number = ".$part_num = $data->part_number;
// 		echo "Item Name = ".$desc = $data->item_name;
// 		echo "Uniy price = ".$price = $data->unit_price;
// 		echo "Total = ".$total = $data->total_price;
		?>
		<tr>
		<td style="border-right:1px solid black; border-left:1px solid black;"><?php echo $data->quantity; ?></td>
		<td style="border-right:1px solid black;"><?php echo $data->part_number; ?></td>
		<td style="border-right:1px solid black;"><?php echo $data->item_name; ?></td>
			
		<?php 
	}//end of foreach().
	
}//end of if().

else 
{

	for ($i=1;$i<7;$i++)
	{
		?>
		<tr>
		<td style="border-right:1px solid black; border-left:1px solid black;"><br></td>
		<td style="border-right:1px solid black;"><br></td>
		<td style="border-right:1px solid black;"><br></td>
 
		</tr>
		<?php 
	}//end of for.
	
}//end of else().
?>

<?php //}//end if outer for().?>
<tr> 
	<td colspan="3" style="border-top:1px solid black; "></td>

</tr>


</table><!-- end of Spares Table -->
</td></tr><!-- END OF SPARES TD -->

		
</table>
<br><br><br>


		
<table style="width:100%; "  >
	<tr>
		<td>Date of First Visit</td>
		<td>Date of Completion</td>
		<td>Engineer Signature</td>
		<td>Customer Signature</td>
		
	</tr>
	<tr>
		<td><?php 
			if(!empty($model->job_finished_date))
				echo date('d-M-Y',$model->job_finished_date); 
			else 
				echo "<br>";
		?><hr width="90%"></td>
		<td><?php 
			if(!empty($model->engg_first_visit_date))
				echo date('d-M-Y',$model->engg_first_visit_date); 
			else 
				echo "<br>";
		?><hr width="90%"></td>
		<td><br><hr width="90%"></td>
		<td><br><hr width="90%"></td>
		 
	</tr>
</table>
			
		 <!-- 
			<br>
			<small><b>Payment: </b></small>&nbsp;
			<?php 
					if ($model->job_payment_date!='')
					echo date('d-M-Y',$model->job_payment_date); 
				
				?>
			<br>
			<small><b>Completion:	</b></small>&nbsp;
			<?php 	if ($model->job_finished_date)
					echo date('d-M-Y',$model->job_finished_date); ?>
			
			 -->
			 
			  
	
