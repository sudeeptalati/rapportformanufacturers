<head>

<title>Uplifts Fault date</title>

<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>


 

</head>

<body style="background-color: #FFBFBF;">

<table border=2>

<?php

	//include "mysql.php";
							
							
	$data_handler = new PDO('sqlite:chs/protected/data/chs.db'); 
			
	$prod_result = $data_handler->query("SELECT * FROM uplifts WHERE date(date_of_call) IS NULL");
	$prod_rows = $prod_result->fetchAll(); // assuming $result == true
	$prod_no = count($prod_rows);
	echo "<br>count of local data = ".$prod_no."<hr>";
	if($prod_no == 0)
	{
		echo "<br>Not Known";
	}
	else
	{
		?>
		<tr>
			<th>Sl No.</th>
			<th>Id</th>
			<th>Uplift No</th>
			<th>Prefix no</th>
			<th>Service Id</th>
			<th>Service Ref No</th>
			<th>Fault date from service_id</th>
		</tr>
		
		<?php
		
		$i = 1;
		foreach($prod_rows as $rows)
		{
			?>
			
			<tr>
				<td><?php echo $i; ?></td>
				<td><?php echo $rows['id']; ?></td>
				<td><?php echo $rows['uplift_number']; ?></td>
				<td><?php echo $rows['prefix_id']; ?></td>
				<td>
					<?php 
						echo $rows['servicecall_id']; 
						$service_id = $rows['servicecall_id']; 
					?>
				</td>
				<td><?php echo $rows['service_reference_number']; ?></td>
				<td>
					<?php
						$get_fault_date_query = "SELECT * FROM servicecall WHERE id = '$service_id'";
						
						$service_result = $data_handler->query($get_fault_date_query);
						$service_rows = $service_result->fetchAll(); // assuming $result == true
						$service_count = count($service_rows);
						//echo "<br>count of local data = ".$prod_no;
						if($service_count == 0)
						{
							echo "<br>Not Known";
						}
						else
						{
							foreach($service_rows as $calls)
							{
								echo "Fault date from servicecall = ".date('d-M-Y', $calls['fault_date']);
								echo "<br>Db fault date str format = ".$calls['fault_date'];
								$fault_date = $calls['fault_date'];
								
								$update_uplifts = "UPDATE uplifts SET date_of_call = '$fault_date' WHERE servicecall_id = '$service_id'";
								$uplifts_result = $data_handler->query($update_uplifts);
								
							}//end of foreach.
							
						}//end of else.
					
					?>
				</td>
			
			</tr>
			
			<?php
			$i++;
		}//end of foreach
		
	}//end of else						

?>

</table>

</body>















