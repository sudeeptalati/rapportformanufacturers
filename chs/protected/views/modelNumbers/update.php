<div id="sidemenu">             
<?php include('setup_sidemenu.php'); ?>   
</div>

 <h1>Model Numbers	</h1>
 

<div id="submenu">   
<li><?php echo CHtml::link('Manage Model Numbers',array('admin')); ?></li>
<li><?php echo CHtml::link('Add New Model Numbers',array('create')); ?></li>
</div>

 
<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>