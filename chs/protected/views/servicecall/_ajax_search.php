
<?php 
$displayResults=$results->getData();
$customerResults=$customer_results->getData();
/*
echo "<br>";
echo "Fault Description: ".$row['fault_description']."	   ";
echo "Customer Name : ".$row['customer_name']."			";
echo "Insurence Reference Number : ".$row['insurer_reference_number']."			";
*/
?>
<?php 
$bg_color='#EFFDFF;';

//echo "hello";


?>
<style type="text/css">
td,th{
vertical-align:top;
}
 

#remove_padding{
padding: 0px 0px 0px 0px;
vertical-align:top;
}			


</style>


<STYLE>
<!--
  tr { background-color: <?php echo $bg_color; ?>}
  .initial{ background-color: <?php echo $bg_color; ?>}
  .normal { background-color: <?php echo $bg_color; ?>}
  .highlight { background-color: #B7D6E7 }
//-->
</style>

<p align="right">
     <?php //echo CHtml::link('New Customer Service', array('servicecall/create'));
       		$service_img_url = Yii::app()->request->baseUrl.'/images/service.gif';
			$service_img_html = CHtml::image($service_img_url,'Raise Service Call',array('width'=>30,'height'=>30, 'title'=>'Raise Service Call')); 

			?>
		
       <?php //echo CHtml::link('New Customer Service', array('servicecall/create')); ?>
       <?php //echo CHtml::link($service_img_html, array('Servicecall/create'));?>	
       </p>


<!-- ************ DISPLAYING DATA FROM SERVICECALL SEARCH RESULTS *********************** -->

<table style="border-radius:15px;">
	<tr style="background: #B7D6E7;">
		<th style="width:7em;">Customer Name</th>
		<th style="width:7em;">Postcode</th>
		<th style="width:10em;">Product</th>
		<th style="width:10em;">Servicecalls</th>
		
		<!-- <th>Search Web</th>
 -->
	</tr>
	<?php 
	$row_count=1;
	
	$GLOBALS['my_gbp']='NAYA WALA';
	
	$GLOBALS['service_cust_id_list']=array();
	$list=array();
	
	
	foreach ($displayResults as $data)
	{

		
		
	if ( ! in_array($data->customer->id, $list)) 
		{
			
		/*Creating array List of coustomer ids sho that they are not displayed again*/
		array_push($GLOBALS['service_cust_id_list'], $data->customer->id );
		array_push($list, $data->customer->id );
		
		setBgColor($row_count);
		
		
		
	?>
<!--	<tr style="<?php //echo $background; ?>" >-->


<tr onMouseOver="this.className='highlight'" onMouseOut="this.className='normal'" >
		<td>
			<?php echo $data->customer->fullname;?>
			<hr>
			<?php echo $data->customer->address_line_1;?>
			<br>
			<?php echo $data->customer->address_line_2;?>
			<br>
			<?php echo $data->customer->address_line_3;?>
			<br>
			<?php echo $data->customer->town;?>
			<br>
			<?php echo $data->customer->postcode;?>
			
			
			<br><small><?php echo CHtml::link('Edit Details', array('Customer/openDialog', 'customer_id'=>$data->customer->id,'product_id'=>$data->customer->product_id));?>
			</small><br>
			<?php //echo CHtml::link('Existing Customer', array('servicecall/existingCustomer', 'customer_id'=>$data->customer_id, 'product_id'=>$data->product_id));?>
		</td>
		
		<td>
			<form method="get" action="http://maps.google.com/maps/" target="_blank">
					<input type="hidden"   name="q" size="10"
				 	maxlength="255" value= "<?php echo $data->customer->postcode;?>" />
					<input type ="image" src="<?php echo Yii::app()->baseUrl.'/images/googlemaps.png';?>" title="See on Google Map" width='30' 'height'='30' />
					<span style="margin-left:-8px;">
					<?php echo $data->customer->postcode;?>
					</span>	
			</form>
		</td>
		
		<?php 
			$productModel = Product::model()->findAllByAttributes(array(
																	'customer_id'=>$data->customer->id,
																));
			$i=0;
			foreach ($productModel as $product)
			{
				if($i>0)
				{	
		?>
	
<!--	<tr style="<?php //echo $background; ?>" >-->
		

<tr onMouseOver="this.className='highlight'" onMouseOut="this.className='normal'" >
			<td><?php echo " ";?></td>
			<td><?php echo " ";?></td>
			<?php 
				}//end of if products grater than 1.
			?>
		
		<td>
			<?php echo $product->brand->name;?>
			<?php echo $product->productType->name;?><br>
			<?php echo $product->model_number;?><br>
			<?php echo $product->serial_number;?>
		</td>
		
			
		<?php 
			$serviceModel = Servicecall::model()->findAllByAttributes(
															array(
															'customer_id'=>$data->customer->id,
															'product_id' => $product->id
															),
															'job_status_id<:status',
															array(':status<100')
															);

			 
			$service_img_url = Yii::app()->request->baseUrl.'/images/service.gif';
			$service_img_html = CHtml::image($service_img_url,'Raise Service Call',array('width'=>25,'height'=>25, 'title'=>'Raise Service Call'));
			$booked_service_img_url = Yii::app()->request->baseUrl.'/images/engineer_diary.gif';
			$booked_service_img_html = CHtml::image($booked_service_img_url,'OPen Service Call',array('width'=>25,'height'=>25, 'title'=>'Open Service Call'));
																		
																		
			if(count($serviceModel)==0)
			{
				//echo "NEW";
			?>
			
<!-- 			<td> -->
				<?php //echo CHtml::link($service_img_html, array('Servicecall/existingCustomer', 'customer_id'=>$data->customer->id, 'product_id'=>$product->id));?>
				<?php //echo CHtml::link('New Call', array('Servicecall/existingCustomer', 'customer_id'=>$data->customer->id, 'product_id'=>$product->id))?>
<!-- 			</td> -->
			
			<?php 
			}//end of if no active servicecalls with this cust and prod. 
			else
			{
				foreach ($serviceModel as $service)
				{	
			?>

					<td>
						<?php echo CHtml::link($booked_service_img_html, array('servicecall/view', 'id'=>$service->id));?>
						<?php echo CHtml::link($service->service_reference_number, array('servicecall/view', 'id'=>$service->id));?>
						<br>
						<?php echo $service->jobStatus->html_name; ?>
					</td>



					<!--<td><?php //echo $service->jobStatus->name;?></td>-->

			<?php }//end of foreach of servicecall.?>
			

			
			
		<?php }//end of else of no active calls i.e, display call details.?>
		
		<td style="width:150px;background-color:#DCDCF2;">
			<?php echo CHtml::link($service_img_html, array('Servicecall/existingCustomer', 'customer_id'=>$data->customer->id, 'product_id'=>$product->id));?>
			<?php echo CHtml::link('New Call', array('Servicecall/existingCustomer', 'customer_id'=>$data->customer->id, 'product_id'=>$product->id))?>
		</td>	
		
		<!--
		<td>
		<form method="get" action="http://www.google.com/search" target="_blank">
			<input type="hidden"   name="q" size="10"
		 	maxlength="255" value= "<?php //echo $product->brand->name."-- ".$product->productType->name." ".$product->model_number;?>" />
			<input type ="image" src="<?php //echo Yii::app()->baseUrl.'/images/search.gif';?>" title="Search Web" width='25' 'height'='25' />
		</form>	
		</td>
		-->
	

	<?php $i++; }//end of product foreach.?>
	
<!-- 		<td style="width:150px;background-color:#DCDCF2;">
			<?php
			
// 			//echo CHtml::link($service_img_html, array('Servicecall/existingCustomer', 'customer_id'=>$data->customer->id, 'product_id'=>$product->id));
// 			//echo CHtml::link('New Call', array('Servicecall/existingCustomer', 'customer_id'=>$data->customer->id, 'product_id'=>$product->id));
// 			?>
			
		</td> -->
				
	
<!--	<tr style="<?php //echo $background; ?>" >-->

		<tr    onMouseOver="this.className='highlight'" onMouseOut="this.className='normal'" >
		<td></td>
		<td></td>

		<td>
			<?php echo CHtml::link($service_img_html, array('servicecall/addProduct','cust_id'=>$data->customer->id));?>
			<?php echo CHtml::link('Add Product & <br> Raise Servicecall', array('servicecall/addProduct','cust_id'=>$data->customer->id))?>
		</td>
		 		<td></td>
	</tr>
	<tr>
			<td style="background:#599FC8;"></td>
			<td style="background:#599FC8;"></td>
			<td style="background:#599FC8;"></td>
			<td style="background:#599FC8;"></td>
			
		</tr>
	<?php
		$row_count++;
		}///end of if customer present
		?>
		
		
		
		<?php 
	}//end of foreach service call foreeach.
	?>
	
	<!-- ************************ END OF SERVICECALL SEARCH RESULTS ******************** -->
	
<!--	<tr style="background: #B7D6E7;" >-->
<!--		<th>Customer Name</th>-->
<!--		<th>Postcode</th>-->
<!--	</tr>-->

<!-- ******************* DISPLAYING DETAILS FROM CUSTOMER SEARCH ********************* -->

	<?php 
		$cust_count=0;
		foreach($customerResults as $custData)
		{
			if ( ! in_array($custData->id, $list)) 
			{

	?>
	
<tr onMouseOver="this.className='highlight'" onMouseOut="this.className='normal'" >

		
		<td>
			<?php echo $custData->fullname;?>
			<br><small><?php echo CHtml::link('Edit Details', array('Customer/openDialog', 'customer_id'=>$custData->id,'product_id'=>$custData->product_id));?>
			</small>
		</td>
		
		<td>
			<form method="get" action="http://maps.google.com/maps/" target="_blank">
					<input type="hidden"   name="q" size="10"
				 	maxlength="255" value= "<?php echo $custData->postcode;?>" />
					<input type ="image" src="<?php echo Yii::app()->baseUrl.'/images/googlemaps.png';?>" title="See on Google Map" width='30' 'height'='30' />
					<span style="margin-left:-8px;">
					<?php echo $custData->postcode;?>
					</span>	
			</form>
		</td>
		
		<?php 
			$cust_product = Product::model()->findAllByAttributes(array(
																	'customer_id'=>$custData->id,
															));
			$x=0;															
			foreach ($cust_product as $row)
			{	
				if($x>0)
				{															
		?>
			
		
<tr    onMouseOver="this.className='highlight'" onMouseOut="this.className='normal'" >
			<td><?php echo " ";?></td>
			<td><?php echo " ";?></td>
			
		
		<?php $x++; }//end of if of $cust_product products more than 1.?>
		
		<td>
			<?php echo $row->brand->name;?>
			<?php echo $row->productType->name;?><br>
			<?php echo $row->model_number;?><br>
			<?php echo $row->serial_number;?>
			
		</td>
		
		
		
		<?php 
		$service_img_url = Yii::app()->request->baseUrl.'/images/service.gif';
		$service_img_html = CHtml::image($service_img_url,'Raise Service Call',array('width'=>30,'height'=>30, 'title'=>'Raise Service Call'));
		?>
		
		<td>
			<?php echo CHtml::link($service_img_html, array('Servicecall/existingCustomer', 'customer_id'=>$custData->id, 'product_id'=>$row->id));?>
			<?php echo CHtml::link('New Call', array('Servicecall/existingCustomer', 'customer_id'=>$custData->id, 'product_id'=>$row->id))?>
		</td>
		
		<!-- 
		<td>
		<form method="get" action="http://www.google.com/search" target="_blank">
			<input type="hidden"   name="q" size="10"
		 	maxlength="255" value= "<?php echo $row->brand->name." ".$row->productType->name." ".$row->model_number;?>" />
			<input type ="image" src="<?php echo Yii::app()->baseUrl.'/images/search.gif';?>" title="Search Web" width='25' 'height'='25' />
		</form>	
		</td>
		 -->
		</tr>
		
		<?php $x++; }//end of foreach of $cust_product to display product details. ?>
	
	</tr>
	
	 
<!--	-->
<!--	<tr style="<?php //echo $background; ?>" >-->
	<tr    onMouseOver="this.className='highlight'" onMouseOut="this.className='normal'" >
		<td></td>
		<td></td>
		
		<td>
			<?php echo CHtml::link($service_img_html, array('servicecall/addProduct','cust_id'=>$custData->id));?>
			<?php echo CHtml::link('Add Product & <br> Raise Servicecall', array('servicecall/addProduct','cust_id'=>$custData->id))?>
		</td>
		<td></td>
		</tr>
	

	
	<?php
		$cust_count++;
		
			}//end of if of customer list	
			?>
				<tr>
			<td style="background:#599FC8;"></td>
			<td style="background:#599FC8;"></td>
			<td style="background:#599FC8;"></td>
			<td style="background:#599FC8;"></td>
			
		</tr>
			<?php 
		}//end of foreach of displaying customer search data.
	?>
	
	
</table>

<?php 


 function setBgColor($row_count)
{
	$bg_color='';
	if ($row_count%2==0){
			$background='background: #EFFDFF;';
		   	$bg_color='#EFFDFF;';
		}
		else{
			$background='background: #E5F1F4;';
		  	$bg_color='#E5F1F4;';
		}
			
	return $bg_color;
	
}


?>







