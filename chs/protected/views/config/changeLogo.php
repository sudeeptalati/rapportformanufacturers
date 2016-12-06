
<div id="sidemenu">             
<?php include('setup_sidemenu.php'); ?>   
</div>



<h4>Change Company Logo</h4><?php
$company_logo=Yii::app()->request->baseUrl."/images/company_logo.png";
$rapport_logo=Yii::app()->request->baseUrl."/images/rapport_logo.png";
?>
 
<?php echo CHtml::image($company_logo,"ballpop",array("width"=>"200", "height"=>"75")); ?>

 

<form id="install" action="changeLogo" enctype="multipart/form-data" method="post">		

		
		<small>Ideal size is 200 x 75 (in pixels) in PNG </small><br>
		<input type="file" name='logo_url'/>
		
  <input type="submit" name="finish" value="Change" />
 <br>
 <small>Note: Logo change can sometimes take time to be in effect due to cache memory of your browser</small>
 </form>