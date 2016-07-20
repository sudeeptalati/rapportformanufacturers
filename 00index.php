

<html>
<head>

<style type="text/css">
body
{
background-color:#F6F6F6;
}
h1,td
{
color:#355C96;
text-align:center;
font-family:"Arial";
}
p
{
font-family:"Times New Roman";
font-size:20px;
}
</style>
<?php

//echo $_POST['project'];

//echo "hello in index outside chs<hr>";

$dir = dirname(__FILE__);
//echo $dir."<hr>";

$chs_path = $dir."\chs";
$ims_path = $dir."\ims";

if(file_exists($chs_path) && !file_exists($ims_path))
{
	//echo "Only chs is present";

	echo "<SCRIPT LANGUAGE='javascript'>location.href='chs/';</SCRIPT>";

}
else if(file_exists($ims_path) && !file_exists($chs_path))
{
	//echo "Only ims is present";
	echo "<SCRIPT LANGUAGE='javascript'>location.href='ims/';</SCRIPT>";

	}
else if(file_exists($chs_path) && file_exists($ims_path))
{
	
	//echo "Chs and ims are present<hr>";
	?>
	<!--
	<a href="javascript:location.href='chs/';">CHS</a><br>
	<a href="javascript:location.href='ims/';">IMS</a>
	-->	
	<?php
}
else
{
	echo "Both are not present";
}
?>
</head>

<body>

<center>
<br>
<table>
<tr>
<td colspan='2'><h1>Please Select </h1></td>
</tr>
<tr>
<td colspan='2'><br></td>
</tr>
<tr>
	<td><a href="javascript:location.href='chs/';"><img src="images/rapportchsbox.png" alt="Smiley face" height="" width="" /></a></td>
	<td><a href="javascript:location.href='ims/';"><img src="images/rapportstkbox.png" alt="Smiley face" height="" width="" /></a></td>
</td>
</tr>
<tr>
	<td><a href="javascript:location.href='chs/';"><img src="images/rapport-logo.png" alt="Smiley face" height="67" width="200" /></a></td>
	<td><a href="javascript:location.href='ims/';"><img src="images/rapport-stock-logo.png" alt="Smiley face" height="67" width="200" /></a></td>
	
</tr>
</table>

</center>
</body>
</html>

	
