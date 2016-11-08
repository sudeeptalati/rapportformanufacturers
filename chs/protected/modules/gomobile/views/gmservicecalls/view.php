<?php
/* @var $this GmServicecallsController */
/* @var $model GmServicecalls */

//include('gomobile_menu.php');


$servicecall_id=$_GET['id'];
$gomobile_id=Gmservicecalls::model()->getgomobileidbyservicecallid($servicecall_id);

$model=Gmservicecalls::model()->findByPk($gomobile_id);
$system_message = '';



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

    <!--
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

    -->
    <!-- Work Carried Out Start -->

    <tr>
        <td>

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
                                   	<?php
									 $updateproducttext = "<span><i class='fa fa-pencil-square-o'></i></span>";
									echo CHtml::link($updateproducttext,
										'#', array(
											'onclick' => '$("#update-product-dialog").dialog("open"); return false;',
										));
									?>
 
 
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
                            <div class="datacontenttitle">Work Carried Out</div>
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
                                    //$payment_date = time() + 2592000;///we just add 1 month as they are paid next month
									$payment_date = '';///we just add 1 month as they are paid next month
								else
									$payment_date=date('d-M-Y',$model->servicecall->job_payment_date);
								 		
										
								?>
                                
                                <?php echo CHtml::textField('job_payment_date', $payment_date, array('id'=>'job_payment_date','readonly'=>'readonly')); ?>
                            </td>
                            <td>
                                <div class="datacontenttitle">Reason</div>
                                <?php echo CHtml::textArea('chat_message', '', array("style" => "width:300px; height: 100px")) ?>
                                <div class="errorMessage" id="chat_message_error"></div>
                            </td>
                            <td>
                        	    <?php $imghtml = CHtml::image($model->getportalurl() . '/images/chaticon.png', '', array("style" => "width:50px; height: 50px")); ?>
								<?php echo CHtml::link($imghtml, '#', array('class' => 'chat-button')); ?>
                            </td>
                        </tr>
                        <?php if ($model->servicecall->job_status_id<100): ?>
							<tr>
								<td>
									<div class="row submit">
										<?php echo CHtml::submitButton('Approve',array('class'=>'btn btn-success')); ?>
									</div>
								</td>
								<td>
									<?php echo CHtml::button("Reject", array('title' => "Reject", 'onclick' => 'js:rejectthisclaim();', 'class'=>'btn btn-danger' )); ?>
									&nbsp;&nbsp;&nbsp;
									<?php echo CHtml::button("Need More Info", array('title' => "Need More Info", 'onclick' => 'js:needmoreinfothisclaim();', 'class'=>'btn btn-warning' )); ?>
									&nbsp;&nbsp;&nbsp;
									<?php echo CHtml::button("Cancel", array('title' => "Cancel", 'onclick' => 'js:cancelthisclaim();', 'class'=>'btn btn-info' )); ?>
									
								</td>
								<td>
								</td>
							</tr>
                        <?php endif; ///if ($model->servicecall->job_status_id<100): ?>

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
            <table  style="margin-bottom:0px;">
                <tr>
                    <td><h4>Communication for this Job</h4>
                    </td>
                    <td>X</td>
                </tr>
            </table>
        </div>
        
        <table style="margin-bottom:0px;">
            <tr>
                <td style="width: 80%">
                    <?php $bgcolor=$model->jobstatus->backgroundcolor;?>
                    <div style="border-radius: 10px;padding: 5px 5px 5px 30px;color:white; background-color:<?php echo $bgcolor;?> ">
                        <?php echo $model->jobstatus->name;?>
                    </div>
                    <small title="Last Modified"  style="float: right;">
                    	<b><i class="fa fa-clock-o" aria-hidden="true"></i></b>&nbsp;&nbsp;<?php echo Setup::model()->formatdatewithtime($model->modified); ?>
                	</small>
                    </td>
                <td style="width: 20%">
                    <?php if($model->server_status_id=='38'): //38 msg is unread ?>
                        <div class="">
                            <?php $msgread='<i style title="Mark message as Unread" class="fa fa-  fa-inbox fa-2x" aria-hidden="true"></i>';?>
                            <?php echo CHtml::link($msgread,array('gomobile/gmservicecalls/markservermessageasunread', 'gmservicecall_id'=>$gomobile_id, 'servicecall_id'=>$servicecall_id)); ?>
                        </div>
                    <?php else: ?>
                        <div class="">
                            <?php $msgread='<i title="Move to Archive" class="fa fa- fa-stack-overflow fa-2x" aria-hidden="true"></i>';?>
                            <?php echo CHtml::link($msgread,array('gomobile/gmservicecalls/markservermessageasread', 'gmservicecall_id'=>$gomobile_id, 'servicecall_id'=>$servicecall_id)); ?>
                        </div>
                    <?php endif; ///end of if($model->server_status_id=='38'): ?>
                </td>

            </tr>
        </table>
        
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


<script type="text/javascript">//<![CDATA[


    function rejectthisclaim() {
		if (validatereasonbox()) {
           	rejecturl= 'index.php?r=gomobile/gmservicecalls/rejectthisclaim';	
            performajaxaction(rejecturl);
        }
    }//end of function rejectthisclaim
    
    
    function needmoreinfothisclaim()
    {
    	if (validatereasonbox()) {
           	moreinfo_url= 'index.php?r=gomobile/gmservicecalls/needmoreinfoonthisclaim';
            performajaxaction(moreinfo_url);
        }
    }///end of function needmoreinfothisclaim
    
    function cancelthisclaim()
    {
    	if (validatereasonbox()) {
    	
	    	if (confirm("Are you sure you want to cancel this job and close it?") == true) {
  
        	   cancelthisclaim_url= 'index.php?r=gomobile/gmservicecalls/cancelthisclaim';
    	       performajaxaction(cancelthisclaim_url);
			  return true;
  
  			} else {
			  return false;
  			}///end of if else     	if (confirm("Are you sure you want to cancel this job. This action will close the job.") == true) {
  
  
    	}//end of 	if (validatereasonbox()) {
    
    }///end of function needmoreinfothisclaim
    

	function performajaxaction(action_url)
	{
			console.log('performajaxaction '+action_url);
			
			gomobile_id = '<?php echo $model->id; ?>';
			reason= document.getElementById("chat_message").value;
            
            $.ajax({
                url: action_url,
                type: 'post',
                data: {'chat_msg': reason, 'gomobile_id': gomobile_id},
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


    
    
    function validatereasonbox()
    {
        var chat_msg = document.getElementById("chat_message").value; //the reason box id is chat_message

        if (chat_msg == '' || chat_msg == null) {
            document.getElementById("chat_message").style.backgroundColor = "#FEEEEE";
            document.getElementById("chat_message_error").innerHTML = 'Please input some reason';
            document.getElementById("chat_message_error").style.color = "#C00000";
            //alert('Please specify the reason');
           return false
        }
        else {
        	return true;
        }
        
    }//end of    function validatereasonbox()
    
    




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
    
    
    
    var job_payment_date = new Pikaday(
        {
            numberOfMonths: 3,
            field: document.getElementById('job_payment_date'),

        });
    
    
   
var objDiv = document.getElementById("chat_text");
objDiv.scrollTop = objDiv.scrollHeight;
    
    
</script>



