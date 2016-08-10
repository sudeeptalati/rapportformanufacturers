<?php
/**
 * Created by PhpStorm.
 * User: sudeeptalati
 * Date: 08/08/2016
 * Time: 13:17
 */
?>

<?php $form = $this->beginWidget('CActiveForm', array(
    'id' => 'servicecall-updateServicecall-form',
    'action' => Yii::app()->createUrl('servicecall/updateservicecalldialog&servicecall_id=' . $_GET['id']),
    'enableAjaxValidation' => false,

)); ?>


<?php if (isset($_GET['error_msg'])): ?>
    <div class="error">
        <?php echo $_GET['error_msg']; ?>
    </div>
<?php endif; ?>

<?php $servicecall_id=$_GET['id']; ?>
<?php $serviecallmodel=Servicecall::model()->findByPk($servicecall_id); ?>


<?php echo $form->labelEx($serviecallmodel, 'fault_description'); ?>
<?php echo $form->textArea($serviecallmodel, 'fault_description', array('style' => 'width:600px;height:100px;')); ?>
<?php echo $form->error($serviecallmodel, 'fault_description'); ?>


<table>
    <tr>
        <td>
            <!--
            <?php echo $form->labelEx($serviecallmodel, 'contract_id'); ?>
            <?php echo CHtml::activeDropDownList($serviecallmodel, 'contract_id', $serviecallmodel->getAllContract()); ?>
            <?php echo $form->error($serviecallmodel, 'contract_id'); ?>
            -->


            <?php echo $form->labelEx($serviecallmodel, 'fault_code'); ?>
            <?php echo $form->textField($serviecallmodel, 'fault_code'); ?>
            <?php echo $form->error($serviecallmodel, 'fault_code'); ?>

            <?php echo $form->labelEx($serviecallmodel, 'work_carried_out'); ?>
            <?php echo $form->textArea($serviecallmodel, 'work_carried_out', array('rows' => 4, 'cols' => '30')); ?>
            <?php echo $form->error($serviecallmodel, 'work_carried_out'); ?>


            <?php echo $form->labelEx($serviecallmodel, 'work_summary'); ?>
            <?php //echo $form->textField($serviecallmodel,'work_summary',array('rows'=>6, 'cols'=>50)); ?>

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
            <?php echo $form->dropDownList($serviecallmodel, 'work_summary', array_combine($works_array, $works_array)); ?>

            <hr>
            <?php $serviecallmodel->comments = '';///so that commenst are not messed up as they are managed sperately?>
            <?php echo $form->labelEx($serviecallmodel, 'comments'); ?>
            <?php echo $form->textArea($serviecallmodel, 'comments', array('rows' => 4, 'cols' => '30')); ?>
            <?php echo $form->error($serviecallmodel, 'comments'); ?>

            <?php echo $form->labelEx($serviecallmodel, 'notes'); ?>
            <?php echo $form->textArea($serviecallmodel, 'notes', array('rows' => 8, 'cols' => 120)); ?>
            <?php echo $form->error($serviecallmodel, 'notes'); ?>
        </td>
        <td>

            <!-- ***** Fault  Date**** -->
            <?php if (!empty($serviecallmodel->fault_date)) {
                    $serviecallmodel->fault_date = date('j-M-Y', $serviecallmodel->fault_date);
            }?>
            <?php echo $form->labelEx($serviecallmodel, 'fault_date'); ?>
            <?php echo $form->textField($serviecallmodel,'fault_date', array('readonly'=>'readonly')); ?>
            <?php echo $form->error($serviecallmodel, 'fault_date'); ?>


            <!-- ***** Engineet first Visit Date**** -->
            <?php if (!empty($serviecallmodel->engg_first_visit_date)) {
                $serviecallmodel->engg_first_visit_date = date('j-M-Y', $serviecallmodel->engg_first_visit_date);
            }?>
            <?php echo $form->labelEx($serviecallmodel, 'engg_first_visit_date'); ?>
            <?php echo $form->textField($serviecallmodel,'engg_first_visit_date', array('readonly'=>'readonly')); ?>
            <?php echo $form->error($serviecallmodel, 'engg_first_visit_date'); ?>


            <!-- ***** Job Completed Date**** -->
            <?php if (!empty($serviecallmodel->job_finished_date)) {
                $serviecallmodel->job_finished_date = date('j-M-Y', $serviecallmodel->job_finished_date);
            }?>
            <?php echo $form->labelEx($serviecallmodel, 'job_finished_date'); ?>
            <?php echo $form->textField($serviecallmodel,'job_finished_date', array('readonly'=>'readonly')); ?>
            <?php echo $form->error($serviecallmodel, 'job_finished_date'); ?>

            <!-- DATE of Paperwork returned - claim sheet return date -->
            <?php if (!empty($serviecallmodel->engg_claim_returned_date)) {
                $serviecallmodel->engg_claim_returned_date = date('j-M-Y', $serviecallmodel->engg_claim_returned_date);
            }?>
            <?php echo $form->labelEx($serviecallmodel, 'engg_claim_returned_date'); ?>
            <?php echo $form->textField($serviecallmodel,'engg_claim_returned_date', array('readonly'=>'readonly')); ?>
            <?php echo $form->error($serviecallmodel, 'engg_claim_returned_date'); ?>

            <!-- Job Payment date  -->
            <?php if (!empty($serviecallmodel->job_payment_date)) {
                $serviecallmodel->job_payment_date = date('j-M-Y', $serviecallmodel->job_payment_date);
            }?>
            <?php echo $form->labelEx($serviecallmodel, 'job_payment_date'); ?>
            <?php echo $form->textField($serviecallmodel,'job_payment_date', array('readonly'=>'readonly')); ?>
            <?php echo $form->error($serviecallmodel, 'job_payment_date'); ?>

            <!-- Job Payment date END  -->

            <hr>

            <i class="fa fa-money fa-2x"></i>

            <?php echo $form->labelEx($serviecallmodel, 'total_cost'); ?>
            <?php echo $form->textField($serviecallmodel, 'total_cost', array('readonly'=>'readonly')); ?>
            <?php echo $form->error($serviecallmodel, 'total_cost'); ?>



            <?php echo $form->labelEx($serviecallmodel, 'vat_on_total'); ?>
            <?php echo $form->textField($serviecallmodel, 'vat_on_total'); ?>
            <?php echo $form->error($serviecallmodel, 'vat_on_total'); ?>





            <?php

            $invoicePresentModel = Invoice::model()->findByAttributes(array('servicecall_id' => $serviecallmodel->id));
            if ($invoicePresentModel) {
                //echo "<br> Idof invoice = ".$invoicePresentModel->id;
                $invoiceModel = Invoice::model()->findByPk($invoicePresentModel->id);
            } else {
                $invoiceModel = Invoice::model();
            }
            ?>

            <?php echo $form->labelEx($invoiceModel, 'shipping_handling_cost'); ?>
            <?php echo $form->textField($invoiceModel, 'shipping_handling_cost', array('size' => '10', 'style' => 'text-align:right')); ?>
            <?php echo $form->error($invoiceModel, 'shipping_handling_cost'); ?>


            <?php echo $form->labelEx($invoiceModel, 'labour_cost'); ?>
            <?php echo $form->textField($invoiceModel, 'labour_cost', array('size' => '10', 'style' => 'text-align:right')); ?>
            <?php echo $form->error($invoiceModel, 'labour_cost'); ?>





        </td>

    </tr>
</table>

<div class="success">

    <?php echo CHtml::submitButton('Save'); ?>
</div>
<?php $this->endWidget(); ?>


<script>

    var Servicecall_fault_date = new Pikaday(
        {
            numberOfMonths: 3,
            field: document.getElementById('Servicecall_fault_date'),

        });

    var Servicecall_engg_first_visit_date = new Pikaday(
        {
            numberOfMonths: 3,
            ///mainCalendar: 'right',
            field: document.getElementById('Servicecall_engg_first_visit_date'),
        });

    var Servicecall_job_finished_date = new Pikaday(
        {
            numberOfMonths: 3,
            field: document.getElementById('Servicecall_job_finished_date'),

        });

    var Servicecall_engg_claim_returned_date = new Pikaday(
        {
            numberOfMonths: 3,
            field: document.getElementById('Servicecall_engg_claim_returned_date'),

        });

    var Servicecall_job_payment_date = new Pikaday(
        {
            numberOfMonths: 3,
            field: document.getElementById('Servicecall_job_payment_date'),

        });




</script>