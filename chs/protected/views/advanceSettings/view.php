<div id="sidemenu">             
<?php include('setup_sidemenu.php'); ?>   
</div>



<h1><?php echo $model->name; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		//'id',
		'parameter',
		'name',
		'value',
	),
)); ?>



<br>
<table>
<tr><td></td>
<td align="centre">
<?php echo CHtml::button('Edit', array('submit'=>array('/advanceSettings/update/&id='.$model->id))); ?>
</td></tr>
</table>




