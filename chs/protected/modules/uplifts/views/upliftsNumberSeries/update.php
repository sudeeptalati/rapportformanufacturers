
<?php include('uplifts_menu.php'); ?>
<?php
$this->menu=array( 
	array('label'=>'Manage UpliftsNumberSeries', 'url'=>array('admin')),
);
?>



<h4>Uplifts Series #  <?php echo $model->prefix; ?></h4>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>