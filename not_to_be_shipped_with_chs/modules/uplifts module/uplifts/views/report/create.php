<?php include('uplifts_menu.php'); ?>   

  <?php
$this->menu=array( 
	array('label'=>'Manage Reports Fields', 'url'=>array('admin')),
);
?>
<h4>Add New Field in Uplifts Report</h4>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>