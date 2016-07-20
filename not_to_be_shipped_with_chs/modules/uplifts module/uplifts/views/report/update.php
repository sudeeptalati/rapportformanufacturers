<?php include('uplifts_menu.php'); ?>   

 <?php
$this->menu=array( 
	array('label'=>'Manage Reports Fields', 'url'=>array('admin')),
);
?>
<h4>Report Field #  <?php echo $model->field_label; ?></h4>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>