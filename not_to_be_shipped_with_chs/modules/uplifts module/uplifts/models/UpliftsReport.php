<?php

/**
 * This is the model class for table "uplifts_report".
 *
 * The followings are the available columns in table 'uplifts_report':
 * @property integer $id
 * @property integer $report_type
 
 * @property string $field_type
 * @property string $field_relation
 * @property string $field_label
 * @property integer $sort_order
 * @property integer $active
 */
class UpliftsReport extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return UpliftsReport the static model class
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
		return 'uplifts_report';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('report_type, sort_order, active', 'numerical', 'integerOnly'=>true),
			array(' field_type, field_relation, field_label', 'safe'),
			array(' field_type, field_relation, field_label', 'required'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, report_type, field_type, field_relation, field_label, sort_order, active', 'safe', 'on'=>'search'),
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
			'report_type' => 'Report Type',
			
			'field_type' => 'Field Type',
			'field_relation' => 'Field Relation',
			'field_label' => 'Field Label',
			'sort_order' => 'Sort Order',
			'active' => 'Active',
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
		$criteria->compare('report_type',$this->report_type);
		
		$criteria->compare('field_type',$this->field_type,true);
		$criteria->compare('field_relation',$this->field_relation,true);
		$criteria->compare('field_label',$this->field_label,true);
		$criteria->compare('sort_order',$this->sort_order);
		$criteria->compare('active',$this->active);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	
	public function getRelationsAndFieldsListByModelName($modelname)
	{
		//$modelname='Customer';
		$fieldslist=$this->getFieldsListByModelName($modelname);		
		
		$one_to_one_relationlist=$this->getOneToOneRelationListByModelName($modelname);
		
		$list_data= array_merge($fieldslist, $one_to_one_relationlist);
		//array_push($list_data,"");
		
		//$list_data=array_reverse($list_data);	
		return $list_data;
		
	}
	
	public function getFieldsListByModelName($modelname)
	{
		$table = Yii::app()->getDb()->getSchema()->getTable($modelname::model()->tableName());
		$fieldslist = $table->getColumnNames();
		return $fieldslist;
	}
	
	public function getOneToOneRelationListByModelName($modelname)
	{
		$relationslist=$modelname::model()->relations();
		
		$one_to_one_relationlist=array();
		
		foreach ($relationslist as $key=>$value)
		{
			
			/*STRUCTURE OF RELATION LIST
			authorisedByUser: Array[3]
								0: "CBelongsToRelation"	
								1: "User"
								2: "authorised_by"
								length: 3
								__proto__: Array[0]
			*/
			///We will only consider one to one relationship data
			//if (strcmp($value[0],"CBelongsToRelation")==0)///both strings are equal
			if ($value[0]=="CBelongsToRelation")///both strings are equal
			{
				array_push($one_to_one_relationlist,$key);
				////echo "SLEEEEEEEECETD DD";
			}
		}
		
		return $one_to_one_relationlist;
		
	}
	
	public function getNewModelNameBySelectedValueAndCurrentModelName($currentmodelname,$selectedvalue)
	{
		$relationslist=$currentmodelname::model()->relations();
		foreach ($relationslist as $key=>$value)
		{
			if ($key==$selectedvalue)
			{
				return $value[1];
				break;
			}
		}
	
	}//////public function getNewModelNameBySelectedValueAndCurrentModelName($currentmodelname,$selectedvalue)
	
	public function processDataForReports ($data,$type)
	{
		switch ($type) {
	
		case "TEXT":
					return $data;			
					 
		case "INTEGER":
					return $data;			
				 
		case "DATETIME":
					if (!empty($data))
					{
						return date("d-M-Y",$data);			
					}
					else
					{
						return "";
					}
					
		return $data;
		}///end of SWICTCH
	}/// end of 	public processDataForReports($data,$type)

	
	
	
}