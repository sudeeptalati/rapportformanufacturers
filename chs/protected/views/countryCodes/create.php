<div id="sidemenu">             
<?php include('setup_sidemenu.php'); ?>   
</div>

 <h1>Create Country Codes</h1>
 

<div id="submenu">   
<li><?php echo CHtml::link('Manage Country Codes' ,array('admin')); ?></li>
<li><?php echo CHtml::link('Add New Country Codes',array('create')); ?></li>
</div>
 

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>