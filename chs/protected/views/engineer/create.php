
<div id="sidemenu">             
<?php include('setup_sidemenu.php'); ?>   
</div>

<h1>New Engineer</h1> 

<div id="submenu">   
<li><?php echo CHtml::link('Manage Engineers',array('admin')); ?></li>
<li><?php echo CHtml::link('Add New Engineers',array('create')); ?></li>
<li><?php echo CHtml::link('Engineers Display List',array('engglistdisplay')); ?></li>
</div>


<?php echo $this->renderPartial('_form', array('model'=>$model,'contactDetailsModel'=>$contactDetailsModel,'deliveryDetailsModel'=>$deliveryDetailsModel)); ?>