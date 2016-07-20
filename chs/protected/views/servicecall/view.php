<?php include('servicecall_sidemenu.php'); ?>

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<?php
echo CHtml::scriptFile("https://maps.googleapis.com/maps/api/js");//This has to import here else it shows that it is called multiple times
echo CHtml::scriptFile("https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js");


$service_id = $_GET['id'];

$productModel = Product::model()->findByPk($model->product_id);

$brandModel = Brand::model()->findByPk($productModel->brand_id);
//$productTypeModel=ProductType::model()->findByPk($productModel->product_type_id);
$productType = $productModel->productType->name;
$productTypeModel = ProductType::model()->findByPk($productModel->product_type_id);

$contractModel = Contract::model()->findByPk($model->contract_id);
$contractName = $contractModel->name;
$contractTypeModel = ContractType::model()->findByPk($contractModel->contract_type_id);
$engineerModel = Engineer::model()->findByPk($model->engineer_id);
$engineerName = $engineerModel->fullname;
$enggDiaryModel = Enggdiary::model()->findByPk($model->engg_diary_id);

//address of customer.
$str1 = $model->customer->address_line_1 . " " . $model->customer->address_line_2 . " " . $model->customer->address_line_3 . "\n";
$str2 = $model->customer->town . "\n";
$str3 = $model->customer->postcode_s . " " . $model->customer->postcode_e;
$address = $str1 . " " . $str2 . " " . $str3;

//CALCULATING VALID UNTILL.
$php_warranty_date = $productModel->warranty_date;
$php_waranty_months = $productModel->warranty_for_months;
$warranty_end_date = '';
if (!empty ($php_warranty_date)) {
    $warranty_until = strtotime(date("Y-M-d", $php_warranty_date) . " +" . $php_waranty_months . " month");
    $warranty_end_date = date('d-M-Y', $warranty_until);
}
?>


<table>
    <tr>
        <td><b><?php echo CHtml::link('Home', array('/servicecall/admin')); ?></b>
        </td>
        <td>
            <table style="width:50%;float: right;">
                <tr>
                    <td>
                        <b>
                            <?php echo CHtml::link('Edit', array('/servicecall/update', 'id' => $model->id)); ?>
                        </b>
                    </td>
                    <td>
                        <?php
                        $previewImgUrl = Yii::app()->request->baseUrl . '/images/pdf.gif';
                        $previewImg = CHtml::image($previewImgUrl, 'Preview', array('width' => 35, 'height' => 35, 'title' => 'Preview in Pdf'));
                        ?>
                        <?php echo CHtml::link($previewImg, array('Preview', 'id' => $model->id), array('target' => '_blank')); ?>
                    </td>
                    <td>
                        <?php
                        $htmlImgUrl = Yii::app()->request->baseUrl . '/images/html_file.png';
                        $htmlImg = CHtml::image($htmlImgUrl, 'htmlPreview', array('width' => 35, 'height' => 35, 'title' => 'Preview in HTML'));
                        ?>
                        <?php echo CHtml::link($htmlImg, array('htmlPreview', 'id' => $model->id), array('target' => '_blank')); ?>
                    </td>
                    <td>
                        <?php
                        //$mobileImgUrl = Yii::app()->request->baseUrl . '/images/mobile.png';
                        $mobileImgUrl = Yii::app()->request->baseUrl . '/images/icons/paper_plane.png';
                        $mobileImg = CHtml::image($mobileImgUrl, 'sendToMobile', array('width' => 35, 'height' => 35, 'title' => 'Send to Mobile'));
                        echo CHtml::link($mobileImg, array('/gomobile/default/sendsingleservicecalltoserver', 'id' => $model->id), array('target' => '_blank'));
                        ?>
                    </td>
                </tr>
            </table>
        </td>
    </tr>

    <tr>
        <td colspan="2" style="text-align:center">
            <h2>Service Call Details</h2>
        </td>
    </tr>
    <tr>
        <th style="width:50%; padding:20px;"><b>Job Status : </b>
            <h6 style="color:maroon"><?php echo $model->jobStatus->html_name; ?></h6></th>
        <th>Service Ref. No.# <h1 style="color:green"><?php echo $model->service_reference_number; ?></h1></th>

    </tr>


    <tr>
        <td colspan="2">
            <div class="customerheadingbox">
                <h4><?php echo $model->getAttributeLabel('comments'); ?></h4>

            </div>
            <div class="customerdatabox">
                <div>
                    <?php

                    Yii::app()->clientScript->registerScript('comments-div', "
                                        $('#comments-button').click(function(){
	                                    $('#comments-div').toggle();
	                                    return false;
                                        });
                                ");
                    ?>
                    <?php echo CHtml::link('', '#', array('id' => 'comments-button', 'class' => 'fa fa-eye fa-1x')); ?>
                    <div id="comments-div" style="display:block">
                        <?php echo Setup::model()->printjsonnotesorcommentsinhtml($model->comments); ?>
                    </div><!-- comments-form -->
                </div>
            </div>
        </td>
    </tr>


    <!-- Customer Details Start -->
    <tr>
        <td colspan="2">
            <div class="customerheadingbox">
                <h4>Customer
                    Details <?php echo CHtml::link(CHtml::image('images/icons/edit.png', 'Edit Customer', array('width' => '20px')), array('Customer/openDialog', 'customer_id' => $model->customer->id, 'product_id' => $productModel->id)); ?></h4>
            </div>

            <div class="customerdatabox">
                <table style="margin: 5px;">
                    <tr>
                        <th style="width:50%;"></th>
                        <th style="width:50%;  text-align: right;"></th>
                    </tr>
                    <tr>
                        <td>
                            <?php echo $model->customer->title . ' ' . $model->customer->fullname; ?>
                            <br>
                            <div class="address_contact">
                                <?php
                                echo Setup::model()->formataddressinhtml($model->customer->address_line_1, $model->customer->address_line_2, $model->customer->address_line_3, $model->customer->town, $model->customer->postcode);
                                ?>
                            </div>
                            <br>
                            <table>
                            	<tr>
                            		<td><span class="datacontenttitle"><?php echo $model->getAttributeLabel('customer.mobile'); ?></span></td>
                            		<td><?php echo '' . $model->customer->mobile; ?></td>
                            	</tr>
                            	<tr>
                            		<td><span class="datacontenttitle"><?php echo $model->getAttributeLabel('customer.telephone'); ?></span></td>
                            		<td><?php echo '' . $model->customer->telephone; ?></td>
                            	</tr>
                            	<tr>
                            		<td><span class="datacontenttitle"><?php echo $model->getAttributeLabel('customer.fax'); ?></span></td>
                            		<td><?php echo '' . $model->customer->fax; ?></td>
                            	</tr>
                            	<tr>
                            		<td><span class="datacontenttitle"><?php echo $model->getAttributeLabel('customer.email'); ?></span></td>
                            		<td><?php echo '' . $model->customer->email; ?></td>
                            	</tr>
                            </table>
                        </td>
                        <td class="address_contact" style="text-align: right;">

                            <a target="_blank" href="https://www.google.co.uk/maps?q=<?php echo $address ?>">View Larger
                                Map</a>
                            <br>
                            <div class="googlemapdiv" style="display:block; float: right;">
                                <?php $this->renderPartial('postcodeongooglemap', array('address' => $address)); ?>
                            </div><!-- googlemapdiv -->

                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">


                            <?php

                            Yii::app()->clientScript->registerScript('search', "
                                        $('#customer-comments-button').click(function(){
	                                    $('#customer-comments-div').toggle();
	                                    return false;
                                        });
                                ");
                            ?>
                            <?php echo CHtml::link(' Notes ', '#', array('id' => 'customer-comments-button', 'class' => 'fa fa-eye fa-1x')); ?>
                            <div id="customer-comments-div" style="display:block">
                                <?php echo Setup::model()->printjsonnotesorcommentsinhtml($model->customer->notes); ?>
                            </div><!-- Customer comments-div -->


                        </td>
                    </tr>
                </table>

            </div>
        </td>
    </tr>

    <!-- Customer Details End -->


    <!-- Product Details Start-->
    <tr>
        <td colspan="2">
            <div class="customerheadingbox">
                <h4>Product
                    Details <?php echo CHtml::link(CHtml::image('images/icons/edit.png', 'Edit Product', array('width' => '20px')), array('Product/updateProduct', 'id' => $productModel->id)); ?></h4>
            </div>
            <div class="customerdatabox">
                <table style="margin: 5px;">
                    <tr>
                        <th style="width:50%;"></th>
                        <th style="width:50%;  text-align: right;"></th>
                    </tr>
                    <tr>
                        <td>

                            <table style="width: 80%">
                                <tr>
                                    <td><span class="datacontenttitle">Brand</span>
                                    <td><?php echo '' . $model->product->brand->name; ?></td>
                                </tr>

                                <tr>
                                    <td><span class="datacontenttitle">Product Type</span>
                                    <td><?php echo '' . $model->product->productType->name; ?></td>
                                </tr>

                                <tr>
                                    <td><span
                                            class="datacontenttitle"><?php echo $productModel->getAttributeLabel('model_number'); ?></span>
                                    <td><?php echo '' . $productModel->model_number; ?></td>
                                </tr>

                                <tr>
                                    <td><span
                                            class="datacontenttitle"><?php echo $productModel->getAttributeLabel('serial_number'); ?></span>
                                    <td><?php echo '' . $productModel->serial_number; ?></td>
                                </tr>

                                <tr>
                                    <td><span
                                            class="datacontenttitle"><?php echo $productModel->getAttributeLabel('enr_number'); ?></span>
                                    <td><?php echo '' . $productModel->enr_number; ?></td>
                                </tr>

                                <tr>
                                    <td><span
                                            class="datacontenttitle"><?php echo $productModel->getAttributeLabel('fnr_number'); ?></span>
                                    <td><?php echo '' . $productModel->fnr_number; ?></td>
                                </tr>


                            </table>
                        </td>
                        <td>


                            <table style="width: 80%">

                                <tr>
                                    <td><span
                                            class="datacontenttitle"><?php echo $productModel->getAttributeLabel('purchased_from'); ?></span>
                                    <td><?php echo '' . $productModel->purchased_from; ?></td>
                                </tr>
                                <tr>
                                    <td><span
                                            class="datacontenttitle"><?php echo $productModel->getAttributeLabel('purchase_date'); ?></span>
                                    <td><?php echo Setup::model()->formatdate($productModel->purchase_date); ?></td>
                                </tr>
                                <tr>
                                    <td><span
                                            class="datacontenttitle"><?php echo $productModel->getAttributeLabel('warranty_date'); ?></span>
                                    <td><?php echo Setup::model()->formatdate($productModel->warranty_date); ?></td>
                                </tr>
                                <tr>
                                    <td><span
                                            class="datacontenttitle"><?php echo $productModel->getAttributeLabel('warranty_until'); ?></span>
                                    <td><?php echo $warranty_end_date; ?></td>
                                </tr>
                                <tr>
                                    <td><span
                                            class="datacontenttitle"><?php echo $productModel->getAttributeLabel('discontinued'); ?></span>
                                    </td>
                                    <td><?php
                                        if ($productModel->discontinued == 0)
                                            echo 'No';
                                        else
                                            echo 'Yes';
                                        ?></td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td colspan='2'>
                            <div>
                                <?php
                                Yii::app()->clientScript->registerScript('product-notes-div-script', "
													$('#product-notes-button').click(function(){
													$('#product-notes-div').toggle();
													return false;
													});
											");
                                ?>
                                <?php echo CHtml::link('Notes', '#', array('id' => 'product-notes-button', 'class' => 'fa fa-eye fa-1x')); ?>
                                <div id="product-notes-div" style="display:block">
                                    <?php echo Setup::model()->printjsonnotesorcommentsinhtml($productModel->notes); ?>
                                </div><!-- comments-form -->
                            </div>
                        </td>
                    </tr>
                </table>
            </div>
        </td>
    </tr>
    <!-- Product Details End-->


    <!-- Service Details Start-->
    <tr>
        <td colspan="2">
            <div class="customerheadingbox" id="service-details">

                <table>
                    <tr>
                        <td>
                            <h4>Service
                                Details <?php echo CHtml::link(CHtml::image('images/icons/edit.png', 'Edit Servicecall', array('width' => '20px')), array('Servicecall/update', 'id' => $model->id)); ?></h4>
                        </td>
                        <td><h4><?php echo $model->getAttributeLabel('fault_date'); ?></h4>
                            <?php echo Setup::model()->formatdate($model->fault_date); ?>
                        </td>
                    </tr>
                </table>
            </div>


            <div class="customerdatabox">

                <!--

                <div>
                    <span class="datacontenttitle">Contract</span>
                    <?php echo $model->contract->name; ?>
                </div>


                <div>
                                <span
                                    class="datacontenttitle"><?php echo $model->getAttributeLabel('insurer_reference_number'); ?></span>
                    <?php echo $model->insurer_reference_number; ?>
                </div>

                <br>


                <div>
                                <span
                                    class="datacontenttitle"><?php echo $model->getAttributeLabel('fault_code'); ?></span>
                    <?php echo $model->fault_code; ?>
                </div>

                <br>
                -->
                <div>
                                <span
                                    class="datacontenttitle"><?php echo $model->getAttributeLabel('fault_description'); ?></span>
                    <br>
                    <?php echo $model->fault_description; ?>
                </div>
                <br>
                <div>
                    <span class="datacontenttitle">Engineer</span>
                    <?php echo $model->engineer->company; ?>

                    <?php //echo CHtml::link(CHtml::image('images/icons/edit.png', 'Change', array('width' => '20px')), array('servicecall/changeEngineerOnly/', 'service_id' => $model->id));
                         echo CHtml::link(CHtml::image('images/icons/edit.png', 'Change', array('width' => '20px')),
                                        '#', array(
                                                'onclick'=>'$("#change-engineer-dialog").dialog("open"); return false;',
                             ));
                    ?>

                </div>
                <?php
                $this->beginWidget('zii.widgets.jui.CJuiDialog',array(
                    'id'=>'change-engineer-dialog',
                    // additional javascript options for the dialog plugin
                    'options'=>array(
                        'title'=>'Change Engineer',
                        'autoOpen' => false,
                        'resizable' => false,
                        'modal' => 'true',
                    ),
                ));

                $this->renderPartial('changeEngineerOnly');

                $this->endWidget('zii.widgets.jui.CJuiDialog');

                // the link that may open the dialog

                ?>


        </td>
    </tr>
    <!-- Service Details End-->


    <!-- Previous Servicecalls Start-->
    <tr>
        <td colspan="2">
            <div class="customerheadingbox">
                <h4>Previous Service Details </h4>
            </div>
            <div class="customerdatabox">
                <table>
                    <tr>
                        <th><span class="datacontenttitle">Service Ref#</span></th>
                        <th><span class="datacontenttitle">Product</span></th>
                        <th><span class="datacontenttitle">Reported Date</span></th>
                        <th><span class="datacontenttitle">Fault Description</span></th>
                        <th><span class="datacontenttitle">Engineer Visited</span></th>
                        <th><span class="datacontenttitle">Job Status</span></th>
                    </tr>
                    <?php $previousCall = $model->previousCall($model->customer_id);
                    foreach ($previousCall as $data) {
                        if ($data->service_reference_number != $model->service_reference_number)//////since we want to skip the current service call
                        {
                            ?>
                            <tr>
                                <td><?php echo CHtml::link($data->service_reference_number, array('view', 'id' => $data->id)); ?></td>
                                <td><?php echo "<b>" . $data->product->productType->name . "<b>"; ?></td>
                                <td><?php
                                    if (!empty($data->fault_date))
                                        echo date('d-M-Y', $data->fault_date);
                                    ?>
                                </td>
                                <td><?php echo $data->fault_description; ?></td>
                                <td><?php echo $data->engineer->company . ', ' . $data->engineer->fullname; ?></td>
                                <td style="color:maroon"><?php echo $data->jobStatus->name; ?></td>
                            </tr>
                            <?php
                        }///end of if
                    }//end of foreach().?>
                </table>
            </div>
        </td>
    </tr>
    <!-- Previous Servicecalls End-->


    <!--  Previous Uplifts START-->
    <tr>
        <td colspan="2">
            <div class="customerheadingbox">
                <h4>Previous Uplifts</h4>
            </div>
            <div class="customerdatabox">
                <?php
                $uplifts = Uplifts::model()->findAllByAttributes(array('customer_id' => $model->customer->id));
               	?>
               	<table>
               		<tr>
               			<th class="datacontenttitle" style="width:15%;">Uplift No.#</th>
               			<th  class="datacontenttitle"style="width:15%;">Product</th>
               			<th class="datacontenttitle" style="width:20%;">Serial Number</th>
          				<th  class="datacontenttitle"style="width:45%;">Reason</th>
               		</tr>
	               	<?php foreach ($uplifts as $uplift){ ?>
				   		<tr>	
						<td><?php echo CHtml::link($uplift->uplift_number, array('uplifts/manage/view', 'id' => $uplift->id)); ?></td>
						<td><?php echo $uplift->product->productType->name; ?></td>
						<td><?php echo $uplift->serial_number;
								
									if ($uplift->product_id==$model->product_id)
										echo "</br><small style='color: #f89406;'><b> This Servicecall Product</b></small>"; 

								?>
								
								</td>
						<td><?php echo $uplift->reason_for_uplift;?></td>
						</tr>
					<?php }
                ?>
 				</table>
 
            </div>
        </td>
    </tr>
    <!--  Previous Uplifts End-->


    <!-- Spares Used -->
    <tr>
        <td colspan="2">
            <div class="customerheadingbox">
                <h4>Spares </h4>

            </div>
            <div class="customerdatabox">
            
            
            
                <table style="width:100%;">
                    <?php
                    if ($model->spares_used_status_id == 1) {
                        ?>

                        <?php //echo "Spares used";
                        $sparesModel = SparesUsed::model()->findAllByAttributes(array('servicecall_id' => $model->id));
                        ?>

                        <tr>
                            <th><span class="datacontenttitle">Item</span></th>
                            <th><span class="datacontenttitle">Part Number</span></th>
                            <th><span class="datacontenttitle">Date Ordered</span></th>
                            <th><span class="datacontenttitle" >Date Ordered Poland</span></th>
                            <th><span class="datacontenttitle" >Date Posted</span></th>
                            <th><span class="datacontenttitle">Quantity</span></th>
                            <th><span class="datacontenttitle">Unit Price</span></th>
                            <th><span class="datacontenttitle">Total Price</span></th>
                        </tr>
						<!--
						<tr>
							<td colspan='8'>
								<hr>
							</td>
						</tr>
						-->
                        <?php foreach ($sparesModel as $data) { ?>
                            <tr>
                                <td><?php echo $data->item_name; ?></td>
                                <td><?php echo $data->part_number; ?></td>
                                <td  style="width: 100px;">
										<?php
										if(!empty($data->date_ordered))
										{
											echo date('d-M-Y', $data->date_ordered);
										}
										?>
								</td>
								<td style="width: 100px;">
										<?php
										if(!empty($data->date_ordered_from_manufacturer))
										{
											echo date('d-M-Y', $data->date_ordered_from_manufacturer);
										}
										?>
								</td>
								<td style="width: 100px;">
										<?php
										if(!empty($data->date_posted))
										{
											echo date('d-M-Y', $data->date_posted);
										}
										?>
								</td>
								<td><?php echo $data->quantity; ?></td>
                                <td><?php echo $data->unit_price; ?></td>
 								<td><?php echo $data->total_price; ?></td>
 								
                            </tr>
                        <?php }//end of foreach of spares()?>

  
                        <tr>
                            <td colspan="5"></td>
                            <td><span
                                    class="datacontenttitle"><?php echo $model->getAttributeLabel('total_cost'); ?></span>
                            </td>
                            <td><?php echo $model->total_cost; ?></td>
                        </tr>

                    <?php }//end of if($spares_used == 1).?>
 
                </table>
                
               
				<div>
                	<span class="datacontenttitle"><?php echo $model->getAttributeLabel('spares_notes'); ?></span>
                    <br>
                    <?php echo $model->spares_notes; ?>
                </div>
            </div><!-- end of customerdatabox-->
        </td>
    </tr>
    <!-- Spares Used End-->


    <!-- WORK CARRIED OUT Details Start-->
    <tr>
        <td colspan="2">
            <div class="customerheadingbox">
                <h4>Work Carried Out
                    <?php echo CHtml::link(CHtml::image('images/icons/edit.png', 'Edit Servicecall', array('width' => '20px')), array('Servicecall/update', 'id' => $model->id)); ?>
                </h4>

            </div>

            <div class="customerdatabox">
                <table style="margin: 5px;">
                    <tr>

                        <th>Engineer Reported</th>
                    </tr>
                    <tr>
                        <td>
                            <table style="width: 50%">   
                                <tr>
                                    <td><span
                                            class="datacontenttitle"><?php echo $model->getAttributeLabel('fault_date'); ?></span>
                                    </td>
                                    <td><?php echo Setup::model()->formatdate($model->fault_date); ?></td>
                                </tr>
                            
                                <tr>
                                    <td><span
                                            class="datacontenttitle"><?php echo $model->getAttributeLabel('engg_first_visit_date'); ?></span>
                                    </td>
                                    <td><?php echo Setup::model()->formatdate($model->engg_first_visit_date); ?></td>
                                </tr>
                            
                            
                            
                                <tr>
                                    <td><span
                                            class="datacontenttitle"><?php echo $model->getAttributeLabel('job_finished_date'); ?></span>
                                    </td>
                                    <td>          <?php echo Setup::model()->formatdate($model->job_finished_date); ?></td>
                                </tr>
                                <tr>
                                    <td><span
                                            class="datacontenttitle"><?php echo $model->getAttributeLabel('engg_claim_returned_date'); ?></span>
                                    </td>
                                    <td><?php echo Setup::model()->formatdate($model->engg_claim_returned_date); ?></td>
                                </tr>
                                <tr>
                                    <td><span
                                            class="datacontenttitle"><?php echo $model->getAttributeLabel('job_payment_date'); ?></span>
                                    </td>
                                    <td> <?php echo Setup::model()->formatdate($model->job_payment_date); ?></td>
                                </tr>
                            </table>


                            <br><br<br>

                            <div>
                                <span
                                    class="datacontenttitle"><?php echo $model->getAttributeLabel('work_summary'); ?></span>
                                <?php echo $model->work_summary; ?>
                            </div>
                            <br>
                            <div>
                                <span
                                    class="datacontenttitle"><?php echo $model->getAttributeLabel('work_carried_out'); ?></span>
                                <br>
                                <?php echo $model->work_carried_out; ?>
                            </div>
                            <br>


                            <br>
                            <div>
                                <span class="datacontenttitle"><?php echo $model->getAttributeLabel('notes'); ?></span>
                                <br>
                                <?php echo $model->notes; ?>
                            </div>


                        </td>
                    </tr>
                </table><!-- END OF Table in customer databox-->

            </div><!-- end of customerdatabox-->
        </td>
    </tr>
    <!-- WORK CARRIED OUT DEetails End-->




    <!-- Invoice Start-->
    <tr>
        <td colspan="2">
            <div class="customerheadingbox">
                <h4>Costs </h4>
            </div>
            <div class="customerdatabox">
              <!--- INVOICE DETAILS START--->
				<table style="width:50%">
                    <td><span
                                    class="datacontenttitle"><?php echo $model->getAttributeLabel('total_cost'); ?></span>
                            </td>
                            <td><?php echo $model->total_cost; ?></td>
                    
                    <tr>
                         <td><span
                                class="datacontenttitle"><?php echo $model->getAttributeLabel('invoice.shipping_handling_cost'); ?></span>
                        </td>
                        <td><?php echo $model->invoice->shipping_handling_cost; ?></td>
                    </tr>
                    
                    <tr>
                         <td><span
                                class="datacontenttitle"><?php echo $model->getAttributeLabel('invoice.labour_cost'); ?></span>
                        </td>
                        <td><?php echo $model->invoice->labour_cost; ?></td>
                    </tr>
                    <tr>
                         <td><span
                                class="datacontenttitle"><?php echo $model->getAttributeLabel('vat_on_total'); ?></span>
                        </td>
                        <td><?php echo $model->vat_on_total; ?></td>
                    </tr>

                    <tr>
                         <td><span
                                class="datacontenttitle"><?php echo $model->getAttributeLabel('net_cost'); ?></span>
                        </td>
                        <td><?php echo $model->net_cost; ?></td>
                    </tr>

				</table>

                <!-- INVOICE DETAILS END --->
            </div>
        </td>
    </tr>
    <!-- Invoice End-->
    

    <!-- Go Mobile Start-->
    <tr>
        <td colspan="2">
            <div class="customerheadingbox">
                <h4>Activity with Engineer </h4>
            </div>
            <div class="customerdatabox">
                <div>
                    <span class="datacontenttitle">Activity Log</span>
                    <table>
                        <tr>
                            <th><span class="datacontenttitle">Activity Date</span></th>
                            <th><span class="datacontenttitle">Status</span></th>
                            <th><span class="datacontenttitle">Sent By</span></th>
                        </tr>

                        <?php

                        $gomobile_server_url = Gmservicecalls::model()->getserverurl();
                        $gmservice = Gmservicecalls::model()->findByAttributes(array('servicecall_id' => $model->id), array('order' => 'created ASC'));
						
						if ($gmservice)
						{
							echo $gmservice->event_log; ////this contains data in <tr> format
							echo CHtml::link(CHtml::image('images/icons/view.png', 'Edit Servicecall', array('width' => '20px')), array('/gomobile/gmservicecalls/view', 'id' => $gmservice->id, '#' => 'workcarriedout'));
						
                        //foreach ($gmservicecallslogs as $gmservice) {
                            /*
                            echo '<tr>';
                            echo '<td>' . $gmservice->jobstatus->name . '</td>';
                            echo '<td>' . Setup::model()->formatdatewithtime($gmservice->created) . '</td>';
                            echo '</tr>';
                            */
							
                            

                            //echo $gmservice->comments;

                            if ($gmservice->server_status_id == '5') { ///status 5 means data is recieved from the server
                                $fulldataarray = json_decode($gmservice->comments, true);

                                //$recieveddata=json_decode($fulldataarray['data'],true);
                                $fullchatarray = json_decode($fulldataarray['communications'], true);

                            }///end of if

                        }//end if ($gmservice)

                        ?>
                    </table>

                </div>
            </div>
        </td>
    </tr>
    <!-- Go Mobile End-->


</table>




