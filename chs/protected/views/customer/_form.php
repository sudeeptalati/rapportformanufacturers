 
<!-- ********  CODE FOR POSTCODE SET-UP ***************** -->


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
   }//end of func PostcodeAnywhere().

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
            	msg+='!  This is Postcode Search Service. You need to setup the account with postcode anywhere. Please go to setup page and then go to Postcode Anywhere account. Create the Account there and You will obtain Postcodeanywhere Account Code and Postcodeanywhere License Key. You need to this accont code and license key in the textbox of setup page. ';
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
	document.getElementById("Customer_postcode").value= response[0].Postcode;

               }
         }
   }
    
   
</script> 

<?php

///Presets
if(isset($_GET['postcode']))
{
	$customerModel->postcode=$_GET['postcode'];
}

if(empty($productModel->contract_id))
 $productModel->contract_id= '1000001';
if(empty($productModel->warranty_for_months))
 $productModel->warranty_for_months= '24';


?>

<div class="form">

    <?php $form = $this->beginWidget('CActiveForm', array(
        'id' => 'customer-form',
        //'enableAjaxValidation'=>false,
        'enableAjaxValidation' => true,
        'clientOptions' => array(
            'validateOnSubmit' => true,
        ),
    )); ?>

    <?php

   
	
/*
    if (!empty($model->product->id)){
        $productModel = Product::model()->findByPk($model->product_id);
    } else {
        $productModel = Product::model();
    }
*/



    ?>

    <!-- *************** BLOCK TO ASSIGN COUNTRY CODES TO YTHE MOBILE NUMBERS ********************** -->

    <?php

    $country_id = '';
    $calling_code = '';

    if ($model->mobile == '') {
        //echo "<hr>In create customer form";
        $setupModel = Setup::model()->findByPk(1);
        $calling_code = $setupModel->countryCodes->calling_code;
        //echo "<br>Country calling code  = ".$setupModel->countryCodes->calling_code;
        $country_id = $setupModel->country_id;
        //echo "<hr>";
    }//This bit is called in CREATE

    if ($model->mobile != '') {
        //echo "<br>Customer mobile no = ".$model->mobile;
        $mobile_number = $model->mobile;
        $code = substr($mobile_number, 0, -10);  // gives the string data removing last 10 digits, returns only the code.
        $calling_code = $code;
        $contryCodeModel = CountryCodes::model()->findAllByAttributes(array('calling_code' => $code));

        foreach ($contryCodeModel as $data) {
            //echo "<br>Country short name = ".$data->short_name;
            //echo "<br>Country id = ".$data->id;
            $country_id = $data->id;

        }//end of foreach().

        //echo "<br>Code removing number = ".$code;
        $number = substr($mobile_number, -10);  // gives last 10 digits, returns actual no.
        //echo "<br>Actual number = ".$number;
        $model->mobile = $number;

    }//end of if(!= ''),This bit is called in UPDATE


    ?>

    <?php
    $setupModel = Setup::model()->findByPk(1);
    $postcodeanwhere_account_code = $setupModel->postcodeanywhere_account_code;
    $postcodeanwhere_license_key = $setupModel->postcodeanywhere_license_key;
    ?>

    <!-- *************** END OF BLOCK TO ASSIGN COUNTRY CODES TO YTHE MOBILE NUMBERS ********************** -->

    <p class="note">Fields with <span class="required">*</span> are required.</p>

    <?php
    echo $form->errorSummary($model);
    echo $form->errorSummary($productModel);
    ?>

    <!-- ***** MASTER TABLE FOR LAYOUT AND CURVES ******* -->
    <table>


        <!-- ******* DISPLAYING CUSTOMER  ********* -->
        <!-- CODE FOR MASTER TABLE TO CHANGE COLOR -->
        <tr>
            <td style="background-color: #C7E8FD; border-radius: 15px; vertical-align: top;">
                <!-- CODE FOR MASTER TABLE TO CHANGE COLOR END -->


                <!-- FIELDS FOR  CUSTOMER  -->
                <?php echo $form->errorSummary($model); ?>


                <table>
                    <tr>
                        <th colspan="3" ></th>
                    </tr>


                    <tr>
                        <td>
                            <?php echo $form->labelEx($model, 'title'); ?>
                            <?php echo $form->textField($model, 'title', array('rows' => 6, 'cols' => 50)); ?>
                            <?php echo $form->error($model, 'title'); ?>
                        </td>
                        <td>
                            <?php echo $form->labelEx($model, 'last_name'); ?>
                            <?php echo $form->textField($model, 'last_name', array('rows' => 6, 'cols' => 50)); ?>
                            <?php echo $form->error($model, 'last_name'); ?>
                        </td>
                        <td>
                            <?php echo $form->labelEx($model, 'first_name'); ?>
                            <?php echo $form->textField($model, 'first_name', array('rows' => 6, 'cols' => 50)); ?>
                            <?php echo $form->error($model, 'first_name'); ?>
                        </td>
                    </tr>


         
	<tr>
			<td colspan="2">
			
			
				<hr>
				<div id="locationField">
				<!--
					<input id="autocomplete" placeholder="Start typing complete address or postcode"
						   onFocus="geolocate()" type="text" style="width:100%" />
				-->
				
				</div>
				<?php
					$postcode_service=Setup::model()->findByPk(1);
				 	$postcodeanwhere_account_code=$postcode_service->postcodeanywhere_account_code;
					$postcodeanwhere_license_key=$postcode_service->postcodeanywhere_license_key;
 
				?>

			</td>
	</tr>

	<tr>
			<td colspan="2">
				<?php echo $form->labelEx($model,'postcode'); ?>
				<?php echo $form->textField($model,'postcode'); ?>
				<?php echo $form->error($model,'postcode'); ?>
				
								 <span  class="fa fa-search fa-2x" type=button value="Find" 
  						 onclick="Javascript: PostcodeAnywhere_Interactive_RetrieveByPostcodeAndBuilding_v1_10Begin
    					  ('<?php echo $postcodeanwhere_license_key; ?>',
      							 (document.getElementById('Customer_postcode').value),
      								 ''
      						)"> </span>
      						 
			</td>
	</tr>
	
	
					<tr>
						<td colspan="2">
							<?php echo $form->labelEx($model,'address_line_1'); ?>
							<?php echo $form->textField($model,'address_line_1',array('size'=>68)); ?>
							<?php echo $form->error($model,'address_line_1'); ?>
						</td>
					</tr>


					<tr>
						<td>
							<?php echo $form->labelEx($model,'address_line_2'); ?>
							<?php echo $form->textField($model,'address_line_2',array('size'=>30)); ?>
							<?php echo $form->error($model,'address_line_2'); ?>
						</td>
						<td>
							<?php echo $form->labelEx($model,'address_line_3'); ?>
							<?php echo $form->textField($model,'address_line_3',array('size'=>30)); ?>
							<?php echo $form->error($model,'address_line_3'); ?>
						</td>
					</tr>

					<tr>
						<td>
							<?php echo $form->labelEx($model,'town'); ?>
							<?php echo $form->textField($model,'town',array('size'=>30)); ?>
							<?php echo $form->error($model,'town'); ?>
						</td>
						<td>
							<?php echo $form->labelEx($model,'country'); ?>
							<?php echo $form->textField($model,'country',array('size'=>30)); ?>
							<?php echo $form->error($model,'country'); ?>
						</td>
					</tr>

		 

                    <tr>
                        <td colspan="3"><br><b><i>Contact Details</i></b></td>
                    </tr>


                    <tr>
                        <td>
                            <?php echo $form->labelEx($model, 'telephone'); ?>
                            <?php echo $form->textField($model, 'telephone', array('placeholder' =>'home landline')); ?>
                            <?php echo $form->error($model, 'telephone'); ?>

                            <?php echo $form->labelEx($model, 'fax'); ?>
                            <?php echo $form->textField($model, 'fax', array('placeholder' =>'work landline'));?>
                            <?php echo $form->error($model, 'fax'); ?>
                        </td>
                        <td>
                            <?php echo $form->labelEx($model, 'mobile'); ?>
                            <?php echo $form->textField($model, 'mobile', array('placeholder' =>'mobile without 0')); ?>
                            <!-- <small><br>(Please enter number preceding with your country code<br> Like if you are based in UK your number will 447501662739 or if you are based in India write 919893139091)</small> -->
                            <?php echo $form->error($model, 'mobile'); ?>
                        </td>
                        <td>
                            <label>Country</label>
                            <?php

                            $codes_list = CountryCodes::model()->getAllCountryNames();

                            echo CHtml::dropDownList('calling_codes', $country_id, $codes_list,
                                array(
                                    'prompt' => 'Please Select a county',
                                    'value' => '0',
                                    'ajax' => array(
                                        'type' => 'POST',
                                        'url' => CController::createUrl('CountryCodes/getCallingCode/'),
                                        'data' => array("country_code_id" => "js:this.value"),
                                        'success' => 'function(data)
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
                                        'error' => 'function(){alert("AJAX call error..!!!!!!!!!!");}',
                                    )//end of ajax array().
                                )//end of array
                            );//end of chtml dropdown.

                            ?>


                            <?php echo CHtml::textField('', $calling_code, array('size' => 3, 'disabled' => 'disabled', 'id' => 'code_disp_textField')); ?>
                            <?php
                            //********** THIS HIDDEN FIELD IS TO PASS CODE VALUE TO CONTROLLER ************
                            echo CHtml::hiddenField('hidden_code_val', $calling_code, array('id' => 'hidden_code_textField'));
                            ?>

                        </td>
                    </tr>

                    <tr>
                        <td colspan="2">
                            <?php //echo $form->labelEx($model, 'email'); ?>
                            <?php echo $form->textField($model, 'email', array('placeholder' =>'customer email', 'style' => 'width: 450px;')); ?>
                            <?php echo $form->error($model, 'email'); ?>

                            <?php echo $form->labelEx($model,'notes'); ?>
                            <?php echo $form->textArea($model,'notes',array(  'style' => 'width: 450px; height:100px;',  'value'=>'')); ?>
                            <?php echo $form->error($model,'notes'); ?>
                            <div style="width:100%;">
                                <?php echo Setup::model()->printjsonnotesorcommentsinhtml($model->notes); ?>
                            </div>

                        </td>
                    </tr>
                    <!-- END OF CUSTOMER INNER TABLE -->
                </table>


                <!-- CODE FOR MASTER TABLE TO CHANGE COLOR -->
            </td>
        </tr>
        <tr>
            <td></td>
        </tr>
        <tr>
            <td style="background-color: #ADEBAD; border-radius: 15px; vertical-align: top;">
                <!-- CODE FOR MASTER TABLE TO CHANGE COLOR END -->


                <!-- FIELDS FROM PRODUCT TABLE -->

                <table style="width:400px; margin:10px;">
                    <tr>
                        <td colspan="3"><h2 style="margin-bottom:0.01px;color:#555;"><label>Product Details</label></h2>

                        </td>
                    </tr>

                    <tr>
                        <td>
                            <?php echo $form->labelEx($productModel, 'brand_id'); ?>
                            <?php echo CHtml::activeDropDownList($productModel, 'brand_id', $productModel->getAllBrands() ); ?>
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
                            <?php echo CHtml::activeDropDownList($productModel, 'contract_id', $productModel->getAllContract() ); ?>
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
                            <?php echo $form->textField($productModel,'warranty_date', array('readonly'=>'readonly')); ?>
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
                            <?php echo $form->textField($productModel,'purchase_date', array('readonly'=>'readonly')); ?>
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


                <?php //echo $form->labelEx($productModel,'customer_id'); ?>
                <?php //CUSTOMER ID SET TO ZERO TO CHECK WHETHER NEW CUSTOMER.?>
                <?php echo $form->hiddenField($productModel, 'customer_id', array('value' => 0)); ?>
                <?php echo $form->error($productModel, 'customer_id'); ?>

                <?php echo $form->hiddenField($model, 'lockcode', array('value' => 0)); ?>
                <?php echo $form->error($model, 'lockcode'); ?>


                <!-- CODE FOR MASTER TABLE TO CHANGE COLOR -->
            </td>
        </tr>
        <tr>
            <td></td>
        </tr>
        <tr>
            <td style="background-color: #F3B6B7; border-radius: 15px; vertical-align: top;">
                <!-- CODE FOR MASTER TABLE TO CHANGE COLOR END -->


                <table style="width:400px; margin:10px;">
                    <tr>
                        <td colspan="2"><h2 style="margin-bottom:0.01px;color:#555;"><label>Assign Engineer</label></h2>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <?php echo $form->labelEx($productModel, 'engineer_id'); ?>
                            <?php //echo $form->textField($model,'engineer_id'); ?>
                            <?php //echo CHtml::activeDropDownList($productModel, 'engineer_id', $productModel->getAllEngineers());?>
                            <?php echo CHtml::activeDropDownList($productModel, 'engineer_id', Engineer::model()->getAllEnggAndCompany(), array('empty' => array('90000000' => 'Not Assigned'))); ?>
                            <?php echo $form->error($productModel, 'engineer_id'); ?>
                        </td>
                        <td>
                            <?php
                            echo CHtml::submitButton($model->isNewRecord ? 'Register This New Customer' : 'Modify this Customer');
                            //echo CHtml::ajaxSubmitButton('Register',array('customer/create','ajax'=>'create_form'));
                            ?>
                        </td>
                    </tr>
                </table>

        </tr>
    </table><!-- END OF MASTER TABLE WITH CURVES -->

    <?php // }//end of else of count($result).?>
    <?php $this->endWidget(); ?>

</div><!-- form -->



<script>

    var Product_purchase_date = new Pikaday(
        {
            numberOfMonths: 3,
            field: document.getElementById('Product_purchase_date'),

        });
    
     var Product_warranty_date = new Pikaday(
        {
            numberOfMonths: 3,
            field: document.getElementById('Product_warranty_date'),
             onSelect: function(date) {
      			  copywarrantydatetopurchasedate();
    		}

        });
    
	    
        
    function copywarrantydatetopurchasedate()
	{
		document.getElementById('Product_purchase_date').value=document.getElementById('Product_warranty_date').value;
	}////end of function copywarrantydatetopurchasedate()
	
        
</script>