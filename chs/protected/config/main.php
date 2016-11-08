<?php



	//echo "HELLO WELCOME TO MAIN";
	//echo "<br>".dirname(dirname(__FILE__));
	//$filename = "mail_server.json";
	
	$smtp_host = '';
	$smtp_username = '';
	$smtp_password = '';
	$smtp_encryption = '';
	$smtp_port = '';
	$smtp_auth = '';
	$gateway_username = '';
	$gateway_password = '';
	$gateway_apikey = '';
	$url = dirname(__FILE__);
	
	
		
	/******** CUSTIOM MODULES START***********/
	
	/* OLD
	$addons=array(
		'gii'=>array(
			'class'=>'system.gii.GiiModule',
			'password'=>'chs',
		 	// If removed, Gii defaults to localhost only. Edit carefully to taste.
			'ipFilters'=>array('127.0.0.1','::1'),
		),
	);
	*/
	
	$addons=array(
	
	'gomobile'=>array(),
	
	'gii' => array(
				'class' => 'system.gii.GiiModule',
				'password' => 'gii',
				// If removed, Gii defaults to localhost only. Edit carefully to taste.
				'ipFilters' => array('127.0.0.1', '::1'),
				'generatorPaths' => array(
								'bootstrap.gii',),
				),
		
		'user'=>array(
                'tableUsers' => 'tbl_users',
                'tableProfiles' => 'tbl_profiles',
                'tableProfileFields' => 'tbl_profiles_fields',
				     # encrypting method (php hash function)
                'hash' => 'md5',
 
                # send activation email
                'sendActivationMail' => true,
 
                # allow access for non-activated users
                'loginNotActiv' => false,
 
                # activate user on registration (only sendActivationMail = false)
                'activeAfterRegister' => false,
 
                # automatically login from registration
                'autoLogin' => true,
 
                # registration path
                'registrationUrl' => array('/user/registration'),
 
                # recovery password path
                'recoveryUrl' => array('/user/recovery'),
 
                # login form path
                'loginUrl' => array('/user/login'),
 
                # page after login
                'returnUrl' => array('/user/profile'),
 
                # page after logout
                'returnLogoutUrl' => array('/user/login'),
				
				
        ),
        'rights'=>array(
               'superuserName'=>'Admin', // Name of the role with super user privileges. 
               'authenticatedName'=>'Authenticated',  // Name of the authenticated user role. 
               'userIdColumn'=>'id', // Name of the user id column in the database. 
               'userNameColumn'=>'username',  // Name of the user name column in the database. 
               'enableBizRule'=>true,  // Whether to enable authorization item business rules. 
               'enableBizRuleData'=>true,   // Whether to enable data for business rules. 
               'displayDescription'=>true,  // Whether to use item description instead of name. 
               'flashSuccessKey'=>'RightsSuccess', // Key to use for setting success flash messages. 
               'flashErrorKey'=>'RightsError', // Key to use for setting error flash messages. 
 
               'baseUrl'=>'/rights', // Base URL for Rights. Change if module is nested. 
               'layout'=>'rights.views.layouts.main',  // Layout to use for displaying Rights. 
               'appLayout'=>'application.views.layouts.main', // Application layout. 
               'cssFile'=>'rights.css', // Style sheet file to use for Rights. 
               'install'=>false,  // Whether to enable installer.
               'debug'=>false, 
        ),
		
		
		
	);
	
	
	$xml=simplexml_load_file($url."/addons.xml");
	foreach($xml->children() as $child)
	{
		$a=(string)$child;
		array_push($addons,$a);
	}
	//print_r($addons);
	
	
			
	/******** CUSTIOM MODULES END***********/
	
	
	
	/******** DECODING MAIL SETTING DETAILS FROM JSON FILE *************/
	
	$filename = $url."/mail_server.json";
	if(file_exists($filename))
	{
		//echo "File is present<br>";
		$data = file_get_contents($filename);
		$decodedata = json_decode($data, true);
		//echo "decoded data = ".var_dump($decodedata);
		
		$smtp_host = $decodedata['smtp_host'];
		//echo "<br>host value = ".$smtp_host;
		$smtp_username = $decodedata['smtp_username'];
		//echo "<br>user name = ".$smtp_username;
		$smtp_password = $decodedata['smtp_password'];
		//echo "<br>passowrd = ".$smtp_password;
		$smtp_encryption = $decodedata['smtp_encryption'];
		//echo "<br>encryption = ".$smtp_encryption;
		$smtp_port = $decodedata['smtp_port'];
		//echo "<br>post = ".$smtp_port;
		$smtp_auth = $decodedata['smtp_auth'];
		//echo "<br>Authentication = ".$smtp_auth;
		
	}//end of if file present.
	else 
	{
		echo "MAIL settings File not found";	
	}//end of else().

	/******** END OF DECODING MAIL SETTING DETAILS FROM JSON FILE *************/
	
	
	/*********** DECODING SMS SETTING DETAILS FROM JSON FILE ***************/
	
	$smsjsonfilename = $url.'/smsgateway_settings.json';
	
	if(file_exists($smsjsonfilename))
	{
		//echo "File exists";
		$smsdata = file_get_contents($smsjsonfilename);
		$smsDecodedData = json_decode($smsdata, true);
		//echo "<br>";
		//print_r($smsDecodedData);
	
		$gateway_username = $smsDecodedData['gateway_username'];
		//echo "<br>user name = ".$gateway_username;
		$gateway_password = $smsDecodedData['gateway_password'];
		//echo "<br>password = ".$gateway_password;
		$gateway_apikey = $smsDecodedData['gateway_apikey'];
		//echo "<br>Api key = ".$gateway_apikey;
	
	}
	else
	{
		echo "<br>SMS settings file not present";	
	}
	
	/******** END OF DECODING SMS SETTING DETAILS FROM JSON FILE *************/
	

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'timeZone' => 'Europe/London',
	'name'=>'Call Handling - Rapport',
	'defaultController'=>'servicecall/admin',
	'aliases' => array(
         
        'bootstrap' => realpath(__DIR__ . '/../extensions/bootstrap'), // change this if necessary
    ),
		

	// preloading 'log' component
	'preload'=>array('bootstrap','log'),

	// autoloading model and component classes
	'import'=>array(
		'application.models.*',
		'application.components.*',
		'application.extensions.yii-mail.*',
		'application.extensions.yii-zip.*',
		'application.extensions.yii-RGridView.*',
		//'application.extensions.*',
		'application.extensions.bootstrap.*',
		'bootstrap.helpers.TbHtml',
		'application.modules.gomobile.models.*',
		'application.modules.user.models.*',
        'application.modules.user.components.*',
        'application.modules.rights.*',
        'application.modules.rights.components.*',
        
		
		),

	'modules'=>$addons,
 
	// application components
	'components'=>array(
				'user'=>array(
							'class'=>'RWebUser',
							// enable cookie-based authentication
							'allowAutoLogin'=>true,
							'loginUrl'=>array('/user/login'),
				),
				
				'authManager'=>array(
							'class'=>'RDbAuthManager',
							'connectionID'=>'db',
							'itemTable'=>'authitem',
							'itemChildTable'=>'authitemchild',
							'assignmentTable'=>'authassignment',
							'rightsTable'=>'rights',
				),
		
		
		
				'bootstrap' => array(
						'class' => 'bootstrap.components.TbApi',   
				),	
				
				'cache' => array( 'class' => 'system.caching.CFileCache', ),
			
				'zip'=>array(
						'class'=>'application.extensions.zip.EZip',
				),
			
	
				'sms' => array(
						'class'=>'ext.ClickatellSms.ClickatellSms',
						//'clickatell_username'=>'kruthika',
						'clickatell_username'=>$gateway_username,
						//'clickatell_password'=>'ukwgoods10',
						'clickatell_password'=>$gateway_password,
						//'clickatell_apikey'=>'3406681',
						'clickatell_apikey'=>$gateway_apikey,
						'debug' => false,
						'https' => false,
						
				),

				'ePdf' => array(
					'class'         => 'ext.yii-pdf.EYiiPdf',
					'params'        => array(
							'mPDF'     => array(
									'librarySourcePath' => 'application.vendors.mpdf.*',
									'constants'         => array(
											'_MPDF_TEMP_PATH' => Yii::getPathOfAlias('application.runtime'),
									),
									'class'=>'mpdf', // the literal class filename to be loaded from the vendors folder
									/*'defaultParams'     => array( // More info: http://mpdf1.com/manual/index.php?tid=184
											'mode'              => '', //  This parameter specifies the mode of the new document.
											'format'            => 'A4', // format A4, A5, ...
											'default_font_size' => 0, // Sets the default document font size in points (pt)
											'default_font'      => '', // Sets the default font-family for the new document.
											'mgl'               => 15, // margin_left. Sets the page margins for the new document.
											'mgr'               => 15, // margin_right
											'mgt'               => 16, // margin_top
											'mgb'               => 16, // margin_bottom
											'mgh'               => 9, // margin_header
											'mgf'               => 9, // margin_footer
											'orientation'       => 'P', // landscape or portrait orientation
									)*/
							),

				'HTML2PDF' => array(
									'librarySourcePath' => 'application.vendors.html2pdf.*',
											'classFile'         => 'html2pdf.class.php', // For adding to Yii::classMap
											/*'defaultParams'     => array( // More info: http://wiki.spipu.net/doku.php?id=html2pdf:en:v4:accueil
													'orientation' => 'P', // landscape or portrait orientation
													'format'      => 'A4', // format A4, A5, ...
													'language'    => 'en', // language: fr, en, it ...
													'unicode'     => true, // TRUE means clustering the input text IS unicode (default = true)
													'encoding'    => 'UTF-8', // charset encoding; Default is UTF-8
													'marges'      => array(5, 5, 5, 8), // margins by default, in order (left, top, right, bottom)
											)*/
									),
								),
								
								
							),

			/*
			 *MAIL CONFIGURATION 
			 */
					
			'mail' => array(
		        'class' => 'application.extensions.yii-mail.YiiMail',
		        'transportType'=>'smtp', /// case sensitive!
		        'transportOptions'=>array(
					'host'=>$smtp_host,
		            //'host'=>'smtp.live.com',
		            'username'=>$smtp_username,
					//'username'=>'mailtest.test10@gmail.com',
		            'password'=>$smtp_password,
		            //'password'=>'testtest10',
					'port' => $smtp_port,
					//'port'=>'543',
					//'port'=>'465',
					'encryption'=> $smtp_encryption,
					//'encryption'=>'tls',
					//'encryption'=>'ssl',
					),
		        'viewPath' => 'application.views.mail',
		        'logging' => true,
		        'dryRun' => false
		    ),	
			
			
			
 
			

			/*
		
		'urlManager'=>array(
			'urlFormat'=>'path',
			'showScriptName'=>false,
			'rules'=>array(
				//accessing gii.
				'gii'=>'gii',
            	'gii/<controller:\w+>'=>'gii/<controller>',
            	'gii/<controller:\w+>/<action:\w+>'=>'gii/<controller>/<action>',
				// REST patterns
				array('api/ViewFullDiaryJsonData', 'pattern'=>'api/ViewFullDiaryJsonData', 'verb'=>'GET'),
				array('api/updateDiary', 'pattern'=>'api/updateDiary/<model:\w+>/<engg_id:\d+>', 'verb'=>'GET'),
				//ACCESSING OTHER CONTROLLERS.
				'<controller:\w+>/<id:\d+>'=>'<controller>/view',
				'<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
				'<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
				//FOR ACCESSING FREESEARCH.
				'<controller:\w+>/<action:\w+>/<keyword:\w+>'=>'<controller>/<action>',
				//FOR ACCESSING MODULES
				'<controller:\w+>/<action:\w+>/<keyword:\w+>'=>'<controller>/<action>',
				
				
 				'module/<module:\w+>/<controller:\w+>/<action:\w+>'=>'<module>/<controller>/<action>',
				//now do the following just so you see what I meant
				'module/<m:\w+>/<c:\w+>/<a:\w+>'=>'<m>/<c>/<a>',
			),
		),
		*/
		
		
		
		'db'=>array(
			'connectionString' => 'sqlite:'.dirname(__FILE__).'/../data/chs.db',
		),
		
		// uncomment the following to use a MySQL database
		/*
		'db'=>array(
			'connectionString' => 'mysql:host=localhost;dbname=testdrive',
			'emulatePrepare' => true,
			'username' => 'root',
			'password' => '',
			'charset' => 'utf8',
		),
		*/
		'errorHandler'=>array(
			// use 'site/error' action to display errors
            'errorAction'=>'site/error',
        ),
		'log'=>array(
			'class'=>'CLogRouter',
			'routes'=>array(
				array(
					'class'=>'CFileLogRoute',
					'levels'=>'error, warning',
				),
				// uncomment the following to show log messages on web pages
				/*
				array(
					'class'=>'CWebLogRoute',
				),
				*/
			),
		),
		
	),//end of components.

	// application-level parameters that can be accessed
	// using Yii::app()->params['paramName']
	'params'=>array(
		// this is used in contact page
		'adminEmail'=>'demo.co.uk',
		'company_name'=>'DEMO',
		'company_address'=>'Demo',
		'company_contact_details'=>'Telephone:00000000 Fax:00000000 E-mail:demo.co.uk',
		'vat_in_percentage'=>'',	
		'software_version'=>'12',	
		'smtp_host'=>$smtp_host,
		'smtp_username'=>$smtp_username,
		'smtp_password'=>$smtp_password,
		'smtp_encry'=>$smtp_encryption,
		'smtp_port'=>$smtp_port,
		'smtp_auth'=>$smtp_auth
	),

);
