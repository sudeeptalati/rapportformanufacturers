<?php 

if(isset($postcode))
{
	//echo "<br>postcode received in view = ".$postcode;
	
	$url = "https://maps.google.co.uk/maps?q=".$postcode."&amp;output=embed";
}


?>


<iframe width="420" height="350" frameborder="0" scrolling="yes" marginheight="0" marginwidth="0" src="<?php echo $url; ?>"></iframe><br />




