<?php



return [
    'class' => 'yii\db\Connection',
    'dsn' => YII_ENV_PROD ? env('DB_DSN'):'mysql:host=localhost;dbname=abrar',
    'username' => YII_ENV_PROD ? env('DB_USER'):'root',
    'password' => YII_ENV_PROD ? env('DB_PASS'):'',
    'charset' => 'utf8',

    // Schema cache options (for production environment)
    //'enableSchemaCache' => true,
    //'schemaCacheDuration' => 60,
    //'schemaCache' => 'cache',
	
	
	
	
	
	
	
	
];
