 
<?php include('graph_menu.php'); ?>   
 
 <?php
$this->menu=array(
	array('label'=>'Manage CSV Report Fields', 'url'=>array('admin')),
	array('label'=>'Create CSV Report Fields', 'url'=>array('create')),
);
?>

<h1>Create CSV Report Fields</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>