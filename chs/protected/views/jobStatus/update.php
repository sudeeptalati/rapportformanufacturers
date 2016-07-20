
<div id="sidemenu">             
<?php include('setup_sidemenu.php'); ?>   
</div>

<h1>Job Status : Manage</h1>
<div id="submenu">   
<li><?php echo CHtml::link('Change Dashboard Priority Order', array('JobStatus/dashboardorder'));?></li>
<li><?php echo CHtml::link('Manage JobStatus', array('JobStatus/admin'));?></li>
<li><?php echo CHtml::link('Change Drop Down View Order', array('JobStatus/dropdownorder'));?></li>
</div><!-- END OF DIV SUBMENU -->

 
<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>