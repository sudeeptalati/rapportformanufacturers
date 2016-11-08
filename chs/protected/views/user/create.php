
<div id="sidemenu">             
<?php include('setup_sidemenu.php'); ?>   
</div>

<h1>New Users</h1>

<div id="submenu">   
<li><?php echo CHtml::link('Manage Users',array('admin')); ?></li>
<li><?php echo CHtml::link('Add New Users',array('create')); ?></li>
</div>
<br><br>


<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>