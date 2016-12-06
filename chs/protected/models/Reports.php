<?php

class Reports extends CFormModel 
{

	
	/**
	 * Returns the static model of the specified AR class.
	 * @return Product the static model class
	 */
	
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	
	
	
	public function enggProductReport($engg_id)
    {
    	//echo "<br>Engg id in prod method = ".$engg_id;
    	
    	if($engg_id == '0')
    	{
    		// or using: $rawData=Yii::app()->db->createCommand('SELECT * FROM tbl_user')->queryAll();
			$allProdData=Product::model()->findAll();
			$prodDataProvider=new CArrayDataProvider($allProdData);
			return $prodDataProvider;
			
    	}//end of if, returnd all prods.
    	else 
    	{
    	
	    	$criteria=new CDbCriteria();
			$criteria->condition = 'engineer_id='.$engg_id;
	//		$criteria->addCondition('fault_date BETWEEN :from_date AND :to_date');
	//		$criteria->params = array(
	//		  ':from_date' => $from_date,
	//		  ':to_date' => $to_date,
	//		);
			return new CActiveDataProvider(Product::model(),
						 array(
	    					'criteria' => $criteria
					));
    	}//end of else, returns selected engg's prods.
    	
    }//end of enggProductReport($engg_id).

}//end of class.
?>