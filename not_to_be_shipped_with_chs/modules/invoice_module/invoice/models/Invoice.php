<?php

/**
 * This is the model class for table "invoice".
 *
 * The followings are the available columns in table 'invoice':
 * @property integer $id
 * @property integer $servicecall_id
 * @property double $labour_cost
 * @property double $shipping_handling_cost
 * @property double $sub_total
 * @property double $vat
 * @property double $grand_total_ex_vat
 * @property double $grand_total_in_vat
 * @property string $created
 * @property integer $created_by
 * @property string $modified
 * @property integer $modified_by
 */
class Invoice extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Invoice the static model class
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
		return 'invoice';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('servicecall_id, created_by, modified_by', 'numerical', 'integerOnly'=>true),
			array('labour_cost, shipping_handling_cost, sub_total, vat, grand_total_ex_vat, grand_total_in_vat', 'numerical'),
			array('created, modified', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, servicecall_id, labour_cost, shipping_handling_cost, sub_total, vat, grand_total_ex_vat, grand_total_in_vat, created, created_by, modified, modified_by', 'safe', 'on'=>'search'),
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
			'servicecall_id' => 'Servicecall',
			'labour_cost' => 'Labour Cost',
			'shipping_handling_cost' => 'Shipping Handling Cost',
			'sub_total' => 'Sub Total',
			'vat' => 'Vat',
			'grand_total_ex_vat' => 'Grand Total Ex Vat',
			'grand_total_in_vat' => 'Grand Total In Vat',
			'created' => 'Created',
			'created_by' => 'Created By',
			'modified' => 'Modified',
			'modified_by' => 'Modified By',
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
		$criteria->compare('servicecall_id',$this->servicecall_id);
		$criteria->compare('labour_cost',$this->labour_cost);
		$criteria->compare('shipping_handling_cost',$this->shipping_handling_cost);
		$criteria->compare('sub_total',$this->sub_total);
		$criteria->compare('vat',$this->vat);
		$criteria->compare('grand_total_ex_vat',$this->grand_total_ex_vat);
		$criteria->compare('grand_total_in_vat',$this->grand_total_in_vat);
		$criteria->compare('created',$this->created,true);
		$criteria->compare('created_by',$this->created_by);
		$criteria->compare('modified',$this->modified,true);
		$criteria->compare('modified_by',$this->modified_by);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}