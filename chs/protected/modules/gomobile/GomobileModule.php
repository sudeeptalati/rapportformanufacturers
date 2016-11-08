<?php

class GomobileModule extends CWebModule
{
	public function init()
	{
		// this method is called when the module is being created
		// you may place code here to customize the module or the application

		// import the module-level models and components
		$this->setImport(array(
			'gomobile.models.*',
			'gomobile.components.*',
		));
		
		$url = 	Yii::app()->getAssetManager()->publish(Yii::getPathOfAlias('application.modules.gomobile.assets'));	
		Yii::app()->clientScript->registerCssFile($url.'\css\gomobile.css') ;
		
		
		
		$gomobile_account_id=Gmservicecalls::model()->getaccountid();
		if ($gomobile_account_id=='' || $gomobile_account_id=='DEMO')
		{	
			$url=Yii::app()->getBaseUrl().'/index.php?r=gomobile/default/getaccountid';
			
			echo '<div style="background-color:red; padding:20px; width:100%;"> <h4>Please set <a href='.$url.'>account id</a> first before using the GoMobile service</h4>
					Or <a href="http://www.rapportsoftware.co.uk/index.php/about/mobile/request-gomobile-account-id" target=_blank> Click here</a> to get the account id
			</div>';
			 
		}
		
		
		
		
		
	}

	public function beforeControllerAction($controller, $action)
	{
		if(parent::beforeControllerAction($controller, $action))
		{
			// this method is called before any module controller action is performed
			// you may place customized code here
			return true;
		}
		else
			return false;
	}
}
