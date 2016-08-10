<?php
/**
 * Created by PhpStorm.
 * User: sudeeptalati
 * Date: 01/07/2016
 * Time: 16:45
 */
 
 

$service_id = $_GET['id'];
$servicecallmodel = Servicecall::model()->findByPk($service_id);

if(isset($_GET['successfulredirect_to']))
    $servicecallmodel->successfulredirectto=$_GET['successfulredirect_to'];
else
    $servicecallmodel->successfulredirectto='/servicecall/view&id='.$service_id.'' ;




$actionurl=Yii::app()->createUrl('/servicecall/changejobstatusonly', array('service_id' => $service_id));

?>

<div class="form">
    <?php $form=$this->beginWidget('CActiveForm', array(
        'id'=>'changejobstatus-form',
        'action' => $actionurl,

    )); ?>


    <?php echo $form->errorSummary($servicecallmodel); ?>

    <div class="row">
        <?php echo $form->label($servicecallmodel,'job_status_id'); ?>
        <?php echo $form->dropDownList($servicecallmodel, 'job_status_id', Jobstatus::model()->getAllPublishedListdata());?>
    </div>

    <?php echo $form->hiddenField($servicecallmodel,'id'); ?>
    <?php echo $form->hiddenField($servicecallmodel,'successfulredirectto'); ?>

    <div class="row submit">
        <?php echo CHtml::submitButton('Change'); ?>
    </div>

    <?php $this->endWidget(); ?>
</div><!-- form -->

