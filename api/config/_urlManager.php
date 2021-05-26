<?php
return [
    'class' => 'yii\web\UrlManager',
    'enablePrettyUrl' => true,
    'enableStrictParsing' => true,
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

        ['class' => 'yii\rest\UrlRule', 'controller' => 'site'
            , 'only' => ['login', 'request-password-reset', 'reset-password']
            , 'extraPatterns' => [
            'Post login' => 'login',
            'Post request-password-reset' => 'request-password-reset',
            'Post reset-password' => 'reset-password',

        ]
            , 'pluralize' => false
        ],
        ['class' => 'yii\rest\UrlRule', 'controller' => 'signup'
            , 'only' => ['create']
            , 'extraPatterns' => [
            'POST create' => 'create',


        ]
            , 'pluralize' => false
        ],
        ['class' => 'yii\rest\UrlRule', 'controller' => 'profile'
            , 'only' => ['data','update', 'upload-picture','delete-cover','joined-courses']
            , 'extraPatterns' => [
            'GET data' => 'data',
            'PUT update' => 'update',
            'PATCH upload-picture' => 'upload-picture',
            'DELETE delete-cover' => 'delete-cover',
            'GET joined-courses' => 'joined-courses',
        ]
            , 'pluralize' => false
        ],

        ['class' => 'yii\rest\UrlRule', 'controller' => 'course'
            , 'only' => ['index', 'view', 'section']
            , 'extraPatterns' => [
            'GET index' => 'index',
            'GET view' => 'view',
            'GET section' => 'section',
        ],
            'pluralize' => false
        ],

        ['class' => 'yii\rest\UrlRule', 'controller' => 'join-course',
            'only' => ['review', 'join-course','upload-homework'],
            'extraPatterns' => [
            'POST review' => 'review',
            'POST join-course' => 'join-course',
            'POST upload-homework' => 'upload-homework',
        ]
            , 'pluralize' => false
        ],

        ['class' => 'yii\rest\UrlRule', 'controller' => 'home'
            , 'only' => ['index']
            , 'extraPatterns' => [
            'GET index' => 'index',
        ]
            , 'pluralize' => false
        ],
    ],
];
