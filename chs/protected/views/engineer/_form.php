<div class="form">


    <script type="text/javascript">

        $(document).ready(function () {

            //DISPLAYS ADDRESS DIV TAG WHILE UPDATE, IF ADDRESS IS DIFFERENT FROM CONTACT ADDRESS
            var delivery_checkbox = document.getElementById("delivery-checkbox-id");
            if (delivery_checkbox.checked == false)
                $('.delivery-details-form').show();

            //********* FUNCTION TO TOGGLE DIV TAG.
            $('#delivery-checkbox-id').change(function () {

                $('.delivery-details-form').toggle();
                return false;
            });

        });


    </script>


    <?php $form = $this->beginWidget('CActiveForm', array(
        'id' => 'engineer-form',
        'enableAjaxValidation' => false,
        'clientOptions' => array('validateOnSubmit' => true),
    )); ?>


    <?php
    // 	if(!empty($model->contact_details_id))
    // 	{
    // 		$contactDetailsModel=ContactDetails::model()->findByPk($model->contact_details_id);
    // 	}
    // 	else
    // 	{
    // 		$contactDetailsModel=ContactDetails::model();
    // 	}
    ?>


    <br><br>
    <p class="note">Fields with <span class="required">*</span> are required.</p>

    <?php
    echo $form->errorSummary($model);
    echo $form->errorSummary($contactDetailsModel);
    echo $form->errorSummary($deliveryDetailsModel);

    ?>


    <table style="width:700px; margin:10px; background-color: #C7E8FD;  border-radius: 15px; padding:15px;">
        <tr>
            <td>
                <?php echo $form->labelEx($model, 'first_name'); ?>
                <?php echo $form->textField($model, 'first_name', array('rows' => 6, 'cols' => 50)); ?>
                <?php echo $form->error($model, 'first_name'); ?>
            </td>
            <td>
                <?php echo $form->labelEx($model, 'last_name'); ?>
                <?php echo $form->textField($model, 'last_name', array('rows' => 6, 'cols' => 50)); ?>
                <?php echo $form->error($model, 'last_name'); ?>
            </td>
            <td>
                <?php echo $form->labelEx($model, 'active'); ?>
                <?php echo $form->dropDownList($model, 'active', array('1' => 'Active', '0' => 'Inactive')); ?>
                <?php echo $form->error($model, 'active'); ?>
            </td>
        </tr>

        <tr>
            <td colspan="2">
                <?php echo $form->labelEx($model, 'company'); ?>
                <?php echo $form->textField($model, 'company', array('size' => 60)); ?>
                <?php echo $form->error($model, 'company'); ?>

                <?php echo $form->labelEx($model, 'payment_name'); ?>
                <?php echo $form->textField($model, 'payment_name', array('rows' => 6, 'cols' => 50)); ?>
                <?php echo $form->error($model, 'payment_name'); ?>
            </td>
            <td>
                <?php echo $form->labelEx($model, 'vat_reg_number'); ?>
                <?php echo $form->textField($model, 'vat_reg_number', array('rows' => 6, 'cols' => 50)); ?>
                <?php echo $form->error($model, 'vat_reg_number'); ?>
            </td>

        </tr>
        <tr>
            <td colspan="3">
                <?php echo $form->labelEx($model, 'notes'); ?>
                <?php echo $form->textArea($model, 'notes', array('rows' => 6, 'cols' => 75)); ?>
                <?php echo $form->error($model, 'notes'); ?>
            </td>

        </tr>
    </table>


    <!-- FIELDS OF CONTACT DETAILS FORM  -->


    <table style="width:700px; margin:10px; background-color: #ADEBAD;  border-radius: 15px;padding:15px;">

        <tr>
            <td colspan="3"><h3 style="margin-bottom:0.01px;color:#555;"><label>Address Details</label></h3></td>
        </tr>

        <tr>
            <td>
                <?php echo $form->labelEx($contactDetailsModel, '[1]address_line_1'); ?>
                <?php echo $form->textField($contactDetailsModel, '[1]address_line_1', array('rows' => 6, 'cols' => 50)); ?>
                <?php echo $form->error($contactDetailsModel, '[1]address_line_1'); ?>
            </td>
            <td>
                <?php echo $form->labelEx($contactDetailsModel, '[1]address_line_2'); ?>
                <?php echo $form->textField($contactDetailsModel, '[1]address_line_2', array('rows' => 6, 'cols' => 50)); ?>
                <?php echo $form->error($contactDetailsModel, '[1]address_line_2'); ?>
            </td>
            <td>
                <?php echo $form->labelEx($contactDetailsModel, '[1]address_line_3'); ?>
                <?php echo $form->textField($contactDetailsModel, '[1]address_line_3', array('rows' => 6, 'cols' => 50)); ?>
                <?php echo $form->error($contactDetailsModel, '[1]address_line_3'); ?>
            </td>
        </tr>
        <tr>
            <td>
                <?php echo $form->labelEx($contactDetailsModel, '[1]town'); ?>
                <?php echo $form->textField($contactDetailsModel, '[1]town', array('rows' => 6, 'cols' => 50)); ?>
                <?php echo $form->error($contactDetailsModel, '[1]town'); ?>
            </td>
            <td>
                <?php echo $form->labelEx($contactDetailsModel, '[1]postcode', array('size' => 3, 'maxlength' => 5, 'style' => 'width:2.5em;display: inline')); ?>
                <span class="required">*</span><br>
                <?php echo $form->textField($contactDetailsModel, '[1]postcode_s', array('size' => 6, 'maxlength' => 5, 'style' => 'width:2.5em')); ?>
                <?php echo $form->error($contactDetailsModel, '[1]postcode_s'); ?>
                <?php echo $form->textField($contactDetailsModel, '[1]postcode_e', array('size' => 6, 'maxlength' => 5, 'style' => 'width:2.5em')); ?>
                <?php echo $form->error($contactDetailsModel, '[1]postcode_e'); ?>
            </td>
            <td>
                <?php echo $form->labelEx($contactDetailsModel, '[1]country'); ?>
                <?php echo $form->textField($contactDetailsModel, '[1]country', array('rows' => 6, 'cols' => 50)); ?>
                <?php echo $form->error($contactDetailsModel, '[1]country'); ?>
            </td>
        </tr>
        <tr>
            <td>
                <?php echo $form->labelEx($contactDetailsModel, '[1]telephone'); ?>
                <?php echo $form->textField($contactDetailsModel, '[1]telephone', array('rows' => 6, 'cols' => 50)); ?>
                <?php echo $form->error($contactDetailsModel, '[1]telephone'); ?>
            </td>
            <td>
                <?php echo $form->labelEx($contactDetailsModel, '[1]mobile'); ?>
                <?php echo $form->textField($contactDetailsModel, '[1]mobile', array('rows' => 6, 'cols' => 50)); ?>
                <?php echo $form->error($contactDetailsModel, '[1]mobile'); ?>
            </td>
            <td>
                <?php echo $form->labelEx($contactDetailsModel, '[1]fax'); ?>
                <?php echo $form->textField($contactDetailsModel, '[1]fax', array('rows' => 6, 'cols' => 50)); ?>
                <?php echo $form->error($contactDetailsModel, '[1]fax'); ?>
            </td>
        </tr>

        <tr>
            <td>
                <?php echo $form->labelEx($contactDetailsModel, '[1]email'); ?>
                <?php echo $form->textField($contactDetailsModel, '[1]email', array('rows' => 6, 'cols' => 50)); ?>
                <?php echo $form->error($contactDetailsModel, '[1]email'); ?>
            </td>
            <td>
                <?php echo $form->labelEx($contactDetailsModel, '[1]website'); ?>
                <?php echo $form->textField($contactDetailsModel, '[1]website', array('rows' => 6, 'cols' => 50)); ?>
                <?php echo $form->error($contactDetailsModel, '[1]website'); ?>
            </td>
        </tr>
    </table>

    <!-- FIELDS OF CONTACT DETAILS END HERE -->


    <table style="width:700px; margin:10px; background-color: #F3B6B7;  border-radius: 15px;padding:15px;">
        <tr>
            <td>

                <?php

                //******* CALLED IN UPDATE, AND IF DELIVERY ADDRESS IS CHANGE THAN CONTACT DETAILS.
                //**********	OTHERWISE JUST A CHECKED BOX IS SHOWED *************

                //if(($model->delivery_contact_details_id == '') || ($model->delivery_contact_details_id == $model->contact_details_id))

                /*
                if ($model->delivery_contact_details_id == $model->contact_details_id)
                    $delivery_checkbox_status = true;
                else
                    $delivery_checkbox_status = false;
                */


                if ($model->delivery_contact_details_id == '' || ($model->delivery_contact_details_id != $model->contact_details_id)) {
                    $delivery_checkbox_status = false;/////Khulne walal
                } else {
                    $delivery_checkbox_status = true;/////Naiu Khulne walal
                }


                //$delivery_checkbox_status = false;

                ?>


                <?php echo $form->labelEx($model, 'delivery_contact_details_id'); ?>

                <?php //echo $form->checkBox($model,'delivery_contact_details_id',array('checked'=>'checked','id'=>'delivery-checkbox-id')); ?>
                <?php echo CHtml::CheckBox('delivery_checkbox', $delivery_checkbox_status, array('value' => '', 'id' => 'delivery-checkbox-id')); ?>
                <?php //echo CHtml::checkBox('same_delivery_details', $delivery_checkbox_status, array('id'=>'delivery-checkbox-id')); ?>
                <?php echo "Same as above"; ?>
                <?php echo $form->error($model, 'delivery_contact_details_id'); ?>


                <div class="delivery-details-form" style="display:none">
                    <table>
                        <tr>
                            <td>
                                <?php echo $form->labelEx($deliveryDetailsModel, '[2]address_line_1'); ?>
                                <?php echo $form->textField($deliveryDetailsModel, '[2]address_line_1'); ?>
                                <?php echo $form->error($deliveryDetailsModel, '[2]address_line_1'); ?>
                            </td>
                            <td>
                                <?php echo $form->labelEx($deliveryDetailsModel, '[2]address_line_2'); ?>
                                <?php echo $form->textField($deliveryDetailsModel, '[2]address_line_2'); ?>
                                <?php echo $form->error($deliveryDetailsModel, '[2]address_line_2'); ?>
                            </td>
                            <td>
                                <?php echo $form->labelEx($deliveryDetailsModel, '[2]address_line_3'); ?>
                                <?php echo $form->textField($deliveryDetailsModel, '[2]address_line_3', array('rows' => 6, 'cols' => 50)); ?>
                                <?php echo $form->error($deliveryDetailsModel, '[2]address_line_3'); ?>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <?php echo $form->labelEx($deliveryDetailsModel, '[2]town'); ?>
                                <?php echo $form->textField($deliveryDetailsModel, '[2]town', array('rows' => 6, 'cols' => 50)); ?>
                                <?php echo $form->error($deliveryDetailsModel, '[2]town'); ?>
                            </td>
                            <td>
                                <?php echo $form->labelEx($deliveryDetailsModel, '[2]postcode', array('size' => 3, 'maxlength' => 5, 'style' => 'width:2.5em;display: inline')); ?>
                                <span class="required">*</span><br>
                                <?php echo $form->textField($deliveryDetailsModel, '[2]postcode_s', array('size' => 6, 'maxlength' => 5, 'style' => 'width:2.5em')); ?>
                                <?php echo $form->error($deliveryDetailsModel, '[2]postcode_s'); ?>
                                <?php echo $form->textField($deliveryDetailsModel, '[2]postcode_e', array('size' => 6, 'maxlength' => 5, 'style' => 'width:2.5em')); ?>
                                <?php echo $form->error($deliveryDetailsModel, '[2]postcode_e'); ?>
                            </td>
                            <td>
                                <?php echo $form->labelEx($deliveryDetailsModel, '[2]country'); ?>
                                <?php echo $form->textField($deliveryDetailsModel, '[2]country', array('rows' => 6, 'cols' => 50)); ?>
                                <?php echo $form->error($deliveryDetailsModel, '[2]country'); ?>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <?php echo $form->labelEx($deliveryDetailsModel, '[2]telephone'); ?>
                                <?php echo $form->textField($deliveryDetailsModel, '[2]telephone', array('rows' => 6, 'cols' => 50)); ?>
                                <?php echo $form->error($deliveryDetailsModel, '[2]telephone'); ?>
                            </td>
                            <td>
                                <?php echo $form->labelEx($deliveryDetailsModel, '[2]mobile'); ?>
                                <?php echo $form->textField($deliveryDetailsModel, '[2]mobile', array('rows' => 6, 'cols' => 50)); ?>
                                <?php echo $form->error($deliveryDetailsModel, '[2]mobile'); ?>
                            </td>
                            <td>
                                <?php echo $form->labelEx($deliveryDetailsModel, '[2]fax'); ?>
                                <?php echo $form->textField($deliveryDetailsModel, '[2]fax', array('rows' => 6, 'cols' => 50)); ?>
                                <?php echo $form->error($deliveryDetailsModel, '[2]fax'); ?>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <?php echo $form->labelEx($deliveryDetailsModel, '[2]email'); ?>
                                <?php echo $form->textField($deliveryDetailsModel, '[2]email', array('rows' => 6, 'cols' => 50)); ?>
                                <?php echo $form->error($deliveryDetailsModel, '[2]email'); ?>
                            </td>
                            <td>
                                <?php echo $form->labelEx($deliveryDetailsModel, '[2]website'); ?>
                                <?php echo $form->textField($deliveryDetailsModel, '[2]website', array('rows' => 6, 'cols' => 50)); ?>
                                <?php echo $form->error($deliveryDetailsModel, '[2]website'); ?>
                            </td>
                        </tr>
                    </table>

                </div><!-- **** END OF DELIVERY CONTACT DETAILS ******* -->


            </td>
        </tr>
        <tr>
            <td>
                <?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
            </td>
        </tr>
    </table>


    <?php $this->endWidget(); ?>

</div><!-- form -->