<div id="sidemenu">             
<?php include('setup_sidemenu.php'); ?>   
</div>
 



<h1>Job Status: Dropdown</h1>
<div id="submenu">   
<li><?php echo CHtml::link('Change Dashboard Priority Order', array('JobStatus/dashboardorder'));?></li>
<li><?php echo CHtml::link('Manage JobStatus', array('JobStatus/admin'));?></li>
<li><?php echo CHtml::link('Change Drop Down View Order', array('JobStatus/dropdownorder'));?></li>
</div><!-- END OF DIV SUBMENU -->


<br>


 <b>Job Status Drop Down Order: </b>
			<?php
			
						$jobStatusModel=Servicecall::model()->updateStatus();
 
						$list=CHtml::listData($jobStatusModel, 'id','name');
				 
						echo CHtml::dropDownList('', 'id',$list);
				  
			?>
	<br>
	<br><b><i><u>How To Use</u></i></b>	
	<br><br> To display the service calls with desired status on the dashboard, you need to go to Manage Job status from above menu and set the optoin of display dashboard to yes. Also make sure there is no pop up blocker is installed on your browser
	<br><br> <b>Step 1: </b>Click on any status 
  	<br> <b>Step 2: </b>Drag or Move Staus to desired order
	<br> <b>Step 3: </b> <b><u>Do Not Forget to click on Re-Order Drop Down Button at bottom when you have finished ordering</u></b>
	<br> <b>Step 4: </b>When the new order will be set, a Dialogue box will appear saying that New Order is set.
			
<?php
$dataProvider=new CActiveDataProvider('JobStatus', array(
    'criteria'=>array(
        'condition'=>'published=1',
        'order'=>'view_order ASC',
       
    ),
    'pagination'=>array(
        'pageSize'=>50,
    ),
));
 
	$this->widget('ext.yii-RGridView.RGridViewWidget', array(
    'dataProvider'=>$dataProvider,
    'rowCssId'=>'$data->id',
    'orderUrl'=>array('orderdropdown'),
    'successOrderMessage'=>'Dropdown Order Set',
    'buttonLabel'=>'Re Order Drop Down ',
    'template' => '{summary} {items} {order} {pager}',
    'options'=>array(
        'cursor' => 'crosshair',
    ),
    'columns'=>array(

    //'id',
    'name',
	'information',
 //'view_order',
   
	array(
      		'name'=>'published',
      		'value'=>'$data->published ? "Yes" : "No"',
    		'type'=>'text',
			'filter'=>array('1'=>'Yes','0'=>'No'),
	
    	),
 		  
    ),
));
?>