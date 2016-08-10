<?php
/**
 * Created by PhpStorm.
 * User: sudeeptalati
 * Date: 08/08/2016
 * Time: 14:17
 */
?>

<?php $form = $this->beginWidget('CActiveForm', array(
    'id' => 'servicecall-updateServicecall-form',
    'action' => Yii::app()->createUrl('servicecall/addcommnetsinservicecall&servicecall_id=' . $_GET['id']),
    'enableAjaxValidation' => false,

));

$model->comments='';
?>

<?php echo $form->labelEx($model, 'comments'); ?>
<?php echo $form->textArea($model, 'comments', array('rows' => 8, 'cols' => 120)); ?>
<?php echo $form->error($model, 'comments'); ?>


    <div class="success">
        <?php echo CHtml::submitButton('Add Comments'); ?>
    </div>
<?php $this->endWidget(); ?>