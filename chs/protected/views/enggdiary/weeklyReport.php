<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'enggdiary-weeklyReport-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>
	
	<?php 
		$engg_id=$_GET['engg_id'];
		//echo "Engg id :".$engg_id;
		$start_date=$_GET['start_date'];
		//echo "<hr>Week start date :".$start_date;
		$end_date=$_GET['end_date'];
		//echo "<hr>Week end date :".$end_date;
		
		$engineerModel=Engineer::model()->findByPk($engg_id);
		$str=$engineerModel->contactDetails->address_line_1." ".$engineerModel->contactDetails->address_line_3." ".$engineerModel->contactDetails->address_line_3;
		$address=$str."\n".$engineerModel->contactDetails->town."\n".$engineerModel->contactDetails->postcode_s." ".$engineerModel->contactDetails->postcode_e;
				
		$result=$model->weeklyReport($engg_id, $start_date, $end_date);
	
		//echo $result;
//		foreach($result as $data)
//		{
//			echo "<hr>".date('d-M-Y', $data->visit_start_date)."<br>";
//			echo $data->slots;
//		}
	?>
	
	<!-- *************** DISPLAYING ENGINEER DETAILS ******* -->
	
	<table>
		<tr>
			<td>
				<?php echo $form->labelEx($engineerModel,'fullname'); ?>
				<?php echo $form->textField($engineerModel,'fullname',array('disabled'=>'disabled')); ?>
			</td>
			<td>
				<?php echo "<b>Address</b><br>";?>
				<?php echo CHtml::textArea('',$address, array('rows'=>2, 'cols'=>20, 'disabled'=>'disabled'));?>
			</td>
		</tr>
		<tr>
			<td colspan="6" style="text-align:right">
			<h3>Appointments for the Week from <?php echo $start_date;?> to <?php echo $end_date;?></h3></td>
		</tr>
		<tr>
			<th style="color:maroon">Service Number</th>
			<th style="color:maroon">Visit Date</th>
			<th style="color:maroon">Customer Name</th>
			<th style="color:maroon">Postcode</th>
			<th style="color:maroon">Slots</th>
			<th style="color:maroon">Job Status</th>
		</tr>
		<?php 
			foreach ($result as $data)
			{
		
				$serviceModel=Servicecall::model()->findByPk($data->servicecall_id);
				?>
				<tr>
				<td><?php echo CHtml::link($serviceModel->service_reference_number, array('Servicecall/'.$serviceModel->id));?></td>
				<td><?php echo date('d-M-Y',$data->visit_start_date);?></td>
				<td><?php echo $serviceModel->customer->fullname;?></td>
				<td><?php echo $serviceModel->customer->postcode_s." ".$serviceModel->customer->postcode_e;?></td>
				<td><?php echo $data->slots;?></td>
				<td><?php echo $data->servicecall->jobStatus->name;?></td>
				</tr>
		<?php 	} ?>
		
	
	</table>

<?php $this->endWidget(); ?>

</div><!-- form -->