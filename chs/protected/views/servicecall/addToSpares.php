<!--<div class="form">-->

<?php 
//$form=$this->beginWidget('CActiveForm', array(
//	'id'=>'servicecall-addToSpares-form',
//	'enableAjaxValidation'=>false,
//)); 
?>

<?php 
$master_id = $_GET['master_id'];
//echo $master_id."<br>";
$service_id = $_GET['service_id'];
//echo $service_id."<br>";

$itemDetails="localhost/KRUTHIKA/fitlist/spares_diary/masterItems/SendJsonData?id=".$master_id;
			$server_msg = Servicecall::model()->curl_file_get_contents($itemDetails, true);
			//echo $server_msg."<hr>";
			
			$decodedata = json_decode($server_msg, true);
//			echo $decodedata['master_id']."<br>";
//			echo $decodedata['part_num']."<br>";
			$part_number = $decodedata['part_num'];
			//echo $decodedata['opn']."<br>";
			$opn = $decodedata['opn'];
			//echo $decodedata['part_name']."<br>";
			$name = $decodedata['part_name'];
			//echo "item name = ".$name."<br>";
			
						

?>

	<form action="<?php echo Yii::app()->createUrl("SparesUsed/saveData");?>" method="POST">
	Master ID <input type="text" name="master_id" value=<?php echo $master_id;?>><br>
	Service ID <input type="text" name="service_id" value=<?php echo $service_id;?>><br>
	Part Num <input type="text" name="part_number" value=<?php echo $part_number;?>><br>
	OPN <input type="text" value=<?php echo $opn;?>><br>
	Name <input type="text" name="name" value="<?php echo $name;?>" ><br>
	Quantity <input type="text" name="quantity"><br>
	Price <input type="text" name="unit_price"><br>
	<input type="submit" style="width:100px">
	 
	</form>

<?php //$this->endWidget(); ?>

<!--</div> form -->