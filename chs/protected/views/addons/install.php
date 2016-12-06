 <!--
<a href="JavaScript:window.close()">Close This Window</a>
-->


<table>
	<tr>
	
		<td>
		<!-- HERE WE WILL LOAD THE POST INSTALLATION FILE-->
		
 

		
		</td>
		<td>
			<?php
				if ($errors)
					{
						echo "<h3><span style='color:red'>Error in Installing Module</span></h3>";
						foreach ($errors as $e)
						{
							echo "<span style='color:red'>";
							echo $e[0];
							echo "<span><br>";

						}
					}
					
					foreach ($log_msgs as $l)
					{
							echo "<span style='color:green'>";
							echo $l;
							echo "<span><br>";

					}		
			?>
		</td>
	</tr>
</table>
