<h1>Send email</h1>

<?php
 

$emailmodel->email_to=trim($model->engineer->contactDetails->email);
$emailmodel->email_from=$setupmodel->getloggedinuseremail();
$emailmodel->email_subject=$model->service_reference_number.' - '.$model->customer->fullname;

if (isset($system_message))
{
    echo $system_message;
}

?>



<div class="form">
    <?php $form = $this->beginWidget('CActiveForm', array(
        'id' => 'Emailform-form',
        'enableAjaxValidation' => true,
        'clientOptions' => array(
            'validateOnSubmit' => true,
        ),
    ));


    ?>
    <p class="note">Fields with <span class="required">*</span> are required.</p>

    <?php echo $form->errorSummary($emailmodel); ?>

    <div class="emailbox">
        <table style="width: 80%">
            <tr>
                <th style="width:15%"></th>
                <th style="width:85%"></th>
            </tr>
            <tr>
                <td>
                    <?php echo $form->labelEx($emailmodel, 'email_to'); ?>
                </td>
                <td>
                    <?php echo $form->textField($emailmodel, 'email_to', array('style'=>'width:90%')); ?>
                    <?php echo $form->error($emailmodel, 'email_to'); ?>

                </td>
            </tr>

            <tr>
                <td>
                    <?php echo $form->labelEx($emailmodel, 'email_subject'); ?>
                </td>
                <td>
                    <?php echo $form->textField($emailmodel, 'email_subject', array('style'=>'width:90%')); ?>
                    <?php echo $form->error($emailmodel, 'email_subject'); ?>

                </td>
            </tr>

            <tr>
                <td>
                    <label>Attachment</label>
                </td>
                <td>
                    <span class="datacontenttitle">
                        Servicecall Sheet - <?php echo $attachfilename; ?>
                    </span>
                    <?php

                    $previewImgUrl = Yii::app()->request->baseUrl . '/images/pdf.gif';
                    $previewImg = CHtml::image($previewImgUrl, 'Preview', array('width' => 35, 'height' => 35, 'title' => 'Preview in Pdf'));
                    echo CHtml::link($previewImg, array('/servicecall/preview', 'id' => $model->id), array('target' => '_blank'));

                    ?>

                    <table>
                        <tr>
                            <td style="width:2%">
                                <i class="fa fa-paperclip fa-2x" aria-hidden="true"></i>
                            </td>
                            <td style="width: 98%">
                                <?php
                                $this->widget('CMultiFileUpload', array(
                                    'name' => 'uploaded_attachments',
                                    'accept' => 'jpeg|jpg|gif|png|pdf|doc|docx|xls|xlsx', // useful for verifying files
                                    'duplicate' => 'Duplicate file!', // useful, i think
                                    'denied' => 'Invalid file type', // useful, i think
                                ));
                                ?>
                            </td>
                        </tr>
                    </table>


                </td>
            </tr>
            <tr>
                <td>
                     <span class="datacontenttitle">
                        Reply To
                    </span>
                </td>
                <td>
                    <span class="datacontenttitle"><?php echo $emailmodel->email_from; ?></span>


                </td>
            </tr>

            <tr>
                <td>
                    <?php echo $form->labelEx($emailmodel, 'email_body'); ?>
                </td>
                <td>
                    <?php echo $form->textArea($emailmodel, 'email_body', array('style'=>'width:100%;height:400px;')); ?>
                    <?php echo $form->error($emailmodel, 'email_body'); ?>

                </td>
            </tr>

        </table>
        <div class="row buttons">
            <?php echo CHtml::submitButton('Send Email'); ?>
        </div>

    </div><!-- end of emailbox-->


    <?php $this->endWidget(); ?>

</div><!-- form -->