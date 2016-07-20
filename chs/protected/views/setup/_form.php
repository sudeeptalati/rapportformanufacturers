<script type="text/javascript">
function PostcodeAnywhere_Interactive_RetrieveByPostcodeAndBuilding_v1_10Begin(Key, Postcode,  UserName)
   {
      var scriptTag = document.getElementById("PCA38d38252878f434581f85b249661cd94");
      var headTag = document.getElementsByTagName("head").item(0);
      var strUrl = "";

      //Build the url
      strUrl = "http://services.postcodeanywhere.co.uk/PostcodeAnywhere/Interactive/RetrieveByPostcodeAndBuilding/v1.10/json.ws?";
      strUrl += "&Key=" + escape(Key);
      strUrl += "&Postcode=" + escape(Postcode);
      //strUrl += "&Building=" + escape(Building);
      strUrl += "&UserName=" + escape(UserName);
      strUrl += "&CallbackFunction=PostcodeAnywhere_Interactive_RetrieveByPostcodeAndBuilding_v1_10End";

      //Make the request
      if (scriptTag) 
      {
	      try
	      {
	      	headTag.removeChild(scriptTag);
	      }
	      catch (e)
	      {
	      	//Ignore
	      }
      }
      scriptTag = document.createElement("script");
      scriptTag.src = strUrl
      scriptTag.type = "text/javascript";
      scriptTag.id = "PCA38d38252878f434581f85b249661cd94";
      headTag.appendChild(scriptTag);
   }

function PostcodeAnywhere_Interactive_RetrieveByPostcodeAndBuilding_v1_10End(response)
   {
      //Test for an error
      if (response.length==1 && typeof(response[0].Error) != 'undefined')
         {
            //Show the error message
            alert(response[0].Description);
         }
      else
         {
            //Check if there were any items found
            if (response.length==0)
               {
                  alert("Sorry, no matching items found");
               }
            else
               {
         
 		 
		 
               }
         }
   }///end of call function
   
   
   function PostcodeAnywhere_Interactive_RetrieveByPostcodeAndBuilding_v1_10End(response)
   {
      //Test for an error
      if (response.length==1 && typeof(response[0].Error) != 'undefined')
         {
          	var msg=response[0].Description;
            //Show the error message
            if (response[0].Error==2)
           	 {	
            	msg+='!  Please Set A valid Key from setup page';
          	  }
            if (response[0].Error==1002)
          	 {	
           	msg+='!  Please Enter Outward Code of postcode in First part like KA1 (part before space) and Inward code in second like 2NP';
         	  }


    		alert(msg);
			
         }
      else
         {
            //Check if there were any items found
            if (response.length==0)
               {
                  alert("Sorry, no matching items found");
               }
            else
               {
	 
	document.getElementById("Customer_address_line_1").value= response[0].Line1;
	document.getElementById("Customer_address_line_2").value= response[0].Line2;
	document.getElementById("Customer_address_line_3").value= response[0].Line3;
	document.getElementById("Customer_town").value= response[0].PostTown;
	document.getElementById("Customer_country").value= response[0].CountryName;
	//document.getElementById("postcode").value= response[0].Postcode;

               }
         }
   }
   
</script>



<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'setup-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>
	
	<table style="padding:25px;margin:10px;background-color: #C7E8FD;  border-radius: 15px;">
	
	
	<tr>
		<td>
			<?php echo $form->labelEx($model,'company'); ?>
			<?php echo $form->textField($model,'company',array('rows'=>6, 'cols'=>50)); ?>
			<?php echo $form->error($model,'company'); ?>
		</td>
	</tr>
	
	<tr>
		<td colspan="2">
			<?php echo $form->labelEx($model,'address'); ?>
			<?php echo $form->textArea($model,'address',array('rows'=>5, 'cols'=>30)); ?>
			<?php echo $form->error($model,'address'); ?>
		</td>
	</tr>
	
	<tr>
		<td>
			<?php echo $form->labelEx($model,'town'); ?>
			<?php echo $form->textField($model,'town',array('rows'=>6, 'cols'=>50)); ?>
			<?php echo $form->error($model,'town'); ?>
		</td>
	
		<td>
			<?php echo $form->labelEx($model,'postcode_s'); ?> <small>First Part &nbsp; Second Part</small><br>
			<?php echo $form->textField($model,'postcode_s',array('size'=>3,'maxlength'=>4)); ?>
			<?php echo $form->error($model,'postcode_s'); ?>
		
			<?php //echo $form->labelEx($model,'postcode_e'); ?>
			<?php echo $form->textField($model,'postcode_e',array('size'=>3, 'maxlength'=>4)); ?>
			<?php echo $form->error($model,'postcode_e'); ?>
		</td>
		
		<td>
			<?php echo $form->labelEx($model,'county'); ?>
			<?php echo $form->textField($model,'county',array('rows'=>6, 'cols'=>50)); ?>
			<?php echo $form->error($model,'county'); ?>
		</td>
		
	</tr>
	
	<tr>
		<td>
			<?php echo $form->labelEx($model,'country'); ?>
			<?php
				$codes_list = CountryCodes::model()->getAllCountryNames();
				echo $form->dropDownList($model, 'country_id', $codes_list); 
			?>
			<?php echo $form->error($model,'country'); ?>
		</td>
		
		<td>
			<?php echo $form->labelEx($model,'vat_reg_no'); ?>
			<?php echo $form->textField($model,'vat_reg_no',array('rows'=>6, 'cols'=>50)); ?>
			<?php echo $form->error($model,'vat_reg_no'); ?>
		</td>
		
		<td>
			<?php echo $form->labelEx($model,'company_number'); ?>
			<?php echo $form->textField($model,'company_number',array('rows'=>6, 'cols'=>50)); ?>
			<?php echo $form->error($model,'company_number'); ?>
		</td>
	</tr>
	
	<tr>
		<td>
			
			<?php echo $form->labelEx($model,'telephone'); ?>
			<?php echo $form->textField($model,'telephone',array('maxlength'=>10, 'rows'=>6, 'cols'=>50)); ?>
			<?php echo $form->error($model,'telephone'); ?>
		</td>
		
		<td>
			<?php echo $form->labelEx($model,'alternate'); ?>
			<?php echo $form->textField($model,'alternate',array('rows'=>6, 'cols'=>50)); ?>
			<?php echo $form->error($model,'alternate'); ?>
		</td>
		
		<td>
			<?php echo $form->labelEx($model,'fax'); ?>
			<?php echo $form->textField($model,'fax',array('rows'=>6, 'cols'=>50)); ?>
			<?php echo $form->error($model,'fax'); ?>
		</td>
	</tr>
	
	<tr>
		<td>
			<?php 
			
				$country_code_val = '';
				$codes_list = CountryCodes::model()->getAllCountryNames();
				$selected = '';
				
				if($model->mobile != '')
				{
					if(strlen($model->mobile) > 12)
					{
						//echo "<br>Code is added";
						$phone_no = $model->mobile;
						// TO DISPLAY CODE AND PHONE NUMBER SEPERATLY WE ARE DIVIDING THE STRING IN 12TH POSITION FROM END OF STRING. 
						// ****** THIS WILL GIVE THE PHONE NUMBER. CODE IS TAKEN FROM THE COUNTRY'S CODE ******** 
						$code_pos = -12;
						$actual_phone_no = substr($phone_no, $code_pos);
						//echo "<br>Phone no = ".$actual_phone_no;
						$model->mobile = $actual_phone_no;
						
						$country_code_val = $model->countryCodes->calling_code;
						//echo "<br>Code = ".$country_code_val;
						
						$selected = $model->country_id;
						
					}//end if inner if(strlen()).
					
				}//end of if !null of mobile. 
			
			?>
			
			<?php echo $form->labelEx($model,'mobile'); ?>
			
			<?php 
			echo CHtml::dropDownList('calling_codes', $selected, $codes_list, 
					array(
						'prompt' => 'Please Select The Country',
						'value' => '0',
						'ajax'  => array(
									'type'  => 'POST',
									'url' => CController::createUrl('CountryCodes/getCallingCode/'),
									'data' => array("country_code_id" => "js:this.value"),
									'success'=> 'function(data) 
												{
													if(data != " ")
													{
														$("#code_disp_textField").val(data);
														$("#hidden_code_textField").val(data);
													}
													else
													{
														alert("Code is not present for this region !!!!!!!!");
													}
												}',
												'error'=> 'function(){alert("AJAX call error..!!!!!!!!!!");}',
									)//end of ajax array().
						)//end of array
				);//end of dropdown.
			?>
			
			
			<?php echo CHtml::textField('code_val', $country_code_val, array('size'=>3, 'id'=>'code_disp_textField', 'disabled'=>'disabled'));?>
			<?php
				//********** THIS HIDDEN FIELD IS TO PASS CODE VALUE TO CONTROLLER ************  
				echo CHtml::hiddenField('hidden_code_val', $country_code_val, array('id'=>'hidden_code_textField'));
			?>
			
			<?php echo $form->textField($model,'mobile',array('rows'=>6, 'cols'=>50)); ?>
			<?php echo $form->error($model,'mobile'); ?>
		</td>
		
		<td>
			<?php echo $form->labelEx($model,'email'); ?>
			<?php echo $form->textField($model,'email',array('rows'=>6, 'cols'=>50)); ?>
			<?php echo $form->error($model,'email'); ?>
		</td>
		
		<td>
			<?php echo $form->labelEx($model,'website'); ?>
			<?php echo $form->textField($model,'website',array('rows'=>6, 'cols'=>50)); ?>
			<?php echo $form->error($model,'website'); ?>
		</td>
	</tr>
	
	
	<!--<tr>
		<td>
			<?php echo $form->labelEx($model,'postcodeanywhere_account_code'); ?>
			<?php echo $form->textField($model,'postcodeanywhere_account_code',array('rows'=>6, 'cols'=>50)); ?>
			<?php echo $form->error($model,'postcodeanywhere_account_code'); ?>
		</td>
	
		<td>
			<?php echo $form->labelEx($model,'postcodeanywhere_license_key'); ?>
			<?php echo $form->textField($model,'postcodeanywhere_license_key',array('rows'=>6, 'cols'=>50)); ?>
			<?php echo $form->error($model,'postcodeanywhere_license_key'); ?>
		</td>
	</tr>
	-->
	
	<tr>
		<td>
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
		</td>
		
	</tr>
	
	</table>

<?php $this->endWidget(); ?>

</div><!-- form -->