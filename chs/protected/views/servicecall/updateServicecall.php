<?php


?>

<style type="text/css">
	td
	{

		vertical-align:top;
	}
</style>
<div class="form">


	<?php $form=$this->beginWidget('CActiveForm', array(
		'id'=>'servicecall-updateServicecall-form',
		'enableAjaxValidation'=>false,
		//'focus'=>array($model,'spares_used_status_id'),
	)); ?>

	<script>
		$(document).ready(function(){
			var droplist = $('#spares-dropdown-id');
			if(droplist.val()== '1')
				$('#freesearch-Form').show();

			droplist.change(function(e){
				if (droplist.val() == '1') {
					$('#freesearch-Form').show();
				}
				else {
					$('#freesearch-Form').hide();
				}
			});
		});
	</script>

	<script type="text/javascript">
		function my_change(id)
		{
			if(id > 100)
			{
				alert("This status will close the call and it won't be editable afterwards.");
			}
		}

	</script>


	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<?php
	$service_id=$_GET['id'];
	//echo "STR TO TIME :".strtotime($model->job_payment_date)."<br>";
	//echo "CONVERTED DATE FROM STR TO TIME :".date('d-M-y', strtotime($model->job_payment_date));
	//echo "SERVICE ID FROM URL :".$service_id;
	//echo "ID FROM MODEL :".$model->id;
	$customerModel=Customer::model()->findByPk($model->customer_id);
	$productModel=Product::model()->findByPk($model->product_id);
	$brandModel=Brand::model()->findByPk($productModel->brand_id);
	$productTypeModel=ProductType::model()->findByPk($productModel->product_type_id);
	$contractModel=Contract::model()->findByPk($model->contract_id);
	$contractName=$contractModel->name;
	$contractTypeModel=ContractType::model()->findByPk($contractModel->contract_type_id);
	$engineerModel=Engineer::model()->findByPk($model->engineer_id);
	$engineerName=$engineerModel->fullname;
	$engineerCompanyName=$engineerModel->company;

	$enggDiaryModel=Enggdiary::model()->findByPk($model->engg_diary_id);

	//address of customer.
	$str1=$customerModel->address_line_1." ".$customerModel->address_line_2." ".$customerModel->address_line_3."\n";
	$str2=$customerModel->town."\n";
	$str3=$customerModel->postcode;
	$address=$str1." ".$str2." ".$str3;

	//CALCULATING VALID UNTILL.

	$php_warranty_date=$productModel->warranty_date;
	$php_waranty_months=$productModel->warranty_for_months;

	$res='';
	if (!empty($php_warranty_date))
	{
		$warranty_until= strtotime(date("Y-M-d", $php_warranty_date) . " +".$php_waranty_months." month");
		$res=date('d-M-Y', $warranty_until);
		//echo $res;
	}
	//echo $res;

	?>

	<!-- ************ Servicecall DEATILS******** -->

	<div class="row">
		<table>
			<tr><td colspan='2' style="text-align:center"><h1>Service Call Details</h1></td>
			</tr>

			<tr>


				<td style="vertical-align:top;"><b>Job Status : </b>
					<span style="color:maroon"><?php echo $model->jobStatus->name;?></span>

					<br>


					<?php
				
						$result=$model->updateStatus();
						$list=CHtml::listData($result, 'id','name');
						echo $form->dropDownList($model, 'job_status_id', $list, array('onchange'=>'js:my_change(this.value)')
//												array(
//													'ajax' => array(
//													'type'=>'POST', //request type
//													'url'=>CController::createUrl('setup/testConnection'), //url to call.
//												))

						);
						echo $form->error($model,'job_status_id');
					
					




					?>
				</td>
				<td>

					<b>Service Ref. No.#</b> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <?php echo CHtml::submitButton('Modify'); ?>
					<h2 style="color:green;"><?php echo $model->service_reference_number;?></h2>

				</td>



			</tr>

			<tr><td colspan="2">
					<?php echo $form->labelEx($model,'comments'); ?><small>(not visible on call sheet)</small><br>
					<?php echo $form->textArea($model,'comments',array('rows'=>8, 'cols'=>120, 'value'=>'')); ?>
					<?php echo $form->error($model,'comments'); ?>
					<div style="width:70%;">
					<?php echo Setup::model()->printjsonnotesorcommentsinhtml($model->comments); ?>
					</div>

				</td>
			</tr>


			<tr>
				<td>
					<h2>Customer Details</h2>
					<small><?php echo CHtml::link('Edit Details',array('Customer/openDialog','customer_id'=>$customerModel->id, 'product_id'=>$productModel->id),array("target"=>"_blank"));?></small>
				</td>
				<td>
					<h2>Product Details</h2>
					<small><?php echo CHtml::link('Edit Details',array('Product/updateProduct','id'=>$productModel->id),array("target"=>"_blank"));?></small>
				</td>
			</tr>

			<!-- *********** DISPLAYING CUSTOMER DETAILS ********* -->

			<tr>
				<td>
					<?php echo $form->labelEx($customerModel,'fullname'); ?>
					<?php echo $form->textField($customerModel,'fullname', array('disabled'=>'disabled')); ?>
					<?php echo $form->error($customerModel,'fullname'); ?>

					<?php echo "<br><b>Address</b><br>" ,
					CHtml::textArea('Address', $address,  array('rows'=>4, 'cols'=>40,'disabled'=>'disabled')); ?>

					<?php echo $form->labelEx($customerModel,'telephone'); ?>
					<?php echo $form->textField($customerModel,'telephone',array('disabled'=>'disabled')),"<br>"; ?>
					<?php echo $form->textField($customerModel,'mobile',array('disabled'=>'disabled')); ?>

					<?php echo $form->labelEx($customerModel,'email'); ?>
					<?php echo $form->textField($customerModel,'email',array('disabled'=>'disabled')); ?>

					<?php echo $form->labelEx($customerModel,'notes'); ?>
					<?php echo $form->textArea($customerModel,'notes',array('disabled'=>'disabled', 'rows'=>4, 'cols'=>40)); ?>
				</td>

				<!-- *********** DISPLAYING PRODUCT DEATILS ********** -->
				<td>
					<table>
						<tr>
							<td>
								<?php echo $form->labelEx($brandModel,'name'); ?>
								<?php echo $form->textField($brandModel,'name', array('disabled'=>'disabled')); ?>

								<?php echo $form->labelEx($productTypeModel,'name'); ?>
								<?php echo $form->textField($productTypeModel,'name', array('disabled'=>'disabled')); ?>

								<?php echo $form->labelEx($productModel,'model_number'); ?>
								<?php echo $form->textField($productModel,'model_number',array('disabled'=>'disabled')); ?>

								<?php echo $form->labelEx($productModel,'serial_number'); ?>
								<?php echo $form->textField($productModel,'serial_number',array('disabled'=>'disabled')); ?>

								<?php echo $form->labelEx($productModel,'enr_number'); ?>
								<?php echo $form->textField($productModel,'enr_number',array('disabled'=>'disabled')); ?>

							</td>
							<td>

								<?php echo $form->labelEx($productModel,'purchased_from'); ?>
								<?php echo $form->textField($productModel,'purchased_from', array('disabled'=>'disabled')); ?>

								<?php	$viewPurchaseDate='';
								if (!empty($productModel->purchase_date))
								{
									$viewPurchaseDate=date('d-M-y', $productModel->purchase_date);
								}
								?>
								<?php echo $form->labelEx($productModel,'purchase_date'); ?>
								<?php echo CHtml::textField('',$viewPurchaseDate,  array('disabled'=>'disabled')); ?>
								<?php //echo $form->textField($productModel,'purchase_date', array('disabled'=>'disabled')); ?>

								<?php	$viewWarrantyDate='';
								if (!empty($productModel->warranty_date))
								{
									$viewWarrantyDate=date('d-M-y', $productModel->warranty_date);
								}
								?>
								<?php echo $form->labelEx($productModel,'warranty_date'); ?>
								<?php echo CHtml::textField('',$viewWarrantyDate,  array('disabled'=>'disabled')); ?>
								<?php //echo $form->textField($productModel,'warranty_date',array('disabled'=>'disabled')); ?>

								<?php echo $form->labelEx($productModel,'warranty_until'); ?>
								<?php
								echo CHtml::textField('Warranty Date',$res,  array('disabled'=>'disabled'));
								?>

								<?php echo $form->labelEx($productModel,'fnr_number'); ?>
								<?php echo $form->textField($productModel,'fnr_number',array('disabled'=>'disabled')); ?>

							</td>
						</tr>
						<tr>
							<td>
								<?php
								$product_discontinued = '';
								if($productModel->discontinued == 1)
									$product_discontinued = 'Yes';
								else
									$product_discontinued = 'No';
								?>
								<?php echo $form->labelEx($productModel,'discontinued'); ?>
								<?php echo CHtml::textField('', $product_discontinued, array('disabled'=>'disabled'));?>
								<?php echo $form->error($productModel,'discontinued'); ?>
							</td>
							<td colspan="2">
								<?php echo $form->labelEx($productModel,'notes'); ?>
								<?php echo $form->textArea($productModel,'notes',array('disabled'=>'disabled', 'rows'=>4, 'cols'=>20)); ?>
							</td>
						</tr>
					</table><!-- end of product table -->
				</td>
			</tr>


			<tr><td colspan="2" style="text-align:center">
					<h3>Previous Service Calls </h3>
				</td></tr>
			<tr><td colspan="2" style="text-align:center">
					<table><tr>
							<th>Service Ref#</th>
							<th>Product</th>
							<th>Reported Date</th>
							<th>Fault Description</th>
							<th>Engineer Visited</th>
							<th>Visit Date</th>
							<th>Job Status</th>
						</tr>
						<?php $previousCall = $model->previousCall($model->customer_id);
						foreach ($previousCall as $data)
						{
							if ($data->service_reference_number!=$model->service_reference_number)//////since we want to skip the current service call
							{
								$enggdiaryModel=Enggdiary::model()->findByPk($data->engg_diary_id);
								?>
								<tr>
									<td><?php echo CHtml::link($data->service_reference_number, array('view', 'id'=>$data->id));?></td>
									<td><?php echo "<b>".$data->product->productType->name."<b>";?></td>
									<td><?php
										if(!empty($data->fault_date))
											echo date('d-M-Y', $data->fault_date);
										?>
									</td>
									<td><?php echo $data->fault_description;?></td>
									<td><?php echo $data->engineer->fullname;?></td>
									<td><?php
										if(!empty($enggdiaryModel->visit_start_date))
											echo date('d-M-Y',$enggdiaryModel->visit_start_date);?>
									</td>
									<td style="color:maroon"><?php echo $data->jobStatus->name;?></td>
								</tr>
								<?php

							}////end of if
						}//end of foreach().?>
					</table>
				</td>
			</tr>


			<tr><td colspan='2' style="text-align:center; background:#C7FAFF; border-radius:15px;">
					<?php
					//$uplift=Uplifts::model()->findByAttributes(array('servicecall_id'=>$model->id));
					$uplift=Uplifts::model()->findByAttributes(array('customer_id'=>$model->customer->id));
					echo "<h3>Previous Uplifts </h3>";
					if ($uplift)
					{
						echo '<hr>';
						echo CHtml::link($uplift->uplift_number,array('uplifts/manage/view','id'=>$uplift->id));
						echo "<br><b>Serial Number: </b>".$uplift->serial_number;
						echo "<br>".$uplift->reason_for_uplift;
						echo "<br><br>";
					}
					?>
				</td></tr>





			<tr><td colspan="2" style="text-align:center">
					<h2>Servicecall Details</h2>
				</td>
			</tr>
			<tr><td>
					<?php echo $form->labelEx($model,'fault_date');?>
					<?php
					//echo $model->fault_date;

					if ($model->fault_date!='')
					{
						$fault_date=date('d-M-Y',$model->fault_date);
						//$fault_date = $model->fault_date;
					}
					else
					{
						$fault_date='';
					}


					$this->widget('zii.widgets.jui.CJuiDatePicker', array(
						'name'=>CHtml::activeName($model, 'fault_date'),
						'model'=>$model,
						'value' => $fault_date,

						'options'=>array(
							'showAnim'=>'fold',
							'dateFormat' => 'd-M-y',
						),
						'htmlOptions'=>array(
							'style'=>'height:20px;'
						),
					));



					?>
					<?php //echo $form->textField($model,'fault_date'); ?>
					<?php echo $form->error($model,'fault_date'); ?>

					<?php echo $form->labelEx($model,'fault_code'); ?>
					<?php echo $form->textField($model,'fault_code'); ?>
					<?php echo $form->error($model,'fault_code'); ?>

					<?php echo $form->labelEx($model,'fault_description'); ?>
					<?php echo $form->textArea($model,'fault_description',array('rows'=>4, 'cols'=>40)); ?>
					<?php echo $form->error($model,'fault_description'); ?>
				</td>
				<td>

					<?php
					$viewVisitStartDate='';
					if(!empty($enggDiaryModel->visit_start_date))
					{
						//$enggDiaryModel->visit_start_date= date('d-M-y', $enggDiaryModel->visit_start_date);
						$viewVisitStartDate=date('d-M-Y', $enggDiaryModel->visit_start_date);
					}
					?>

					<?php echo "<b>Current Appointment</b><br>";?>
					<?php //echo $form->textField($enggDiaryModel,'visit_start_date', array('disabled'=>'disabled')); ?>
					<?php echo CHtml::textField('',$viewVisitStartDate,array('disabled'=>'disabled')); ?>
					<?php //echo $form->error($enggDiaryModel,'visit_start_date'); ?>

					<!-- ******* code for image link to change appointment ******* -->
					<?php
					$imgurl = Yii::app()->request->baseUrl.'/images/engineer_diary.gif';
					$imghtml = CHtml::image($imgurl,'Engineer Appointment',array('width'=>25, 'height'=>25, 'title'=>'Engineer Appointment' ));
					//echo CHtml::link($imghtml, array('Enggdiary/iCalLink','id'=>$model->id));
					?>
					<!-- ****************** end of code. ******************** -->

					<?php echo $form->labelEx($model,'engineer_id'); ?>

					<?php echo $form->textField($engineerModel, 'company', array('disabled'=>'disabled'));?>
					<?php echo $form->error($model,'engineer_id'); ?>
					<?php echo CHtml::link('Change Engineer', array('servicecall/changeengineeronly/', 'id'=>$model->id));
					?>
					<br>
					<?php if(empty($model->engg_diary_id))
					{
						echo CHtml::link($imghtml, array('enggdiary/create/', 'id'=>$model->id, 'engineer_id'=>$model->engineer_id));
						echo CHtml::link('Create Appointment', array('enggdiary/bookingAppointment/', 'id'=>$model->id, 'engineer_id'=>$model->engineer_id));
						echo "<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";

					}
					else
					{
						echo CHtml::link($imghtml, array('enggdiary/changeAppointment/', 'service_id'=>$model->id, 'engineer_id'=>$model->engineer_id, 'enggdiary_id'=>$model->engg_diary_id));
						//echo CHtml::link('Change Engineer or Appointment', array('enggdiary/changeAppointment/', 'serviceId'=>$model->id, 'engineerId'=>$model->engineer_id, 'enggdiary_id'=>$model->engg_diary_id));
						echo CHtml::link('Change Appointment', array('enggdiary/viewFullDiary/', 'engg_id'=>$model->engineer_id));
						//echo CHtml::link('Change Appointment', array('enggdiary/bookingAppointment/', 'id'=>$model->id, 'engineer_id'=>$model->engineer_id));
						echo "<br>";
						echo CHtml::link('Book Appointment for another visit', array('enggdiary/bookingAppointment/', 'id'=>$model->id, 'engineer_id'=>$model->engineer_id));
					}
					?>


					<?php //echo CHtml::link('Change the Engineer or Appointment', array('enggdiary/changeAppointment/', 'serviceId'=>$model->id, 'engineerId'=>$model->engineer_id, 'enggdiary_id'=>$model->engg_diary_id)); ?>

					<?php echo $form->labelEx($model,'insurer_reference_number'); ?>
					<?php echo $form->textField($model,'insurer_reference_number'); ?>
					<?php echo $form->error($model,'insurer_reference_number'); ?>

					<?php $model->contract_id=$productModel->contract->id; ?>
					<?php echo $form->labelEx($model,'contract_id'); ?>
					<?php echo CHtml::activeDropDownList($model,'contract_id', $model->getAllContract()); ?>
					<?php echo $form->error($model,'contract_id'); ?>








				</td>
			</tr>


			<tr><td colspan="2" style="text-align:center">
					<h2>Further Details</h2>
				</td>
			</tr>
			<tr>

				<td>

					<hr>
					<table style="margin:-5px;" id="spares_details"><tr>
							<td ><?php echo $form->labelEx($model,'spares_used_status_id'); ?>
							</td>
							<td style="text-align:left; "><?php //$model->spares_used_status_id='';?>
								<?php
								echo $form->dropDownList($model, 'spares_used_status_id', array('0'=>'No','1'=>'Yes'),
									array('id'=> 'spares-dropdown-id')
								);
								?>
								<?php echo $form->error($model,'spares_used_status_id'); ?><br>
							</td>
							<td width="55%" style="text-align:right;  ">
								<?php
								if($model->spares_used_status_id == 1)
									echo CHtml::link('Print Spares Order',array('sparesUsed/GenerateSparesOrderFormPdf', 'service_id'=>$model->id), array('target'=>'_blank'));
								?>
							</td>
						</tr></table>


					<!-- ****** CODE TO DISPLAY SPARES ALREADY USED *********** -->
					<?php
					//if($model->spares_used_status_id == 1)
					if(  1)
					{
						//echo "Spares used :<br>";
						$sparesModel = SparesUsed::model()->findAllByAttributes(array('servicecall_id'=> $model->id));
						?>

						<table>
							<tr>
								<th>Part Number</th>
								<th>Item Name</th>
								<th>Qty</th>
								<th>Price</th>
								<th>Date Ordered</th>
								<th>Date Ordered Poland</th>
								<th>Date Posted</th>
								<th style="color:maroon; ">Action</th>

							</tr>
							<?php

							$calculated_price=0;
							foreach ($sparesModel as $data)
							{

								$spares_id=$data->id;
								?>
								<tr>
									<td width="35%"><?php echo $data->part_number;?></td>
									<td width="35%"><?php echo $data->item_name;?></td>
									<td><?php echo $data->quantity."<br>";?></td>
									<td><?php echo $data->unit_price."<br>";?></td>

									<td>
										<?php
										if(!empty($data->date_ordered))
										{
											echo date('d-M-Y', $data->date_ordered);
										}
										?>
									</td>

									<td>
										<?php
										if(!empty($data->date_ordered_from_manufacturer))
										{
											echo date('d-M-Y', $data->date_ordered_from_manufacturer);
										}
										?>
									</td>
									<td>
										<?php
										if(!empty($data->date_posted))
										{
											echo date('d-M-Y', $data->date_posted);
										}
										?>
									</td>

									<td>

										<?php echo CHtml::link('Delete', array('sparesUsed/delete', 'id'=>$spares_id, 'servicecall_id'=>$model->id));?>

									</td>

									<td>

										<?php echo CHtml::link('Edit', array('sparesUsed/updateSpares', 'spares_id'=>$spares_id, 'servicecall_id'=>$model->id));?>

									</td>


								</tr>
								<?php

								$calculated_price=$calculated_price+$data->total_price;
							}//end of foreach.
							?>

							<!-- <tr><td colspan="6"><hr></td></tr> -->
							<?php

							$model->total_cost=$calculated_price;

							?>
							<tr>
								<td colspan="3"><?php echo $form->labelEx($model,'total_cost'); ?> </td>
								<td  colspan="2" style="text-align:right;"   >
									<?php echo $model->total_cost;
									echo CHtml::textField('',$model->total_cost, array('disabled'=>'disabled','size'=>'10' , 'style'=>'text-align:right'));
									echo $form->textField($model,'total_cost', array('hidden'=>'hidden','size'=>'10' , 'style'=>'text-align:right'));
									?>
								</td>

								<td><?php echo $form->error($model,'total_cost'); ?></td>
							</tr>

							<tr>
								<td colspan="3"><?php echo $form->labelEx($model,'vat_on_total'); ?> </td>
								<td  colspan="2" style="text-align:right;"   ><?php echo $form->textField($model,'vat_on_total', array('size'=>'10' , 'style'=>'text-align:right')); ?></td>
								<td><?php echo $form->error($model,'vat_on_total'); ?></td>
							</tr>

							<tr>
								<?php

								$invoicePresentModel = Invoice::model()->findByAttributes(array('servicecall_id'=>$model->id));
								if($invoicePresentModel)
								{
									//echo "<br> Idof invoice = ".$invoicePresentModel->id;
									$invoiceModel = Invoice::model()->findByPk($invoicePresentModel->id);
								}
								else
								{
									$invoiceModel = Invoice::model();
								}
								?>
								<td colspan="3">
									<?php echo $form->labelEx($invoiceModel,'shipping_handling_cost'); ?>
								</td>
								<td colspan="2" style="text-align:right;">
									<?php echo $form->textField($invoiceModel,'shipping_handling_cost', array('size'=>'10' , 'style'=>'text-align:right')); ?>
								</td>
								<td><?php echo $form->error($invoiceModel,'shipping_handling_cost'); ?></td>
							</tr>

							<td colspan="3">
								<?php echo $form->labelEx($invoiceModel,'labour_cost'); ?>
							</td>
							<td colspan="2" style="text-align:right;">
								<?php echo $form->textField($invoiceModel,'labour_cost', array('size'=>'10' , 'style'=>'text-align:right')); ?>
							</td>
							<td><?php echo $form->error($invoiceModel,'labour_cost'); ?></td>
							</tr>




						</table>
						<?php
					}//end of if spares_used_status_id == 1.

					?>

					<!-- ****** END OF CODE TO DISPLAY SPARES ALREADY USED ******* -->

					<!-- ****** LINK DISPLAY FORM TO ADD SPARES USED ******* -->

					<script type="text/javascript">
						function addSpares()
						{
							//alert('IN ADD CONTACT FUNC'+<?php //echo $model->id;?> );
							<?php
								echo CHtml::ajax(array(
									'url'=>array('sparesUsed/addSpares', 'service_id'=>$model->id),
									'data'=> "js:$(this).serialize()",
									'type'=>'post',
									'dataType'=>'json',
									'success'=>"function(data)
					   {
						if (data.status == 'failure')
						   {
							$('#formdialog div.divForForm').html(data.div);
							   // Here is the trick: on submit-> once again this function!
							   $('#dialogClassroom div.divForForm form').submit(addSpares);
						   }
						   else
						   {
							$('#formdialog div.divForForm').html(data.div);
							   setTimeout(\"$('#formdialog').dialog('close') \",3000);
						   }

					   } ",
								))
								?>;
							return false;
						}//end of function addSpares().
					</script>

					<?php

					/***** CODE TO GET DIALOGUE BOX OF FORM TO ENTER Spares DETAILS ****/
					$this->beginWidget('zii.widgets.jui.CJuiDialog', array(
						'id'=>'formdialog',
						// additional javascript options for the dialog plugin
						'options'=>array(
							'title'=>'Spares Details',
							'autoOpen'=>false,
							'modal'=>'true',
							'show' => 'blind',
							'hide' => 'explode',
						),
					));

					?>

					<div class="divForForm"></div>

					<?php $this->endWidget('zii.widgets.jui.CJuiDialog'); ?>

					<?php
					echo CHtml::link('Add Spares', "",
						array(
							'style'=>'cursor: pointer; text-decoration: underline;',
							'onclick'=>"{addSpares(); $('#formdialog').dialog('open');}"
						));
					?>
					<?php echo $form->labelEx($model,'spares_notes'); ?>
					<?php echo $form->textArea($model,'spares_notes',array('rows'=>8, 'cols'=>120)); ?>
					<?php echo $form->error($model,'spares_notes'); ?>

					<!-- ****** END OF LINK DISPLAY FORM TO ADD SPARES USED ******* -->


					<!-- ***** CODE TO GET THE FREES SEARCH OF MASTER DATABASE **** -->

					<br><div id="freesearch-Form" style="display:none"><!-- ITEM SEARCH DIV -->
						<?php
						$service_id = $model->id;

						$baseUrl = Yii::app()->baseUrl;
						$cs = Yii::app()->getClientScript();
						// $cs->registerScriptFile($baseUrl.'/js/jquery.js');
						//include ('jquery.js');
						?>

						<div class="admin">

							<script type="text/javascript">


								$(document).ready(function() {

									$("#faq_search_input").keyup(function()

									{
										var faq_search_input = $(this).val();
										var dataString = 'keyword='+ faq_search_input;

										//var ref_id = $('#ref_id').val();
										//var cust_id = $('#cust_id').val();
										//var search_url = $('#search_url').val();
										var service_id = $('#service_id').val();
										var local_db_url = $('#local_db_url').val();
										//var current_url = $('#current_url').val();

										if(faq_search_input.length>3)
										{
											$.ajax({
												type: "GET",
												//url: current_url+"/MasterSearchData/?service_id="+service_id,
												//url: current_url+"/getItems",
												//url: search_url,
												url: local_db_url,

												//data: dataString,
												data: dataString+"&service_id="+service_id,
												//data: dataString+"&refid="+ref_id+"&custid="+cust_id,
												//data: dataString,
												beforeSend:  function() {

													$('input#faq_search_input').addClass('loading');

												},
												success: function(server_response)
												{
													$('#searchresultdata').html(server_response).show();
													$('span#faq_category_title').html(faq_search_input);

													if ($('input#faq_search_input').hasClass("loading")) {
														$("input#faq_search_input").removeClass("loading");
													}

												}
											});
										}return false;
									});
								});

							</script>

							<?php
							$baseUrl = Yii::app()->baseUrl;
							$model_name=Yii::app()->controller->id;
							$current_url=$baseUrl."/".$model_name;

							$local_db_url='../local_items_database/api/searchData.php?';
							?>

							<input type="hidden" id="service_id" value="<?php echo $service_id;?>"/>
							<input type="hidden" id="local_db_url" value="<?php echo $local_db_url;?>"/>
							<!-- Enter Item Name, Part Number or barcode<br>
                             The Searchbox Starts Here
                            <form  name="search_form">
                                <input  name="query" type="text" id="faq_search_input" style="background-color: #B2DFEE" size='55' />
                            </form>
                            The Searchbox Ends  Here  -->

							<!--
                            <div id="searchresultdata" class="faq-articles"> </div>

                        </div>
                        -->

						</div><!-- END OF ITEM SEARCH DIV -->

						<!-- ********* CODE TO DISPLAY SEARCH RESULTS FROM SERVER MASTER ITEMS ********** -->
						<?php

						if (!empty($_GET['cloud_id']) || !empty($_GET['master_id']))
						{
							echo "<hr>";
							$master_id = $_GET['master_id'];
							//echo "master id = ".$master_id;
							$cloud_id = $_GET['cloud_id'];
							//echo "cloud id = ".$cloud_id;


							if($cloud_id == 0)
							{
								//echo "no data";
								$db = new PDO('sqlite:../local_items_database/api/master_database.db');

								$result = $db->query("SELECT * FROM master_items WHERE id = '$master_id'");
								$rows = $result->fetchAll(); // assuming $result == true
								$n = count($rows);
								//echo "no of rows = ".$n."<br>";

								foreach($rows as $d)
								{
									//echo $d['id']."<br>";
									//echo $d['name']."<br>";
									$name = $d['name'];
									//echo $d['part_number']."<br>";
									$part_number = $d['part_number'];
									$var = preg_replace("/[^A-Za-z0-9]/", "", $part_number);
									$trimmed = trim($var);
									$opn = strtoupper($trimmed);
								}//end of foreach().

							}//end of if(cloud_id == 0). Data is present in local_items_database.


							?>

							<!-- ************** FORM TO ADD SPARES THAT ARE IN LIST ***************** -->
							<form action="<?php echo Yii::app()->createUrl("SparesUsed/saveData");?>" method="POST">

								<table style="border-radius:15px;" bgcolor="#B2DFEE" >
									<tr><td>
											<input type="hidden" name="master_id" value=<?php echo $master_id;?>>
											<input type="hidden" name="service_id" value=<?php echo $model->id;?>>
											<input type="hidden" value=<?php echo $opn;?>>
											<input type="hidden" name="part_number" value=<?php echo $part_number;?>>
											<input type="hidden" name="name" value="<?php echo $name;?>" >
										</td>
									</tr>
									<tr>
										<td colspan="3"><b> <?php echo $part_number;?>&nbsp;&nbsp;
												<?php echo $name;?></b></td>
									</tr>
									<tr>
										<td>Price<input type="text" name="unit_price" size="3">
										</td>
										<td>Quantity*  <input type="text" name="quantity" size="3"></td>
										<td style="text-align:right;"> <input type="submit" value="Add To Spares" style="width:auto" > </td>
									</tr>

									<tr><td colspan="3"><br> <small><b>* Required</b></small></td></tr>

								</table>
							</form>

							<!-- *************** FORM TO ADD SPARES THAT ARE IN LIST ********************** -->

							<hr>

							<?php
						}//end of if(!empty(cloud_id || master_id)). i.e, item is present in list.



						?>

						<!-- ********* END OF CODE TO DISPLAY SEARCH RESULTS FROM SERVER MASTER ITEMS ********** -->
						<BR><BR><BR>
						<!-- ***** END OF CODE TO GET THE FREES SEARCH OF MASTER DATABASE ENDS **** -->


				</td>
				<td>



					<!-- ***** Engineet first Visit Date**** -->
					<?php echo $form->labelEx($model,'engg_first_visit_date'); ?>
					<?php
					//echo '***'.$model->engg_first_visit_date;
					if ($model->engg_first_visit_date==0)
					{
						$model->engg_first_visit_date='';
					}


					if (!empty($model->engg_first_visit_date))
					{
						$model->engg_first_visit_date=date('j-M-y', $model->engg_first_visit_date);
					}
					$this->widget('zii.widgets.jui.CJuiDatePicker', array(
						'name'=>CHtml::activeName($model, 'engg_first_visit_date'),
						'model'=>$model,
						'value' => $model->attributes['engg_first_visit_date'],
						// additional javascript options for the date picker plugin
						'options'=>array(
							'showAnim'=>'fold',
							'dateFormat' => 'd-M-y',
						),
						'htmlOptions'=>array(
							'style'=>'height:20px;'
						),
					));

					?>
					<?php //echo $form->textField($model,'job_payment_date'); ?>
					<?php echo $form->error($model,'engg_first_visit_date'); ?>



					<!-- ***** Job Completed Date**** -->

					<?php echo $form->labelEx($model,'job_finished_date'); ?>
					<?php
					if (!empty($model->job_finished_date))
					{
						$model->job_finished_date=date('j-M-y', $model->job_finished_date);
					}
					?>
					<?php
					$this->widget('zii.widgets.jui.CJuiDatePicker', array(
						'name'=>CHtml::activeName($model, 'job_finished_date'),
						'model'=>$model,
						'value' => $model->attributes['job_finished_date'],
						// additional javascript options for the date picker plugin
						'options'=>array(
							'showAnim'=>'fold',
							'dateFormat' =>'d-M-y' ,
						),
						'htmlOptions'=>array(
							'style'=>'height:20px;'
						),
					));
					?>
					<?php echo $form->error($model,'job_finished_date'); ?>

					<!-- DATE of Paperwork returned - claim sheet return date -->

					<?php echo $form->labelEx($model,'engg_claim_returned_date'); ?>

					<?php

					if ($model->engg_claim_returned_date==0)
					{
						$model->engg_claim_returned_date='';
					}


					if (!empty($model->engg_claim_returned_date))
					{
						$model->engg_claim_returned_date=date('j-M-y', $model->engg_claim_returned_date);
					}
					$this->widget('zii.widgets.jui.CJuiDatePicker', array(
						'name'=>CHtml::activeName($model, 'engg_claim_returned_date'),
						'model'=>$model,
						'value' => $model->attributes['engg_claim_returned_date'],
						// additional javascript options for the date picker plugin
						'options'=>array(
							'showAnim'=>'fold',
							'dateFormat' => 'd-M-y',
						),
						'htmlOptions'=>array(
							'style'=>'height:20px;'
						),
					));

					?>
					<?php echo $form->error($model,'engg_claim_returned_date'); ?>

					<!-- Job Payment date  -->

					<?php echo $form->labelEx($model,'job_payment_date'); ?>

					<?php
					if (!empty($model->job_payment_date))
					{
						$model->job_payment_date=date('j-M-y', $model->job_payment_date);
					}
					$this->widget('zii.widgets.jui.CJuiDatePicker', array(
						'name'=>CHtml::activeName($model, 'job_payment_date'),
						'model'=>$model,
						'value' => $model->attributes['job_payment_date'],
						// additional javascript options for the date picker plugin
						'options'=>array(
							'showAnim'=>'fold',
							'dateFormat' => 'd-M-y',
						),
						'htmlOptions'=>array(
							'style'=>'height:20px;'
						),
					));

					?>
					<?php echo $form->error($model,'job_payment_date'); ?>











					<?php echo $form->labelEx($model,'work_summary'); ?>
					<?php //echo $form->textField($model,'work_summary',array('rows'=>6, 'cols'=>50)); ?>

					<?php
					$works_array = array();
					array_push($works_array, '');
					array_push($works_array, 'RETURNED WITH ENGINEER VISIT');
					array_push($works_array, 'RETURNED WITHOUT ENGINEER VISIT');
					array_push($works_array, 'REPAIRED');
					array_push($works_array, 'CALL AVOIDANCE ENGINEER');
					array_push($works_array, 'CANCELLED');
					array_push($works_array, 'SPARES ONLY');
					array_push($works_array, 'CALL AVOIDANCE CC');
					array_push($works_array, 'CUSTOMER CHARGED');
					array_push($works_array, 'NOT KNOWN');
					?>
					<?php 	echo $form->dropDownList($model,'work_summary', array_combine($works_array,$works_array)); ?>



					<?php echo $form->labelEx($model,'work_carried_out'); ?>
					<?php echo $form->textArea($model,'work_carried_out', array('rows'=>4, 'cols'=>'30')); ?>
					<?php echo $form->error($model,'work_carried_out'); ?>

					<?php echo $form->labelEx($model,'notes'); ?>
					<?php echo $form->textArea($model,'notes',array('rows'=>8, 'cols'=>120)); ?>
					<?php echo $form->error($model,'notes'); ?>
				</td>

			</tr>


		</table>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Modify'); ?>
	</div>



	<?php $this->endWidget(); ?>

</div><!-- form -->

