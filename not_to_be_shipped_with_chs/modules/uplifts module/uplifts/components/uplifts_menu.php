<style>

#uplifts_menu {
padding-top: 5px;
padding-left: 25px;
padding-right: 1px;
padding-bottom: 5px;
background: #C7FAFF;
margin-top: -5px;
margin-bottom: 0px;
list-style: inline;
border-radius: 15px;	
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

<div id='uplifts_menu'><?php
echo "<li>".CHtml::link("Raise",array('/uplifts/manage/create'))."</li>"; 
echo "<li>".CHtml::link("Update",array('/uplifts/manage/admin'))."</li>"; 
echo "<li>".CHtml::link("Reports",array('//uplifts/report/'))."</li>"; 
echo "<li>".CHtml::link("Uplifts Series",array('/uplifts/upliftsnumberseries/admin'))."</li>"; 
echo "<li>".CHtml::link("Request Types",array('/uplifts/UpliftsRequestType/admin'))."</li>"; 
echo "<li>".CHtml::link("Reports Fields",array('/uplifts/report/admin'))."</li>"; 
 
 
?>
</div>
 <br><br>
