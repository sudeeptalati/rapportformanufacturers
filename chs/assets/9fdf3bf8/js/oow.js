if (document.getElementById("Product_serial_number")){	
	window.onload =changeAttribute();
}

if (document.getElementById("Uplifts_serial_number")){	
	window.onload =changeUpliftsAttribute();
}




  function changeAttribute()
  {
   	console.log("Change Attribute called");
	
	if (document.getElementById("Product_serial_number"))
	{
		var serial_number= document.getElementById("Product_serial_number");   	
		console.log("Serial ini is "+serial_number.value);
  		serial_number.setAttribute("onkeyup","checkIfSerialNumberOowViaProduct_serial_number();");
  		 
	}
  }
  

  function changeUpliftsAttribute()
  {
   	console.log("changeUpliftsAttribute Attribute called");
	
	if (document.getElementById("Uplifts_serial_number"))
	{
		var serial_number= document.getElementById("Uplifts_serial_number");   	
		console.log("Uplifts_serial_number ini is "+serial_number.value);
  		serial_number.setAttribute("onkeyup","checkIfSerialNumberOowViaUplifts_serial_number();");
	}
  }
  

  
   
  
  
  function checkIfSerialNumberOowViaProduct_serial_number()
  {
	srno=document.getElementById("Product_serial_number").value;	
	searchSerialNo(srno);
	////Call the Ajax to Check for this serial numbber.
  }
  
  
  function checkIfSerialNumberOowViaUplifts_serial_number()
  {
	srno=document.getElementById("Uplifts_serial_number").value;	
	searchSerialNo(srno);
	////Call the Ajax to Check for this serial numbber.
  }
  
  
  
  function searchSerialNo(srno)
  {
	 
	console.log("searchSerialNo  Serial ini is "+srno);
	////Removing all spaces
	srno = srno.replace(/\s/g,'');
	srno =srno.toUpperCase()
	
	
	
	
	$.ajax({
	type: "GET",
	url: "index.php?r=oow/search",
	data: "serial_number="+srno,
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