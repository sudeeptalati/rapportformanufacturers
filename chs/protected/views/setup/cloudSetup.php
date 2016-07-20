
<?php 
include 'setup_sidemenu.php';
?>

<h1>Spares Lookup Url</h1>



<?php 

//echo "IN CLOUD SETUP VIEW";

//$master_id = 1;
$cloud_url = '';
$cloud_setup_id = 1;

$db = new PDO('sqlite:../local_items_database/api/master_database.db');
$result = $db->query("SELECT spares_lookup_cloud_url FROM cloud_setup WHERE id = '$cloud_setup_id'");
//$result = $db->query("SELECT * FROM master_items WHERE id = '$master_id'");
$rows = $result->fetchAll(); // assuming $result == true
$n = count($rows);
//echo "<br>no of rows = ".$n."<br>";
//echo "CLOUD URL FROM DB = ".$rows['spares_lookup_cloud_url']."<br>";


foreach($rows as $data)
{
	//echo $data['id'];
	//echo "<br>";
	//echo $data['spares_lookup_cloud_url']."<br>";
	$cloud_url = $data['spares_lookup_cloud_url'];
}//end of foreach().

//echo "cloud_url outside foreach = ".$cloud_url."<br>";

?>

<form action="<?php echo Yii::app()->createUrl('setup/cloudUrlUpdated')?>" method="post">

<b>Cloud URL</b><br>

<textarea rows="2" cols="65" id="cloud_url" name="cloud_url">
<?php echo $cloud_url;?>
</textarea>

<br><br>

<input name="cloud_url_update"  type="submit" style="width:100px" value="Save">

</form>

