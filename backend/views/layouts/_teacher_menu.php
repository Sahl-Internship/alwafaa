<?php

use backend\widgets\MainSidebarMenu;
use common\models\TimelineEvent;
use rmrevin\yii\fontawesome\FAS;

$keyStorage = Yii::$app->keyStorage;

echo MainSidebarMenu::widget([
    'options' => [
        'class' => [
            'nav',
            'nav-pills',
            'nav-sidebar',
            'flex-column',
            $keyStorage->get('adminlte.sidebar-small-text') ? 'text-sm' : null,
            $keyStorage->get('adminlte.sidebar-flat') ? 'nav-flat' : null,
            $keyStorage->get('adminlte.sidebar-legacy') ? 'nav-legacy' : null,
            $keyStorage->get('adminlte.sidebar-compact') ? 'nav-compact' : null,
            $keyStorage->get('adminlte.sidebar-child-indent') ? 'nav-child-indent' : null,
        ],
        'data' => [
            'widget' => 'treeview',
            'accordion' => 'false'
        ],
        'role' => 'menu',
    ],
    'items' => [
        [
            'label' => Yii::t('backend', 'Main'),
            'options' => ['class' => 'nav-header'],
        ],

//        [
//            'label' => Yii::t('backend', 'All Users'),
//            'icon' => FAS::icon('users', ['class' => ['nav-icon']]),
//            'url' => ['/user/index'],
//            'active' => Yii::$app->controller->id === 'user' && Yii::$app->controller->action->id === 'index',
//            'visible' => Yii::$app->user->can('administrator'),
//        ],


        [
            'label' => Yii::t('backend', 'My Courses'),
            'icon' => FAS::icon('fas fa-book-open', ['class' => ['nav-icon']]),
            'url' => ['/course/index'],
            'active' => Yii::$app->controller->id === 'course',
            'visible' => Yii::$app->user->can('teacher'),
        ],
        [
            'label' => Yii::t('backend', 'My Students'),
            'icon' => FAS::icon('fas fa-user-graduate', ['class' => ['nav-icon']]),
            'url' => ['/user/student'],
            'active' => Yii::$app->controller->action->id === 'student',
            'visible' => Yii::$app->user->can('teacher'),
        ],
        [
            'label' => Yii::t('backend', 'Homeworks'),
            'icon' => FAS::icon('fas fa-book', ['class' => ['nav-icon']]),
//            'url' => ['/user/student'],
            'url' => ['#'],
//            'active' => Yii::$app->controller->action->id === 'student',
            'visible' => Yii::$app->user->can('teacher'),
        ],
    ],
]) ;