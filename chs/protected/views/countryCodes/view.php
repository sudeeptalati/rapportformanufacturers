 <div id="sidemenu">             
<?php include('setup_sidemenu.php'); ?>   
</div>


<h1>View CountryCodes #<?php echo $model->long_name; ?></h1>
<div id="submenu">   
<li><?php echo CHtml::link('Manage Country Codes' ,array('admin')); ?></li>
<li><?php echo CHtml::link('Add New Country Codes',array('create')); ?></li>
</div>


<div style="text-align:right;" >
<?php echo CHtml::link('Edit',array('update', 'id'=>$model->id)); ?>
</div>



<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		/*
		'id',
		'iso2',
		*/
		'short_name',
		'long_name',
		'calling_code',
		/*
		'iso3',
		'numcode',
		'un_member',
		'cctld',
		*/
	),
)); ?>
