<?php 
class ReportsController extends RController
{



	public function actionDisplayDropdown()
	{
		//$model=new Servicecall('search');
		$model=new Servicecall();
		$model->unsetAttributes();
		 
		$this->render('enggReportDropdown',array('model'=>$model));	
	}//end of actionDisplayDropdown();
	
	
	public function actionExport()
	{
		$model=new Servicecall();
		//echo "in action test";
		//echo "<br>Value of engg id from engineer_id  = ".$_GET['engglist'];
		$engg_id = $_GET['engglist'];
		//echo "<br>Value of Stattus id  = ".$_GET['statuslist'];
		$status_id = $_GET['statuslist'];
		//echo "<br>Start date = ".$_GET['startDate'];
		$startDate = $_GET['startDate'];
		//echo "<br>Start date = ".$_GET['endDate'];
		$endDate = $_GET['endDate'];
		$exportData = '';
		
		if($startDate != '')
		{
			$str_startdate = strtotime($startDate);
			$str_enddate = strtotime($endDate );
			
			if($str_enddate < $str_startdate )
			{
				$this->render('enggReportDropdown',array('model'=>$model,'date_error'=>2));
			}//end of if comparing dates.
			else
			{
				
				
				$exportData = Servicecall::model()->enggJobReport($engg_id, $status_id, $startDate, $endDate);
				//var_dump($exportData);
				
				$this->render('engg_job_report',
					array('enggjobdata'=>$exportData, 'engg_id'=>$engg_id, 'status_id'=>$status_id, 'startDate'=>$startDate, 'endDate'=>$endDate)
				);
				
				
				
				
			}//end of else(comparing dates.)
		}//end of if(start_date not empty).
		else 
		{
			$this->render('enggReportDropdown',array('model'=>$model,'date_error'=>1));
		}
		
	}//end of export.
	


	public function actionEnggProductReport()
	{
		//echo "In engg prod report action";
		//echo "<br>engg id from url = ".$_GET['enggprodlist'];
		$engg_id = $_GET['enggprodlist'];
		
		//Product::model()->enggProductReport($engg_id);
		$model = new Reports;
		//$model->unsetAttributes(); 
		
		$this->render('enggProdReport', array('model'=>$model, 'engg_id'=>$engg_id));
		
	}//end of EnggProductReport.
	
	
	
	
	public function actionExcelServicecallsReport($engg_id, $status_id, $startDate, $endDate)
	{
		$criteriaData = Servicecall::model()->enggJobReport($engg_id, $status_id, $startDate, $endDate);
		
		$this->renderPartial('excelServicecallsReport',array('criteriaData'=>$criteriaData));
		
	}//end of actionEnggJobReport().
	
	
	
	
	
	
	public function actionEnggProdExport($engg_id)
	{
		//echo "<hr>engg id in export contr = ".$engg_id;
		header("Cache-Control: public");
  		header("Content-Description: File Transfer");
    	header("Content-Transfer-Encoding: binary");
    	header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
		header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); // Date in the past	
		header( "Content-Type: application/vnd.ms-excel; charset=utf-8" );
		header( "Content-Disposition: inline; filename=\"Engineer Report  ".date("F j, Y").".xls\"" );
		
		
        $dataProvider = Product::model()->enggProductReport($engg_id);
        $dataProvider->pagination = False;
        
        ?>
        <table border="1"> 
        <tr>
        	<th>Contract</th>
			<th>Brand</th>
			<th>Product </th>
			<th>Customer </th>
			<th>Town </th>
			<th>Postcode </th>
			<th>Engineer </th>
			
		</tr>
		<?php 
		foreach( $dataProvider->data as $data )
		{
		?>
			<tr> 
				<td><?php echo $data->contract->name;?></td>
				<td><?php echo $data->brand->name;?></td>
				<td><?php echo $data->productType->name;?></td>
				<td><?php echo $data->customer->fullname;?></td>
				<td><?php echo $data->customer->town;?></td>
				<td><?php echo $data->customer->postcode;?></td>
				<td><?php echo $data->engineer->company.', '.$data->engineer->fullname;?></td>
				
			</tr>
        
        <?php }//end of foreach($dataProvider); ?> 
		
		</table>
		
        <?php 

	}//end of enggProdExport().
	
}//end of class.


?>