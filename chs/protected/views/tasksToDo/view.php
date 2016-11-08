<div id="sidemenu">             
<?php include('setup_sidemenu.php'); ?>   
</div>

 
<h1>View TasksToDo #<?php echo $model->id; ?></h1>
<div id="submenu">   
<li><?php echo CHtml::link('Perform Tasks',array('/tasksToDo/completeTasks')); ?></li>
<li><?php echo CHtml::link('Manage Tasks',array('/tasksToDo/admin')); ?></li>
<li><?php echo CHtml::link('Tasks Lifetime',array('/tasksToDo/tasksLifetime')); ?></li>

</div>

<br><br>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'task',
		'status',
		'msgbody',
		'subject',
		'send_to',
		//'created',
		array( 'name'=>'created', 'value'=>$model->created==null ? "":date("d-M-Y",$model->created)),
		//'scheduled',
		array( 'name'=>'scheduled', 'value'=>$model->scheduled==null ? "":date("d-M-Y",$model->scheduled)),
		//'executed',
		array( 'name'=>'executed', 'value'=>$model->executed==null ? "":date("d-M-Y",$model->executed)),
		//'finished',
		array( 'name'=>'finished', 'value'=>$model->finished==null ? "":date("d-M-Y",$model->finished)),
	),
)); ?>
