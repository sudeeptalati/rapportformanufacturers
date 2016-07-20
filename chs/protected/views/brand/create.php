<div id="sidemenu">             
<?php include('setup_sidemenu.php'); ?>   
</div>

<h1>New Brand</h1>
<div id="submenu">   
<li><?php echo CHtml::link('Manage Brands',array('admin')); ?></li>
<li><?php echo CHtml::link('Add New Brand',array('create')); ?></li>
</div>
  
<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>