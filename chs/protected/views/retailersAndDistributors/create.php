<div id="sidemenu">             
<?php include('setup_sidemenu.php'); ?>   
</div>

 <h1>Retailers & Distributors</h1>
 

<div id="submenu">   
<li><?php echo CHtml::link('Manage Retailers  & Distributors',array('admin')); ?></li>
<li><?php echo CHtml::link('Add New ',array('create')); ?></li>
</div>
 
 
<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>