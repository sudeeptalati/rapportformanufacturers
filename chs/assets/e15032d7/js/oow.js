if (document.getElementById("Product_serial_number")){	
	window.onload =changeAttribute();
}


  function changeAttribute()
  {
   	console.log("Change Attribute called");
	
	if (document.getElementById("Product_serial_number"))
	{
		var serial_number= document.getElementById("Product_serial_number");   	
		console.log("Serial ini is "+serial_number.value);
  		serial_number.setAttribute("onkeyup","checkIfSerialNumberOow();");
  		checkIfSerialNumberOow(); 	  
	}
  }
  
  
  
  
  function checkIfSerialNumberOow()
  {
	var serial_number= document.getElementById("Product_serial_number").value;   	
	
	////Removing all spaces
	serial_number = serial_number.replace(/\s/g,'');
	serial_number =serial_number.toUpperCase()
	console.log("checkIfSerialNumberOow Serial ini is "+serial_number);
	
	////Call the Ajax to Check for this serial numbber.
 
	 
$.ajax({
type: "GET",
url: "index.php?r=oow/search",
data: "serial_number="+serial_number,
async:false,
success: function(server_response)
{
	console.log(server_response);
	//alert(server_response);
	
	var jsonObj = jQuery.parseJSON( server_response );
	console.log("******"+ jsonObj.searchstatus);
	if (jsonObj.searchstatus=='1')
	{
	 alert (jsonObj.response);
	}
	
	
}//end of success
 

});//end of $.ajax

 

 
 
	
	
	
	
	
	
	
  }
  