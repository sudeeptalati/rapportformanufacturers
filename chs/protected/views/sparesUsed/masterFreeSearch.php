<?php
$service_id = $_GET['service_id'];

//$this->breadcrumbs=array(
	//'Items'=>array('index'),
	//'Manage',
//);

//$this->menu=array(
	//array('label'=>'List Items', 'url'=>array('index')),
	//array('label'=>'Create Items', 'url'=>array('create')),
//);

?>

<body onload="document.search_form.query.focus()">
<!--<script type="text/javascript" src="jquery.js"></script>-->
 <?php 
 
  $baseUrl = Yii::app()->baseUrl; 
  $cs = Yii::app()->getClientScript();
  $cs->registerScriptFile($baseUrl.'/js/jquery.js');
  //include ('jquery.js'); 
  
 
  
  ?>

  <div class="admin">
  
  <script type="text/javascript">
 
 
$(document).ready(function() {

$("#faq_search_input").keyup(function()

{
var faq_search_input = $(this).val();
var dataString = 'keyword='+ faq_search_input;

//var ref_id = $('#ref_id').val(); 
//var cust_id = $('#cust_id').val(); 
var search_url = $('#search_url').val(); 
var service_id = $('#service_id').val();
 
if(faq_search_input.length>1)

{
$.ajax({
type: "GET",
//url: current_url+"/MasterSearchData/?service_id="+service_id,
url: search_url,

//data: dataString+"&service_id="+service_id,
//data: dataString+"&refid="+ref_id+"&custid="+cust_id,
data: dataString,
beforeSend:  function() {

$('input#faq_search_input').addClass('loading');

},
success: function(server_response)
{

$('#searchresultdata').html(server_response).show();
$('span#faq_category_title').html(faq_search_input);

if ($('input#faq_search_input').hasClass("loading")) {
 $("input#faq_search_input").removeClass("loading");
        } 

}
});
}return false;
});
});
	  
</script>

<?php

$baseUrl = Yii::app()->baseUrl; 
$model_name=Yii::app()->controller->id;
$current_url=$baseUrl."/".$model_name;
 


//echo $_GET['service_id'];

  
$search_url=$current_url."/MasterSearchData?service_id=".$service_id."&";

//echo $search_url;
//$customer_id = 77;
//echo "Model Name   :".$current_url."<hr>";

/*
echo "<br>".$baseUrl."<br>";

echo "Adding the Seller for ";
echo "Customer no :<br>".$customer_id ;


echo "<br>Adding the Seller for ";
echo "Service ref no :".$reference_id ;
*/

?>

 
	<input type="hidden" id="search_url" value="<?php echo $search_url;?>"/> 
	<input type="hidden" id="service_id" value="<?php echo $service_id;?>"/>
	<!--<input type="hidden" id="ref_id" value="<?php //echo $reference_id ;?>"/> 
	<input type="hidden" id="cust_id" value="<?php //echo $customer_id ;?>"/>  -->
	
			  <h3>Searching in Master Database</h3><br>
			  Enter Item Name, Part Number or barcode<br><br>
              <!-- The Searchbox Starts Here  -->
              <form  name="search_form">
              <input  name="query" type="text" id="faq_search_input" style="background-color: #FFFFFF" />
              </form>
             <!-- The Searchbox Ends  Here  -->
       <div id="searchresultdata" class="faq-articles"> </div>
     </div>



<!-- ***************** CODE FOR SEARCH BOX ********************* -->
<!---->
<!--	<br><hr>-->
<!--	-->
<!--	<h3>google search</h3>-->
<!--	-->
<!--	<form method="get" action="http://www.google.com/search" target="_blank">-->
<!---->
<!--	<input type="text"   name="q" size="31"-->
<!-- 	maxlength="255" value="" />-->
<!--	<input type="submit" value="Google Search" />-->
<!--	<input type="radio"  name="sitesearch" value="" />-->
<!-- 	The Web-->
<!--	<input type="radio"  name="sitesearch"-->
<!-- 	value="askdavetaylor.com" checked /> Ask Dave Taylor<br />-->

<!--	</form>-->
