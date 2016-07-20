<?php
$this->breadcrumbs=array(
	'Contact Details'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List ContactDetails', 'url'=>array('index')),
	array('label'=>'Create ContactDetails', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('contact-details-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Contact Details</h1>

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
	'id'=>'contact-details-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'address_line_1',
		'address_line_2',
		'address_line_3',
		'town',
		'postcode',
		/*
		'country',
		'latitudes',
		'longitudes',
		'mobile',
		'telephone',
		'fax',
		'email',
		'website',
		'created',
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
