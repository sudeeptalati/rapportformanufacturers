<?php include('servicecall_sidemenu.php'); ?>

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<?php
echo CHtml::scriptFile("https://maps.googleapis.com/maps/api/js");//This has to import here else it shows that it is called multiple times
echo CHtml::scriptFile("https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js");


$service_id = $_GET['id'];

$customerModel = Customer::model()->findByPk($model->customer_id);
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
<script>
    $(function () {
        $("#draggable").draggable();
    });
</script>

<div class="customerheadingbox" id="draggable"
     style="position: fixed;right: 14%; top: 4%;   width: 150px; height:auto;   padding-left: 35px; border-radius: 10px; cursor:move;">


    <h4>
     	<i class="fa fa-arrow-up" aria-hidden="true"></i>
        <a style="color:white;" href="#page">Top</a>
    </h4>  
    <h4>
        <i class="fa fa-users" aria-hidden="true"></i>
        <a style="color:white;" href="#customerbox">Customer</a>
    </h4>

    <h4>
        <i class="fa fa-archive" aria-hidden="true"></i>
        <a style="color:white;" href="#productbox">Product</a>
    </h4>

    <h4>
        <i class="fa fa-wrench" aria-hidden="true"></i>
        <a style="color:white;" href="#service-details">Service</a>
    </h4>

    <h4>
        <i class="fa fa-gears" aria-hidden="true"></i>
        <a style="color:white;" href="#sparesbox">Spares</a>
    </h4>
    
    <h4>
        <i class="fa fa-money" aria-hidden="true"></i>
        <a style="color:white;" href="#costs">Costs</a>
    </h4>    
     


    <h4>
        <i class="fa fa-briefcase" aria-hidden="true"></i>
        <a style="color:white;" href="#enggreporting">Work Done</a>
    </h4>
    <h4>
        <i class="fa fa-code-fork" aria-hidden="true"></i>

        <a style="color:white;"  onclick="showhideactivitylog()" href="#activitylog">Activity Log</a>
        <script>
			function showhideactivitylog()
			{	
				$('#activitylog-div').toggle();	
			}		
        </script>
        
    </h4>
    <h4>
		<i class="fa fa-comments" aria-hidden="true"></i>
        <span id='sidechatbtn' onclick="showhidechatbox()" style="color:white;cursor:pointer;" >Chats</<span>
        <script>
			function showhidechatbox()
			{	
				$('.chat-form').toggle();	
			}		
        </script>
    </h4>
    

    
    <h4>
     	<i class="fa fa-arrow-down" aria-hidden="true"></i>
        <a style="color:white;" href="#footer">Bottom</a>
    </h4>  

</div>

<table>
    <tr>
        <td><b><?php echo CHtml::link('Home', array('/servicecall/admin')); ?></b>
        </td>
        <td>
            <table style="width:50%;float: right;">
                <tr>
                    <td>
                        <b>
                            <?php //echo CHtml::link('Edit', array('/servicecall/update', 'id' => $model->id)); ?>
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
                        
                        
                        if ($model->job_status_id<100)
                        {
                        	//$mobileImgUrl = Yii::app()->request->baseUrl . '/images/mobile.png';
                        	$mobileImgUrl = Yii::app()->request->baseUrl . '/images/icons/paper_plane.png';
                        	$mobileImg = CHtml::image($mobileImgUrl, 'sendToMobile', array('width' => 35, 'height' => 35, 'title' => 'Send to Mobile'));
                        	echo CHtml::link($mobileImg, array('/gomobile/default/sendsingleservicecalltoserver', 'id' => $model->id), array('target' => '_blank'));
                        }
                        
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
        <th style="text-align:left;"><h1 title="Job Reference No."
                                          style="color:green"><?php echo $model->service_reference_number; ?></h1></th>

        <th style="width:50%;">

            <?php $editicon = '<h4><i class="fa fa-pencil-square-o" aria-hidden="true"></i>&nbsp;&nbsp;' . $model->jobStatus->name . '</h4>'; ?>


            <div class="contentbox"
                 style="background-color:<?php echo $model->jobStatus->backgroundcolor; ?> ">

                <?php
                echo CHtml::link($editicon,
                    '#', array(
                        'onclick' => '$("#change-jobstatus-dialog").dialog("open"); return false;',
                    ));
                ?>


                <?php
                $this->beginWidget('zii.widgets.jui.CJuiDialog', array(
                    'id' => 'change-jobstatus-dialog',
                    // additional javascript options for the dialog plugin
                    'options' => array(
                        'title' => 'Change Status',
                        'autoOpen' => false,
                        'resizable' => false,
                        'modal' => 'true',
                    ),
                ));
                $this->renderPartial('changejobstatusonly');
                $this->endWidget('zii.widgets.jui.CJuiDialog');
                // the link that may open the dialog
                ?>


            </div>

        </th>
    </tr>

    <tr><th style="text-align:left;">
            <h3 title="Reported Date" style="color:green">
                <i class="fa fa-calendar" aria-hidden="true"></i>
                <?php echo Setup::model()->formatdate($model->fault_date); ?>

            </h3>
        <th style="width:50%;">
            <div class="enginnerheadingbox contentbox">
                <h4 style="color:white">

                    <?php $enggtitle = '<h4 style="color: white;"><i class="fa fa-wrench" aria-hidden="true"></i> &nbsp;&nbsp; ' . $model->engineer->company . '</h4>'; ?>
                    <?php echo CHtml::link($enggtitle,
                        '#', array(
                            'onclick' => '$("#change-engineer-dialog").dialog("open"); return false;',
                        ));


                    $this->beginWidget('zii.widgets.jui.CJuiDialog', array(
                        'id' => 'change-engineer-dialog',
                        // additional javascript options for the dialog plugin
                        'options' => array(
                            'title' => 'Change Engineer',
                            'autoOpen' => false,
                            'resizable' => false,
                            'modal' => 'true',
                        ),
                    ));

                    $this->renderPartial('changeEngineerOnly');

                    $this->endWidget('zii.widgets.jui.CJuiDialog');

                    ?>


                </h4>
            </div>
        </th>

        </th>
    </tr>

    <tr>
        <td colspan="2">

            <?php if (isset($_GET['error_msg'])): ?>
                    <?php
                    
                    $error_msg=$_GET['error_msg'];
					$error_msg=trim($error_msg);
					
					if (!empty($error_msg))
					{
                    $this->beginWidget('zii.widgets.jui.CJuiDialog', array(
                        'id' => 'error-dialog',
                        // additional javascript options for the dialog plugin
                        'options' => array(
                            'title' => 'Error',
                            'autoOpen' => true,
                            'resizable' => false,
                            'modal' => true,
                            'overflow' => 'hidden',

                        ),
                    ));


                    echo '<div class="error">'.$_GET['error_msg'].'</div>';

                    $this->endWidget('zii.widgets.jui.CJuiDialog');
                    // the link that may open the dialog
					}///end of if (!empty($error_msg))

                    ?>

                    </div>
            <?php endif; ?>






            <div class="customerheadingbox contentbox">
                <?php
                Yii::app()->clientScript->registerScript('comments-div', "
                                        $('#comments-button').click(function(){
	                                    $('#comments-div').toggle();
	                                    return false;
                                        });
                                ");
                ?>

                 
                            <h4>
                                <?php $updatecomments = "<span style='color: white;' ><i class='fa fa-plus-square-o' ></i> Comments</span>"; ?>

                                <?php
                                echo CHtml::link($updatecomments,
                                    '#', array(
                                        'onclick' => '$("#update-comments-dialog").dialog("open"); return false;',
                                    ));
                                ?>
                                <div class="right">
									<?php $commentstext = "<span style='color: white;' id='activilitylogdivbutton'> <i class='fa fa-toggle-on'></i></span>"; ?>
									<?php echo CHtml::link($commentstext, '#', array('id' => 'comments-button')); ?>
                            	</div>
                            </h4>
                         
            </div>

            <div class="customerdatabox">
                <div>

                    <div id="comments-div" style="display:block">
                        <?php echo Setup::model()->printjsonnotesorcommentsinhtml($model->comments); ?>
                    </div><!-- comments-form -->


                    <?php
                    $this->beginWidget('zii.widgets.jui.CJuiDialog', array(
                        'id' => 'update-comments-dialog',
                        // additional javascript options for the dialog plugin

                        'options' => array(
                            'title' => 'Add Comments',
                            'autoOpen' => false,
                            'resizable' => false,
                            'modal' => true,
                            //'width'=>'600px',

                        ),
                    ));

                    $this->renderPartial('addcomments', array('model' => $model));
                    $this->endWidget('zii.widgets.jui.CJuiDialog');
                    // the link that may open the dialog
                    ?>


                </div>
            </div>
        </td>
    </tr>


    <!-- Customer Details Start -->
    <tr>
        <td colspan="2">
            <div class="customerheadingbox contentbox" id="customerbox">
                <?php 
				$updatecustomertext = "<h4 style='color: white;'><i class='fa fa-users'></i>&nbsp;&nbsp;Customer <div style='float:right'><i class='fa fa-pencil-square-o'></i></div></h4>";

                echo CHtml::link($updatecustomertext,
                    '#', array(
                        'onclick' => '$("#update-customer-dialog").dialog("open"); return false;',
                    ));
                ?>
            </div>
            <?php
            $this->beginWidget('zii.widgets.jui.CJuiDialog', array(
                'id' => 'update-customer-dialog',
                // additional javascript options for the dialog plugin
                'options' => array(
                    'title' => 'Update Customer',
                    'autoOpen' => false,
                    'resizable' => false,
                    'modal' => 'true',
                    'width' => '60%',
                ),
            ));
            $this->renderPartial('/customer/updatecustomerfromservicecall', array('model' => $customerModel));
            $this->endWidget('zii.widgets.jui.CJuiDialog');
            // the link that may open the dialog
            ?>

            <div class="customerbox contentbox">
                <table style="margin: 5px;">
                    <tr>
                        <th style="width:50%;"></th>
                        <th style="width:50%;  text-align: right;"></th>
                    </tr>
                    <tr>
                        <td>
                            <h4><?php echo $model->customer->title . ' ' . $model->customer->fullname; ?></h4>
                             
                            <div>
                                <?php
                                echo Setup::model()->formataddressinhtml($model->customer->address_line_1, $model->customer->address_line_2, $model->customer->address_line_3, $model->customer->town, $model->customer->postcode);
                                ?>
                            </div>
                             <br>
                            <table>
                                <tr>
                                    <td><span
                                            class="datacontenttitle"><?php echo $model->getAttributeLabel('customer.mobile'); ?></span>
                                    </td>
                                    <td><?php echo '' . $model->customer->mobile; ?></td>
                                </tr>
                                <tr>
                                    <td><span
                                            class="datacontenttitle"><?php echo $model->getAttributeLabel('customer.telephone'); ?></span>
                                    </td>
                                    <td><?php echo '' . $model->customer->telephone; ?></td>
                                </tr>
                                <tr>
                                    <td><span
                                            class="datacontenttitle"><?php echo $model->getAttributeLabel('customer.fax'); ?></span>
                                    </td>
                                    <td><?php echo '' . $model->customer->fax; ?></td>
                                </tr>
                                <tr>
                                    <td><span
                                            class="datacontenttitle"><?php echo $model->getAttributeLabel('customer.email'); ?></span>
                                    </td>
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
    							echo CHtml::link('<h4><i class="fa fa-sticky-note-o" title="Product Notes" aria-hidden="true"></i></h4>',
										'#', array(
											'onclick' => '$("#update-customer-dialog").dialog("open"); return false;',
										));
    							?>
                                <?php echo Setup::model()->printjsonnotesorcommentsinhtml($model->customer->notes); ?>
                          


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

            <div class="productheadingbox contentbox" id="productbox">

                <?php
                $updateproducttext = "<h4 style='color: white;'><i class='fa fa-archive'></i>&nbsp;&nbsp;Product <div style='float:right'><i class='fa fa-pencil-square-o'></i></div></h4>";

                echo CHtml::link($updateproducttext,
                    '#', array(
                        'onclick' => '$("#update-product-dialog").dialog("open"); return false;',
                    ));
                ?>
            </div>
            <?php
            $this->beginWidget('zii.widgets.jui.CJuiDialog', array(
                'id' => 'update-product-dialog',
                // additional javascript options for the dialog plugin
                'options' => array(
                    'title' => 'Update Product',
                    'autoOpen' => false,
                    'resizable' => false,
                    'modal' => 'true',
                    'width' => '60%',
                ),
            ));
            $this->renderPartial('/product/updateproductfromservicecall', array('productModel' => $productModel));
            $this->endWidget('zii.widgets.jui.CJuiDialog');
            // the link that may open the dialog
            ?>

            <div class="productbox contentbox" id="productbox">
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
                                            class="datacontenttitle"><?php echo $productModel->getAttributeLabel('product.contact'); ?></span>
                                    <td><?php echo '' . $productModel->contract->name; ?></td>
                                </tr>
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
    							echo CHtml::link('<h4><i class="fa fa-sticky-note-o" title="Product Notes" aria-hidden="true"></i></h4>',
										'#', array(
											'onclick' => '$("#update-product-dialog").dialog("open"); return false;',
										));
    							?>
    
                                
	
                                <?php echo Setup::model()->printjsonnotesorcommentsinhtml($productModel->notes); ?>
                                
                            </div>
                        </td>
                    </tr>
                </table>
            </div>
        </td>
    </tr>
    <!-- Product Details End-->
    <!-- Previous Servicecalls Start-->
    <tr>
        <td colspan="2">
            <div class="customerheadingbox contentbox" id='previousservicecalls'>
                	
                         
                            <?php

                            Yii::app()->clientScript->registerScript('prevserivicecalls', "
                                        $('#previous-servicecalls-button').click(function(){
	                                    $('#previous-servicecalls-div').toggle();
	                                    return false;
                                        });
                                ");

                            ?>
                            <?php $prevserviceallastitle = "<h4 style='color: white;'><i class='fa fa-history'></i>&nbsp;&nbsp; Previous Services <div style='color: white; float:right;'><i class='fa fa-toggle-on'></i> </div></h4>"; ?>
                            <?php echo CHtml::link($prevserviceallastitle, '#', array('id' => 'previous-servicecalls-button', 'style'=>'color:white;')); ?>
                        
                        
                        
            </div>
            <div class="customerdatabox">
                <div id="previous-servicecalls-div" style="display:block">


                    <table>
                        <tr>
                            <th><span class="datacontenttitle">Service Ref#</span></th>
                            <th><span class="datacontenttitle">Product</span></th>
                            <th><span class="datacontenttitle">Reported Date</span></th>
                            <th><span class="datacontenttitle">Fault Description</span></th>
                            <th><span class="datacontenttitle">Engineer Visited</span></th>
                            <th><span class="datacontenttitle">Job Status</span></th>
                        </tr>
                        <?php $previousCalls = $model->previousCalls($model->customer_id);
                        foreach ($previousCalls as $data) {
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
                </div><!-- previous-servicecalls -div -->

            </div>
        </td>
    </tr>
    <!-- Previous Servicecalls End-->


    <!--  Previous Uplifts START-->
    <tr>
        <td colspan="2">
            <div class="customerheadingbox contentbox">
                <h4><i class="fa fa-history" aria-hidden="true"></i>
                    Previous Uplifts</h4>
            </div>
            <div class="customerdatabox">
                <?php
                $uplifts = Uplifts::model()->findAllByAttributes(array('customer_id' => $model->customer->id));
                ?>
                <table>
                    <tr>
                        <th class="datacontenttitle" style="width:15%;">Uplift No.#</th>
                        <th class="datacontenttitle" style="width:15%;">Product</th>
                        <th class="datacontenttitle" style="width:20%;">Serial Number</th>
                        <th class="datacontenttitle" style="width:45%;">Reason</th>
                    </tr>
                    <?php foreach ($uplifts as $uplift) { ?>
                        <tr>
                            <td><?php echo CHtml::link($uplift->uplift_number, array('uplifts/manage/view', 'id' => $uplift->id)); ?></td>
                            <td><?php echo $uplift->product->productType->name; ?></td>
                            <td><?php echo $uplift->serial_number;

                                if ($uplift->product_id == $model->product_id)
                                    echo "</br><small style='color: #f89406;'><b> This Servicecall Product</b></small>";

                                ?>

                            </td>
                            <td><?php echo $uplift->reason_for_uplift; ?></td>
                        </tr>
                    <?php }
                    ?>
                </table>

            </div>
        </td>
    </tr>
    <!--  Previous Uplifts End-->


    <!-- Service Details Start-->
    <tr>
        <td colspan="2">
            <div class="serviceheadingbox contentbox" id="service-details">

               

                            <?php
                            $updateproducttext = "<h4 style='color: white;'><i class='fa fa-wrench'></i>&nbsp;&nbsp;Service Details<div style='float:right'><i class='fa fa-pencil-square-o'></i></div></h4>";
                            echo CHtml::link($updateproducttext,
                                '#', array(
                                    'onclick' => '$("#update-servicelcall-dialog").dialog("open"); return false;',
                                ));
                            ?>
                            <?php
                            
                            if (isset($_GET['openservicedialog']))
                            	$autoopenservice=true; 
                            else
                            	$autoopenservice=false;
                            
                            
                            
                            $this->beginWidget('zii.widgets.jui.CJuiDialog', array(
                                'id' => 'update-servicelcall-dialog',
                                // additional javascript options for the dialog plugin
                                'options' => array(
                                    'title' => 'Update Servicecall',
                                    'autoOpen' => $autoopenservice,
                                    'resizable' => false,
                                    'modal' => 'true',
                                    'width' => '60%',
                                ),
                            ));
                            $this->renderPartial('/servicecall/updateservicecalldialog');
                            $this->endWidget('zii.widgets.jui.CJuiDialog');
                            // the link that may open the dialog
                            ?>

                         
            </div>


            <div class="servicebox contentbox">

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
                    <span class="datacontenttitle">
                        <?php echo $model->getAttributeLabel('fault_description'); ?>
                    </span>
                    <br>
                    <?php echo $model->fault_description; ?>
                </div>

                <table>
                    <tr>
                        <th style="width: 50%"></th>
                        <th style="width: 50%"></th>
                    </tr>
                    <tr>
                        <td>
                            <table>

                                <!--
                                <tr>
                                    <td>
                                        <span class="datacontenttitle">
                                            <?php echo $model->getAttributeLabel('Servicecall.contract'); ?>
                                        </span>
                                    </td>
                                    <td> <?php echo $model->contract->name; ?></td>
                                </tr>

                                <tr>
                                    <td>
                                        <span class="datacontenttitle">
                                            <?php echo $model->getAttributeLabel('insurer_reference_number'); ?>
                                        </span>
                                    </td>
                                    <td><?php echo $model->insurer_reference_number; ?></td>
                                </tr>
                                -->
                                <tr>
                                    <td colspan="2">
                                        <span class="datacontenttitle">
                                            <?php echo $model->getAttributeLabel('work_carried_out'); ?>
                                        </span><br>
                                        <?php echo $model->work_carried_out; ?></td>
                                </tr>

                            </table>
                        </td>
                        <td>
                            <table style="width: 90%">
                                <tr>
                                    <td><span class="datacontenttitle">
                                            <?php echo $model->getAttributeLabel('fault_date'); ?>
                                        </span>
                                    </td>
                                    <td>
                                        <?php echo Setup::model()->formatdate($model->fault_date); ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td><span class="datacontenttitle">
                                            <?php echo $model->getAttributeLabel('engg_first_visit_date'); ?>
                                        </span>
                                    </td>
                                    <td>
                                        <?php //echo $model->engg_first_visit_date; ?>
                                        <?php echo Setup::model()->formatdate($model->engg_first_visit_date); ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td><span class="datacontenttitle">
                                            <?php echo $model->getAttributeLabel('job_finished_date'); ?>
                                        </span>
                                    </td>
                                    <td>
                                        <?php //echo $model->job_finished_date; ?>
                                        <?php echo Setup::model()->formatdate($model->job_finished_date); ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td><span class="datacontenttitle">
                                            <?php echo $model->getAttributeLabel('engg_claim_returned_date'); ?>
                                        </span>
                                    </td>
                                    <td>
                                        <?php //echo $model->engg_claim_returned_date; ?>
                                        <?php echo Setup::model()->formatdate($model->engg_claim_returned_date); ?>
                                    </td>
                                </tr>

                                <tr>
                                    <td><span class="datacontenttitle">
                                            <?php echo $model->getAttributeLabel('job_payment_date'); ?>
                                        </span>
                                    </td>
                                    <td>
                                        <?php //echo $model->job_payment_date; ?>
                                        <?php echo Setup::model()->formatdate($model->job_payment_date); ?>
                                    </td>
                                </tr>
                            </table>


                        </td>
                    </tr>
                </table>


                <div>
                    <span class="datacontenttitle"><?php echo $model->getAttributeLabel('work_summary'); ?></span>
                    <?php echo $model->work_summary; ?>
                </div>


                <br>
                <div>
                    <span class="datacontenttitle"><?php echo $model->getAttributeLabel('notes'); ?></span>
                    <br>
                    <?php echo $model->notes; ?>
                </div>

        </td>
    </tr>
    <!-- Service Details End-->


    <!-- Spares Used -->
    <tr>
        <td colspan="2">
            <div class="sparesheadingbox contentbox" id="sparesbox">
		 	<h4 style='color: white;'>
					  <?php
						$updateproducttext = "<span style='color: white;'><i class='fa fa-cogs'></i>&nbsp;&nbsp;Spares</span>";
						echo CHtml::link($updateproducttext,
							'#', array(
								'onclick' => '$("#add-spares-dialog").dialog("open"); return false;',
							));
						?>
						<?php
						$this->beginWidget('zii.widgets.jui.CJuiDialog', array(
							'id' => 'add-spares-dialog',
							// additional javascript options for the dialog plugin
							'options' => array(
								'title' => 'Add Spares',
								'autoOpen' => false,
								'resizable' => false,
								'modal' => 'true',
								'width' => '30%',
							),
						));

						$this->renderPartial('/sparesUsed/addSpares', array('service_id' => $model->id));
						$this->endWidget('zii.widgets.jui.CJuiDialog');
						// the link that may open the dialog
						?>
					<div class="right">
                	<?php
					    $printspares='<i title="Print Spares Order" style="color: white" class="fa fa-print" aria-hidden="true"></i>';
		                echo CHtml::link($printspares,array('sparesUsed/GenerateSparesOrderFormPdf', 'service_id'=>$model->id), array('target'=>'_blank'));
                	?>
                	&nbsp;&nbsp;&nbsp;
			        <?php
					    $addsparestext = "<span style='color: white;'><i class='fa fa-plus-square-o'></i></span>";
						echo CHtml::link($addsparestext,
							'#', array(
								'onclick' => '$("#add-spares-dialog").dialog("open"); return false;',
							));
                	?>
                	
                	</div>
  				</h4>
            </div>
            
            <div class="sparesrbox contentbox">


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
                            <th><span class="datacontenttitle">Date Ordered Poland</span></th>
                            <th><span class="datacontenttitle">Date Posted</span></th>
                            <th><span class="datacontenttitle">Quantity</span></th>
                            <th><span class="datacontenttitle">Unit Price</span></th>
                            <th><span class="datacontenttitle">Total Price</span></th>
                            <th><span class="datacontenttitle"></span></th>
                            <th><span class="datacontenttitle"></span></th>

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
                                <td style="width: 100px;">
                                    <?php
                                    if (!empty($data->date_ordered)) {
                                        echo date('d-M-Y', $data->date_ordered);
                                    }
                                    ?>
                                </td>
                                <td style="width: 100px;">
                                    <?php
                                    if (!empty($data->date_ordered_from_manufacturer)) {
                                        echo date('d-M-Y', $data->date_ordered_from_manufacturer);
                                    }
                                    ?>
                                </td>
                                <td style="width: 100px;">
                                    <?php
                                    if (!empty($data->date_posted)) {
                                        echo date('d-M-Y', $data->date_posted);
                                    }
                                    ?>
                                </td>
                                <td><?php echo $data->quantity; ?></td>
                                <td><?php echo $data->unit_price; ?></td>
                                <td><?php echo $data->total_price; ?></td>
                                <td>

                                    <?php echo CHtml::link('<i title="Delete" class="fa fa-trash" aria-hidden="true"></i>', array('sparesUsed/delete', 'id' => $data->id, 'servicecall_id' => $model->id)); ?>

                                </td>

                                <td>

                                    <?php echo CHtml::link('<i title="Edit" class="fa fa-pencil-square-o" aria-hidden="true"></i>', array('sparesUsed/updateSpares', 'spares_id' => $data->id, 'servicecall_id' => $model->id)); ?>

                                </td>
                            </tr>
                            <tr>
                            	<td colspan='10'>
                            	<small>
		                           	<i title="Parts specific Notes" class="fa fa-sticky-note-o" aria-hidden="true"></i>
                            		<?php echo $data->notes; ?>
                            	</small>
                            	<br>
                            	</td>
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
                    <br>
                  	 	
                  	 	<?php
                  	 	echo CHtml::link('<i class="fa fa-sticky-note-o" aria-hidden="true"></i>',
							'#', array(
								'onclick' => '$("#update-servicelcall-dialog").dialog("open"); return false;',
							));
                  	 	?>
                     	<?php echo $model->spares_notes; ?>
                   

                </div>
            </div><!-- end of customerdatabox-->
        </td>
    </tr>
    <!-- Spares Used End-->


    <!-- Invoice Start-->
    <tr>
        <td colspan="2">
            <div class="costinvoiceheadingbox contentbox" id="costs">


                <?php

 
                $coststext = "<h4 style='color: white;'><i class='fa fa-money'></i>&nbsp;&nbsp;Costs <div style='float:right'><i class='fa fa-pencil-square-o'></i></div></h4>";

                echo CHtml::link($coststext,
                    '#', array(
                        'onclick' => '$("#update-servicelcall-dialog").dialog("open"); return false;',
                    ));
                ?>


            </div>
            <div class="costinvoicebox contentbox">
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


    <!-- GO mobible View-->
    <tr>
        <td colspan="2">
            <div class="customerheadingbox contentbox" id="enggreporting">
				<?php
					Yii::app()->clientScript->registerScript('workdoneboxgtext-div', "
							$('#workdonebox-button').click(function(){
							$('#workdonebox-div').toggle();
							return false;
							});
							");
				?>

				<?php $workdoneboxgtext = "<h4 style='color: white;' id='workdonebox'> <i class='fa fa-briefcase'></i>&nbsp;&nbsp;Reported By Engineer <div style='float:right'> <i class='fa fa-toggle-on'></i></div><h4>"; ?>
				<?php echo CHtml::link($workdoneboxgtext, '#', array('id' => 'workdonebox-button')); ?>
			 
            </div>

			<div id="workdonebox-div">
            <?php
            ///Loading view from Go Mobile
            $gmserviceid = Gmservicecalls::model()->getgomobileidbyservicecallid($service_id);
            if ($gmserviceid != null || $gmserviceid != "" || $gmserviceid != false)
                $this->renderPartial('gomobile.views.gmservicecalls.view');
            else
                echo "<div class='alert'><h4>No Work has been reported by Engineer yet</h4></div>"
            ?>
            </div>
            
        </td>
    </tr>

    <!-- GO mobible View-->


    <!-- Activity Log Start-->
    <tr>
        <td colspan="2">
            <div class="customerheadingbox contentbox">
           
                            <?php

                            Yii::app()->clientScript->registerScript('activitylog-div', "
                                        $('#activitylog-button').click(function(){
	                                    $('#activitylog-div').toggle();
	                                    return false;
                                        });
                                ");
                            ?>


                            <?php $activitylogtext = "<h4 style='color: white;' id='activilitylogdivbutton'><i class='fa fa-code-fork'></i>&nbsp;&nbsp;Activity Log <div style='float:right;'><i class='fa fa-toggle-on'></i></div> <h4>"; ?>
                            <?php echo CHtml::link($activitylogtext, '#', array('id' => 'activitylog-button')); ?>

                 
            </div>
            <div class="customerdatabox" id="activitylog">
                <div id="activitylog-div" style="display:none">
                    <?php $activity_array = json_decode($model->activity_log, true); ?>
                    <?php if (count($activity_array) > 0): ?>
                         
                        <table>
                            <tr>
                                <th><span class="datacontenttitle">Activity Date</span></th>
                                <th><span class="datacontenttitle">Status</span></th>
                                <th><span class="datacontenttitle">User</span></th>
                                <th><span class="datacontenttitle">Engineer</span></th>
                            </tr>
                            <?php foreach ($activity_array as $ac): ?>
                                <tr>
                                    <td><?php echo $ac['time']; ?></td>
                                    <td><?php echo $ac['jobstatus']; ?></td>
                                    <td><?php echo $ac['user']; ?></td>
                                    <td><?php echo $ac['engineer']; ?></td>

                                </tr>
                            <?php endforeach; ?>
                        </table>
                    <?php endif; ?>
                </div>
            </div>
        </td>
    </tr>
    <!-- Activity Log  End-->


</table>



