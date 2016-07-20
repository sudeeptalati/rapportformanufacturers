<?php

/**
 * This is the model class for table "engineer_data".
 *
 * The followings are the available columns in table 'engineer_data':
 * @property integer $id
 * @property integer $engineer_id
 * @property string $data
 */
class Sparesusedbyengg extends CFormModel
{


    public $part_number_or_name;
    public $qty;
    public $price;



    public function rules()
    {
        return array(
            array('part_number_or_name, $qty,', 'required'),
            array('qty', 'numerical'),
            array('price, qty, part_number_or_name', 'safe'),
        );
    }

    /**
     * Declares attribute labels.
     */
    public function attributeLabels()
    {
        return array(

            'part_number_or_name' => 'Part Number/Name',
            'qty' => 'Qty',
            'price' => 'Price',

        );
    }

}
