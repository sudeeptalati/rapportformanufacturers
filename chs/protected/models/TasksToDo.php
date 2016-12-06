<?php

/**
 * This is the model class for table "tasks_to_do".
 *
 * The followings are the available columns in table 'tasks_to_do':
 * @property integer $id
 * @property string $task
 * @property string $status
 * @property string $msgbody
 * @property string $subject
 * @property string $send_to
 * @property string $created
 * @property string $scheduled
 * @property string $executed
 * @property string $finished
 */
class TasksToDo extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return TasksToDo the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tasks_to_do';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('task, status, msgbody, subject, send_to, created, scheduled, executed, finished', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, task, status, msgbody, subject, send_to, created, scheduled, executed, finished', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'task' => 'Task',
			'status' => 'Status',
			'msgbody' => 'Msgbody',
			'subject' => 'Subject',
			'send_to' => 'Send To',
			'created' => 'Created',
			'scheduled' => 'Scheduled',
			'executed' => 'Executed',
			'finished' => 'Finished',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('task',$this->task,true);
		$criteria->compare('status',$this->status,true);
		$criteria->compare('msgbody',$this->msgbody,true);
		$criteria->compare('subject',$this->subject,true);
		$criteria->compare('send_to',$this->send_to,true);
		$criteria->compare('created',$this->created,true);
		$criteria->compare('scheduled',$this->scheduled,true);
		$criteria->compare('executed',$this->executed,true);
		$criteria->compare('finished',$this->finished,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}//end of search.
	
	public function listTasksToDo( $task_id)
	{
		//echo "<br>In Tasks model :".$task_id;
		$taskModel = TasksToDo::model()->findByPk($task_id);
		
		$email_sent_status = '';
		//echo "<hr>Task Id = ".$taskModel->id;
		//echo "<br>Task = ".$taskModel->task;
		$task = $taskModel->task;
		//echo "<br>Status = ".$taskModel->status;
		$taskStatus = $taskModel->status;
		//echo "<br>Msg body = ".$taskModel->msgbody;
		$msgbody = $taskModel->msgbody;
		//echo "<br>Subject = ".$taskModel->subject;
		$subject = $taskModel->subject;
		//echo "<br>Send to = ".$taskModel->send_to;
		$send_to = $taskModel->send_to;
		$response_msg = '';
		
		switch ($task) 
		{
			case 'email':
				//echo "<br>Send email";
				
				$response = NotificationRules::model()->sendEmail($send_to, $msgbody, $subject);
				//echo "<br>Response in tasks model = ".$response;
					
				if($response == 1)
				{
					$response_msg = "<br><span style='color:green'>Email sent succesuflly to ".$send_to." Subject: ".$subject."</span>";
					$tasksCompleteModel = TasksToDo::model()->updateByPk($task_id, array('status'=>'finished'));
					
					$finished_time = time();
					$taskFinishedTimeUpdateModel = TasksToDo::model()->updateByPk($task_id, array('finished'=>$finished_time));
				}
				else
				{
					$response_msg = "<br><span style='color:red'>Email not sent succesuflly to ".$send_to." Subject: ".$subject."</span>";
					$tasksCompleteModel = TasksToDo::model()->updateByPk($task_id, array('status'=>'error'));
				}
					
				return $response_msg;
				break;//end of case Email.
					
			case 'sms':
				//echo "<br>Send sms";
				$response = NotificationRules::model()->sendSMS($send_to, $msgbody);
				
				if($response == '1')
				{
					//echo "<br>Sent";
					$response_msg = "<br><span style='color:green'>SMS sent to ".$send_to."</span>";
					$tasksCompleteModel = TasksToDo::model()->updateByPk($task_id, array('status'=>'finished'));
					
					$finished_time = time();
					$taskFinishedTimeUpdateModel = TasksToDo::model()->updateByPk($task_id, array('finished'=>$finished_time));
				}
				else
				{
					//echo "<br>Not Sent";
					$response_msg = "<br><span style='color:red'>SMS not sent to ".$send_to." Error is: ".$response."</span>";
					$tasksCompleteModel = TasksToDo::model()->updateByPk($task_id, array('status'=>'error'));
				}
					
				return $response_msg;
				break;//end if case SMS.
		}//end of switch.
		
		
		
	}//end of listTasksToDo.
	
	
	
	
	public function clearOldNotification($notification_lifetime)
	{
				//*********** DELETING OLD FINISHED TASKS.
				//echo "<br>Task is finished";
			$tasksToDelete = TasksToDo::model()->FindAll();
				
				
			foreach ($tasksToDelete as $task)
			{
				$created_time = $task->created;
				if(!empty($created_time))
				{
					//echo "<br>Finished date = ".$created_time;
					$dEnd = time();
					$dStart = $created_time;
					
					//******** CALCULATING DIFF IN DAYS **********
					$date_diff = $dEnd - $dStart;
					$days = round($date_diff/(60 * 60 * 24));
					//echo "<br>Diff days = ".$days;
					//**** END OF CALCULATING DIFF IN DAYS *******
					
					if($days >= $notification_lifetime)
					{
						//echo "<br>Difference in more than 1. ID = ".$task_id;
						$taskDeleteModel=TasksToDo::model()->findByPk($task->id); 
						$taskDeleteModel->delete(); 
					}
					
				}//end of if (!empty($created_time)).
				
			}///END OF FOREACH 	

	}///end of function clearOldNotification($id)
	
	
	
	
	
}//end of class.