<?php
$this->breadcrumbs=array(
	'Spares Useds'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List SparesUsed', 'url'=>array('index')),
	array('label'=>'Create SparesUsed', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('spares-used-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Spares Useds</h1>

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
	'id'=>'spares-used-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'master_item_id',
		'servicecall_id',
		'item_name',
		'part_number',
		'unit_price',
		/*
		'quantity',
		'total_price',
		'date_ordered',
		'created',
		'modified',
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>

<!-- ******* TEMP CODE TO TEST JSON FILE MUST BE DELETED LATER ************ -->

<?php 

	
	
//	$sparesModel = SparesUsed::model()->initialize();
	
//	$sparesModel = SparesUsed::model()->addData();
	
//	$sparesModel = SparesUsed::model()->finalize();
	
//	$sparesModel = SparesUsed::model()->uploadFile('KRUTHIKA');

?>

<!-- ******* END OF TEMP CODE TO TEST JSON FILE MUST BE DELETED LATER ************ -->
