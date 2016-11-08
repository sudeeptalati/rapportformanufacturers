<div id="sidemenu">             
<?php include('setup_sidemenu.php'); ?>   
</div>

 <h1>Retailers & Distributors</h1>
 

<div id="submenu">   
<li><?php echo CHtml::link('Manage Retailers  & Distributors',array('admin')); ?></li>
<li><?php echo CHtml::link('Add New ',array('create')); ?></li>
</div>
<h1>Update Retailers & Distributors <?php echo $model->company; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>