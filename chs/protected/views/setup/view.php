
<div id="container" style="width:150%;">

	<div  style="background-color:#FFFFFF;style='width:150%;'">
		<h1 style="margin-bottom:0;">Set Up</h1>
	</div>

	<div id="menu" style="background-color:#FFFFFF; width:70%;float:left;">

		<div style="text-align:right"><b><?php echo CHtml::link('Edit Details', array('/setup/update/&id=1'));?></b></div>

				<?php $this->widget('zii.widgets.CDetailView', array(
					'data'=>$model,
					'attributes'=>array(
						//'id',
						'company',
						'address',
						'town',
						'postcode_s',
						'postcode_e',
						'county',
						//'country',
						array('name'=>'country_id', 'value'=>$model->country_id==null ? "":$model->countryCodes->short_name),
						'email',
						'website',
						'telephone',
						'mobile',
						'alternate',
						'fax',
						'vat_reg_no',
						'company_number',
						//'postcodeanywhere_account_code',
				/*		array(
							'name'=>'postcodeanywhere_account_code',
							'type'=>'raw',
							'value'=>'<a href="admin" target="_blank">'.$model->postcodeanywhere_account_code.'</a>'
						),
						'postcodeanywhere_license_key',
				*/	
					//'postcode',
						//'version_update_url',
					),
				)); 
				?>
				<br>
				 <table style="width:100%; padding:5px;background-color: #C7E8FD; border-radius: 15px; vertical-align: top;">
				<tr>	
					<td colspan="2" style="vertical-align:top; text-align:left;">
					<h4 style="vertical-align:top; text-align:center; margin-bottom:11px;"><b>Preferred Settings</b></h4>
					
					The following settings should be used to get the best results from the application. The application have been tested under following conditions.</td>
				</tr>
				<tr>
					<td style="vertical-align:top;"><b>Browser</b></td>
					<td style="vertical-align :top;"><a href="http://www.google.com/intl/en_uk/chrome/browser/" target="_blank" >Google Chrome </a></td>
				</tr>
				<tr>
					<td style="vertical-align:top;"><b>Pop Ups</b></td>
					<td style="vertical-align :top;">No Pop up Blocker should be installed on browser. The app have several instances when user is notified through alert box. The pop up blocker also blocks the alert box.</td>
				</tr>
				<tr>
					<td style="vertical-align:top;"><b>Java Script</b></td>
					<td style="vertical-align :top;">No Java Script should be installed. The app uses java script.</td>
				</tr>
				<tr>
					<td style="vertical-align:top;"><b>Internet Connection</b></td>
					<td style="vertical-align :top;">The app is designed to work perfectly with as well as without internet. However for the features like email notification, sms notification, remote call booking alerts, the system need to have internet connection.</td>
				</tr>

				</table>
		</div>
 

	<div id="content" style="background-color:#FFFFFF;height:200px;width:20%;float:left;">
		<div id="sidemenu">             
		<?php include('setup_sidemenu.php'); ?>   
		</div>
	</div>

 

</div>




