<?php
$this->breadcrumbs=array(
	'Enggdiaries'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List Enggdiary', 'url'=>array('index')),
	//array('label'=>'Create Enggdiary', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('enggdiary-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Enggdiaries</h1>

<p>
You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'enggdiary-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		//'engineer_id',
		array('name'=>'engineer_name','value'=>'$data->engineer->fullname'),
		//'engineer.fullname',
		//'visit_start_date',
		array('name'=>'date_of_visit','value'=>'date("d-M-Y",$data->visit_start_date)'),
		//'visit_end_date',
		array('name'=>'visit_end_date','value'=>'date("d-M-Y",$data->visit_end_date)'),
		'slots',
		'servicecall_id',
		//'status',
		array('name'=>'appointment_status','value'=>'$data->jobStatus->name'),
		/*
		'user_id',
		'created',
		'modified',
		*/
		array(
			'class'=>'CButtonColumn',
			'template'=>'{view}{update}',
		),
	),
)); ?>
