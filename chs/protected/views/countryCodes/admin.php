<div id="sidemenu">             
<?php include('setup_sidemenu.php'); ?>   
</div>

 <h1>Country Codes</h1>
 

<div id="submenu">   
<li><?php echo CHtml::link('Manage Country Codes' ,array('admin')); ?></li>
<li><?php echo CHtml::link('Add New Country Codes',array('create')); ?></li>
</div>

 

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'country-codes-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		//'id',
		//'iso2',
		'short_name',
		'long_name',
		//'iso3',
		//'numcode',
		
		//'un_member',
		'calling_code',
		///'cctld',
		
		array(
			'class'=>'CButtonColumn',
			'template'=>'{view}{update}',
		),
	),
)); ?>
