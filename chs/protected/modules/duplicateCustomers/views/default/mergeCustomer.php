<div class="form">
 
<?php $form=$this->beginWidget('CActiveForm', array(
        'id'=>'form-id',
        'action' => Yii::app()->createUrl('/duplicateCustomers/default/performMerge', array('primary_id'=>$primary_id, 'secondary_id'=>$secondary_id)),  
      
)); ?>

<?php

//echo "<br>In Merge customer view";

echo "<br>Primary id = ".$primary_id;
$primaryCustModel = DuplicateCustomer::model()->findByPk($primary_id);
echo "<br>primary prod id = ".$primaryCustModel->product_id;
echo "<hr>Secondary id = ".$secondary_id;
$secondaryCustModel = DuplicateCustomer::model()->findByPk($secondary_id);
echo "<br>Secondary prod id = ".$secondaryCustModel->product_id;

echo "<hr>Primary cust details:<br>";

?>


<table>

<tr>
	<th>First Name</th>
	<th>Last Name</th>
	<th>Address 1</th>
	<th>Address 2</th>
	<th>Address 3</th>
	<th>Town</th>
	<th>Country</th>
	<th>Postcode</th>
	<th>Telephone</th>
	<th>Mobile</th>
	<th>E-mail</th>
	<th>Date of purchase</th>
	<th>Model No</th>
	<th>Serial No</th>
</tr>

<tr>
	<td><?php echo $primaryCustModel->first_name; ?></td>
	<td><?php echo $primaryCustModel->last_name; ?></td>
	<td><?php echo $primaryCustModel->address_line_1; ?></td>
	<td><?php echo $primaryCustModel->address_line_2; ?></td>
	<td><?php echo $primaryCustModel->address_line_3; ?></td>
	<td><?php echo $primaryCustModel->town; ?></td>
	<td><?php echo $primaryCustModel->country; ?></td>
	<td><?php echo $primaryCustModel->postcode; ?></td>
	<td><?php echo $primaryCustModel->telephone; ?></td>
	<td><?php echo $primaryCustModel->mobile; ?></td>
	<td><?php echo $primaryCustModel->email; ?></td>
	<td><?php echo date('d-M-y', $primaryCustModel->product->purchase_date); ?></td>
	<td><?php echo $primaryCustModel->product->model_number; ?></td>
	<td><?php echo $primaryCustModel->product->serial_number; ?></td>
	
</tr>

<tr></tr>

<tr>
	<td><?php echo $secondaryCustModel->first_name; ?></td>
	<td><?php echo $secondaryCustModel->last_name; ?></td>
	<td><?php echo $secondaryCustModel->address_line_1; ?></td>
	<td><?php echo $secondaryCustModel->address_line_2; ?></td>
	<td><?php echo $secondaryCustModel->address_line_3; ?></td>
	<td><?php echo $secondaryCustModel->town; ?></td>
	<td><?php echo $secondaryCustModel->country; ?></td>
	<td><?php echo $secondaryCustModel->postcode; ?></td>
	<td><?php echo $secondaryCustModel->telephone; ?></td>
	<td><?php echo $secondaryCustModel->mobile; ?></td>
	<td><?php echo $secondaryCustModel->email; ?></td>
	<td><?php echo date('d-M-y', $secondaryCustModel->product->purchase_date); ?></td>
	<td><?php echo $secondaryCustModel->product->model_number; ?></td>
	<td><?php echo $secondaryCustModel->product->serial_number; ?></td>
	
</tr>


</table>


 <div class="row submit">
        <?php echo CHtml::submitButton('Merge'); ?>
    </div>
 
<?php $this->endWidget(); ?>
</div><!-- form -->