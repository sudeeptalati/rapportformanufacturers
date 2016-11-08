
<?php include('gomobile_menu.php');  
/* @var $this GmJsonFieldsController */
/* @var $model GmJsonFields */

 
$this->menu=array(
	array('label'=>'Manage GmJsonFields', 'url'=>array('admin')),
);
?>

<h2>Create Data Field</h2>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>