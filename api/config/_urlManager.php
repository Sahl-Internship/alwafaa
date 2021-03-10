<?php
return [
    'class' => 'yii\web\UrlManager',
    'enablePrettyUrl' => true,
    'showScriptName' => false,
    'rules' => [
        // Api
        ['class' => 'yii\rest\UrlRule', 'controller' => 'api/v1/article', 'only' => ['index', 'view', 'options']],
        ['class' => 'yii\rest\UrlRule', 'controller' => 'api/v1/user', 'only' => ['index', 'view', 'options']],
        ['class' => 'yii\rest\UrlRule', 'controller' => 'api/v1/signup', 'only' => ['index', 'create', 'options']],
        ['class' => 'yii\rest\UrlRule', 'controller' => 'user', 'pluralize' => false],
        ['class' => 'yii\rest\UrlRule', 'controller' => 'signup', 'pluralize' => false],
        ['pattern' => 'site/login', 'route' => 'site/login'],
        ['pattern' => 'site/request-password-reset', 'route' => 'site/request-password-reset'],
        ['pattern' => 'site/reset-password', 'route' => 'site/reset-password'],
        ['class' => 'yii\rest\UrlRule', 'controller' => 'site', 'pluralize' => false],

        ['class' =>'yii\rest\UrlRule','controller'=>'site'
            ,'only'=>['login','request-password-reset','reset-password']
            ,'extraPatterns'=>[
            'Post login' => 'login' ,
            'Post request-password-reset' => 'request-password-reset' ,
            'Post reset-password' => 'reset-password' ,

        ]
            , 'pluralize'=>false
        ],
        ['class' =>'yii\rest\UrlRule','controller'=>'signup'
            ,'only'=>['create']
            ,'extraPatterns'=>[
            'Post create' => 'create' ,


        ]
            , 'pluralize'=>false
        ],
        ['class' =>'yii\rest\UrlRule','controller'=>'profile'
            ,'only'=>['update','upload-picture']
            ,'extraPatterns'=>[
            'PUT update' => 'update' ,
            'Post upload-picture' => 'upload-picture'
        ]
            , 'pluralize'=>false
        ],
        ['class' =>'yii\rest\UrlRule','controller'=>'course'
            ,'only'=>['index','review','join-course']
            ,'extraPatterns'=>[
            'GET index' => 'index' ,
            'Post review' => 'review',
            'Post join-course' => 'join-course'
        ]
            , 'pluralize'=>false
        ],
    ],
];
