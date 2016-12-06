<?php
/* @var $this GmServicecallsController */
/* @var $model GmServicecalls */

include('gomobile_menu.php');
?>
<script type="text/javascript">
    $(document).ready(function () {
        $('#system_message').delay(60000).fadeOut();
    });
</script>


<?php $recieveddata = json_decode($model->data_recieved, true); ?>
<?php $gomobile_server_url = Gmservicecalls::model()->getserverurl(); ?>

<?php if ($system_message != ''): ?>
    <div class="system_message" id="system_message">
        <?php echo $system_message; ?>
    </div>
<?php endif; ///end of if ($system_message!=''):?>

<table>
    <tr>
        <td style="text-align:center">
            <h2>Review Service Call #
                <span style="color:green">
                    <?php echo CHtml::link($model->servicecall->service_reference_number, array('/Servicecall/view', 'id' => $model->servicecall->id)); ?>
                </span>
            </h2>

            <div class="jobstatus"><?php echo $model->jobstatus->html_name; ?></div>
        </td>
    </tr>

    <!-- Customer & Product Details Start -->
    <tr>
        <td>
            <div class="customerheadingbox">
                <h4>Customer & Product</h4>
            </div>
            <div class="customerdatabox">

                <table style="margin: 5px;">
                    <tr>
                        <th style="width:50%;">
                        </th>
                        <th style="width:50%; ">
                        </th>
                    </tr>
                    <tr>
                        <td>
                            <?php echo $model->servicecall->customer->title . ' ' . $model->servicecall->customer->fullname; ?>
                            <br>
                            <div class="address_contact">
                                <?php
                                echo Setup::model()->formataddressinhtml($model->servicecall->customer->address_line_1, $model->servicecall->customer->address_line_2, $model->servicecall->customer->address_line_3, $model->servicecall->customer->town, $model->servicecall->customer->postcode_s . " " . $model->servicecall->customer->postcode_e);
                                ?>
                            </div>
                            <div><span
                                    class="datacontenttitle">Mobile:</span><?php echo '' . $model->servicecall->customer->mobile; ?>
                            </div>
                            <div><span
                                    class="datacontenttitle">Telephone:</span><?php echo '' . $model->servicecall->customer->telephone; ?>
                            </div>


                            <div><span
                                    class="datacontenttitle">Email:</span><?php echo '' . $model->servicecall->customer->email; ?>
                            </div>
                            <br>
                            <div><span
                                    class="datacontenttitle">Customer Notes:</span>
                                <br>
                                <span class="notes"><?php echo '' . $model->servicecall->customer->notes; ?></span>
                            </div>

                        </td>
                        <td>

                            <div><span
                                    class="datacontenttitle">Brand:</span><?php echo '' . $model->servicecall->product->brand->name; ?>
                            </div>

                            <div><span
                                    class="datacontenttitle">Product Type:</span><?php echo '' . $model->servicecall->product->productType->name; ?>
                            </div>

                            <div><span
                                    class="datacontenttitle"><?php echo $model->servicecall->product->getAttributeLabel('product.model_number'); ?></span>
                                    <?php echo '  ' . $model->servicecall->product->model_number; ?>
                            </div>

                            <br>



                            <div>
                                <span
                                    class="datacontenttitle"><?php echo $model->servicecall->product->getAttributeLabel('purchased_from'); ?></span>
                                <?php echo '' . $model->servicecall->product->purchased_from; ?>
                            </div>

                            <div>
                                <span
                                    class="datacontenttitle"><?php echo $model->servicecall->product->getAttributeLabel('purchase_date'); ?></span>
                                <?php echo Setup::model()->formatdate($model->servicecall->product->purchase_date); ?>
                            </div>

                            <div>
                                <span
                                    class="datacontenttitle"><?php echo $model->servicecall->product->getAttributeLabel('warranty_date'); ?></span>
                                <?php echo Setup::model()->formatdate($model->servicecall->product->warranty_date); ?>
                            </div>

                            <div>
                                <span
                                    class="datacontenttitle"><?php echo $model->servicecall->product->getAttributeLabel('warranty_until'); ?></span>
                                <?php
                                if (!empty($model->servicecall->product->warranty_date) && !empty($model->servicecall->product->warranty_for_months))
                                    echo Setup::model()->addmonthstodate($model->servicecall->product->warranty_date, $model->servicecall->product->warranty_for_months);
                                ?>
                            </div>
                            <br>
                            
                            
                            <div><span
                                    class="datacontenttitle">Product Notes:</span>
                                <br>
                                <span class="notes"><?php echo '' . $model->servicecall->product->notes; ?></span>
                            </div>


                        </td>
                    </tr>
                </table>
            </div>
        </td>
    </tr>
    <!-- Customer & Product Details End -->

    <!-- Service Details Start -->
    <tr>
        <td>
            <div class="customerheadingbox">
                <h4>Service Details</h4>
            </div>

            <div class="customerdatabox">
                <br>
                <div>
                    <span class="datacontenttitle">Contract</span>
                    <?php echo $model->servicecall->contract->name; ?>
                </div>


                <div>
                <span class="datacontenttitle">
                    <?php echo $model->servicecall->getAttributeLabel('insurer_reference_number'); ?>
                </span>
                    <?php echo $model->servicecall->insurer_reference_number; ?>
                </div>

                <br>
                <div>
                <span
                    class="datacontenttitle">
                    <?php echo $model->servicecall->getAttributeLabel('fault_date'); ?>
                </span>
                    <?php echo Setup::model()->formatdate($model->servicecall->fault_date); ?>
                </div>

                <div>
                <span
                    class="datacontenttitle">
                    <?php echo $model->servicecall->getAttributeLabel('fault_code'); ?>
                </span>
                    <?php echo $model->servicecall->fault_code; ?>
                </div>

                <br>
                <div>
                <span
                    class="datacontenttitle">
                    <?php echo $model->servicecall->getAttributeLabel('fault_description'); ?>
                </span>
                    <br>
                    <?php echo $model->servicecall->fault_description; ?>
                </div>
                <br>
            </div>

        </td>
    </tr>
    <!-- Service Details End-->

    <!-- Work Carried Out Start -->

    <tr>
        <td>
            <div id="workcarriedout" class="customerheadingbox">
                <h4>Work Carried Out</h4>
            </div>

            <div class="customerdatabox">

                <table style="margin: 5px;">
                    <tr>
                        <th style="width:50%;">
	                        <?php echo $model->servicecall->engineer->company; ?>
                        </th>
                        <th style="width:50%; ">
                        </th>
                    </tr>
                    <tr>
                        <td>
                            <div>
                                <span class="datacontenttitle">Serial Number:</span>
                                <span  style="font-size:18px"> <?php echo '' . $model->servicecall->product->serial_number; ?> (In Records) </span>
                            </div>

                            <div class="recieveddata">
                                <?php if ($recieveddata['product_serial_number_available'] == '1'): ?>
                                    <span class="datacontenttitle">Serial Number:</span>
                                    	 <span  style="font-size:18px"><?php echo $recieveddata['product_serial_number']; ?></span>
                                <?php else: ?>
                                    <?php echo '' . $recieveddata['product_serial_number_unavailable_reason']; ?>
                                <?php endif; ?>
                            </div>

                            <br>
                            <div class="datacontenttitle">Work Done</div>
                            <div class="recieveddata">
                                <?php echo '' . $recieveddata['work_done']; ?>
                            </div>
                            <br>



							<table>
								<tr>
									<td><span class="datacontenttitle"><?php echo $model->servicecall->getAttributeLabel('fault_date'); ?></span></td>
									<td><span class="recieveddata"><?php echo Setup::model()->formatdate($model->servicecall->fault_date); ?></span>
									</td>
								</tr>
								<tr>
									<td><span class="datacontenttitle"><?php echo $model->servicecall->getAttributeLabel('engg_first_visit_date'); ?></span></td>
									<td><span class="recieveddata"><?php echo '' . $recieveddata['first_visit_date']; ?></span>
									</td>
								</tr>
								<tr>
									<td><span class="datacontenttitle"><?php echo $model->servicecall->getAttributeLabel('job_finished_date'); ?></span></td>
									<td><span class="recieveddata"><?php echo '' . $recieveddata['job_completion_date']; ?></span>
									</td>
								</tr>
								<tr>
									<td><span class="datacontenttitle"><?php echo $model->servicecall->getAttributeLabel('engg_claim_returned_date'); ?></span></td>
									<td><span class="recieveddata"><?php echo '' . $recieveddata['submission_date']; ?></span>
									</td>
								</tr>
								 
							</table>


							<!--
                            <div>
                                    <span
                                        class="datacontenttitle"><?php echo $model->servicecall->getAttributeLabel('job_finished_date'); ?></span>
                                 <span class="recieveddata">
                                    <?php echo '' . $recieveddata['job_completion_date']; ?>
                                </span>
                            </div>

                            <div>
                                    <span
                                        class="datacontenttitle"><?php echo $model->servicecall->getAttributeLabel('engg_claim_returned_date'); ?></span>
                                 <span class="recieveddata">
                                    <?php echo '' . $recieveddata['submission_date']; ?>
                                </span>
                            </div>


                            <div>
                                    <span
                                        class="datacontenttitle"><?php echo $model->getAttributeLabel('created'); ?></span>
                               		 <?php echo Setup::model()->formatdatewithtime($model->created); ?>

                            </div>

							-->
							
							
                        </td>
                        <td>
                            <?php //echo $recieveddata['product_plating_image_url']; ?>
                            <?php $recieved_img_url=$model->getportalurl() . $recieveddata['product_plating_image_url']; ?>

                            <a class="image-popup-vertical-fit" id="img_preview_a_tag"  href="<?php echo $recieved_img_url.'?'.time(); ?>" title="Product Image">
                                <img style='width:25%;' id="img_preview" src="<?php echo $recieved_img_url.'?'.time(); ?>" >
                            </a>


                            <!--
                            <img style='width:25%;' id="img_preview" src="<?php echo $model->getportalurl() . $recieveddata['product_plating_image_url']; ?>">
                            -->

                        </td>
                    </tr>
                </table>
                <hr>


                <div class="recieveddata">
                    <span class="datacontenttitle">Spares Used:</span>
                    <?php if ($recieveddata['spares_used'] == '1'): ?>
                        <?php echo 'Yes' ?>
                    <?php else: ?>
                        <?php echo 'No'; ?>
                    <?php endif; ?>
                </div>

                <br>
                <div class="form">
                    <?php $form = $this->beginWidget('CActiveForm', array(
                        'id' => 'Engineerdata-form',
                        'action' => Yii::app()->createUrl('gomobile/gmservicecalls/approvetheclaim'),
                    ));


                    ?>
                    <?php $sparesusedarray = json_decode($recieveddata['spares_array'], true); ?>
                    <?php echo CHtml::hiddenField('total_spares_entries', count($sparesusedarray["spares"])); ?>
                    <?php echo CHtml::hiddenField('enggdata_gm_id', $model->id); ?>


                    <table style="width: 50%">
                        <tr>
                            <th><span class="datacontenttitle">Part Number/ Name</span></th>
                            <th><span class="datacontenttitle">Qty</span></th>
                            <th><span class="datacontenttitle">Price<span class="required">*</span></span></th>

                        </tr>

                        <?php ////firsr showing spares that are in the records ?>

                        <?php if ($model->servicecall->spares_used_status_id == 1): ?>

                            <?php $sparesModel = SparesUsed::model()->findAllByAttributes(array('servicecall_id' => $model->servicecall->id)); ?>

                            <?php foreach ($sparesModel as $data) { ?>
                                <tr>
                                    <td><?php echo $data->item_name; ?></td>
                                    <td><?php echo $data->quantity; ?></td>
                                    <td><?php echo $data->unit_price; ?></td>
                                </tr>
                            <?php }//end of foreach of spares()?>


                        <?php endif; ///end of if ($model->servicecall->spares_used_status_id == 1):?>

                        <?php
                        ///NOW showing spares used by the engineerr
                        for ($i = 0; $i < count($sparesusedarray["spares"]); $i++) {
                            $sparename_input = 'spare_name' . $i;
                            $spareqty_input = 'spare_qty' . $i;
                            $spareprice_input = 'spare_price' . $i;
                            $importcheckbox = 'importspare' . $i;

                            $s = $sparesusedarray["spares"][$i];

                            ?>
                            <tr>
                                <td class="recieveddata">
                                    <?php echo $s['part_number_or_name']; ?>
                                </td>
                                <td class="recieveddata">
                                    <?php echo $s['qty']; ?>
                                </td>
                                <td class="recieveddata">
                                    <?php //echo $spareprice_input; ?>
                                </td>
                            </tr>
                            <?php
                        }///end of for($i=1;$i<=$enggdata->total_spares_entries;$i++)

                        ?>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <!--
                        <tr>
                            <td></td>
                            <td><span
                                    class="datacontenttitle"><?php echo $model->servicecall->getAttributeLabel('total_cost'); ?></span>
                            </td>
                            <td><?php echo $model->servicecall->total_cost; ?></td>
                        </tr>

                        <tr>
                            <td></td>
                            <td><span
                                    class="datacontenttitle"><?php echo $model->servicecall->getAttributeLabel('vat_on_total'); ?></span>
                            </td>
                            <td><?php echo $model->servicecall->vat_on_total; ?></td>
                        </tr>

                        <tr>
                            <td></td>
                            <td>
                                    <span class="datacontenttitle">
                                        <?php echo $model->servicecall->getAttributeLabel('net_cost'); ?>
                                    </span>
                            </td>
                            <td><?php echo $model->servicecall->net_cost; ?></td>
                        </tr>
                        -->
                    </table>


                    <table>
                        <tr>
                            <td>
                                <div class="datacontenttitle">
                                    <?php echo $model->servicecall->getAttributeLabel('job_payment_date'); ?>
                                </div>
                                <?php
                                if (empty($model->servicecall->job_payment_date))
                                    $model->servicecall->job_payment_date = time() + 2592000;///we just add 1 month as they are paid next month
									 


                                $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                                    'name' => 'job_payment_date',
                                    //'value' => date('d-M-Y', $model->servicecall->job_payment_date),
                                    'value' => '',
                                    // additional javascript options for the date picker plugin
                                    'options' => array(
                                        'showAnim' => 'fold',
                                        'dateFormat' => 'dd-M-yy',
                                    ),
                                    'htmlOptions' => array(
                                        'style' => 'height:20px;'
                                    ),
                                ));


                                ?>
                            </td>
                            <td></td>
                            <td>
                                <div class="datacontenttitle">Reason for Rejection</div>
                                <?php echo CHtml::textArea('chat_message', '') ?>
                                <div class="errorMessage" id="chat_message_error"></div>

                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="row submit">
                                    <?php echo CHtml::submitButton('Approve'); ?>
                                </div>
                            </td>
                            <td>
                                <?php echo CHtml::button("Reject", array('title' => "Reject", 'onclick' => 'js:rejectthisclaim();')); ?>
                            </td>
                            <td>
                                <?php $imghtml = CHtml::image($model->getportalurl() . '/images/chaticon.png', '', array("style" => "width:50px; height: 50px")); ?>
                                <?php echo CHtml::link($imghtml, '#', array('class' => 'chat-button')); ?>
                            </td>
                        </tr>
                    </table>


                    <?php $this->endWidget(); ?>

                </div><!-- form -->
                <!-- END EXPERIMENt-->


            </div><!-- div customerdatabox -->
        </td>
    </tr>
    <!-- Work Carried Out End-->
</table>


<?php
Yii::app()->clientScript->registerScript('chat', "
$('.chat-button').click(function(){
	$('.chat-form').toggle();
    document.getElementById('chat_text').scrollTop=document.getElementById('chat_text').scrollHeight;
    return false;
});
");




Yii::app()->clientScript->registerScript( 'chat_time', "
        $('.person').click(function(){
        $('.chat_time').toggle();
        return false;
       });
 " );



?>
<div class="chat-form" style="display:block">
    <div id="chat_window">
        <div class="chat-button">
            <table>
                <tr>
                    <td><h4>Communication for this Job</h4>
                    </td>
                    <td>X</td>
                </tr>
            </table>
        </div>
        <div id="chat_text">
            <table class="chat_table">
                <tr>
                    <th style="width:15%"></th>
                    <th style="width:70%"></th>
                    <th style="width:15%"></th>
                </tr>

                <?php $fullchatarray = json_decode($model->communications, true); ?>
                <?php if ($fullchatarray): ?>
                    <?php foreach ($fullchatarray['chats'] as $c) { ?>
                        <tr>
                            <?php if ($c['person'] === 'me'): ?>
                                <td></td>
                                <td>
                                    <div id='me_talkbubble'> <?php echo $c['message']; ?></div>
                                </td>
                                <td>
                                    <!--
                                                <div class="person" style="text-align: right"><b><?php echo $c['person']; ?>
                                                        says:</b></div>
                                                -->
                                    <div class="person"><img
                                            src="<?php echo YiiBase::app()->baseUrl; ?>/images/service.gif">
                                    </div>
                                    <div class="chat_time"
                                         style="display:none;font-size: 10px;"> <?php echo $c['date']; ?>
                                        :
                                    </div>
                                </td>
                            <?php else: ?>
                                <td>
                                    <div class="person"><b><?php echo $c['person']; ?> says:</b>
                                        <img style="width: 40px;border-radius: 50%;"
                                             src="<?php echo $model->getportalurl(); ?>/images/amicapic.jpg">
                                    </div>
                                    <div class="chat_time"
                                         style="display:none;font-size: 10px;"><?php echo $c['date']; ?></div>
                                </td>
                                <td>
                                    <div id='amica_talkbubble'><?php echo $c['message']; ?></div>
                                </td>
                                <td></td>

                            <?php endif; ?>
                        </tr>
                    <?php }///end of foreach  ?>
                <?php endif; ///<?php if ($fullchatarray ): ?>
            </table>
        </div><!-- <div class="chat_text">    -->
        <div style="text-align: right;">
            <form name="only_chat_form" id="only_chat_form">
                <?php echo CHtml::textArea('only_chat_message', '', array('style' => 'width:78%;height:50px;')); ?>
                <?php echo CHtml::button("Reply to this Chat", array('title' => "Reply to this Chat", 'onclick' => 'js:replytothecchat();')); ?>
            </form>
        </div>

    </div> <!-- <div id="chat_window"> -->
</div><!--<div class="chat-form" style="display:none">-->


<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script type="text/javascript">//<![CDATA[


    function rejectthisclaim() {
        console.log('Open Chat Window To display reason for rejection');

        var chat_msg = document.getElementById("chat_message").value;

        //chat_msg = chat_msg.replace(/\s+/, "")
       	//chat_msg= chat_msg.trim();

        if (chat_msg == '' || chat_msg == null) {
            document.getElementById("chat_message").style.backgroundColor = "#FEEEEE";
            document.getElementById("chat_message_error").innerHTML = 'Please input some reason for Rejection';
            document.getElementById("chat_message_error").style.color = "#C00000";
            //alert('Please specify the reason');
        }
        else {

            chat_msg;

            gomobile_id = '<?php echo $model->id; ?>';


            $.ajax({
                url: 'index.php?r=gomobile/gmservicecalls/rejecttheclaim',
                type: 'post',
                data: {'chat_msg': chat_msg, 'gomobile_id': gomobile_id},
                success: function (data, status) {

                    console.log(data);
                    alert(data);
                    location.reload();


                },
                error: function (xhr, desc, err) {
                    console.log(xhr);
                    alert("Details: " + desc + "\nError:" + err);
                }
            }); // end ajax call


        }

    }//end of function rejectthisclaim

    function replytothecchat() {
        console.log('Reply to this chat called');

        var only_chat_message = document.getElementById("only_chat_message").value;

        if (only_chat_message == '' || only_chat_message == null) {

            document.getElementById("only_chat_message").style.backgroundColor = "#FEEEEE";
            alert('Please enter some message');

        }///end of if   if (chat_msg == '' || chat_msg == null) {
        else
        {
            gomobile_id = '<?php echo $model->id; ?>';


            $.ajax({
                url: 'index.php?r=gomobile/gmservicecalls/sendchatmessagetoengineer',
                type: 'post',
                data: {'only_chat_message': only_chat_message, 'gomobile_id': gomobile_id},
                success: function (data, status) {

                    console.log(data);
                    alert(data);
                    location.reload();


                },
                error: function (xhr, desc, err) {
                    console.log(xhr);
                    alert("Details: " + desc + "\nError:" + err);
                }
            }); // end ajax call

        }

    }///end of function replytothecchat


</script>



<script src="js/magnificpopup/jquery.magnific-popup.min.js"></script>


<link href="js/magnificpopup/magnific-popup.css" rel="stylesheet" type="text/css">

<script type="text/javascript">

    $(document).ready(function () {
        $('.image-popup-vertical-fit').magnificPopup({
            type: 'image',
            closeOnContentClick: true,
            mainClass: 'mfp-img-mobile',
            image: {
                verticalFit: true
            }
        });
    });

    function showimagepreview(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#img_preview')
                    .attr('src', e.target.result)
                    //    .width('25%')
                    //    .height('25%')
                ;
                $("#img_preview_a_tag").attr("href", e.target.result);
            };
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>



