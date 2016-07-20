<?php
$this->breadcrumbs=array(
	'Customers'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List Customer', 'url'=>array('index')),
	array('label'=>'Create Customer', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('customer-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Customers</h1>

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
	'id'=>'customer-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'title',
		'first_name',
		'last_name',
		//'product_id',
		'address_line_1',
		array( 'name'=>'created_by_user', 'value'=>'$data->createdByUser->username' ),
		/*
		'address_line_2',
		'address_line_3',
		'town',
		'postcode',
		'country',
		'telephone',
		'mobile',
		'fax',
		'email',
		'notes',
		'created_by_user_id',
		'created',
		'modified',
		*/
//		array(
//			'class'=>'CButtonColumn',
//			'template'=>'{view}{update}',
//		),
		
		array
		(
		    'class'=>'CButtonColumn',
		    'template'=>'{add_quantity}',
		    'buttons'=>array
		    (
		        'add_quantity' => array
		        (
		            'label'=>'Selct this customer',
		        	//'name'=>'select',
		            //'imageUrl'=>Yii::app()->request->baseUrl.'/images/remove.png',
		        	//'click'=>'function(){alert("Adding to stock!");}',
		            //'url'=>'Yii::app()->createUrl("inboundItem/create", array("id"=>$data->id))',
		            //'url'=>'Yii::app()->createUrl("outboundItemsHistory/create")',
		            'url'=>'Yii::app()->createUrl("Servicecall/existingCustomer" , array("customer_id"=>$data->id,))',
		        ),
		        
		    ),
		)
	),
)); ?>
