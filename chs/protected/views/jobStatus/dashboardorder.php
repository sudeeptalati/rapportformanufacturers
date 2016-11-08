<div id="sidemenu">             
<?php include('setup_sidemenu.php'); ?>   
</div>
 



<h1>Job Status: Dashboard</h1>
<div id="submenu">   
<li><?php echo CHtml::link('Change Dashboard Priority Order', array('JobStatus/dashboardorder'));?></li>
<li><?php echo CHtml::link('Manage JobStatus', array('JobStatus/admin'));?></li>
<li><?php echo CHtml::link('Change Drop Down View Order', array('JobStatus/dropdownorder'));?></li>
</div><!-- END OF DIV SUBMENU -->

<br><br>
<table>
<tr><td>
	This feature is for changing the order of job status as they appear on the dash board page. (The home screen Page). You can drag and move the view order as per your priority.
	<br><br> To display the service calls with desired status on the dashboard, you need to go to Manage Job status from above menu and set the optoin of display dashboard to yes. Also make sure there is no pop up blocker is installed on your browser
	<br>
	<br><b><i><u>How To Use</u></i></b>	
	<br> <b>Step 1: </b>Click on any status 
  	<br> <b>Step 2: </b>Drag or Move Staus to desired order
	<br> <b>Step 3: </b> <b><u>Do Not Forget to click on Re-Order Drop Down Button at bottom when you have finished ordering</u></b>
	<br> <b>Step 4: </b>When the new order will be set, a Dialogue box will appear saying that New Order is set.
 </td>
 <td>
 <?php  $reorder_img=Yii::app()->request->baseUrl."/images/reorder.png";?>
 <?php echo CHtml::image($reorder_img,"ballpop",array()); ?>
 </td>
 </tr></table>
 
 <?php 
$dataProvider=new CActiveDataProvider('JobStatus', array(
    'criteria'=>array(
        'condition'=>'dashboard_display=1',
        'order'=>'dashboard_prority_order ASC',
       
    ),
    'pagination'=>array(
        'pageSize'=>50,
    ),
));
 
	$this->widget('ext.yii-RGridView.RGridViewWidget', array(
    'dataProvider'=>$dataProvider,
    'rowCssId'=>'$data->id',
    'orderUrl'=>array('order'),
    'successOrderMessage'=>'New Order Set',
    'buttonLabel'=>'Re-Order',
    'template' => '{summary} {items} {order} {pager}',
    'options'=>array(
        'cursor' => 'crosshair',
    ),
    'columns'=>array(
      		
    // 'dashboard_prority_order',
    'name',
	'information',

	array(
      		'name'=>'dashboard_display',
      		'value'=>'$data->dashboard_display ? "Yes" : "No"',
    		'type'=>'text',
			'filter'=>array('1'=>'Yes','0'=>'No'),
	
    	),
 		  
    ),
));

?>
 

<!-- **************** END OF CODE OF SORTING OF VIEW ORDER ***************** -->
