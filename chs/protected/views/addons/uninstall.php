
<div id="sidemenu">             
<?php include('setup_sidemenu.php'); ?>   
</div>

<h1>Uninstalling Addon</h1>

<div id="submenu">   
<li><?php echo CHtml::link('Manage',array('admin')); ?></li>
<li><?php echo CHtml::link('Install',array('index')); ?></li>
</div>

<br><br>

<h2>Are you sure you want to Uninstall the following addon</h2>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		//'id',
		'type',
		'name',
		'addon_label',
		'information',
		array(  'name'=>'active',
				'header'=>'Active',
				'value'=>$model->active == 0? "Disabled":"Enabled" ,
		),
		
		'created_on',
		'created_by',
		'inactivated_on',
		'inactivated_by',
	),
)); ?>

<br><b>Make sure that you have backed up all your data related to this addon</b>
<p>Please note that this step cannot be  <b><span style="color:red;">undone</span>.</b></p>


<?php

if ($model->active==0)
{

	  $form=$this->beginWidget('CActiveForm', array(
			'id'=>'addons-form',
			'enableAjaxValidation'=>false,
			));

		
		echo CHtml::hiddenField('confirm_uinstall');
 		
		echo CHtml::submitButton('Uninstall');
 

		$this->endWidget(); 


}
else
{
	echo "<p><h3 style='color:red'>Sorry the module cannot be uninstalled as it is in use and enabled. Please ". CHtml::link('Disable ',array('update', 'id'=>$model->id))." the module first and then try again</h3><p>";
	
	echo "<br>";
		
	echo CHtml::link('Back To Manage Modules',array('admin'));
	
}

?>



