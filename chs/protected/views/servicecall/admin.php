<?php include('servicecall_sidemenu.php');?>
<?php $searchurl=Yii::app()->baseUrl.'/index.php?r=servicecall/searchengine';?>



<?php $newdata=Gmservicecalls::model()->checkfornewdataonserver();?>
<?php $msg_json=json_decode($newdata);?>

<?php if (isset($msg_json->status)) : ?>

	<?php if ($msg_json->status=='MESSAGES') : ?>
		<?php //if (0==1) : ?>


		<a href="index.php?r=gomobile/gmservicecalls/receiveservicecallfrommobile">
			<div style="padding: 5px 5px 5px 30px; border-radius: 10px;background:#91FF95" >
				<?php echo $msg_json->status_message; ?>
			</div>
		</a>


	<?php endif; ?>
<?php endif; ?>



<!-- Search Form -->
<script type="text/javascript">
 
  function stopRKey(evt) { 
	  var evt = (evt) ? evt : ((event) ? event : null); 
	  var node = (evt.target) ? evt.target : ((evt.srcElement) ? evt.srcElement : null); 
	  if ((evt.keyCode == 13) && (node.type=="text"))  {return false;} 
	} 

	document.onkeypress = stopRKey; 

	
$(document).ready(function() {
 	$("#keyword").focus();
	
	$("#keyword").keyup(function()
	{
	
		appendurlnewcustomerurl($(this).val());
		
		var data_string = 'keyword='+ $(this).val();
		var current_url = '<?php echo $searchurl; ?>'; 

		
		if($(this).val().length>3)
		{
			console.log('Key is up'+data_string+current_url);
			$.ajax({
				type: "GET",
				url: current_url,
				data: data_string,
				success: function(server_response)
 				{
					$('#searchresultdata').html(server_response).show();
				}//end of success
			});//end of $.ajax
		
		}///end of if(faq_search_input.length>3)
		
	
	
	});//end of keyup function.
	
});//end of ready function.


function appendurlnewcustomerurl(postcode)
{
	newurl='index.php?r=Servicecall/create&postcode='+postcode;
	console.log(newurl);
	document.getElementById("newcustomer").href=newurl; 
}
</script>
<table>
	<tr>
		<td>
			<h3>Servicecalls</h3>
			<div>
				<input style="width:500px;" name="keyword" type="text" id="keyword" style="background-color: #FFFFFF" placeholder='search by serial number or postcode or name or anything '/>
			</div>
		</td>
		<td>
			<div style='float:right;'>
				<?php $service_img_html = CHtml::image('images/service.gif','Raise Service Call',array('title'=>'Raise New Service Call')); ?>
				<?php echo CHtml::link($service_img_html, array('Servicecall/create'), array('id'=>'newcustomer'));?>	
			</div>
		</td>
	</tr>
</table> 
<div id="searchresultdata"></div>




<!-- Search form end -->


 <!-- Div ADMIN GRID -->
 
 <div style="width:129%;">
 


 
<?php $gridVar = $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'servicecall-grid',
	'dataProvider'=>$model->search(),
 
	'filter'=>$model,
	'columns'=>array(
		//'id',
		//'service_reference_number',
		array(	'name'=>'service_reference_number',
				'value' => 'CHtml::link($data->service_reference_number, array("Servicecall/view&id=".$data->id))',
		 		'type'=>'raw',
        ),
		//'customer_id',
		array('header' => 'Name','name'=>'customer_name','value'=>'$data->customer->fullname'),
		array('name'=>'customer_town','value'=>'$data->customer->town'),
		array('header' => 'Postcode','name'=>'customer_postcode','value'=>'$data->customer->postcode'),
		//'product_id',
		array(	'header' => 'Product',
            	'name'=>'product_name',
				'value'=>'$data->product->productType->name',
				'filter'=>false
				),

		array('header' => 'Model','name'=>'model_number','value'=>'$data->product->model_number'),
		array('header' => 'Serial','name'=>'serial_number','value'=>'$data->product->serial_number'),

		//'contract_id',
		//array('name'=>'contract_name','value'=>'$data->contract->name'),

		//'engineer_id',
		array(
			'name'=>'engineer_id',
			'value'=>'Engineer::item("Engineer",$data->engineer_id)',
			'filter'=>Engineer::items('Engineer'),
		),

		//'created_by_user_id',

		/*
		array(
			'name'=>'job_status_id',
			'value'=>'JobStatus::published_item("JobStatus",$data->job_status_id)',
			'filter'=>JobStatus::published_items('JobStatus'),
			'type'=>'raw',
		),
		*/

		array(
			'name'=>'job_status_id',
			'value' => 'CHtml::link($data->jobStatus->html_name, array("Servicecall/view&id=".$data->id))',
		 		
			'filter'=>JobStatus::model()->getAllPublishedListdata(),
			'type'=>'raw',
		),
		
        

		//'fault_description',

		array('header' => 'RaisedBy',
            	'name'=>'user_name','value'=>'$data->createdByUser->username','filter'=>false),

		array('header' => 'ReportedDate','name'=>'fault_date', 'value'=>'date("d-M-Y",$data->fault_date)', 'filter'=>false),

		//'fault_date',
		//'created',
		array('header' => 'Created','name'=>'created', 'value'=>'date("d-M-Y H:i:s",$data->created)', 'filter'=>false),



		/*
		'insurer_reference_number',
		'job_status_id',
		'fault_date',
		'fault_code',
		'fault_description',
		'engg_diary_id',
		'work_carried_out',
		'spares_used_status_id',
		'total_cost',
		'vat_on_total',
		'net_cost',
		'job_payment_date',
		'job_finished_date',
		'notes',
		'created',
		'modified',
		'cancelled',
		'closed',
		
*/
		array(
			'header'=>'New',
			'value' => 'CHtml::link(" ", array("Servicecall/existingCustomer","customer_id"=>$data->customer_id,"product_id"=>$data->product_id ), array("class"=>"fa fa-plus fa-1x") )',
			'type'=>'raw',
		),

	/*	
		array(
			'header'=>'New Call',
			'value'=>CHtml::image('',' ',array('class'=>'fa fa-camera-retro')),
			'type'=>'raw',
		),
	*/	

	),
));



//$i=0;
//foreach ($gridVar->dataProvider->data as $data)
//{
//
//echo "<br>reff no = ".$data->service_reference_number;
//
//$i++;
//}
//
//echo "<br>i = ".$i;

?>

</div>
 <!-- End Div ADMIN GRID -->
