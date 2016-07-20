<?php
$this->breadcrumbs=array(
	'Contact Details'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List ContactDetails', 'url'=>array('index')),
	array('label'=>'Create ContactDetails', 'url'=>array('create')),
	array('label'=>'Update ContactDetails', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete ContactDetails', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage ContactDetails', 'url'=>array('admin')),
);
?>

<h1>View ContactDetails #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'address_line_1',
		'address_line_2',
		'address_line_3',
		'town',
		'postcode',
		'country',
		'latitudes',
		'longitudes',
		'mobile',
		'telephone',
		'fax',
		'email',
		'website',
		//'lockcode',
		'created',
	),
)); ?>
