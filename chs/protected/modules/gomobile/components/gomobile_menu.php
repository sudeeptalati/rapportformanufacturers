<style>

#actions_menu {
padding-top: 5px;
padding-left: 25px;
padding-right: 1px;
padding-bottom: 5px;
background: #89EACC;
margin-top: -5px;
margin-bottom: 0px;
list-style: inline;
border-radius: 15px;
text-align: left;	
}

#uplifts_menu {
padding-top: 5px;
padding-left: 25px;
padding-right: 25px;
padding-bottom: 5px;
background: #C7FAFF;
margin-top: -5px;
margin-bottom: 0px;
list-style: inline;
border-radius: 15px;	
text-align: right;
}

#uplifts_menu li {
 display: inline;   
  

}
#uplifts_menu li + li {
  border-left: 1px solid;
  margin-left:2em;
  padding-left:2em;

}	

</style>
 <br>
 
 <div id='actions_menu'><?php

//echo "<li>".CHtml::link("Go Mobile",array('/gomobile'))."</li>"; 
echo "".CHtml::link("Send Data",array('/gomobile/default/databyappointmentdate'))."";  
echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".CHtml::link("Get Data",array('/gomobile/gmservicecalls/receiveservicecallfrommobile'))."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"; 
//echo "<li>".CHtml::link("Post Data to Server",array('/gomobile/default/PostDatatoServer'))."</li>"; 
?>
</div>
<br>
<div id='uplifts_menu'><?php

//echo "<li>".CHtml::link("Go Mobile",array('/gomobile'))."</li>"; 
echo "<li>".CHtml::link("All Data",array('/gomobile/gmservicecalls/admin'))."</li>";  
echo "<li>".CHtml::link("Sent Data",array('/gomobile/gmservicecalls/sentcalls'))."</li>";  
echo "<li>".CHtml::link("Received Data",array('/gomobile/gmservicecalls/receivedcalls'))."</li>";  
echo "<li>".CHtml::link("Setup",array('/gomobile/gmjsonfields/admin'))."</li>";
echo "<li>".CHtml::link("Account ID",array('/gomobile/default/getaccountid'))."</li>";  

 
 //echo "<li>".CHtml::link("Post Data to Server",array('/gomobile/default/PostDatatoServer'))."</li>"; 
?>
</div>
 <br>
 

<br>
