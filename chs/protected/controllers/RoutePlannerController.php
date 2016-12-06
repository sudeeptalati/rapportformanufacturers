<?php

class RoutePlannerController extends RController
{
	
	public function filters()
	{
		return array(
			'rights', // perform access control for CRUD operations
		);
	}
	
	public function actionGetEngineerDiary($engg_id, $cust_postcode)
	{
		//$engg_id = '90000114';
		$engineer_id = $engg_id;
		//echo "<br>Engineer id from url = ".$engineer_id;
		$current_date = strtotime('17-04-2013');
		
		$enggModel = Engineer::model()->findByPk($engineer_id);
		
		$engg_postcode = $enggModel->contactDetails->postcode;
		//echo "<br>Engineer postcode = ".$engg_postcode;
		$engg_postcode = str_replace (" ", "", $engg_postcode);
		
		
		
		$date = date('d-m-Y',time());
		//echo "<br>Today - ".$date;
		//$current_date = strtotime($date);
		//$customer_postcode = 'G41 1BH';
		$customer_postcode = $cust_postcode;
		
		//######## FIRST DAY DATES ###########
		$next_date_from_func = $this->getNextDate($current_date);
		$firstDayStartTime = $next_date_from_func['startTime'];
// 		echo "<hr>Temp first start time = ".$firstDayStartTime;
// 		echo "<br>Normal format Start date = ".date('d-m-Y',$firstDayStartTime);
		$firstDayEndTime = $next_date_from_func['endTime'];
// 		echo "<br>Temp first start time = ".$firstDayEndTime;
// 		echo "<br>Normal format End date = ".date('d-m-Y',$firstDayEndTime);
		//######## FIRST DAY DATES ###########
		
		//####### SECOND DAY DATES ############
		$second_day_dates = $this->getNextDate($firstDayStartTime);
		$secondDayStartTime = $second_day_dates['startTime'];
// 		echo "<hr>Temp sec start time = ".$secondDayStartTime;
// 		echo "<br>Normal format Start date = ".date('d-m-Y',$secondDayStartTime);
		$secondDayEndTime = $second_day_dates['endTime'];
// 		echo "<br>Temp sec start time = ".$secondDayEndTime;
// 		echo "<br>Normal format End date = ".date('d-m-Y',$secondDayEndTime);
		//####### SECOND DAY DATES ############
		
 		//######## THIRD DAY DATES ############ 
		$third_day_dates = $this->getNextDate($secondDayStartTime);
		$thirdDayStartTime = $third_day_dates['startTime'];
// 		echo "<hr>Temp third start time = ".$thirdDayStartTime;
// 		echo "<br>Normal format Start date = ".date('d-m-Y',$thirdDayStartTime);
		$thirdDayEndTime = $third_day_dates['endTime'];
// 		echo "<br>Temp third start time = ".$thirdDayEndTime;
// 		echo "<br>Normal format End date = ".date('d-m-Y',$thirdDayEndTime);
		//######## THIRD DAY DATES ############
		
		//######## FORTH DAY DATES ###########
		$forth_day_dates = $this->getNextDate($thirdDayStartTime);
		$forthDayStartTime = $forth_day_dates['startTime'];
//  	echo "<hr>Temp forth start time = ".$forthDayStartTime;
//  	echo "<br>Normal format Start date = ".date('d-m-Y',$forthDayStartTime);
		$forthDayEndTime = $forth_day_dates['endTime'];
//  	echo "<br>Temp forth start time = ".$forthDayEndTime;
//  	echo "<br>Normal format End date = ".date('d-m-Y',$forthDayEndTime);
		//######## FORTH DAY DATES ###########
		
 		//######## FIFTH DAY DATES ###########
 		$fifth_day_dates = $this->getNextDate($forthDayStartTime);
 		$fifthDayStartTime = $fifth_day_dates['startTime'];
//  	echo "<hr>Temp forth start time = ".$fifthDayStartTime;
//  	echo "<br>Normal format Start date = ".date('d-m-Y',$fifthDayStartTime);
 		$fifthDayEndTime = $fifth_day_dates['endTime'];
//  	echo "<br>Temp forth start time = ".$fifthDayEndTime;
//  	echo "<br>Normal format End date = ".date('d-m-Y',$fifthDayEndTime);
 		//######## FIFTH DAY DATES ###########
		
		
		$first_day_data_array = array();
		$second_day_data_array = array();
		$third_day_data_array = array();
		$forth_day_data_array = array();
		$fifth_day_data_array = array();
		$diff_array = array();
		
		//############### GETTING MAX CALLS, DISTANCE AND TRAVEL TIME ##############################
		$advanceModel = AdvanceSettings::model()->findByAttributes(array('parameter'=>'livecall_max_calls'));
// 		echo "<hr>Data parameter = ".$advanceModel->parameter;
// 		echo "<br>Data value = ".$advanceModel->value;
		$max_calls = $advanceModel->value;
		
		$advanceModel = AdvanceSettings::model()->findByAttributes(array('parameter'=>'livecall_max_day_distance'));
// 		echo "<hr>Data parameter = ".$advanceModel->parameter;
// 		echo "<br>Data value = ".$advanceModel->value;
		$max_distance = $advanceModel->value;
		
		$advanceModel = AdvanceSettings::model()->findByAttributes(array('parameter'=>'livecall_max_day_traveltime'));
// 		echo "<hr>Data parameter = ".$advanceModel->parameter;
// 		echo "<br>Data value = ".$advanceModel->value;
		$max_duration = $advanceModel->value;
		//############### GETTING MAX CALLS, DISTANCE AND TRAVEL TIME ##############################
		
		//##### GETTING DIARY MODEL ARRAY FOR 3 DAYS ##################
		
		$first_diary_data = Enggdiary::model()->getData($engg_id, $firstDayStartTime, $firstDayEndTime);
		$i= 0;
		foreach ($first_diary_data as $data)
		{
			$postcode = $data->servicecall->customer->postcode;
			//echo "<br>Customer postcode = ".$postcode;
			array_push($first_day_data_array, $postcode);
			$i++;
		}
		//echo "<br>No of calls on first day = ".$i;
		$firstDay_calls = $i;
		
		//echo "<hr>";
		//print_r($first_day_data_array);
		
		$second_diary_data = Enggdiary::model()->getData($engg_id, $secondDayStartTime, $secondDayEndTime);
		
		$j=0;
		foreach ($second_diary_data as $data)
		{
			$postcode = $data->servicecall->customer->postcode;
			//echo "<br>Customer postcode = ".$postcode;
			array_push($second_day_data_array, $postcode);
			$j++;
		}
		//echo "<br>No of calls on second day = ".$j;
		$secDay_calls = $j;
		
		$third_diary_data = Enggdiary::model()->getData($engg_id, $thirdDayStartTime, $thirdDayEndTime);
		$k=0;
		foreach ($third_diary_data as $data)
		{
			$postcode = $data->servicecall->customer->postcode;
			//echo "<br>Customer postcode = ".$postcode;
			array_push($third_day_data_array, $postcode);
			$k++;
		}
		//echo "<br>No of calls on 3rd day = ".$k;
		$thirdDay_calls = $k;
		
		$forth_diary_data = Enggdiary::model()->getData($engg_id, $forthDayStartTime, $forthDayEndTime);
		$k=0;
		foreach ($forth_diary_data as $data)
		{
			$postcode = $data->servicecall->customer->postcode;
			//echo "<br>Customer postcode = ".$postcode;
			array_push($forth_day_data_array, $postcode);
			$k++;
		}
		//echo "<br>No of calls on 3rd day = ".$k;
		$forthDay_calls = $k;
		
		$fifth_diary_data = Enggdiary::model()->getData($engg_id, $fifthDayStartTime, $fifthDayEndTime);
		$k=0;
		foreach ($fifth_diary_data as $data)
		{
			$postcode = $data->servicecall->customer->postcode;
			//echo "<br>Customer postcode = ".$postcode;
			array_push($fifth_day_data_array, $postcode);
			$k++;
		}
		//echo "<br>No of calls on 3rd day = ".$k;
		$fifthDay_calls = $k;
		 
		//######## GETTING OPTIMISED DISTANCE FOR 3 DAYS WITHOUT CUSTOMER POSTCODE ########		
		
		$first_day_optimised = $this->getOptimisedDistance($engg_postcode,$first_day_data_array);
		$second_day_optimised = $this->getOptimisedDistance($engg_postcode, $second_day_data_array);
		$third_day_optimised = $this->getOptimisedDistance($engg_postcode, $third_day_data_array);
		$forth_day_optimised = $this->getOptimisedDistance($engg_postcode, $forth_day_data_array);
		$fifth_day_optimised = $this->getOptimisedDistance($engg_postcode, $fifth_day_data_array);
		
// 		echo "<hr>First day distance = ".$first_day_optimised['distance'];
// 		echo "<br>First day duration = ".$first_day_optimised['duration'];
		$first_day_distance = $first_day_optimised['distance'];
		$first_day_duration = $first_day_optimised['duration'];
// 		echo "<hr>Second day distance = ".$second_day_optimised['distance'];
// 		echo "<br>Second day duration = ".$second_day_optimised['duration'];
		$second_day_distance = $second_day_optimised['distance'];
		$second_day_duration = $second_day_optimised['duration'];
// 		echo "<hr>Third day distance = ".$third_day_optimised['distance'];
// 		echo "<br>Third day duration = ".$third_day_optimised['duration'];
		$third_day_distance = $third_day_optimised['distance'];
		$third_day_duration = $third_day_optimised['duration'];
// 		echo "<hr>Forth day distance = ".$forth_day_optimised['distance'];
// 		echo "<br>Forth day duration = ".$forth_day_optimised['duration'];
		$forth_day_distance = $forth_day_optimised['distance'];
		$forth_day_duration = $forth_day_optimised['duration'];
// 		echo "<hr>Fifth day distance = ".$fifth_day_optimised['distance'];
// 		echo "<br>Fifth day duration = ".$fifth_day_optimised['duration'];
		$fifth_day_distance = $fifth_day_optimised['distance'];
		$fifth_day_duration = $fifth_day_optimised['duration'];
		
		
		//##### ADDING CUSTOMER POSTCODE AND GETTING OPTIMISED DISTANCE FOR 3 DAYS WITH CUSTOMER POSTCODE #####
		if($firstDay_calls<$max_calls && $first_day_distance<$max_distance && $first_day_duration<$max_duration)
		{
			//echo "<hr>In loop of 1st day";
			array_push($first_day_data_array, $customer_postcode);
			$first_with_custPost_arr = $this->getOptimisedDistance($engg_postcode, $first_day_data_array);
			//echo "<hr>First day distance after adding customer postcode = ".$first_with_custPost_arr['distance'];
			$first_dist_with_custPost = $first_with_custPost_arr['distance'];
			$first_day_diff = $first_dist_with_custPost - $first_day_distance;
			//echo "<br>Addition for 1st day = ".$first_day_diff;
			//$push_arr = array("day"=>"first","distance"=>$first_day_diff);
			$push_arr = array("first"=>$first_day_diff);
			//array_push($diff_array, $push_arr); 
			$diff_array = array_merge($diff_array,$push_arr);
			
		}
		if($secDay_calls<$max_calls && $second_day_distance<$max_distance && $second_day_duration<$max_duration)
		{
			//echo "<hr>In loop of 2nd day";
			array_push($second_day_data_array, $customer_postcode);
			$second_with_custPost_arr = $this->getOptimisedDistance($engg_postcode, $second_day_data_array);
			//echo "<hr>Second day distance = ".$second_with_custPost_arr['distance'];
			$second_dist_with_custPost = $second_with_custPost_arr['distance'];
			$second_day_diff = $second_dist_with_custPost - $second_day_distance;
			//echo "<br>Addition for 2nd day = ".$second_day_diff;
			//$push_arr = array("day"=>"second","distance"=>$second_day_diff);
			$push_arr = array("second"=>$second_day_diff);
			//print_r($push_arr);
			$diff_array = array_merge($diff_array,$push_arr);
			//array_push($diff_array, $push_arr);
			
		}
		if($thirdDay_calls<$max_calls && $third_day_distance<$max_distance && $third_day_duration<$max_duration)
		{
			//echo "<hr>In loop of 3rd day";
			array_push($third_day_data_array, $customer_postcode);
			$third_with_custPost_arr = $this->getOptimisedDistance($engg_postcode, $third_day_data_array);
			//echo "<hr>Third day distance = ".$third_with_custPost_arr['distance'];
			$third_dist_with_custPost = $third_with_custPost_arr['distance'];
			$third_day_diff = $third_dist_with_custPost - $third_day_distance;
			//echo "<br>Addition for 3rd day = ".$third_day_diff;
			//$push_arr = array("day"=>"third","distance"=>$third_day_diff);
			$push_arr = array("third"=>$third_day_diff);
			//print_r($push_arr);
			$diff_array = array_merge($diff_array,$push_arr);
			//array_push($diff_array, $push_arr);
		}
		if($forthDay_calls<$max_calls && $forth_day_distance<$max_distance && $forth_day_duration<$max_duration)
		{
			//echo "<hr>In loop of 3rd day";
			array_push($forth_day_data_array, $customer_postcode);
			$forth_with_custPost_arr = $this->getOptimisedDistance($engg_postcode, $forth_day_data_array);
			//echo "<hr>Third day distance = ".$third_with_custPost_arr['distance'];
			$forth_dist_with_custPost = $forth_with_custPost_arr['distance'];
			$forth_day_diff = $forth_dist_with_custPost - $forth_day_distance;
			//echo "<br>Addition for 3rd day = ".$third_day_diff;
			//$push_arr = array("day"=>"third","distance"=>$third_day_diff);
			$push_arr = array("forth"=>$forth_day_diff);
			//print_r($push_arr);
			$diff_array = array_merge($diff_array,$push_arr);
			//array_push($diff_array, $push_arr);
		}
		if($fifthDay_calls<$max_calls && $fifth_day_distance<$max_distance && $fifth_day_duration<$max_duration)
		{
			//echo "<hr>In loop of 3rd day";
			array_push($fifth_day_data_array, $customer_postcode);
			$fifth_with_custPost_arr = $this->getOptimisedDistance($engg_postcode, $fifth_day_data_array);
			//echo "<hr>Third day distance = ".$third_with_custPost_arr['distance'];
			$fifth_dist_with_cust = $fifth_with_custPost_arr['distance'];
			$fifth_day_diff = $fifth_dist_with_cust - $fifth_day_distance;
			//echo "<br>Addition for 3rd day = ".$third_day_diff;
			//$push_arr = array("day"=>"third","distance"=>$third_day_diff);
			$push_arr = array("fifth"=>$fifth_day_diff);
			//print_r($push_arr);
			$diff_array = array_merge($diff_array,$push_arr);
			//array_push($diff_array, $push_arr);
		}
		
		
		//echo "<hr>";
		if(count($diff_array)!=0)
		{
			//echo "<br>Diff array = ";
			//print_r($diff_array);
			asort($diff_array);
			
			//echo "<hr>Sorted arr = ";
			//print_r($diff_array);
			$newArray = array_slice($diff_array, 0, 3, true);// array_slice($diff_array, $start_index, $till_index, true), gives the data for no of days we want.
			$display_data = array();
			
			foreach ($newArray as $key=>$value)
			{
				if($key == 'first')
				{
					$diary_events_array = array();
					//echo "<hr>First day is prefered";
					foreach ($first_diary_data as $data)
					{
// 						echo "<br>Customer name = ".$data->servicecall->customer->fullname;
// 						echo "<br>Customer postcode = ".$data->servicecall->customer->postcode."<br>";

						$customer_name=$data->servicecall->customer->fullname;
						$customer_postcode=$data->servicecall->customer->postcode;
						$engineer_name = $data->engineer->fullname;
							
						$start_date= date("Y-m-d H:i",$data->visit_start_date);
						
						if (!empty($data->visit_end_date))
						{
							$end_date = date("Y-m-d H:i",$data->visit_end_date);
						}
						 
						$diary_events_array['id'] = $data->id;///id of the engg diary
						$diary_events_array['service_id'] = $data->servicecall_id;
						$diary_events_array['title'] = "\n ".$customer_name." ".$customer_postcode."\n ".$engineer_name.""; ///** HERE WE WIL DISPLAY custtomer name and postcode
						$diary_events_array['start'] = $start_date;
						$diary_events_array['end'] = $end_date;
						$diary_events_array['url'] = Yii::app()->baseUrl."/index.php?r=Servicecall/view&id=".$data->servicecall_id;
						$diary_events_array['allDay'] = false ;
						$diary_events_array['textColor'] = "white" ;
							
						array_push($display_data,$diary_events_array);
					}//end of diary foreach().
				}//end of first.
				if($key == 'second')
				{
					$diary_events_array = array();
					//echo "<hr>Second day is prefered";
					foreach ($second_diary_data as $data)
					{
// 						echo "<br>Customer name = ".$data->servicecall->customer->fullname;
//  					echo "<br>Customer postcode = ".$data->servicecall->customer->postcode."<br>";

						$customer_name=$data->servicecall->customer->fullname;
						$customer_postcode=$data->servicecall->customer->postcode;
						$engineer_name = $data->engineer->fullname;
							
						$start_date= date("Y-m-d H:i",$data->visit_start_date);
						
						if (!empty($data->visit_end_date))
						{
							$end_date = date("Y-m-d H:i",$data->visit_end_date);
						}
							
						$diary_events_array['id'] = $data->id;///id of the engg diary
						$diary_events_array['service_id'] = $data->servicecall_id;
						$diary_events_array['title'] = "\n ".$customer_name." ".$customer_postcode."\n ".$engineer_name.""; ///** HERE WE WIL DISPLAY custtomer name and postcode
						$diary_events_array['start'] = $start_date;
						$diary_events_array['end'] = $end_date;
						$diary_events_array['url'] = Yii::app()->baseUrl."/index.php?r=Servicecall/view&id=".$data->servicecall_id;
						$diary_events_array['allDay'] = false ;
						$diary_events_array['textColor'] = "white" ;
							
						array_push($display_data,$diary_events_array);
						
					}//end of diary foreach().
				}//end of second.
				if($key == 'third')
				{
					$diary_events_array = array();
					//echo "<hr>Third day is prefered";
					foreach ($third_diary_data as $data)
					{
// 						echo "<br>Customer name = ".$data->servicecall->customer->fullname;
// 						echo "<br>Customer postcode = ".$data->servicecall->customer->postcode."<br>";

						$customer_name=$data->servicecall->customer->fullname;
						$customer_postcode=$data->servicecall->customer->postcode;
						$engineer_name = $data->engineer->fullname;
							
						$start_date= date("Y-m-d H:i",$data->visit_start_date);
						
						if (!empty($data->visit_end_date))
						{
							$end_date = date("Y-m-d H:i",$data->visit_end_date);
						}
							
						$diary_events_array['id'] = $data->id;///id of the engg diary
						$diary_events_array['service_id'] = $data->servicecall_id;
						$diary_events_array['title'] = "\n ".$customer_name." ".$customer_postcode."\n ".$engineer_name.""; ///** HERE WE WIL DISPLAY custtomer name and postcode
						$diary_events_array['start'] = $start_date;
						$diary_events_array['end'] = $end_date;
						$diary_events_array['url'] = Yii::app()->baseUrl."/index.php?r=Servicecall/view&id=".$data->servicecall_id;
						$diary_events_array['allDay'] = false ;
						$diary_events_array['textColor'] = "white" ;
							
						array_push($display_data,$diary_events_array);
						
				
					}//end of diary foreach().
				}//end of third.
				if($key == 'forth')
				{
					$diary_events_array = array();
					//echo "<hr>Forth day is prefered";
					foreach ($forth_diary_data as $data)
					{
// 						echo "<br>Customer name = ".$data->servicecall->customer->fullname;
// 						echo "<br>Customer postcode = ".$data->servicecall->customer->postcode."<br>";

						$customer_name=$data->servicecall->customer->fullname;
						$customer_postcode=$data->servicecall->customer->postcode;
						$engineer_name = $data->engineer->fullname;
							
						$start_date= date("Y-m-d H:i",$data->visit_start_date);
						
						if (!empty($data->visit_end_date))
						{
							$end_date = date("Y-m-d H:i",$data->visit_end_date);
						}
							
						$diary_events_array['id'] = $data->id;///id of the engg diary
						$diary_events_array['service_id'] = $data->servicecall_id;
						$diary_events_array['title'] = "\n ".$customer_name." ".$customer_postcode."\n ".$engineer_name.""; ///** HERE WE WIL DISPLAY custtomer name and postcode
						$diary_events_array['start'] = $start_date;
						$diary_events_array['end'] = $end_date;
						$diary_events_array['url'] = Yii::app()->baseUrl."/Servicecall/".$data->servicecall_id.'?notify_response=';
						$diary_events_array['allDay'] = false ;
						$diary_events_array['textColor'] = "white" ;
							
						array_push($display_data,$diary_events_array);
				
					}//end of diary foreach().
				}//end of forth.
				if($key == 'fifth')
				{
					$diary_events_array = array();
					//echo "<hr>Fifht day is prefered";
					foreach ($fifth_diary_data as $data)
					{
// 						echo "<br>Customer name = ".$data->servicecall->customer->fullname;
// 						echo "<br>Customer postcode = ".$data->servicecall->customer->postcode."<br>";

						$customer_name=$data->servicecall->customer->fullname;
						$customer_postcode=$data->servicecall->customer->postcode;
						$engineer_name = $data->engineer->fullname;
							
						$start_date= date("Y-m-d H:i",$data->visit_start_date);
						
						if (!empty($data->visit_end_date))
						{
							$end_date = date("Y-m-d H:i",$data->visit_end_date);
						}
							
						$diary_events_array['id'] = $data->id;///id of the engg diary
						$diary_events_array['service_id'] = $data->servicecall_id;
						$diary_events_array['title'] = "\n ".$customer_name." ".$customer_postcode."\n ".$engineer_name.""; ///** HERE WE WIL DISPLAY custtomer name and postcode
						$diary_events_array['start'] = $start_date;
						$diary_events_array['end'] = $end_date;
						$diary_events_array['url'] = Yii::app()->baseUrl."/index.php?r=Servicecall/view&id=".$data->servicecall_id;
						$diary_events_array['allDay'] = false ;
						$diary_events_array['textColor'] = "white" ;
							
						array_push($display_data,$diary_events_array);
						
				
					}//end of diary foreach().
				}//end of fifth.
			}//end of foreach().
			
			echo json_encode($display_data);
			
		}//end of if i.e, array is NOT empty, display 1 to 3 days
		/*
		else 
		{
			//echo "Array is empty";
			$forth_day_diary_data = Enggdiary::model()->getData($engg_id, $forthDayStartTime, $forthDayEndTime);
			foreach ($forth_day_diary_data as $data)
			{
				$postcode = $data->servicecall->customer->postcode;
				//echo "<br>Customer postcode = ".$postcode;
				array_push($forth_day_data_array, $postcode);
				$j++;
			}
			
			$forth_day_optimised = $this->getOptimisedDistance($forth_day_data_array);
			//echo "<br>Fourth day distance = ".$forth_day_optimised['distance'];
			$forth_day_distance = $forth_day_optimised['distance'];
			$forth_day_duration = $forth_day_optimised['duration'];
			array_push($forth_day_data_array, $customer_postcode);
			$forth_with_custPost_arr = $this->getOptimisedDistance($forth_day_data_array);
			//echo "<br>Fourth day distance after adding customer postcode = ".$forth_with_custPost_arr['distance'];
			$forth_with_custPost = $forth_with_custPost_arr['distance'];
			$forth_day_diff = $forth_with_custPost - $forth_day_distance;
			
			
		}//end of else, i.e, array is empty. Check for 4 and 5 days.
		
		*/
				
		
	}//end of actionGetEngineerDiary().
	
	public function getOptimisedDistance($engg_postcode, $postcode_array)
	{
		//echo "<hr>POSTCODE ARRAY IN FUNC:";
		//echo "<br>Engineer postcode in func = ".$engg_postcode;
		$way_points = '|';
		$totalDistance = 0;
		$totalDuration = 0;
		$returnArray = array();
		for($i=0;$i<count($postcode_array);$i++)
		{
			//echo "<br>Postcode in second_data_array = ".$postcode_array[$i];
			$postcode = $postcode_array[$i];
			$postcode = str_replace (" ", "", $postcode);
			$way_points .= $postcode.'|';
		}
		
		//echo "<br>Waypoints = ".$way_points;
		
		$url = 'http://maps.googleapis.com/maps/api/directions/json?origin='.$engg_postcode.'&destination='.$engg_postcode.'&waypoints=optimize:true'.$way_points.'&sensor=false&units=imperial';
		//echo "<br>URL = ".$url;
		
		$server_data = $this->curl_file_get_contents($url);
		//echo "<br>DATA from google server = ".$server_data;
		
		$jsondata = json_decode($server_data);
		$legs = $jsondata->routes[0]->legs;
		for($i=0; $i<count($legs);$i++)
		{
			//echo "<br>Distance from leg = ".$jsondata->routes[0]->legs[$i]->distance->text;
 			//echo "<br>Duration from leg = ".$jsondata->routes[0]->legs[$i]->duration->text;
			$totalDistance += $legs[$i]->distance->text;
			$totalDuration += $legs[$i]->duration->text;
		}
		
		//echo "<hr>Total distance = ".$totalDistance;
		$returnArray = array(
					'distance'=>$totalDistance,
					'duration'=>$totalDuration
				);
		return $returnArray;
				
	}//end of getOptimisedDistance
	
	public function curl_file_get_contents($request)
	{
		$curl_req = curl_init($request);
			
		curl_setopt($curl_req, CURLOPT_URL, $request);
		curl_setopt($curl_req, CURLOPT_RETURNTRANSFER, TRUE);
		curl_setopt($curl_req, CURLOPT_HEADER, FALSE);
	
		$contents = curl_exec($curl_req);
	
		curl_close($curl_req);
		
		return $contents;
	}///end of functn curl File get contents
	
	public function getNextDate($date)
	{
		//echo "<hr>Date passed in funct = ".$date;
		//echo "<br>Normal format of passed date = ".date('d-m-Y',$date);
		$day_of_passed_date = date('D',$date);
		//echo "<br>Day of passed date = ".$day_of_passed_date;
		$dates_array = array();
		
		if($day_of_passed_date == "Fri")
		{
			//echo "<br>Cannot book for next day";
			$dayStartTime = strtotime('+3 days', $date);
			$dayEndTime = strtotime('+1 day', $dayStartTime);
			$dates_array = array(
					'startTime'=>$dayStartTime,
					'endTime'=>$dayEndTime
			);
			
		}
		else 
		{
			//echo "<br>Just increment day by +1";
			$dayStartTime = strtotime('+1 day', $date);
			$dayEndTime = strtotime('+2 days', $date);
			$dates_array = array(
						'startTime'=>$dayStartTime,
						'endTime'=>$dayEndTime
					);
			
		}
		
		return $dates_array;

	}
	
	
	public function actionIndex()
	{
		$this->render('index');
	}

	// Uncomment the following methods and override them if needed
	/*
	public function filters()
	{
		// return the filter configuration for this controller, e.g.:
		return array(
			'inlineFilterName',
			array(
				'class'=>'path.to.FilterClass',
				'propertyName'=>'propertyValue',
			),
		);
	}

	public function actions()
	{
		// return external action classes, e.g.:
		return array(
			'action1'=>'path.to.ActionClass',
			'action2'=>array(
				'class'=>'path.to.AnotherActionClass',
				'propertyName'=>'propertyValue',
			),
		);
	}
	*/
}//end of class.