<div id="sidemenu">             
<?php include('setup_sidemenu.php'); ?>   
</div>


<h1>Tasks To Dos</h1>


<?php 
$email_sms_image=CHtml::image(Yii::app()->request->baseUrl.'/images/email-sms.png');
echo CHtml::link($email_sms_image ,array('/tasksToDo/completeTasks'));
?>

<div id="submenu">   
<li><?php echo CHtml::link('Perform Tasks',array('/tasksToDo/completeTasks')); ?></li>
<li><?php echo CHtml::link('Manage Tasks',array('/tasksToDo/admin')); ?></li>
<li><?php echo CHtml::link('Tasks Lifetime',array('/tasksToDo/tasksLifetime')); ?></li>
</div>


<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'tasks-to-do-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		//'id',
		'task',
		'status',
		'msgbody',
		'subject',
		'send_to',
		array( 'name'=>'created', 'value'=>'$data->created==null ? "":date("d-M-Y",$data->created)'),
		/*
		'created',
		'scheduled',
		'executed',
		'finished',
		*/
		array(
			'class'=>'CButtonColumn',
			'template'=>'{view}{delete}',
		),
	),
)); ?>
