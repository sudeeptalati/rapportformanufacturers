<div id="sidemenu">             
<?php include('setup_sidemenu.php'); ?>   
</div>

 <h1>Retailers & Distributors</h1>
 

<div id="submenu">   
<li><?php echo CHtml::link('Manage Retailers  & Distributors',array('admin')); ?></li>
<li><?php echo CHtml::link('Add New ',array('create')); ?></li>
</div>

<br>
<h4>  <?php echo $model->company; ?></h4>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		///'id',
		'company',
		'companytype',
		'address',
		'town',
		'postcode',
		'telephone',
		//'created',
	),
)); ?>
