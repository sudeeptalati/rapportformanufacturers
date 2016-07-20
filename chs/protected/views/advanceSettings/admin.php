<div id="sidemenu">             
<?php include('setup_sidemenu.php'); ?>   
</div>



<h1>Manage Advance Settings</h1>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'advance-settings-grid',
	//'dataProvider'=>$model->search(),
	'dataProvider'=>$model->dataForAdmin(),
	'filter'=>$model,
	'columns'=>array(
		//'id',
		//'parameter',
		'name',
		'value',
		array(
			'class'=>'CButtonColumn',
			'template'=>'	{update}'
		),
	),
)); ?>
