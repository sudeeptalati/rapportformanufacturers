<?php include('uplifts_menu.php'); ?>   
 <?php
$this->menu=array( 
	array('label'=>'Manage Uplifts', 'url'=>array('admin')),
);
?>


 
<h1>Update</h1>
<h4>Uplift Number # <?php echo $model->uplift_number; ?></h4>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>