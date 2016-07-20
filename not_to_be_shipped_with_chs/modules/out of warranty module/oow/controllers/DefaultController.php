<?php

class DefaultController extends Controller
{
	public function actionIndex()
	{
		$this->redirect('index.php?r=oow/search/admin');
	}
	
	public function actionCreateoowbyapi()
	{
	
		$id=$_POST['id'];
		$model_number=$_POST['model_number'];
		$serial_number=$_POST['serial_number'];
		$notes=urldecode($_POST['notes']);
		
		//echo "<br>".$serial_number;
		
		$model=new Oow;
		$model->serial_number=$serial_number;
		$model->model_number=$model_number;
		$model->notes=$notes;
		
		if ($model->save())
		{
			echo "success";
			$this->updateMySqlToSuccess($id);
		}
		else
		{
			echo "Fail :".print_r($model->getErrors());
		}
		
		
		
	}
	
	
	
	public function updateMySqlToSuccess($id)
	{
	$db_link = mysql_connect('localhost', 'starref', 'starref');
	
	if (!$db_link) {
		die('Could not connect: ' . mysql_error());
		}

	if (!mysql_select_db('amica_testing', $db_link)) {
		echo 'Could not select database';
		exit;
	}



	echo "Recieved Id".$id;
	
	$sql_query="UPDATE `out_of_warranty_products` SET  `migrated` =  '1' WHERE  `out_of_warranty_products`.`id_product` = ".$id;
	
	$result = mysql_query($sql_query, $db_link);

	if (!$result) {
		echo "DB Error, could not query the database\n";
		echo 'MySQL Error: ' . mysql_error();
		echo "<p>Query used: $query";
		exit;
		}

	}
	
	
}