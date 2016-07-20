
<?php 
include 'setup_sidemenu.php';
?>

<h1>Spares Lookup Url</h1>

<?php 

//$cloud_url = '';
$cloud_setup_id = 1;

	$new_cloud_url = '';
	if(isset($_POST['cloud_url_update']))
	{
		//echo "<hr>UPDATE BUTTON IS CLICKED<hr>";
		//echo "Cloud url from textarea = ".$_POST['cloud_url']."<br>";
		$new_cloud_url = $_POST['cloud_url'];
		
		$db = new PDO('sqlite:../local_items_database/api/master_database.db');
		$result = $db->query("UPDATE  cloud_setup SET spares_lookup_cloud_url='$new_cloud_url' WHERE id = 1;");
			
	}//end of if(isset ()) of cloud_url_update button.
	
	else
	{
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
			$new_cloud_url = $data['spares_lookup_cloud_url'];
		}//end of foreach().
		
	}//end of else.
		
	//echo "<br>Cloud url outside if loop = ".$new_cloud_url;
		

?>

<div class="row">
		<?php echo "<b>Cloud URL</b><br>";?>
		<?php echo CHtml::textArea('',$new_cloud_url, array('disabled'=>'disabled', 'cols'=>'65'));?>
</div>
<br>
<div class="row" >
		<?php echo CHtml::button('Edit', array('submit' => array('setup/cloudSetup'))); ?>
</div>





