<?php

class DefaultController  extends RController
{
	public function filters()
	{
		return array(
			'rights', // perform access control for CRUD operations
		);
		/*
		return array(
		'accessControl', // perform access control for CRUD operations
		);
		*/
	}
 
	public function accessRules()
	{
		return array(
		
		array('allow', // allow authenticated user to perform 'create' and 'update' actions
		'actions'=>array('paidcustomer'),
		'users'=>array('@'),
		),
		array('allow', // allow admin user to perform 'admin' and 'delete' actions
		'actions'=>array('index','getcustomdaysdata','getexpirydate','servercode_simple_for_json','getServicecallsCountByStatusesInDateRange'),
		'users'=>array('admin'),
		),
		array('deny',  // deny all users
		'users'=>array('*'),
		),
		);
	}//end of access rules
	
	
	
	public function actionServercode_simple_for_json()
	{
	defined('DS') ? null : define('DS', DIRECTORY_SEPARATOR);
	
		if(isset($_POST['key']))
		{
		$k = $_POST['key'];		
		$request='http://www.rapportsoftware.co.uk/phocadownloads/addonsauthentication/keyauthentication.php?key='.$k;
		$curl=Graph::model()->curl_file_get_contents($request);
		$s=json_decode($curl,true);
    	//	echo $curl;			
    	echo $s['status'];
    	if($s['status']=='OK'){
				$url = 	Yii::getPathOfAlias('application.modules.graph.components');	
				$file= $url.DS.'graph.json';	
				Graph::model()->file_put_contents_deep($file,$s); 
				$this->redirect(array('default/index'));
			}
			else
			{
				$this->render('servercode_simple_for_json',array('server_response'=>$s));
			}
			
		}///end of if(isset($_POST['key']))
		else{		
			
			$this->redirect(array('default/index'));
		}
		
	}//////end of actionServercode_simple_for_json 
	
	
	
	public function actionPaidcustomer()
	{
		//echo "*********** *****";
		$this->render('paidcustomer');
	}
	
	
	public function actionIndex()
	{	
	
		$this->redirect(array('default/getexpirydate'));
			
	 
	}
	
	
	public function actionGetCustomDaysData()
	{
		//$data=CHtml::listData(Servicecall::model()->findAll(array('condition'=>'fault_date>=1404165600', 'order'=>"`fault_date` ASC")), 'id', 'fault_date');
		 
		$weekdays=$_GET['weekdays'];
		$job_status_id=$_GET['job_status_id'];
		$start_date=Graph::model()->formatDateForGraphData($_GET['start_date']);
		$end_date=Graph::model()->formatDateForGraphData($_GET['end_date']);
		$days_difference=Graph::model()->getDaysDifference($start_date, $end_date);
		
		
 
 
		
		//echo "<br>".$days_difference;
		$show_days=array('0','1','2','3','4','5','6'); ///0 (for Sunday) through 6 (for Saturday)

		//$show_days=array('1','2','3','4','5'); ///0 (for Sunday) through 6 (for Saturday)
		$show_days=str_split($weekdays);

	
		$today=date('d-M-Y');
		$today_time=strtotime($today);
		
		$full_graph_data=array();
		$jobstatus_filter_graph_data=array();
		$total_count=0;
		$jobstatus_filter_total_count=0;
 
		if ($days_difference<60)
		{
			for ($i=0;$i<=$days_difference;$i++)
			{
				$d = strtotime(date("d-M-Y", strtotime($start_date)) . "+".$i." day");

				$sd=$d;
				$ed=$d+86399;

				$weekday = date('w', $d);
				if (in_array($weekday, $show_days)) {

					$label_date=date('l d-M-Y',$d);

					$criteria=new CDbCriteria();
					$criteria->select="fault_date";
					$criteria->addBetweenCondition('fault_date', $sd, $ed);
					$no_of_calls=Servicecall::model()->count($criteria);

					$full_graph_data[$label_date]=$no_of_calls;
					$total_count=$total_count+$no_of_calls;

					if ($job_status_id!=0)/// 0 means all status not selected
					{
						//$jobstatus_filter_no_of_calls= Servicecall::model()->countByAttributes(array('fault_date'=>$d,'job_status_id'=>$job_status_id));

						$criteria=new CDbCriteria();
						$criteria->select="fault_date";
						$criteria->addBetweenCondition('fault_date', $sd, $ed);
						$criteria->addCondition('job_status_id='.$job_status_id);
						$jobstatus_filter_no_of_calls=Servicecall::model()->count($criteria);
						$jobstatus_filter_graph_data[$label_date]=$jobstatus_filter_no_of_calls;
						$jobstatus_filter_total_count=$jobstatus_filter_total_count+$jobstatus_filter_no_of_calls;
					} //end of if ($job_status_id!=0)/// 0 means all status not selected
				}///end of 	if (in_array($weekday, $show_days)) {		
			}//end of for

		}///end of if $days_difference
		else
		{
		
			$months = date_diff(new DateTime($start_date),new DateTime($end_date));
			$count_month=(int) abs(($months->format('%R%a'))/30);
			//echo (int) abs(($months->format('%R%a'))/30);
			$forloop_month=date('n',strtotime($start_date));
			$forloop_year=date('Y',strtotime($start_date));

			////First create an array of Start date of month and end date of month of 12 Months
			//for ($i=0;$i<12;$i++)///initialization for loop
			
			////if month $startdate == $month of enddate
			$sd_month=date('n',strtotime($start_date));
			$ed_month=date('n',strtotime($end_date));
			$ed_year=date('Y',strtotime($end_date));
				
			$exit=false;
			
			$i=0;
			while($exit==false)
			{
				if ($i==0)
				{
					$sd=$start_date;
				}else
				{
					$month_name=Graph::model()->getMonthNameByNumber($forloop_month);
					$sd='01-'.$month_name.'-'.$forloop_year;
				}

				if ($ed_month===date('n',strtotime($sd)) && $ed_year===date('Y',strtotime($sd)))
				{
					$ed=$end_date;
					$exit=true;
				}else
				{
					$ed=date('t-F-Y',strtotime($sd));//t gives no of days in a month
				}
				
				/*
				echo '<hr>'.$sd;
				echo '- '.$ed;
				*/
				$sd=strtotime($sd);
				$ed=strtotime($ed);
				
				$criteria=new CDbCriteria();
				$criteria->select="fault_date";
				$criteria->addBetweenCondition('fault_date', $sd, $ed);
				$no_of_calls=Servicecall::model()->count($criteria);
				$label_date=date('M-Y',$sd);
				$full_graph_data[$label_date]=$no_of_calls;
				$total_count=$total_count+$no_of_calls;
			
				
				if ($job_status_id!=0)/// 0 means select all status
				{	 
					$criteria->addCondition('job_status_id='.$job_status_id); 
					$jobstatus_filter_no_of_calls=Servicecall::model()->count($criteria);
					$jobstatus_filter_graph_data[$label_date]=$jobstatus_filter_no_of_calls;
					$jobstatus_filter_total_count=$jobstatus_filter_total_count+$jobstatus_filter_no_of_calls;
				}
				
				//echo '<br> '.$label_date.':	'.$no_of_calls;
				
				
			
				
				$forloop_month=$forloop_month+1;
				
				if ($forloop_month>12)
				{
					$forloop_month='1';
					$forloop_year=$forloop_year+1;
				}
				
				$i++;
				
			}///end of initialization for loop 
			
			
		}////end of else $days_difference
		
		 $final=array('full_data'=>$full_graph_data,'jobstatus_filter_data'=>$jobstatus_filter_graph_data, 'total_calls'=>$total_count,'jobstatus_filter_total_calls'=>$jobstatus_filter_total_count);
		 
		//array_push($full_graph_data,$total_count);
		//$full_graph_data=array_reverse($full_graph_data);
		///print_r($full_graph_data);
		//echo json_encode($full_graph_data);
		echo json_encode($final);

	}///end of actiongetcustomdaysdata
	
	
	
	public function actionGetServicecallsCountByStatusesInDateRange()
	{
		 
		$weekdays=$_GET['weekdays'];
		$start_date=Graph::model()->formatDateForGraphData($_GET['start_date']);
		$end_date=Graph::model()->formatDateForGraphData($_GET['end_date']);
		$days_difference=Graph::model()->getDaysDifference($start_date, $end_date);
		
		$jobstatuses_count=array();
		$total_count=0;
		/*
		echo "****".$start_date;
		echo "<br>***".$end_date;
		echo '<br> DF-'.$days_difference;
		*/
		
		
		//get list of JS
		$sd=strtotime($start_date);
		$ed=strtotime($end_date);
		$all_published_job_status=JobStatus::model()->getAllPublishedListdata('html_name');
		//print_r($all_published_job_status);
		
		
		foreach ($all_published_job_status as $id => $job_status_label) {
		
			$criteria=new CDbCriteria();
			$criteria->select="fault_date";
			$criteria->addBetweenCondition('fault_date', $sd, $ed);
			$criteria->addCondition('job_status_id='.$id); 		
			$no_of_calls=Servicecall::model()->count($criteria);
			//echo "<hr>".$jobstatus_label;
			if ($no_of_calls>0)
				$jobstatuses_count[$job_status_label]=$no_of_calls;
			$total_count=$total_count+$no_of_calls;
		}
		
		//echo "<hr>".print_r($jobstatuses_count);

		$final=array('jobstatuses_count'=>$jobstatuses_count,'total_calls'=>$total_count);
		echo json_encode($final);  
	
	}///end of actionGetServicecallsCountByStatusesInDateRange()
	
	
	public function actionGetExpiryDate()
	{
	
		Graph::model()->loadjson();
	
		$json_a=Graph::model()->loadjson();
		$encryption_key=$json_a['key'];
		//echo $json_a['expiry_date'];
		$encrypted_string=$json_a['encrypted_expiry_date'];
		/*echo "<hr>";
		echo "<hr>";
		*/
		$e=Graph::model()->encrypt('31-December-2014', '12345');
		//echo $e;
		
		
		$d=Graph::model()->decrypt($encrypted_string, $encryption_key);
		
		$l=strlen($encryption_key);
		
		$d=substr($d,0,-$l);
		//echo '<br>'.$d;
		//echo '<br>'.date('d-M-Y',$d);
		
		$dd_time=$d;
	
		$t=date('d-M-Y');
		$t_time=strtotime($t);
		
		
		/*
		echo '<br> Today time'.$t_time;
		echo '<br> DECRYPETD time'.$dd_time;
		echo '<br>'.date('d-M-Y',$dd_time);
		*/
		$this->render('index');
		/*
		if ($json_a['expiry_date']==null || $dd_time<$t_time)
		{
			$this->redirect(array('default/paidcustomer'));
		}
		else
		{
			$this->render('index');
		}
		*/
		
	}////end of GetExpiryDate
	
	
 }////end of class

?>