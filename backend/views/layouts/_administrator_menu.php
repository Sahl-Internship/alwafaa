<?php

use backend\modules\system\models\SystemLog;
use backend\widgets\MainSidebarMenu;
use common\models\TimelineEvent;
use rmrevin\yii\fontawesome\FAR;
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
        [
            'label' => Yii::t('backend', 'Timeline'),
            'icon' => FAS::icon('stream', ['class' => ['nav-icon']]),
            'url' => ['/timeline-event/index'],
            'badge' => TimelineEvent::find()->today()->count(),
            'badgeBgClass' => 'badge-success',
        ],
        [
            'label' => Yii::t('backend', 'All Users'),
            'icon' => FAS::icon('users', ['class' => ['nav-icon']]),
            'url' => ['/user/index'],
            'active' => Yii::$app->controller->id === 'user' && Yii::$app->controller->action->id === 'index',
            'visible' => Yii::$app->user->can('administrator'),
        ],
        [
            'label' => Yii::t('backend', 'Students'),
            'icon' => FAS::icon('fas fa-user-graduate', ['class' => ['nav-icon']]),
            'url' => ['/user/student'],
            'active' => Yii::$app->controller->action->id === 'student',
            'visible' => Yii::$app->user->can('administrator'),
        ],
        [
            'label' => Yii::t('backend', 'Teachers'),
            'icon' => FAS::icon('fas fa-user-tie', ['class' => ['nav-icon']]),
            'url' => ['/user/teacher'],
            'active' => Yii::$app->controller->action->id === 'teacher',
            'visible' => Yii::$app->user->can('administrator'),
        ],
        [
            'label' => Yii::t('backend', 'Sections'),
            'icon' => FAS::icon('fad fa-stream', ['class' => ['nav-icon']]),
            'url' => ['/section/index'],
            'active' => Yii::$app->controller->id === 'section',
            'visible' => Yii::$app->user->can('administrator'),
        ],
        [
            'label' => Yii::t('backend', 'Tags'),
            'icon' => FAS::icon('fas fa-tags', ['class' => ['nav-icon']]),
            'url' => ['/tag/index'],
            'active' => Yii::$app->controller->id === 'tag',
            'visible' => Yii::$app->user->can('administrator'),
        ],
        [
            'label' => Yii::t('backend', 'Courses'),
            'icon' => FAS::icon('fas fa-book-open', ['class' => ['nav-icon']]),
            'url' => ['/course/index'],
            'active' => Yii::$app->controller->id === 'course',
            'visible' => Yii::$app->user->can('administrator'),
        ],
        [
            'label' => Yii::t('backend', 'Join Requests'),
            'icon' => FAS::icon('fas fa-user-clock', ['class' => ['nav-icon']]),
            'url' => ['/student-request/index'],
            'active' => Yii::$app->controller->id === 'student-request',
            'visible' => Yii::$app->user->can('administrator'),
        ],

                                [
                                    'label' => Yii::t('backend', 'Content'),
                                    'options' => ['class' => 'nav-header'],
                                ],
                                [
                                    'label' => Yii::t('backend', 'Static pages'),
                                    'url' => ['/content/page/index'],
                                    'icon' => FAS::icon('thumbtack', ['class' => ['nav-icon']]),
                                    'active' => Yii::$app->controller->id === 'page',
                                ],
                                [
                                    'label' => Yii::t('backend', 'Articles'),
                                    'url' => '#',
                                    'icon' => FAS::icon('newspaper', ['class' => ['nav-icon']]),
                                    'options' => ['class' => 'nav-item has-treeview'],
                                    'active' => 'content' === Yii::$app->controller->module->id &&
                                        ('article' === Yii::$app->controller->id || 'category' === Yii::$app->controller->id),
                                    'items' => [
                                        [
                                            'label' => Yii::t('backend', 'Articles'),
                                            'url' => ['/content/article/index'],
                                            'icon' => FAR::icon('circle', ['class' => ['nav-icon']]),
                                            'active' => Yii::$app->controller->id === 'article',
                                        ],
                                        [
                                            'label' => Yii::t('backend', 'Categories'),
                                            'url' => ['/content/category/index'],
                                            'icon' => FAR::icon('circle', ['class' => ['nav-icon']]),
                                            'active' => Yii::$app->controller->id === 'category',
                                        ],
                                    ],
                                ],
                                [
                                    'label' => Yii::t('backend', 'Widgets'),
                                    'url' => '#',
                                    'icon' => FAS::icon('puzzle-piece', ['class' => ['nav-icon']]),
                                    'options' => ['class' => 'nav-item has-treeview'],
                                    'active' => Yii::$app->controller->module->id === 'widget',
                                    'items' => [
                                        [
                                            'label' => Yii::t('backend', 'Text Blocks'),
                                            'url' => ['/widget/text/index'],
                                            'icon' => FAR::icon('circle', ['class' => ['nav-icon']]),
                                            'active' => Yii::$app->controller->id === 'text',
                                        ],
                                        [
                                            'label' => Yii::t('backend', 'Menu'),
                                            'url' => ['/widget/menu/index'],
                                            'icon' => FAR::icon('circle', ['class' => ['nav-icon']]),
                                            'active' => Yii::$app->controller->id === 'menu',
                                        ],
                                        [
                                            'label' => Yii::t('backend', 'Carousel'),
                                            'url' => ['/widget/carousel/index'],
                                            'icon' => FAR::icon('circle', ['class' => ['nav-icon']]),
                                            'active' => in_array(Yii::$app->controller->id, ['carousel', 'carousel-item']),
                                        ],
                                    ],
                                ],
                                [
                                    'label' => Yii::t('backend', 'Translation'),
                                    'options' => ['class' => 'nav-header'],
                                    'visible' => Yii::$app->components["i18n"]["translations"]['*']['class'] === \yii\i18n\DbMessageSource::class,
                                ],
                                [
                                    'label' => Yii::t('backend', 'Translation'),
                                    'url' => ['/translation/default/index'],
                                    'icon' => FAS::icon('language', ['class' => ['nav-icon']]),
                                    'active' => (Yii::$app->controller->module->id == 'translation'),
                                    'visible' => Yii::$app->components["i18n"]["translations"]['*']['class'] === \yii\i18n\DbMessageSource::class,
                                ],
                                [
                                    'label' => Yii::t('backend', 'System'),
                                    'options' => ['class' => 'nav-header'],
                                ],
                                [
                                    'label' => Yii::t('backend', 'RBAC Rules'),
                                    'url' => '#',
                                    'icon' => FAS::icon('user-shield', ['class' => ['nav-icon']]),
                                    'options' => ['class' => 'nav-item has-treeview'],
                                    'active' => (Yii::$app->controller->module->id == 'rbac'),
                                    'items' => [
                                        [
                                            'label' => Yii::t('backend', 'Assignments'),
                                            'url' => ['/rbac/rbac-auth-assignment/index'],
                                            'icon' => FAR::icon('circle', ['class' => ['nav-icon']]),
                                        ],
                                        [
                                            'label' => Yii::t('backend', 'Items'),
                                            'url' => ['/rbac/rbac-auth-item/index'],
                                            'icon' => FAR::icon('circle', ['class' => ['nav-icon']]),
                                        ],
                                        [
                                            'label' => Yii::t('backend', 'Child Items'),
                                            'url' => ['/rbac/rbac-auth-item-child/index'],
                                            'icon' => FAR::icon('circle', ['class' => ['nav-icon']]),
                                        ],
                                        [
                                            'label' => Yii::t('backend', 'Rules'),
                                            'url' => ['/rbac/rbac-auth-rule/index'],
                                            'icon' => FAR::icon('circle', ['class' => ['nav-icon']]),
                                        ],
                                    ],
                                ],
                                [
                                    'label' => Yii::t('backend', 'Files'),
                                    'url' => '#',
                                    'icon' => FAS::icon('folder-open', ['class' => ['nav-icon']]),
                                    'options' => ['class' => 'nav-item has-treeview'],
                                    'active' => (Yii::$app->controller->module->id == 'file'),
                                    'items' => [
                                        [
                                            'label' => Yii::t('backend', 'Storage'),
                                            'url' => ['/file/storage/index'],
                                            'icon' => FAS::icon('database', ['class' => ['nav-icon']]),
                                            'active' => (Yii::$app->controller->id == 'storage'),
                                        ],
                                        [
                                            'label' => Yii::t('backend', 'Manager'),
                                            'url' => ['/file/manager/index'],
                                            'icon' => FAS::icon('archive', ['class' => ['nav-icon']]),
                                            'active' => (Yii::$app->controller->id == 'manager'),
                                        ],
                                    ],
                                ],
                                [
                                    'label' => Yii::t('backend', 'Key-Value Storage'),
                                    'url' => ['/system/key-storage/index'],
                                    'icon' => FAS::icon('exchange-alt', ['class' => ['nav-icon']]),
                                    'active' => (Yii::$app->controller->id == 'key-storage'),
                                ],
                                [
                                    'label' => Yii::t('backend', 'Cache'),
                                    'url' => ['/system/cache/index'],
                                    'icon' => FAS::icon('sync', ['class' => ['nav-icon']]),
                                ],
                                [
                                    'label' => Yii::t('backend', 'System Information'),
                                    'url' => ['/system/information/index'],
                                    'icon' => FAS::icon('tachometer-alt', ['class' => ['nav-icon']]),
                                ],
                                [
                                    'label' => Yii::t('backend', 'Logs'),
                                    'url' => ['/system/log/index'],
                                    'icon' => FAS::icon('clipboard-list', ['class' => ['nav-icon']]),
                                    'badge' => SystemLog::find()->count(),
                                    'badgeBgClass' => 'badge-danger',
                                ],


    ],
]) ;