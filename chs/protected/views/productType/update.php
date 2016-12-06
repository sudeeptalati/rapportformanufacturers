<div id="sidemenu">             
<?php include('setup_sidemenu.php'); ?>   
</div>

<h1>Update ProductType :<?php echo $model->name; ?></h1>

<div id="submenu">   
<li><?php echo CHtml::link('Manage Product Types',array('admin')); ?></li>
<li><?php echo CHtml::link(' New Product Types',array('create')); ?></li>
</div>
<br><br>


<?php echo $this->renderPartial('updateProductType', array('model'=>$model)); ?>