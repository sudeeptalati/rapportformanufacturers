<div class="form">
 <?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'job-status-form',
	'enableAjaxValidation'=>false,
)); ?>

	<script type="text/javascript">
	function color_change()
	{
		color_name=document.getElementById('color_chooser').value;
		console.log('Color name selected = '+color_name);
		document.getElementById('current_layout').style.background ="#"+color_name;
		document.getElementById('JobStatus_backgroundcolor').value='#'+color_name;
	}
	</script>
	
	<p class="note">Fields with <span class="required">*</span> are required.</p>
	
	<?php echo $form->errorSummary($model); ?>
    <div class="row buttons">
        <?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
    </div>
	<div class="row">
		<?php echo $form->labelEx($model,'name'); ?>
		<?php
			 	if  ($model->id>50 && $model->id<100 )///id greater than 100 are custom statuses
			 	{
			 		echo $form->textField($model,'name',array('size'=>50));
			 	}
				else
				{
					echo $form->textField($model,'name',array('size'=>50, 'disabled'=>'disabled' ));
					echo "<br><small>This is  system set status, therefore above name cannot be edited</small><br><br>";	
				}
					
				?>
				
		<?php echo $form->error($model,'name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'keyword'); ?>
		<?php echo $form->textField($model,'keyword',array('size'=>50, 'readonly'=>'readonly')); ?>
		<?php echo $form->error($model,'keyword'); ?>
	</div>


    <div class="row">
        <?php echo $form->labelEx($model,'information'); ?>
        <?php echo $form->textArea($model,'information',array('rows'=>6, 'cols'=>50)); ?>
        <?php echo $form->error($model,'information'); ?>
    </div>


	<div class="row">
		<?php echo $form->labelEx($model,'published'); ?>
		<?php echo $form->dropDownList($model,'published',array('1'=>'Yes', '0'=>'No',));?>
		<?php echo $form->error($model,'published'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model,'dashboard_display'); ?>
		<?php echo $form->dropDownList($model,'dashboard_display',array('1'=>'Yes', '0'=>'No',));?>
		<?php echo $form->error($model,'dashboard_display'); ?>
	</div>

	
	<div class="row" >
		<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/js/jscolor/jscolor.js', CClientScript::POS_HEAD); ?>
 
		<?php echo $form->labelEx($model,'backgroundcolor'); ?>
		<?php //echo $form->textField($model,'html_name',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->hiddenField($model,'backgroundcolor',array('rows'=>6, 'cols'=>50)); ?>
		
		
		<input rows="6" cols="50" name="color_chooser" id="color_chooser" type="text"  class="color {onImmediateChange:'color_change(this);', pickerPosition:'left'}" onChange="js:color_change()" value="<?php echo $model->backgroundcolor; ?>">
		
		 
		
		<?php //echo CHtml::textField($model,'html_name');?>
		<?php 
//		echo CHtml::activeTextField($model,'html_name',array('ajax' =>
//															array('background-color':'#ffccff')
//															));?>
		<?php echo $form->error($model,'backgroundcolor'); ?>
		 
		<br>
		
		<br>
		
		 
		
		<table style="width:50%">
			<tr>
				<td >
				
				<div id="current_layout" class="color" style="border-radius:15px;  padding:10px; background-color:<?php echo $model->backgroundcolor;?>">
				Current Layout<br>
				<b><?php echo $model->name ;?></b>
				</div>
				</td>
			</tr>
		</table>


	</div>
 		
	
	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>
 

	
</div><!-- form -->


<script>

    $( document ).ready(function() {
        jobstatus_name=$( "#JobStatus_name" ).val();
        jobstatus_keyword=change_to_upper_case_and_replace_space_with_underscore(jobstatus_name);
        $( "#JobStatus_keyword" ).val(jobstatus_keyword)
    });





    $( "#JobStatus_keyword" ).keyup(function() {
        jobstatus_keyword=$( "#JobStatus_keyword" ).val();
        jobstatus_keyword=change_to_upper_case_and_replace_space_with_underscore(jobstatus_keyword);
        $( "#JobStatus_keyword" ).val(jobstatus_keyword)
    });

    function change_to_upper_case_and_replace_space_with_underscore(str) {

        str=str.replace(/ /g,"_");
        str=str.toUpperCase();

        return str;

    }
</script>

  