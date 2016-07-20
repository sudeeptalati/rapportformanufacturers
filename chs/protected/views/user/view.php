
<div id="sidemenu">             
<?php include('setup_sidemenu.php'); ?>   
</div>


<h1>View User :<?php echo $model->name; ?></h1>
<div id="submenu">   
<li><?php echo CHtml::link('Manage Users',array('admin')); ?></li>
<li><?php echo CHtml::link('Add New Users',array('create')); ?></li>
</div>
<br><br>

<div style="text-align: right;">
<?php echo CHtml::link('Edit',array('update', 'id'=>$model->id)); ?>
</div>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		//'id',
		'username',
//		'password',
		'email',
		'profile',
		//'created',
		array(
				'name'=>'Created',
				'value'=>date('d-M-y H:m',$model->created),
		),
		array(
				'name'=>'modified',
				'value'=>date('d-M-y H:m',$model->created),
		),

	),
)); ?>
