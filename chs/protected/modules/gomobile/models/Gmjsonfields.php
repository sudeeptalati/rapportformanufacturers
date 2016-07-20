<?php

/**
 * This is the model class for table "gm_json_fields".
 *
 * The followings are the available columns in table 'gm_json_fields':
 * @property integer $id
 * @property string $field_type
 * @property string $field_relation
 * @property string $field_label
 * @property integer $sort_order
 * @property integer $active
 * @property integer $created
 */
class Gmjsonfields extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'gm_json_fields';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('sort_order, active, created', 'numerical', 'integerOnly'=>true),
			array('field_type, field_relation, field_label', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, field_type, field_relation, field_label, sort_order, active, created', 'safe', 'on'=>'search'),
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
			'field_type' => 'Field Type',
			'field_relation' => 'Field Relation',
			'field_label' => 'Field Label',
			'sort_order' => 'Sort Order',
			'active' => 'Active',
			'created' => 'Created',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('field_type',$this->field_type,true);
		$criteria->compare('field_relation',$this->field_relation,true);
		$criteria->compare('field_label',$this->field_label,true);
		$criteria->compare('sort_order',$this->sort_order);
		$criteria->compare('active',$this->active);
		$criteria->compare('created',$this->created);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return GmJsonFields the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	
	 
	
	
	public function getRelationsAndFieldsListByModelName($modelname)
	{
		//$modelname='Customer';
		$fieldslist=$this->getFieldsListByModelName($modelname);		
		
		$one_to_one_relationlist=$this->getOneToOneRelationListByModelName($modelname);
 
		
		$list_data= array_merge( $fieldslist,$one_to_one_relationlist);
		//array_push($list_data,"");
		
		
	 
		//$list_data=array_reverse($list_data);	
		return $list_data;
		
	}
	
	public function getFieldsListByModelName($modelname)
	{
		$table = Yii::app()->getDb()->getSchema()->getTable($modelname::model()->tableName());
		$fieldslist = $table->getColumnNames();
		
		$fieldlist_withoutids=array();
		$fieldlist_with_only_ids=array();		
		
		foreach ($fieldslist as $f)
		{
			if (strpos($f,'_id') !== false) ///here we eliminate all fields with _id
			{ 
				array_push($fieldlist_with_only_ids, $f);
			}else
			{
				///if (strcmp($f, 'id') !== 0)///here we will eliminate id too
					array_push($fieldlist_withoutids, $f);
			}
			
		}
		
		return $fieldlist_withoutids;
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

	
	protected function beforeSave()
    {
    	if(parent::beforeSave())
        {
        	if($this->isNewRecord)  // Creating new record 
            {
        		$this->created=time();
    			return true;
            }
        }//end of if(parent())
    }//end of beforeSave().
	
	
		 
	public function processDataFormat ($data,$type)
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
