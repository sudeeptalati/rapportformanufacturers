<?php

/**
 * This is the model class for table "oow".
 *
 * The followings are the available columns in table 'oow':
 * @property integer $id
 * @property string $serial_number
 * @property string $model_number
 * @property string $model_range
 * @property string $notes
 * @property string $created
 * @property string $modified
 * @property integer $createdby
 * @property integer $modifiedy
 */
class Oow extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Oow the static model class
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
		return 'oow';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('createdby, modifiedy', 'numerical', 'integerOnly'=>true),
			array('serial_number, model_number, model_range, notes, created, modified', 'safe'),
			array('serial_number','unique','message'=>'{attribute}:{value} already exists!'),
			array('serial_number', 'required'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, serial_number, model_number, model_range, notes, created, modified, createdby, modifiedy', 'safe', 'on'=>'search'),
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
			'createdByUser' => array(self::BELONGS_TO, 'User', 'createdby'),
			'modifiedByUser' => array(self::BELONGS_TO, 'User', 'modifiedy'),
			
		);
	}
	
	
	
	
	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'serial_number' => 'Serial Number',
			'model_number' => 'Model Number',
			'model_range' => 'Model Range',
			'notes' => 'Notes',
			'created' => 'Created',
			'modified' => 'Modified',
			'createdby' => 'Createdby',
			'modifiedy' => 'Modifiedy',
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
		$criteria->compare('serial_number',$this->serial_number,true);
		$criteria->compare('model_number',$this->model_number,true);
		$criteria->compare('model_range',$this->model_range,true);
		$criteria->compare('notes',$this->notes,true);
		$criteria->compare('created',$this->created,true);
		$criteria->compare('modified',$this->modified,true);
		$criteria->compare('createdby',$this->createdby);
		$criteria->compare('modifiedy',$this->modifiedy);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	
	protected function beforeSave()
    {
	
		$this->serial_number=Product::model()->processSerialNumber($this->serial_number);

    	if(parent::beforeSave())
        {
        	if($this->isNewRecord)  // Creating new record 
            {
        		$this->createdby=Yii::app()->user->id;
        		$this->created=time();
    			return true;
            }
            else
            {
            	$this->modifiedy=Yii::app()->user->id;
            	$this->modified=time();
            	
            	return true;
            }
        }//end of if(parent())
    }//end of beforeSave().
	
	
	
	
}