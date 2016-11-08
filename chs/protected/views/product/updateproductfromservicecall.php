<?php
/**
 * Created by PhpStorm.
 * User: sudeeptalati
 * Date: 02/08/2016
 * Time: 15:41
 */



if(isset($_POST['ajax']) && $_POST['ajax']==='product-form')
{
    echo CActiveForm::validate($productModel);
    Yii::app()->end();
}

?>


<div class="form productbox contentbox">

    <?php $form = $this->beginWidget('CActiveForm', array(
        'id' => 'product-form',
        'action' => Yii::app()->createUrl('product/updateproductfromservicecall&servicecall_id=' . $_GET['id']),
        'enableAjaxValidation'=>false,

    )); ?>



    <?php if(isset($_GET['error_msg'])):?>
        <div class="error">
            ERRORS
            <?php echo $_GET['error_msg']; ?>
        </div>

    <?php endif;?>

    <table style="width:400px; margin:10px;">
        <tr>
            <td colspan="3"><h2 style="margin-bottom:0.01px;color:#555;"><label>Product Details</label></h2>

            </td>
        </tr>

        <tr>
            <td>
                <?php echo $form->labelEx($productModel, 'brand_id'); ?>
                <?php echo CHtml::activeDropDownList($productModel, 'brand_id', $productModel->getAllBrands()); ?>
                <?php echo $form->error($productModel, 'brand_id'); ?>
            </td>
            <td>
                <?php echo $form->labelEx($productModel, 'product_type_id'); ?>
                <?php echo CHtml::activeDropDownList($productModel, 'product_type_id', $productModel->getProductTypes(), array('empty' => array('1000000' => 'Not Known'))); ?>
                <?php echo $form->error($productModel, 'product_type_id'); ?>
            </td>
            <td>
                <?php echo $form->labelEx($productModel, 'model_number'); ?>
                <?php //echo $form->textField($productModel,'model_number',array('size'=>30)); ?>
                <?php
                $this->widget('zii.widgets.jui.CJuiAutoComplete', array(
                    'model' => $productModel,
                    'attribute' => 'model_number',
                    //'source'=>$this->createUrl('jui/autocompleteTest'),
                    //'source'=>array('ac1', 'ac2', 'ac3', 'b1', 'ba', 'ba34', 'ba33'),
                    'source' => ModelNumbers::model()->getAllModelNumbers(),
                    // additional javascript options for the autocomplete plugin
                    'options' => array(
                        'showAnim' => 'fold',
                        //'select' => 'js:function(event, ui){ alert(ui.item.value) }',
                    ),
                    'htmlOptions' => array(
                        'style' => 'height:20px;',
                        // 'onClick' => 'document.getElementById("test1_id").value=""'
                    ),
                    'cssFile' => false,
                ));


                ?>
                <?php echo $form->error($productModel, 'model_number'); ?>
            </td>
        </tr>

        <tr>
            <td>
                <?php echo $form->labelEx($productModel, 'serial_number'); ?>
                <?php echo $form->textField($productModel, 'serial_number', array('size' => 30)); ?>
                <?php echo $form->error($productModel, 'serial_number'); ?>
            </td>

            <td>
                <?php echo $form->labelEx($productModel, 'enr_number'); ?>
                <?php echo $form->textField($productModel, 'enr_number', array('size' => 30)); ?>
                <?php echo $form->error($productModel, 'enr_number'); ?>
            </td>
            <td>
                <?php echo $form->labelEx($productModel, 'fnr_number'); ?>
                <?php echo $form->textField($productModel, 'fnr_number', array('size' => 30)); ?>
                <?php echo $form->error($productModel, 'fnr_number'); ?>
            </td>

        </tr>

        <tr>
            <td colspan="3"><br><b><i>Warranty Details</i></b></td>
        </tr>
        <tr>
            <td>
                <?php echo $form->labelEx($productModel, 'contract_id'); ?>
                <?php echo CHtml::activeDropDownList($productModel, 'contract_id', $productModel->getAllContract()); ?>
                <?php echo $form->error($productModel, 'contract_id'); ?>
            </td>
            <td>
                <?php echo $form->labelEx($productModel, 'warranty_date'); ?>
                <?php
                if ($productModel->warranty_date != '') {
                    $warranty_date = date('j-M-y', $productModel->warranty_date);
                } else {
                    $warranty_date = '';
                }
                ?>
                <?php
                $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                    'name' => CHtml::activeName($productModel, 'warranty_date'),
                    'model' => $productModel,
                    //'value' => $productModel->attributes['warranty_date'],
                    'value' => $warranty_date,
                    // additional javascript options for the date picker plugin
                    'options' => array(
                        'showAnim' => 'fold',
                        'dateFormat' => 'd-M-y',
                        //'onSelect' => 'js:function(){ console.log("Hiiiii "  );document.getElementById("Product_purchase_date").value=""  ; }',
                        'onSelect' => 'js:function(selectedDate) {console.log("Hiiiii "+selectedDate);document.getElementById("Product_purchase_date").value=selectedDate}',

                    ),
                    'htmlOptions' => array(
                        'style' => 'height:20px;'
                    ),
                ));
                ?>
                <?php //echo $form->textField($productModel,'warranty_date'); ?>
                <?php echo $form->error($productModel, 'warranty_date'); ?>
            </td>
            <td>
                <?php echo $form->labelEx($productModel, 'warranty_for_months'); ?>
                <?php //echo $form->textField($productModel,'warranty_for_months',array('size'=>30)); ?>
                <?php $range = array();
                $range = range(0, 120);
                echo $form->dropDownList($productModel, 'warranty_for_months', array($range)); ?>

                <?php echo $form->error($productModel, 'warranty_for_months'); ?>
            </td>

        </tr>

        <tr>
            <td colspan="3"><br><b><i>Purchase Details</i></b></td>
        </tr>

        <tr>
            <td>
                <?php echo $form->labelEx($productModel, 'purchased_from'); ?>
                <?php //echo $form->textField($productModel,'purchased_from',array('size'=>30)); ?>
                <?php
                $this->widget('zii.widgets.jui.CJuiAutoComplete', array(
                    'model' => $productModel,
                    'attribute' => 'purchased_from',
                    //'source'=>$this->createUrl('jui/autocompleteTest'),
                    //'source'=>array('ac1', 'ac2', 'ac3', 'b1', 'ba', 'ba34', 'ba33'),
                    'source' => Engineer::model()->getAllCompanyNamesArray(),
                    // additional javascript options for the autocomplete plugin
                    'options' => array(
                        'showAnim' => 'fold',
                        //'select' => 'js:function(event, ui){ alert(ui.item.value);document.getElementById("Product_engineer_id").value=ui.item.value; }',
                    ),
                    'htmlOptions' => array(
                        'style' => 'height:20px;',
                        // 'onClick' => 'document.getElementById("test1_id").value=""'
                    ),
                    'cssFile' => false,
                ));


                ?>


                <?php echo $form->error($productModel, 'purchased_from'); ?>
            </td>
            <td>
                <?php echo $form->labelEx($productModel, 'purchase_date'); ?>
                <?php
                if ($productModel->purchase_date != '') {
                    $purchase_date = date('j-M-y', $productModel->purchase_date);
                } else {
                    $purchase_date = '';
                }
                ?>
                <?php
                $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                    'name' => CHtml::activeName($productModel, 'purchase_date'),
                    'model' => $productModel,
                    //'value' => $productModel->attributes['purchase_date'],
                    'value' => $purchase_date,
                    // additional javascript options for the date picker plugin
                    'options' => array(
                        'showAnim' => 'fold',
                        'dateFormat' => 'd-M-y',
                    ),
                    'htmlOptions' => array(
                        'style' => 'height:20px;'
                    ),
                ));
                ?>
                <?php //echo $form->textField($productModel,'purchase_date'); ?>
                <?php echo $form->error($productModel, 'purchase_date'); ?>
            </td>

            <td>
                <?php echo $form->labelEx($productModel, 'purchase_price'); ?>
                <?php echo $form->textField($productModel, 'purchase_price', array('size' => 5)); ?>
                <?php echo $form->error($productModel, 'purchase_price'); ?>
            </td>
        </tr>
        <tr>
            <td>
                <?php echo $form->labelEx($productModel, 'discontinued'); ?>
                <?php echo $form->dropDownList($productModel, 'discontinued', array('0' => 'No', '1' => 'Yes')); ?>
                <?php echo $form->error($productModel, 'discontinued'); ?>
            </td>

            <td colspan="2">
                <?php echo $form->labelEx($productModel, 'notes'); ?>
                <?php echo $form->textArea($productModel, 'notes', array('rows' => 4, 'cols' => 40)); ?>
                <?php echo $form->error($productModel, 'notes'); ?>
            </td>
        </tr>


    </table><!-- END OF TABLE OF PRODUCT -->

    <div class="contentbox">
        <?php echo CHtml::submitButton($productModel->isNewRecord ? 'Register This New Customer' : 'Save'); ?>
    </div>


    <?php $this->endWidget(); ?>

</div><!-- form -->
