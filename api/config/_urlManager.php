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
    ],
];
