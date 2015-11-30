<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');
Yii::setPathOfAlias('bootstrap', dirname(__FILE__).'/../extensions/bootstrap');
Yii::setPathOfAlias('ckeditor', dirname(__FILE__).'/../extensions/ckeditor');
//PATH EXTENTSION CHOSEN
Yii::setPathOfAlias('ext.chosen', dirname(__FILE__).'/../extensions/chosen');
//PATH EXTENTSION SELECT2
Yii::setPathOfAlias('ext.select2', dirname(__FILE__).'/../extensions/select2');
//PATH EXTENTION DATA PICKER
Yii::setPathOfAlias('rezvan', dirname(__FILE__).'/../extensions/rezvan');
// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
require_once(dirname(__FILE__).'/../../db.php');
return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'My Web Application',
        'timeZone' => 'Asia/Ho_Chi_Minh',
	'name'=>'TheBlue',
        'theme'=>'bootstrap', // requires you to copy the theme under your themes directory
        //'defaultController' => 'site/login', 
        
	// preloading 'log' component
	'preload'=>array('log'),

	// autoloading model and component classes
	'import'=>array(
		'application.models.*',
		'application.components.*',
                'application.modules.Members.models.*',
                'application.modules.Pages.models.*',
                'application.modules.System.models.*',
                'application.modules.Post.models.*',
                'application.modules.Products.models.*',
                'application.modules.Documents.models.*',
	),
    

	'modules'=>array(
		// uncomment the following to enable the Gii tool
		'Members',
                'System',
                'Post',
                'Products',
                'Comments',
                'Documents',
                'Pages',
            
		'gii'=>array(
			'class'=>'system.gii.GiiModule',
			'password'=>'theBlue',
			// If removed, Gii defaults to localhost only. Edit carefully to taste.
			'ipFilters'=>array('127.0.0.1','::1'),
                        'generatorPaths'=>array(
                            'bootstrap.gii',
                        ),
		),
		
	),

	// application components
	'components'=>array(
                'bootstrap'=>array(
                    'class'=>'bootstrap.components.Bootstrap',
                ),
		'user'=>array(
			// enable cookie-based authentication
			'allowAutoLogin'=>true,
                        // this is actually the default value
                        'loginUrl'=>array('site/login'),
		),
		// uncomment the following to enable URLs in path-format
		
		'urlManager'=>array(
			'urlFormat'=>'path',
                        'showScriptName'=>false,
			'rules'=>array(
                                '<controller:\w+>/<id:\d+>'=>array('<controller>/view', 'urlSuffix'=>'.html', 'caseSensitive'=>false),
                                '<controller:\w+>/<action:\w+>/<id:\d+>'=>array('<controller>/<action>', 'urlSuffix'=>'.html', 'caseSensitive'=>false),
                                '<controller:\w+>/<action:\w+>'=>array('<controller>/<action>', 'urlSuffix'=>'.html', 'caseSensitive'=>false),
//				'<controller:\w+>/<id:\d+>'=>'<controller>/view',
//				'<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
//				'<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
			),
		),
		
//		'db'=>array(
//			'connectionString' => 'sqlite:'.dirname(__FILE__).'/../data/testdrive.db',
//		),
		// uncomment the following to use a MySQL database
		
		'db'=>array(
			'connectionString' => $dbConfig['connectionString'],
			'emulatePrepare' => true,
			'username' => $dbConfig['username'],
			'password' => $dbConfig['password'],
			'charset' => 'utf8',
		),
		
		'errorHandler'=>array(
			// use 'site/error' action to display errors
			'errorAction'=>'site/error',
		),
            
		'session' => array(
			'class' => 'CDbHttpSession',
			'timeout' => 60*60*24*254, // never timeout
			'connectionID' => 'db',
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
	),

	// application-level parameters that can be accessed
	// using Yii::app()->params['paramName']
	'params'=>array(
		// this is used in contact page
		'adminEmail'=>'webmaster@example.com',
	),
);