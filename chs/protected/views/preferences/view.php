<div id="sidemenu">             
<?php include('setup_sidemenu.php'); ?>   
</div>

<?php
// $this->breadcrumbs=array(
// 	'Preferences'=>array('index'),
// 	$model->id,
// );

// $this->menu=array(
// 	array('label'=>'List Preferences', 'url'=>array('index')),
// 	array('label'=>'Create Preferences', 'url'=>array('create')),
// 	array('label'=>'Update Preferences', 'url'=>array('update', 'id'=>$model->id)),
// 	array('label'=>'Delete Preferences', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
// 	array('label'=>'Manage Preferences', 'url'=>array('admin')),
// );
?>

<h1>View Preferences #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'feature',
		//'state',
		array('name'=>'state', 'value' => ($model->state == 1) ? "Yes" : "No"),
		//'created',
		array('name'=>'created', 'value'=>date('d-M-y',$model->created))
	),
)); ?>
