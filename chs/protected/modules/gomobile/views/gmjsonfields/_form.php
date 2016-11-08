<?php
/* @var $this GmJsonFieldsController */
/* @var $model GmJsonFields */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'gm-json-fields-form',
	'htmlOptions'=>array('onsubmit'=>"return validateForm()"),
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'field_type'); ?>
		<?php echo $form->dropDownList($model,'field_type', array('TEXT'=>'TEXT', 'DATETIME'=>'DATETIME', 'INTEGER'=>'INTEGER')); ?>
		<?php echo $form->error($model,'field_type'); ?>
	</div>

	<div id='field_relation_div' style='padding:1em;border-radius: 1em;' class="row">
		
		<span id='field_relation_span_text'></span>
		<?php echo $form->labelEx($model,'field_relation'); ?>
		<?php echo $form->hiddenField($model,'field_relation',array( 'style'=>'width:300px;')); ?>
		<div id="field_relation"><?php  echo $model->field_relation; ?></div>
		<?php echo $form->error($model,'field_relation'); ?>
	
		<br>
		 
		<?php
		
		
			///
			
			
			$uplifts_relation_json=json_encode(Servicecall::model()->relations());
			$uplifts_relations=array_keys(Servicecall::model()->relations());
			
			 
			
			//$uplifts_relations['blank_field']='blank_field';
			$fields_list=$model->getRelationsAndFieldsListByModelName("Servicecall");
			
			array_unshift($fields_list, "BLANK_FIELD");
			
			
			echo CHtml::dropdownList('relation_1','',array_combine($fields_list, $fields_list), array('empty'=>array(''=>'Select/Change the Field'), 'onChange'=>'relation_changed("relation_1")'));
			 
		?>
		
		<span id='dynamicselect'></span>
		<span id="fooBar">&nbsp;</span>
	
	
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'field_label'); ?>
		<?php echo $form->textField($model,'field_label',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'field_label'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'sort_order'); ?>
		<?php echo $form->textField($model,'sort_order'); ?>
		<?php echo $form->error($model,'sort_order'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'active'); ?>
		<?php echo $form->textField($model,'active'); ?>
		<?php echo $form->error($model,'active'); ?>
	</div>

 

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->






<script>
var uplifts_relation = new Array();
var uplifts_relation = [<?php echo '"'.implode('","', $uplifts_relations).'"' ?>];
var relation_completed=false;


for (var i=0; i<uplifts_relation.length;i++)
{
	console.log(uplifts_relation[i]);
}

var uplifts_relation_json=<?php echo $uplifts_relation_json ?>;
var relation_1=document.getElementById("relation_1");

function relation_changed(relation_select_id)
{	
	console.log("relation_changed CALLED "+relation_select_id);
	var selected_value=relation_1.value;
	
	document.getElementById("Gmjsonfields_field_relation").value=selected_value;
	relation_1.disabled=true;
	document.getElementById("field_relation").innerHTML=document.getElementById("Gmjsonfields_field_relation").value;	
	
				
	//console.log("SLECTC RELATION 1 is "+relation_1.value);
	/////check if value is relation or column
	if (uplifts_relation.indexOf(relation_1.value) > -1)
	{
		 
		console.log("RELATION SELECTED");
		relation_completed=false;
		////////relation_2.disabled = false;
		//console.log(uplifts_relation_json);
		
		var relation_1_model=uplifts_relation_json[selected_value][1];
		console.log("RElation 1 Model si "+uplifts_relation_json[selected_value][1]);
		
		$.ajax({
		type: "GET",
		url: "index.php?r=gomobile/gmjsonfields/getrelationsandfieldslistbymodelname",
		data: "modelname="+relation_1_model,
		async:false,
		success: function(server_response)
		{
			//console.log(server_response);
			var listdata = JSON.parse(server_response);
			
			createDropDown(listdata,relation_1_model);
			
		}///end of ajax Success
		});///end of ajax
	
	}else
	{
		console.log("FIELD SELECTED");
		relation_completed=true;
	}
}//end of relation_1_changed



function createDropDown(listdata,modelname)
{
	var dropdownid=modelname+"_relation_dynamic";
	console.log("*****createDropDown*******");
	var dynamicselect=document.getElementById("dynamicselect");
	
	var select12 = document.createElement("Select");
	select12.setAttribute("name", dropdownid);
	select12.setAttribute("id", dropdownid);
	
	//select12.style.width = "300px"
	dynamicselect.innerHTML="";
	//console.log("*****createDropdynamicselecDown*******");
	
	for(var i = 0; i < listdata.length; i++) {
		
		var opt = document.createElement('option');
		opt.innerHTML = listdata[i];
		opt.value = listdata[i];
		select12.appendChild(opt);
		//console.log("*****createDropdynamicselecDown*******"+listdata[i]);
	
	}
	
	select12.setAttribute("onchange", "relation_changed_dynamic("+dropdownid+")");

	select12.setAttribute('style', 'width:75px;');
	
	console.log("************"+dropdownid);
	
	addSelectObject(select12);
	
	
	}


function relation_changed_dynamic(dynamic_relation_select_object)
{
	dynamic_relation_select_object.disabled=true;
				
	console.log("relation_changed_dynamic selected Value CALLED"+dynamic_relation_select_object.value);
	append_relation_form_field(dynamic_relation_select_object.value);
	console.log("SLECT Weidth :"+dynamic_relation_select_object.style.width);
	
	console.log("Object name "+dynamic_relation_select_object.name);
	
	var object_name = dynamic_relation_select_object.name;
	var relation_model_name_array = object_name.split("_relation_dynamic");
	relation_model_name=relation_model_name_array[0];
	
	console.log("Dynamic Model Name"+relation_model_name);
	
	/////////Check Weather selected value is field or relation 
	$.ajax({
		type: "GET",
		url: "index.php?r=gomobile/gmjsonfields/checkfieldorrelationbymodelnameandvalue",
		data: "modelname="+relation_model_name+"&selected_value="+dynamic_relation_select_object.value,
		async:false,
		success: function(server_response)
		{
			console.log(JSON.parse(server_response));
			response_array=JSON.parse(server_response);
			
			console.log("success :"+response_array['value_type']);
			
			
			if (response_array['value_type']=='relation')
			{
				console.log("IT IS RELATIOn");
				relation_completed=false;
				
				var list_data=response_array['list_data'];
				var new_model_name=response_array['newmodel'];
				
				
				/*for (var i=0; i<list_data.length;i++)
				{
					console.log(list_data[i]);
				}*/

				console.log("NEW MODEL ANME"+new_model_name);
				createDropDown(list_data,new_model_name);
				
			}
			else
			{
				console.log("IT IS FIELD");		
				relation_completed=true;
			}
			
			
			
			
			
		}///end of ajax Success
		});//
	
 
}



function append_relation_form_field(relationname)
{
	var Gmjsonfields_field_relation=document.getElementById("Gmjsonfields_field_relation");
	Gmjsonfields_field_relation.value=Gmjsonfields_field_relation.value+"|"+relationname;
	document.getElementById("field_relation").innerHTML=document.getElementById("Gmjsonfields_field_relation").value;	
 
	
	}

function addSelectObject(obj) {
 
	console.log("Add called");
    var foo = document.getElementById("fooBar");
    //Append the element in page (in span).
    //foo.appendChild(element);
	foo.appendChild(obj);
}


function validateForm() 
{
	if (relation_completed==false)
	{
		document.getElementById("field_relation_div").style.backgroundColor = '#FF9494';
		document.getElementById("field_relation_span_text").innerHTML	='*Please make sure values are selected in all dropdown boxes';
		alert('Incomplete Relation');
		return false;
	}
}


</script>