


<div id="sidemenu">             
<?php include('setup_sidemenu.php'); ?>   
</div>

<h1>Addons</h1>


<div id="submenu">   
<li><?php echo CHtml::link('Manage',array('admin')); ?></li>
<li><?php echo CHtml::link('Install',array('index')); ?></li>
</div>


<br><br>
 <script type="text/javascript">
function Checkfiles(f){
 f = f.elements;
 if(/.*\.(zip)$/.test(f['addon_zip'].value.toLowerCase()))
  return true;
 alert('Please Upload Zip Package only.');
 f['addon_zip'].focus();
 return false;
};
</script>

<form action="index.php?r=addons/install" onsubmit="return Checkfiles(this);" enctype="multipart/form-data" method="post">		

		
		 Please Upload the Add On Zip file<br>
		<input type="file" name='addon_zip' class='required'>
		<br> <br> 
		Or input the URL key<br>
		<input type="text" name='addon_url' class='required' style="width:500px;">
		<br><br>
		
		<input type="submit" name="finish"   value="Install" >
 <br>
 
 </form>
 
 
 <?php
 $model=new Addons('search');

 $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'addons-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	
	/*
	'selectableRows'=>1,
	'selectionChanged'=>'function(id){ location.href = "'.$this->createUrl('update').'/id/"+$.fn.yiiGridView.getSelection(id);}',
	*/
	
	'columns'=>array(
		//'id',
		'type',
		'addon_label',
		//'information',
		//'active',
 		
		
	
		
		array(  'name'=>'active',
				//'header'=>'Status',
				'value'=>'($data->active == 0)?"Disabled":"Enabled"',
				'filter'=>array('1'=>'Enabled', '0'=>'Disabled'),
		),	
		
	
		
		
		array( 'name'=>'created_by', 'value'=>'$data->created_by==null ? "":$data->createdByUser->username', 'filter'=>false),
		
		
		array( 'name'=>'created_on', 'value'=>'$data->created_on==null ? "":date("d-M-Y H:i:s ",$data->created_on)', 'filter'=>false),
		
		array( 'name'=>'inactivated_by', 'value'=>'$data->inactivated_by==null ? "":$data->inactivatedByUser->username', 'filter'=>false),
		array( 'name'=>'inactivated_on', 'value'=>'$data->inactivated_on==null ? "":date("d-M-Y H:i:s ",$data->inactivated_on)', 'filter'=>false),
				
				
		array(
			'class'=>'CButtonColumn',
			'template'=>'{update}',
		),
			
		array(	'name'=>'active',
				'header'=>'Actions',
				'value' => 'CHtml::link(($data->active == 0)?"Enable":"Disable", array("addons/enable_disable&id=".$data->id))',
		 		'type'=>'raw',
				'filter'=>false,
        ),
		
		

		'link'=>array(
                        'header'=>'Uninstall',
                        'type'=>'raw',
                        'value'=> 'CHtml::button("Uninstall",array("onclick"=>"document.location.href=\'".Yii::app()->controller->createUrl("addons/uninstall",array("id"=>$data->id))."\'"))',
        ),     
		
		

		
		
		

		
		
		
	),
)); ?>
		
		
 
 
 
 