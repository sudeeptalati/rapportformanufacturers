<?php


$filename = "temp/excelfile.xls";

echo "<br>Hiiii- Deleting old file first";

$nfh = fopen($filename, 'w+') or die("can't open file");
$stringData = '';
fwrite($nfh, $stringData);
fclose($nfh);

echo "<br>Hiiii - now generating filevalues";
?>
<a href=<?php echo $filename;  ?> target-'_blank'>Click here to Download</a>

<?php 
$dataProvider = $criteriaData;
$dataProvider->pagination = false;



$stringData ="<table border=\"1\">
        <tr>
			<th>QTY</th>
			<th>ACCEPTED</th>
			<th>COMMENT AMICA</th>
			<th>NOTES</th>
			<th>COMPANY NAME </th>
			<th>PAYABLE TO</th>
			<th>JOB NUMBER</th>
			<th>LABOUR COST</th>
		
			<th>X = VAT REGISTERED (UK USE ONLY)</th>
			<th>INDEX CODE</th>
			<th>SERIAL NUMBER</th>
			<th>ALTERNATIVE SN.</th>
			<th>CUSTOMER NAME</th>
			<th>ADDRESS</th>
			<th>RETAILER NAME</th>
			<th>MODEL NUMBER</th>
			<th>GROUP </th>
			<th>GROUP 1 </th>
			<th>SUPPLIER </th>
			<th>Date OF PURCHASE</th>
			
			<th>CUSTOMER CALL DATE</th>
			<th>REPAIR START DATE</th>
			<th>DATE JOB COMPLETED</th>
			<th>DATE JOB RETURENED WITH PAPAER</th>
			
			
						
			<th>WARRANTY DAY</th>
			<th>JOB SPEED (in Days)</th>
			<th>ENGINEER JOB SPEED (in Days)</th>
			<th>ENGINEER ADMIN SPEED (in Days)</th>
			
			
			<th>CLAIM DESCRIPTION- CUSTOMER </th>
			<th>FAULT CODE</th>
			<th>CLAIM DESCRIPTION-ENGINEER</th>
			<th>UPLIFT NO</th>
			<th>REASON FOR UPLIFT</th>
			<th>WORK SUMMARY</th>
			<th>Job Status</th>
			<th>Spares Notes</th>
			<th>PARTS USED</th>
			<th>Spare Part Postage</th>
			<th>Spare Part Total</th>
			
			<th>Spares Part Number</th>
			<th>Quantity</th>
			<th>Price</th>
		
		</tr>" ;



appendtofile($stringData);



foreach( $dataProvider->data as $data )
{
	$invoice_data=Invoice::model()->findByAttributes(array('servicecall_id'=>$data->id));
						
    $stringData='';
    $stringData.="\n \n \n <tr>";
    $stringData.="<td></td>";
    $stringData.="<td></td>";
    $stringData.="<td></td>";
    $stringData.="<td>".$data->notes."</td>";
				
				
    $stringData.="<td>".$data->engineer->company."</td>";
    $stringData.="<td>".$data->engineer->payment_name."</td>";
    
 
					
					
					
					
    $stringData.= "<td>". $data->service_reference_number."</td>";
    
    $stringData.= "<td>";
					if ($invoice_data)
						{
							   $stringData.= $invoice_data->labour_cost;
						}
    $stringData.= "</td>";
    
    
     $stringData.= "<td>".$data->engineer->vat_reg_number."</td>";
    
    
    $stringData.= "<td>". $data->product->enr_number."</td>";
    $stringData.= "<td>AEIOU". $data->product->serial_number."</td>";
    $stringData.= "<td>AEIOU". $data->product->fnr_number."</td>";
    $stringData.= "<td>". $data->customer->fullname."</td>";
    $stringData.="<td>";
            $stringData.= $data->customer->address_line_1;
            $stringData.= "\n".$data->customer->address_line_2;
            $stringData.= "\n".$data->customer->address_line_3;
            $stringData.= "\n".$data->customer->town;
            $stringData.= "\n".$data->customer->postcode ;
    $stringData.= "</td>";
    $stringData.= "<td>". $data->product->purchased_from."</td>";
    $stringData.= "<td>". $data->product->model_number."</td>";
    $stringData.= "<td></td>";
    $stringData.= "<td></td>";
    $stringData.= "<td></td>";
    
    $stringData.= "<td>";
		if (!empty($data->product->purchase_date)){
        	$stringData.= date('d-M-Y',$data->product->purchase_date);
    	}
    $stringData.= "</td>";
    
    
    $stringData.= "<td>";////<!---<th>CUSTOMER CALL DATE</th>--->
		if (!empty($data->fault_date)){
        	$stringData.= date('d-M-Y',$data->fault_date);
    	}
    $stringData.= "</td>";
    
    
    $stringData.= "<td>"; ////<!-- REAPIR START DATE which is ENGINEER VISIT DATE -->
		if (!empty($data->engg_first_visit_date)){
        	$stringData.= date('d-M-Y',$data->engg_first_visit_date);
    	}
    $stringData.= "</td>";
    
    $stringData.= "<td>";////	<!-- <th>DATE JOB COMPLETED</th> --->
		if (!empty($data->job_finished_date)){
        	$stringData.= date('d-M-Y',$data->job_finished_date);
    	}
    $stringData.= "</td>";
    
    $stringData.= "<td>";/////<!-- <th>DATE JOB RETURENED</th> --->
		if (!empty($data->engg_claim_returned_date)){
        	$stringData.= date('d-M-Y',$data->engg_claim_returned_date);
    	}
    $stringData.= "</td>";
    
    
    $stringData.= "<td>";/////<!--<th>WARRANTY DAY</th>  -->
		if ($data->product->purchase_date !='' && $data->fault_date!='')
						{
							$timeDiff=$data->fault_date-$data->product->purchase_date;
							$warranty_in_days =  floor($timeDiff/86400);
							$stringData.=  round($warranty_in_days, 0); 
						}
    $stringData.= "</td>";
    
    
    
    $stringData.= "<td>";/////<<!--<th>JOB SPEED (in Days)</th>  -->
		if ($data->job_finished_date!='' && $data->fault_date!='')
						{
							$timeDiff=$data->job_finished_date-$data->fault_date;
							$speed_in_days =  floor($timeDiff/86400);
							$stringData.= round($speed_in_days, 0); 
							
						}
    $stringData.= "</td>";
    
    
    $stringData.= "<td>";/////<!--<th>ENGINEER JOB SPEED (in Days)</th>  -->
					
						if ($data->job_finished_date!='' && $data->engg_first_visit_date!='')
						{
							$timeDiff=$data->job_finished_date-$data->engg_first_visit_date;
							$engg_speed_in_days = floor($timeDiff/86400);
							
							if ($engg_speed_in_days>15)
							{
								$stringData.= '<span style="color:red"><b>'.$engg_speed_in_days.'</b></span>';
							}
							else
							{
								$stringData.= $engg_speed_in_days	;
							}
							
							
						}
    $stringData.= "</td>";
    $stringData.= "<td>";/////<!-- <th>ENGINEER ADMIN SPEED (in Days)</th>  -->
					
						if ($data->job_finished_date!='' && $data->engg_claim_returned_date!='')
						{
							$timeDiff=$data->engg_claim_returned_date-$data->job_finished_date;
							$engg_admin_speed_in_days = floor($timeDiff/86400); 
							 
							/* 
							echo '<br>ADMIN SPEED : '.$engg_admin_speed_in_days;
							echo '<br>claim returned: '.date('d-M-Y',$data->engg_claim_returned_date);
							echo '<br>Date finished : '.date('d-M-Y',$data->job_finished_date);
							*/
							
							
							if ($engg_admin_speed_in_days>60)
							{
								$stringData.=  '<span style="color:red"><b>'.$engg_admin_speed_in_days.'</b></span>';
							}
							else
							{
								$stringData.=  $engg_admin_speed_in_days	;
							}
							
							
						}
    $stringData.= "</td>";
    
    
    
    
 
 
    $stringData.= "<td>". $data->fault_description."</td>";
    $stringData.= "<td>". $data->fault_code ."</td>";
    $stringData.= "<td>". $data->work_carried_out."</td>";

    $uplift_number=''	;
    $reason_for_uplift='';

    $uplift=Uplifts::model()->findByAttributes(array('servicecall_id'=>$data->id));

        if ($uplift)
        {
            $uplift_number= 	$uplift->uplift_number;
            $reason_for_uplift=$uplift->reason_for_uplift;

        }




    $stringData.="<td>".$uplift_number."</td>";
    $stringData.="<td>".$reason_for_uplift."</td>";
    $stringData.="<td>".$data->work_summary."</td>";
    $stringData.="<td>".$data->jobStatus->name."</td>";
    $stringData.="<td>".$data->spares_notes."</td>";
    

	$spares_used='No';
	$total_spares_cost=0;
	$shippingcost=0;
	$spares_details='';
	
	if ($data->spares_used_status_id==1)
    {
		$spares_used="Yes";
		if ($invoice_data)
		{

			 $shippingcost= $invoice_data->shipping_handling_cost;								 
		}//end of if invoice data
 
 		
		$spares=SparesUsed::model()->findAllByAttributes(array('servicecall_id'=>$data->id));
		
	 
		foreach ($spares as $s)
		{
				$spares_details.="<td>".$s->part_number."</td>";
				$spares_details.="<td>".$s->quantity."</td>";
				$spares_details.="<td>".$s->unit_price."</td>";
				
				$total_spares_cost=$total_spares_cost+($s->unit_price*$s->quantity);
				
		}////end foreach
    }//end of spares used status
    
    
    
    
    $stringData.="<td>".$spares_used."</td>";
    $stringData.="<td>".$shippingcost."</td>";
    $stringData.="<td>".$total_spares_cost."</td>";								 

	$stringData.=$spares_details;////since td is already added								 

    
    
    
    
    
    
    
    $stringData.="</tr>";
    
    
    
    
    
    
    

    appendtofile($stringData);

  }//end of foreach($dataProvider);


$stringData="</table>";
appendtofile($stringData);











function appendtofile($s)
{
	//echo $s;
	
    $filename = "temp/excelfile.xls";
    $nfh = fopen($filename, 'a') or die("can't open file");
    fwrite($nfh, $s);
    fclose($nfh);
    
}///end of function appendtofile($s)

/*

header("Cache-Control: public");
header("Content-Description: File Transfer");
//header("Content-Disposition: attachment; filename=$file");
header("Content-Transfer-Encoding: binary");
header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); // Date in the past
header( "Content-Type: application/vnd.ms-excel; charset=utf-8" );
header( "Content-Disposition: inline; filename=\"Engineer Report  ".date("F j, Y").".xls\"" );

$dataProvider = $criteriaData;
$dataProvider->pagination = false;


?>
        <table border="1"> 
        <tr>
			<th>COMPANY NAME </th>
			<th>JOB NUMBER</th>
			<th>TOTAL COST</th>
			<th>X = VAT REGISTERED (UK USE ONLY)</th>
			<th>INDEX CODE</th>
			<th>SERIAL NUMBER</th>
			<th>CUSTOMER NAME</th>
			<th>ADDRESS</th>
			<th>RETAILER NAME</th>
			<th>MODEL NUMBER</th>
			<th>GROUP </th>
			<th>GROUP 1 </th>
			<th>SUPPLIER </th>
			<th>Date OF PURCHASE</th>
			<th>DATE RAISED</th>
			<th>COMPLETED DATE</th>
			<th>WARRANTY DAY</th>
			<th>SPEED</th>
			<th>CLAIM DESCRIPTION- CUSTOMER </th>
			<th>FAULT CODE</th>
			<th>CLAIM DESCRIPTION-ENGINEER</th>
			<th>UPLIFT NO</th>
			<th>REASON FOR UPLIFT</th>
			<th>WORK SUMMARY</th>
			<th>Job Status</th>
			<th>Spares Part Number</th>
			<th>Quantity</th>
			<th>Price</th>
			
			 
			
			
		</tr>
		<?php 
		foreach( $dataProvider->data as $data )
		{
		?>
			<tr> 
				<td><?php echo $data->engineer->company;?></td>
				<td><?php echo $data->service_reference_number;?></td>
				<td><?php echo $data->net_cost;?></td>
				<td></td>
				<td><?php echo $data->product->enr_number;?></td>
				<td><?php echo $data->product->serial_number;?></td>
				<td><?php echo $data->customer->fullname;?></td>
				<td><?php 
							echo $data->customer->address_line_1;
							echo "\n".$data->customer->address_line_2;
							echo "\n".$data->customer->address_line_3;
							echo "\n".$data->customer->town;
							echo "\n".$data->customer->postcode ;
					?>
				</td>
				<td><?php echo $data->product->purchased_from;?></td>
				<td><?php echo $data->product->model_number;?></td>
				<td></td>
				<td></td>
				<td></td>
				<td><?php 
						if (!empty($data->product->purchase_date)){
								echo date('d-M-Y',$data->product->purchase_date);
							}
						?>
				</td>
				<td><?php 
						if (!empty($data->fault_date)){
								echo date('d-M-Y',$data->fault_date);
							}
						?>
				</td>
				<td><?php 
						if (!empty($data->job_finished_date)){
								echo date('d-M-Y',$data->job_finished_date);
							}
						?>
				</td>
				<td></td>
				<td></td>
				<td><?php echo $data->fault_description;?></td>
				<td><?php echo $data->fault_code ;?></td>
				<td><?php echo $data->work_carried_out;?></td>
				<?php
					
					$uplift_number=''	;
					$reason_for_uplift='';
				
					$uplift=Uplifts::model()->findByAttributes(array('servicecall_id'=>$data->id));
					
					if ($uplift)	
					{
						$uplift_number= 	$uplift->uplift_number;
						$reason_for_uplift=$uplift->reason_for_uplift;
					
					}
				 			
					
					?>
				
				
				<td><?php echo $uplift_number; ?></td>
				<td><?php echo $reason_for_uplift; ?></td>
				<td><?php echo $data->work_summary;?></td>
				<td><?php echo $data->jobStatus->name;?></td>
				<?php
				
				if ($data->spares_used_status_id==1)
				{
				
					$spares=SparesUsed::model()->findByAttributes(array('servicecall_id'=>$data->id));
				
					if ($spares)
					{
					?>
					<td><?php echo $spares->part_number; ?></td>
					<td><?php echo $spares->quantity; ?></td>
					<td><?php echo $spares->unit_price; ?></td>
					
					
					<?php
					}
				
				
				}
				?> 
				
				
				
				
			</tr>
        
        <?php }//end of foreach($dataProvider); ?> 
		
		</table>

*/