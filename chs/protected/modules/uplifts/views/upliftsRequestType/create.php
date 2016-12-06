 
<?php include('uplifts_menu.php'); ?>   
 <?php
$this->menu=array( 
	array('label'=>'Create New Uplifts Request Type', 'url'=>array('create')),
);
?>
<h4>Create Uplifts Request Types</h4>


<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>