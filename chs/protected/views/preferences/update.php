<div id="sidemenu">             
<?php include('setup_sidemenu.php'); ?>   
</div>

<?php
// $this->breadcrumbs=array(
// 	'Preferences'=>array('index'),
// 	$model->id=>array('view','id'=>$model->id),
// 	'Update',
// );

// $this->menu=array(
// 	array('label'=>'List Preferences', 'url'=>array('index')),
// 	array('label'=>'Create Preferences', 'url'=>array('create')),
// 	array('label'=>'View Preferences', 'url'=>array('view', 'id'=>$model->id)),
// 	array('label'=>'Manage Preferences', 'url'=>array('admin')),
// );
?>

<h1>Update Preferences <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>