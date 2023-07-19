<?php
error_reporting(0);
require_once(__DIR__.'/functions.php');
$params = require __DIR__ . '/params.php';
$db = require __DIR__ . '/db.php';
require __DIR__ . '/container.php';

$config = [
    'timeZone' => 'Asia/Karachi',
    'id' => 'basic',
    'name'=>'Diagnostics ERP',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => '{}',
        ],


        'assetManager' => [
            'bundles' => [
                'yii\web\JqueryAsset' => [
                    /*'jsOptions' => [ 'position' => \yii\web\View::POS_HEAD ],*/
                    'js'=>[]
                ],
                'yii\bootstrap\BootstrapPluginAsset' => [
                'js'=>[]
                ],
                 'yii\bootstrap\BootstrapAsset' => [
                'css' => [],
                ],


            ],
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'identityClass' => 'app\models\User',
            'enableAutoLogin' => true,
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'useFileTransport' => true,
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'db' => $db,

        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
            ],
        ],
        'authManager' => [
            'class' => 'yii\rbac\DbManager',
            'defaultRoles' => ['guest'],
        ],
		'formatter' => [
           'dateFormat' => 'd-M-Y',
           'datetimeFormat' => 'd-M-Y H:i:s',
           'timeFormat' => 'h:i:s a',
           //'locale' => 'de-DE', //your language locale
           //'defaultTimeZone' => 'Europe/Berlin', // time zone
		],
    ],
    'as beforeRequest' => [
        'class' => 'yii\filters\AccessControl',
        'rules' => [
            [
                'allow' => true,
                'actions' => ['api','login','patient-report','patient-lab-form-print-pdf' , 'apiupdate'],
            ],
            [
                'allow' => true,
                'roles' => ['@'],
            ],
        ],
        'denyCallback' => function () {
            return Yii::$app->response->redirect(['site/login']);
        },
    ],

    'modules' => [
        'gridview' =>  [
            'class' => '\kartik\grid\Module'
            // enter optional module parameters below - only if you need to
            // use your own export download action or custom translation
            // message source
            // 'downloadAction' => 'gridview/export/download',
            // 'i18n' => []
        ],
        'rbac' => [
            'class' => 'app\modules\rbac\Rbac',
        ],
		'utility' => [
            'class' => 'c006\utility\migration\Module',
        ],
    ],

    'params' => $params,
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];
}

return $config;
