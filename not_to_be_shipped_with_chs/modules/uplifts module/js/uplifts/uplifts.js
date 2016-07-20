  window.onload =changeAttribute();
  
  function changeAttribute()
  {
   	console.log("Change Attribute called");
	
	
	
	if (document.getElementById("Uplifts_service_reference_number"))
	{
		var servicecall_attribute= document.getElementById("Uplifts_service_reference_number");   	
		console.log("Uplifts_service_reference_number ini is "+servicecall_attribute.value);
		servicecall_attribute.setAttribute("onkeyup","checkIfServicecallPresent();"); 	  
	}
	
  
  }
  
  
  
  
  function checkIfServicecallPresent()
  {
  
///////TO SHOW AJAX SEARCH IMAGE   
var style = document.createElement('style');
var imgurl=window.location.href.split('?')[0];
imgurl=imgurl.replace("index.php","");
imgurl=imgurl+"images/uplifts/ajax-loader.gif";
style.type = 'text/css';
style.innerHTML = '.ajaxSpin { background: url("'+imgurl+'") no-repeat right center; }';
document.getElementsByTagName('head')[0].appendChild(style);
document.getElementById('Uplifts_service_reference_number').className = 'ajaxSpin';
//console.log(imgurl);
///////END TO SHOW AJAX SEARCH IMAGE 

  
	var service_reference_number= document.getElementById("Uplifts_service_reference_number").value;   	
	
	////Removing all spaces
	service_reference_number = service_reference_number.replace(/\s/g,'');
	service_reference_number =service_reference_number.toUpperCase()
	///////console.log("checkIfSerialNumberOow Serial ini is "+servicecall_id);
	
 
	 
$.ajax({
type: "GET",
url: "index.php?r=uplifts/default/searchservicecall",
data: "service_reference_number="+service_reference_number,
async:false,
success: function(server_response)
{
	console.log(server_response);
	//alert(server_response);
	
	var jsonObj = jQuery.parseJSON( server_response );
	//console.log("******"+ jsonObj.searchstatus);
	if (jsonObj.searchstatus=='1')
	{
		//alert (jsonObj.response);
		console.log(jsonObj.searchstatustext);

		document.getElementById('Uplifts_service_reference_number').className = '';
		
		document.getElementById("Uplifts_servicecall_id").value=jsonObj.servicecall_id;
		document.getElementById("Uplifts_customer_id").value=jsonObj.customer_id;
		document.getElementById("Uplifts_customer_name").innerHTML=jsonObj.customer_name;
		document.getElementById("Uplifts_customer_town_postcode").innerHTML=jsonObj.customer_town_postcode;
		document.getElementById("Uplifts_product_id").value=jsonObj.product_id;
		document.getElementById("Uplifts_product_type_id").value=jsonObj.productType_id;
		
		 
		
		document.getElementById("Uplifts_model_number").value=jsonObj.product_model_number;
		document.getElementById("Uplifts_serial_number").value=jsonObj.product_serial_number;
		document.getElementById("Uplifts_index_number").value=jsonObj.product_index_number;
		
 


		document.getElementById("Uplifts_customer_claim_description").value=jsonObj.fault_description;
		document.getElementById("Uplifts_reason_for_uplift").value=jsonObj.reason_for_uplift;
		

		
		
		
		document.getElementById("Uplifts_retailer_id").value=jsonObj.product_retailer;
		var retailer_comapny = jsonObj.product_retailer;
		retailer_comapny = retailer_comapny.replace(/\s/g,'');
		retailer_comapny = retailer_comapny.toLowerCase();
		
		var selectretailer = document.getElementById("Uplifts_retailer_id");
		
		for(var i=0; i<selectretailer.options.length; i++) {
			var currentValue=selectretailer.options[i].text;
			currentValue=currentValue.replace(/\s/g,'');
			currentValue =currentValue.toLowerCase();
			console.log(" I "+selectretailer.options[i].text);
		
			if (retailer_comapny==currentValue)
			{
				selectretailer.selectedIndex = i;
				break;
			}//////end of if
 
		}//end of for Retailer

		
		console.log("SELCETCEWD IS :"+selectretailer.selectedIndex);
		if (selectretailer.selectedIndex=-1)
		{
		selectretailer.selectedIndex = 1;
		document.getElementById("Uplifts_retailer_contact").value=jsonObj.product_retailer;
		}
		
		
		document.getElementById("Uplifts_distributor_id").value=jsonObj.product_distributor;
		console.log("Uplifts_distributor_id "+jsonObj.product_distributor);
		
		
		var selectdistributor = document.getElementById("Uplifts_distributor_id");
		if ( jsonObj.product_distributor!=null)
		{
		console.log("*********");
		var distributor_comapny = jsonObj.product_distributor;
		distributor_comapny = distributor_comapny.replace(/\s/g,'');
		distributor_comapny = distributor_comapny.toLowerCase();
			
		for(var i=0; i<selectdistributor.options.length; i++) {
		
			var currentValue=selectdistributor.options[i].text;
			currentValue=currentValue.replace(/\s/g,'');
			currentValue =currentValue.toLowerCase();
			console.log(" I "+selectdistributor.options[i].text);
			if (distributor_comapny==currentValue)
			{
				selectdistributor.selectedIndex =i;
				break;
			}//////end of if
		}//end of for Retailer
		}//end of if
		else
		{
			selectdistributor.selectedIndex = 1;
			 
		}
		
		
		
		
		
		
		document.getElementById("Uplifts_visited_engineer_name").value=jsonObj.visited_engineer_name;
		document.getElementById("Uplifts_visited_engineer_id").value=jsonObj.visited_engineer_id;
		document.getElementById("Uplifts_purchase_date").value=jsonObj.product_date_of_purchase;

		
		 
		 
	}
	
	
}//end of success
 

});//end of $.ajax

 

 	
	
  }
  
  
  