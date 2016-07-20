<?php

/**
 * This is the model class for table "engineer_data".
 *
 * The followings are the available columns in table 'engineer_data':
 * @property integer $id
 * @property integer $engineer_id
 * @property string $data
 */
class Engineerdata extends CFormModel
{

	public $gm_id;
	public $product_serial_number_available;
	public $product_serial_number;
	public $product_serial_number_unavailable_reason;
	public $product_plating_image;
	public $product_plating_image_url;


	public $work_done;
	public $first_visit_date;
	public $job_completion_date;
	public $chat_message;

	public $spares_used;
	public $spare_part_number_or_name;
	public $spare_qty;
	public $spares_array;
	public $total_spares_entries;



	public function rules()
	{
		return array(
			array('gm_id, spares_used,work_done, product_serial_number_available, product_serial_number_unavailable_reason, product_serial_number', 'required'),
			array('product_serial_number', 'length', 'max' => 14, 'min' => 14, 'message' =>'Please enter exact 14 digits serial number'),
			array('gm_id, total_spares_entries, product_serial_number_available, product_serial_number, spares_used, spare_qty', 'numerical'),

			array('gm_id, total_spares_entries, product_plating_image_url, product_serial_number_unavailable_reason, work_done, first_visit_date, job_completion_date, chat_message, spare_part_number_or_name, spares_array', 'safe'),
		);
	}

	/**
	 * Declares attribute labels.
	 */
	public function attributeLabels()
	{
		return array(
			'gm_id'=>'Go Mobile Id',

			'product_serial_number_available' => 'Is Product Serial Number Available',
			'product_serial_number_unavailable_reason' => 'Please provide reasons',
			'product_serial_number' => 'Product Serial Number',
			'product_plating_image' => 'Product Plating Image',
			'product_plating_image_url' => 'Product Plating Image URL',

			'work_done' => 'Please state nature of fault and work carried out',

			'first_visit_date' => 'First Visit Date',
			'job_completion_date' => 'Job Completion date',
			'chat_message' => 'Reply to this Message',

			'spares_used' => 'Did you use any spares',
			'spare_part_number_or_name' => 'Part Number or Name',
			'spare_qty' => 'Quantity',
			'spares_array' => 'Spares',
			'total_spares_entries' => 'Total Spares Entires(How many entries in foreach)',

		);
	}

}
