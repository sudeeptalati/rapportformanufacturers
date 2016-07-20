
<?php 
$displayResults=$results->getData();
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


<table style="border-radius:15px;"><tr style="background: #B7D6E7;">
<th>Customer Name</th>
<th style="width:7em;">Postcode</th>
<th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Product</th>
<th>Search Web</th>

<!--<th>Model Number</th>-->
<!--<th>Serial Number</th>-->
<!-- 
<th>Date of Purchase</th>
<th>Warranty Date</th>

<th>Warranty For Months</th>
<th>Warranty untill</th>
 -->
</tr>


<?php
$count=0;
foreach ($displayResults as $row)
{
	
//	$GLOBALS['service_cust_id_list'];
//		
//	if ( ! in_array($row->id, $GLOBALS['service_cust_id_list'])) {
//
//		//echo "Got mac";
	
	

if ($count%2==0)
		$background='background: #EFFDFF;';
		else
		$background='background: #E5F1F4;';		
	
?>	
	 
	<tr style="<?php echo $background; ?>" >
	<td>
		<?php echo $row->fullname;?>
		<br><small><?php echo CHtml::link('Edit Details', array('Customer/openDialog', 'customer_id'=>$row->id,'product_id'=>$row->product_id));?>
		</small>
		
		</td>
	<!--<td><?php //echo $row->town;?></td>
	--><td>
			<form method="get" action="http://maps.google.com/maps/" target="_blank">
					<input type="hidden"   name="q" size="10"
				 	maxlength="255" value= "<?php echo $row->postcode_s." ".$row->postcode_e;?>" />
					<input type ="image" src="<?php echo Yii::app()->baseUrl.'/images/googlemaps.png';?>" title="See on Google Map" width='30' 'height'='30' />
					<span style="margin-left:-8px;">
					<?php echo $row->postcode;?>
					</span>	
			</form>
	</td>
	<?php 
		
		$result=Product::model()->findAllByAttributes(array('customer_id'=>$row->id));
		$i=0;
		foreach($result as $data)
		{
			//echo $i;
			if($i>0)
			{
				
			
			
	?>	<tr style="<?php echo $background; ?>" >
		<td><?php echo " ";?></td>
		<td><?php echo " ";?></td>
		<!--<td><?php echo " ";?></td>
		
	--><?php }//end of if(i>0).?>
	
	
	
	<?php 
			$service_img_url = Yii::app()->request->baseUrl.'/images/service.gif';
			$service_img_html = CHtml::image($service_img_url,'Raise Service Call',array('width'=>30,'height'=>30, 'title'=>'Raise Service Call')); 
			?>	

	<td>
		<table>
			<tr>
				<td id="remove_padding"><?php echo CHtml::link($service_img_html, array('Servicecall/existingCustomer', 'customer_id'=>$row->id, 'product_id'=>$data->id));?></td>
				<td id="remove_padding"><?php echo $data->brand->name;?>
				<?php echo $data->productType->name;?>
		
					<br>
					<small><b>
				<?php echo CHtml::link('Raise Service Call', array('Servicecall/existingCustomer', 'customer_id'=>$row->id, 'product_id'=>$data->id));?>	
				</b></small>
				</td>
			<tr>
		</table>
	
	</td>
	<td>
		<form method="get" action="http://www.google.com/search" target="_blank">
			<input type="hidden"   name="q" size="10"
		 	maxlength="255" value= "<?php echo $data->brand->name." ".$data->productType->name." ".$data->model_number;?>" />
			<input type ="image" src="<?php echo Yii::app()->baseUrl.'/images/search.gif';?>" title="Search Web" width='25' 'height'='25' />
		</form>	
	</td>
	
	<!--<td><?php //echo date('d-M-y', $row->product->purchase_date);?></td>
	<td><?php //echo date('d-M-y', $row->product->warranty_date);?></td>
	<td><?php //echo $row->product->warranty_for_months;?></td>-->
	
	</tr>
	<?php 
		$i++;
		}//end of inner foreach() for products.
		?>
			
		
		<tr style="<?php echo $background; ?>">
			<td></td>
			<td></td>
<!--			<td></td>-->
			<td>
			
			<table>
			<tr>
				<td id="remove_padding"><?php echo CHtml::link($service_img_html, array('servicecall/addProduct','cust_id'=>$row->id));?></td>
				<td id="remove_padding"><?php //echo $data->brand->name;?>
				<?php //echo $data->productType->name;?>
		
					
					<small><b>
				<?php echo CHtml::link('Add Product &  <br> Raise Service Call', array('servicecall/addProduct','cust_id'=>$row->id));?>	
				</b></small>
				</td>
			<tr>
		</table>
			
			</td>
			<td></td>
 
		</tr>	
		
 

		<?php 
		$count++;
		//}//end of if id is not present in array
	}//end of outer foreach().
	
	?>
	

</table>

				