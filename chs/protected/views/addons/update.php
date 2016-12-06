


<div id="sidemenu">             
<?php include('setup_sidemenu.php'); ?>   
</div>

<h1>Addons</h1>


<div id="submenu">   
<li><?php echo CHtml::link('Manage',array('admin')); ?></li>
<li><?php echo CHtml::link('Install',array('index')); ?></li>
</div>


 

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>