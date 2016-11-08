<?php 

$service_id = $_GET['id'];
$servicecallmodel = Servicecall::model()->findByPk($service_id);

if(isset($_GET['successfulredirect_to']))
    $servicecallmodel->successfulredirectto=$_GET['successfulredirect_to'];
else
    $servicecallmodel->successfulredirectto='/servicecall/view&id='.$service_id.'#service-details' ;




$actionurl=Yii::app()->createUrl('/servicecall/changeengineeronly', array('service_id' => $service_id));

?>

<div class="form">
    <?php $form=$this->beginWidget('CActiveForm', array(
        'id'=>'changeengineer-form',
        'action' => $actionurl,

    )); ?>


    <?php echo $form->errorSummary($servicecallmodel); ?>

    <div class="row">
        <?php echo $form->label($servicecallmodel,'engineer_id'); ?>
        <?php echo $form->dropDownList($servicecallmodel, 'engineer_id', Engineer::model()->getactiveengineerslist());?>
    </div>

    <?php echo $form->hiddenField($servicecallmodel,'id'); ?>
    <?php echo $form->hiddenField($servicecallmodel,'successfulredirectto'); ?>

    <div class="row submit">
        <?php echo CHtml::submitButton('Change'); ?>
    </div>

    <?php $this->endWidget(); ?>
</div><!-- form -->





















