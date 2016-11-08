<div id="sidemenu">             
<?php include('setup_sidemenu.php'); ?>   
</div>

<?php
// $this->breadcrumbs=array(
// 	'Preferences'=>array('index'),
// 	'Manage',
// );

// $this->menu=array(
// 	array('label'=>'List Preferences', 'url'=>array('index')),
// 	array('label'=>'Create Preferences', 'url'=>array('create')),
// );

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('preferences-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Preferences</h1>

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
	'id'=>'preferences-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'feature',
		//'state',
		array('name'=>'state', 'value'=>'$data->state ? "Enabled" : "Disabled"'),
		//'created',
		array('name'=>'created', 'value'=>'date("d-M-y", $data->created)'),
		array(
			'class'=>'CButtonColumn',
			'template'=>'{view}{update}',
		),
	),
)); ?>
