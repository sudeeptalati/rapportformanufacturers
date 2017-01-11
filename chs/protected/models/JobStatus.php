<?php

/**
 * This is the model class for table "job_status".
 *
 * The followings are the available columns in table 'job_status':
 * @property integer $id
 * @property string $name
 * @property string $information
 * @property integer $published
 * @property integer $view_order
 * @property integer $updated_by_user_id
 * @property string $updated
 * @property integer $dashboard_display
 * @property integer $dropdown_display
 * @property string $html_name
 * @property string $backgroundcolor
 * @property string $keyword
 * The followings are the available model relations:
 * @property User $updatedByUser
 * @property Servicecall[] $servicecalls
 */
class JobStatus extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return JobStatus the static model class
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
		return 'job_status';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(

            array('name, published, view_order', 'required'),

            array('keyword', 'unique'),
			array('published, view_order, updated_by_user_id', 'numerical', 'integerOnly'=>true),
			array('keyword, dashboard_display,information, updated, html_name, backgroundcolor', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, name, information, published, view_order, updated_by_user_id, updated, dashboard_display', 'safe', 'on'=>'search'),
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
			'updatedByUser' => array(self::BELONGS_TO, 'User', 'updated_by_user_id'),
			'servicecalls' => array(self::HAS_MANY, 'Servicecall', 'job_status_id'),
			'notificationRulesRelation' => array(self::HAS_MANY, 'NotificationRules', 'job_status_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'name' => 'Status Name',
			'information' => 'Information',
			'published' => 'Published',
			'view_order' => 'View Order',
			'updated_by_user_id' => 'Updated By User',
			'updated' => 'Last Changed',
			'dashboard_display' => 'Display on Dashboard',
			'dropdown_display' => 'Display in Dropdown',
			'html_name' => 'Color on Dashboard',
            'backgroundcolor' => 'Background Color Dashboard',
            'keyword' => 'Keyword',



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
		$criteria->compare('name',$this->name,true);
		$criteria->compare('information',$this->information,true);
		$criteria->compare('published',$this->published);
		$criteria->compare('view_order',$this->view_order);
		$criteria->compare('updated_by_user_id',$this->updated_by_user_id);
		$criteria->compare('updated',$this->updated,true);
		$criteria->compare('dashboard_display',$this->dashboard_display,true);
		$criteria->compare('dropdown_display',$this->dropdown_display,true);
		$criteria->compare('html_name',$this->html_name,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			//'order'=>'view_order ASC',
			
		));
	}
	
	
	
	public function publishedStatus()
	{
		return JobStatus::model()->findAllByAttributes(array('published'=>1 ));/*WE will only display the published Status*/
	}
	
	
	
	//************ FUNCTION TO CREATE DROPDOWN FILTER WITH ONLY PUBLISHED STATUS IN ADMIN VIEW ****************
	
	
	private static $_published_items=array();
	
	/**
	 * Returns the items for the specified type.
	 * @param string item type (e.g. 'PostStatus').
	 * @return array item names indexed by item code. The items are order by their position values.
	 * An empty array is returned if the item type does not exist.
	 */
	public static function published_items($type)
	{
		if(!isset(self::$_published_items[$type]))
			self::published_loadItems($type);
		return self::$_published_items[$type];
	}

	/**
	 * Returns the item name for the specified type and code.
	 * @param string the item type (e.g. 'PostStatus').
	 * @param integer the item code (corresponding to the 'code' column value)
	 * @return string the item name for the specified the code. False is returned if the item type or code does not exist.
	 */
	public static function published_item($type,$code)
	{
		if(!isset(self::$_published_items[$type]))
			self::published_loadItems($type);
		return isset(self::$_published_items[$type][$code]) ? self::$_published_items[$type][$code] : false;
	}

	/**
	 * Loads the lookup items for the specified type from the database.
	 * @param string the item type
	 */
	private static function published_loadItems($type)
	{
		self::$_published_items[$type]=array();
		$models=self::model()->findAll(array(
			'condition'=>'published=1',
			'order'=>'view_order ASC',
		));
		foreach($models as $model)
			self::$_published_items[$type][$model->id]=$model->name;
	}



	
	//************ END OF FUNCTION TO CREATE DROPDOWN FILTER IN ADMIN VIEW ****************
	
	//************ FUNCTION TO CREATE DROPDOWN FILTER WITH  IN ADMIN VIEW, WITH ALL STATTUS FOR NOTIFICATION ADMIN ****************
	
	private static $_items=array();
	
	/**
	 * Returns the items for the specified type.
	 * @param string item type (e.g. 'PostStatus').
	 * @return array item names indexed by item code. The items are order by their position values.
	 * An empty array is returned if the item type does not exist.
	*/
	
	public static function items($type)
	{
		if(!isset(self::$_items[$type]))
			self::loadItems($type);
		return self::$_items[$type];
	}
	
	/**
	 * Returns the item name for the specified type and code.
	 * @param string the item type (e.g. 'PostStatus').
	 * @param integer the item code (corresponding to the 'code' column value)
	 * @return string the item name for the specified the code. False is returned if the item type or code does not exist.
	 */
	public static function item($type,$code)
	{
		if(!isset(self::$_items[$type]))
			self::loadItems($type);
		return isset(self::$_items[$type][$code]) ? self::$_items[$type][$code] : false;
	}
	
	/**
	 * Loads the lookup items for the specified type from the database.
	 * @param string the item type
	 */
	private static function loadItems($type)
	{
		self::$_items[$type]=array();
		$models=self::model()->findAll(array(
				//'condition'=>'published=1',
				'order'=>'view_order ASC',
		));
		foreach($models as $model)
			self::$_items[$type][$model->id]=$model->name;
	}
	
	//************ FUNCTION TO CREATE DROPDOWN FILTER WITH IN ADMIN VIEW ****************
	
	
	protected function beforeSave()
    {
    	if(parent::beforeSave())
        {
        	$this->updated=time();

			$this->html_name='<div style="padding: 5px 5px 5px 30px; border-radius: 10px;background:'.$this->backgroundcolor.'" >'.$this->name.'</div>';
			//Using class did'nt worked as css are loaded later
			//$this->html_name='<div class="system_message" >'.$this->name.'</div>';


			return true;
            
        }//end of if(parent())
    }//end of beforeSave().
    
    public function getAllStatuses()
    {
    	//echo "<br>Func called<hr>";
		$job_status_array = array();
    	
//     	$job_status_array = CHtml::listData(JobStatus::model()->findAll(array
//     	('condition'=> "not exists (select 'id' from notification_rules where notification_rules.job_status_id = t.id)")
//     	), 'id','name');

		//print_r($final_array);
    	
    	//return $job_status_array;
		
		return CHtml::listData(JobStatus::model()->findAll(), 'id', 'name');
    	  
    }//end of getAllStatuses.
    
	public function getAllPublishedListdata($type='name')
    {
    	$publishedStatus=JobStatus::model()->findAll(array(
    					'condition'=>'published=1',
    					'order'=>'view_order ASC',
    				)
    	);
    	//$publishedStatus = JobStatus::model()->findAllByAttributes(array('published'=>1 ));
    	return CHtml::listData($publishedStatus, 'id', $type);

    }//end of getAllPublishedListdata.



    public function get_status_id_by_keyword($keyword)
    {

        $model = $this->findByAttributes(array('keyword' => $keyword));
        if ($model)
            return $model->id;
        else
            return null;

    }////end of public function getstatusidbyname($keyword)





}//end of class.