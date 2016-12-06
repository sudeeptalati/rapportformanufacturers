

 
<?php

$service_id = $_GET['service_id'];
//echo $service_id;

//include_once ('database_connection.php');

	//echo "IN searchData<hr>";
	
	if(isset($_GET['keyword']))
	{
//		echo $_GET['keyword'];
//	}
	
		try
		{
			
			echo "<br>";
			
				
			$db = new PDO('sqlite:../master_database/api/master_database.db');
			
		
			//$keyword = trim(" flange");
			//$keyword = mysql_escape_string($keyword);
			
			$keyword = $_GET['keyword'];
			$keyword = mysql_escape_string($keyword);
			//echo "keyword before search : ".$keyword."<hr>";
			
			//$keyword = mysqli_real_escape_string($dbc, $keyword);
			//$query = "SELECT * FROM master_items WHERE name like '%$keyword%' ";
			
			$result = $db->query("SELECT * FROM master_items WHERE name like '%$keyword%' or part_number like 
			'%$keyword%' or barcode like '%$keyword%'  LIMIT 0, 100 ");
			
			?>
			
			<table><tr style="background-color: #CC9999;">
			<th>Part Number</th>
			<th>Part Name</th>
			<th></th>
 
			</tr>
			<?php 
			
			
			$i=0;
			//echo count($result);
			if($result)
			{
				foreach($result as $data)
				{

					?>
					<tr style="background-color: #E5FFE5;">
					<td><?php echo $data['part_number'];?></td>
					<td><?php echo $data['name'];?></td>
				 	<td>
				 	<!-- *******  CODE FOR THE IMAGE TO ADD SPARES USED ************ -->
						
						<a href='#' onclick="if(document.getElementById('myBox<?php echo $i;?>').style.display=='none')
											 {document.getElementById('myBox<?php echo $i;?>').style.display='inline';}
											 else{document.getElementById('myBox<?php echo $i;?>').style.display='none'};document.getElementById('myBox<?php echo $i;?>').focus();return false; ">
						<img src="<?php echo Yii::app()->baseUrl.'/images/plus.jpg';?>" width=30 height=30 />
						</a>
						
						<div id="myBox<?php echo $i;?>" style="display:none">
						<form action="<?php echo Yii::app()->createUrl("SparesUsed/saveData");?>" method="POST">
						<b>Price</b> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <b>Qty</b>
						<br><input type="text" name="unit_price" value="<?php echo $data['sale_price'];?>" size="2">
						<input type="text" name="quantity" size="3">
						<input type="hidden" name="master_id" value="<?php echo $data['id'];?>">
						<input type="hidden" name="service_id" value="<?php echo $service_id;?>">
						<input type="hidden" name="name" value="<?php echo $data['name'];?>">
						<input type="hidden" name="part_number" value=<?php echo $data['part_number'];?>>
						<input type="submit" style="width:100px">
						</form>
						</div>				    		
						
					<!-- ******* END OF CODE FOR THE IMAGE TO ADD SPARES USED ************ -->
							    		
					</td>
					</tr>
				
					<?php
					
					$i++;
				}//end of foreach().
				
				
				?>
				<tr>
					<td colspan="3" style="background-color:#B7E6D7;border-radius: 15px;">
						<div>
						
				<!-- ********** CODE FOR FORM TO ADD NEW ITEM THAT IS NOT IN MASTER TABLE ************** -->
												
						<form action="<?php echo Yii::app()->createUrl("SparesUsed/newItemDetails");?>" method="POST">
						<table>
						<tr>
						<td colspan="4" style="text-align:center;">
						<span style="color:green;" ><b>Add item</b><br><small>(If Item not in above list)</small></span>
						</td>
						</tr>
						
						<tr>
						<td><b>Item Name</b></td>
						<td colspan="3">
						<input type="text" name="item_name">
						</td>
						</tr>
						<tr>
						<td>
						<b>Part Number</b></td><td colspan="3"><input type="text" name="part_number">
						</td>
						</tr>
						<tr>
						<td>
						<b>Unit Price</b></td><td><input type="text" name="unit_price" size="3">
						<b>&nbsp;&nbsp;&nbsp;&nbsp;Qty</b>&nbsp;<input type="text" name="quantity" size="3">
						</td>
						</tr>
						<tr>
						<td colspan="4">
						
						<input type="hidden" name="master_id" value="0">
						<input type="hidden" name="service_id" value="<?php echo $service_id;?>">
						<div align="center"><input value="Add" type="submit" align="middle" style="width:100px"></div>
						</td></tr>
						</table>
						
						
						</form>
						
						
						</div>
						
				<!-- ********** CODE FOR FORM TO ADD NEW ITEM THAT IS NOT IN MASTER TABLE ************** -->
						
					</td>
				</tr>
				<?php 
			}//end of if(results).
			
			else
			{
				echo "No Data available matching your search";
			}
			?>
			</table>
		
			<?php 

		}//end of try
		catch(PDOException $e)
		{
			print 'Exception : '.$e->getMessage();
		}
	
	
	}//end if if isset($keyword).
	

?>
 