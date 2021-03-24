<?php

/**
 * @author Eugine Terentev <eugine@terentev.net>
 * @author Victor Gonzalez <victor@vgr.cl>
 * @var yii\web\View $this
 * @var string $content
 */

use backend\assets\BackendArabic;
use backend\assets\BackendAsset;
use backend\modules\system\models\SystemLog;
use backend\widgets\MainSidebarMenu;
use common\models\TimelineEvent;
use yii\bootstrap4\Alert;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use yii\log\Logger;
use yii\bootstrap4\Breadcrumbs;
use yii\bootstrap4\Nav;
use yii\bootstrap4\NavBar;
use yii\bootstrap4\Html;
use rmrevin\yii\fontawesome\FAR;
use rmrevin\yii\fontawesome\FAS;
use common\components\keyStorage\FormModel;
use common\components\keyStorage\FormWidget;


if (Yii::$app->user->identity->userProfile->locale == 'en-US') {
  $bundle = BackendAsset::register($this);
} else {
  $bundle = BackendArabic::register($this);
}

Yii::info(Yii::$app->components["i18n"]["translations"]['*']['class'], 'test');

$keyStorage = Yii::$app->keyStorage;

$logEntries = [
  [
    'label' => Yii::t('backend', 'You have {num} log items', ['num' => SystemLog::find()->count()]),
    'linkOptions' => ['class' => ['dropdown-item', 'dropdown-header']]
  ],
  '<div class="dropdown-divider"></div>',
];
foreach (SystemLog::find()->orderBy(['log_time' => SORT_DESC])->limit(5)->all() as $logEntry) {
  $logEntries[] = [
    'label' => FAS::icon('exclamation-triangle', ['class' => [$logEntry->level === Logger::LEVEL_ERROR ? 'text-red' : 'text-yellow']]) . ' ' . $logEntry->category,
    'url' => ['/system/log/view', 'id' => $logEntry->id]
  ];
  $logEntries[] = '<div class="dropdown-divider"></div>';
}

$logEntries[] = [
  'label' => Yii::t('backend', 'View all'),
  'url' => ['/system/log/index'],
  'linkOptions' => ['class' => ['dropdown-item', 'dropdown-footer']]
];
?>

<?php $this->beginContent('@backend/views/layouts/base.php'); ?>
<div class="wrapper">
  <!-- navbar -->
  <?php NavBar::begin([
    'renderInnerContainer' => false,
    'options' => [
      'class' => [
        'main-header',
        'navbar',
        'navbar-expand',
        'navbar-dark',
        //                'navbar-iqraa',
        $keyStorage->get('adminlte.navbar-no-border') ? 'border-bottom-0' : null,
        $keyStorage->get('adminlte.navbar-small-text') ? 'text-sm' : null,
      ],
    ],
  ]); ?>

  <!-- left navbar links -->
  <div onclick="toggleSidebar()">
    <?php echo Nav::widget([
      'options' => ['class' => ['navbar-nav']],
      'encodeLabels' => false,
      'items' => [
        [
          // sidebar menu toggler
          'label' => FAS::icon('bars'),
          'url' => '#',
          'options' => [
            'data' => ['widget' => 'pushmenu'],
            'role' => 'button',
          ]
        ],
      ]
    ]); ?>
  </div>

  <a href="/" style="margin: 0 20px;">
    <img src="/img/2.svg" alt="logo" class="nav-logo">
  </a>

  <div>
    <h4 style="margin-bottom: 0">أكاديمية إقرأ</h4>
    <p style="font-size: xx-small; margin-bottom: 0">لتعليم اللغة العربية والقرآن الكريم</p>
  </div>


  <!-- /left navbar links -->
  <!-- <img src="/img/2.svg" alt="Iqraa Logo" class="brand-image" style="width:80px;height:50px;margin-left:auto"> -->
  <!-- <img src="/img/2.svg" alt="Iqraa Logo" class="brand-image" style="width:50px;height:50px;"> -->
  <!-- right navbar links -->
  <?php echo Nav::widget([
    //'options' => ['class' => ['navbar-nav', 'ml-auto']],
    'options' => ['class' => ['navbar-nav', 'second-nav', 'second-navAr']],
    'encodeLabels' => false,
    'items' => [
      [
        // timeline events
        'label' => FAR::icon('bell') . ' <span class="badge badge-success navbar-badge">' . TimelineEvent::find()->today()->count() . '</span>',
        'url'  => ['/timeline-event/index']
      ],
      //                [
      //                    // log events
      //                    'label' => FAS::icon('clipboard-list').' <span class="badge badge-warning navbar-badge">'.SystemLog::find()->count().'</span>',
      //                    'url' => '#',
      //                    'linkOptions' => ['class' => ['no-caret']],
      //                    'dropdownOptions' => [
      //                        'class' => ['dropdown-menu', 'dropdown-menu-lg', 'dropdown-menu-right'],
      //                    ],
      //                    'items' => $logEntries,
      //                ],
      '<li class="nav-item dropdown user-menu">
                    <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                        ' . Html::img(Yii::$app->user->identity->userProfile->getAvatar('/img/anonymous.png'), ['class' => ['img-circle', 'elevation-2', 'bg-white', 'user-image'], 'alt' => 'User image']) . '
                        ' . Html::tag('span', Yii::$app->user->identity->publicIdentity, ['class' => ['d-none', 'd-md-inline', 'user-name']]) . '
                    </a>
                    <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                        <!-- User image -->
                        <li class="user-header bg-primary">
                            ' . Html::img(Yii::$app->user->identity->userProfile->getAvatar('/img/anonymous.png'), ['class' => ['img-circle', 'elevation-2', 'bg-white'], 'alt' => 'User image']) . '
                            <p>
                                ' . Yii::$app->user->identity->publicIdentity . '
                                <small>' . Yii::t('backend', 'Member since {0, date, short}', Yii::$app->user->identity->created_at) . '</small>
                            </p>
                        </li>
                        <!-- Menu Footer-->
                        <li class="user-footer">
                            <div class="float-left">
                                ' . Html::a(Yii::t('backend', 'Profile'), ['/sign-in/profile'], ['class' => 'btn btn-default btn-flat']) . '
                            </div>
                            <div class="float-left">
                                ' . Html::a(Yii::t('backend', 'Account'), ['/sign-in/account'], ['class' => 'btn btn-default btn-flat']) . '
                            </div>
                            <div class="float-right">
                                ' . Html::a(Yii::t('backend', 'Logout'), ['/sign-in/logout'], ['class' => 'btn btn-default btn-flat', 'data-method' => 'post']) . '
                            </div>
                        </li>
                    </ul>
                </li>
                ',
      //                [
      //                    // control sidebar button
      //                    'label' => FAS::icon('th-large'),
      //                    'url'  => '#',
      //                    'linkOptions' => [
      //                        'data' => ['widget' => 'control-sidebar', 'slide' => 'true'],
      //                        'role' => 'button'
      //                    ],
      //                    'visible' => Yii::$app->user->can('administrator'),
      //                ],
    ]
  ]); ?>
  <!-- /right navbar links -->

  <?php NavBar::end(); ?>
  <!-- /navbar -->

  <div class="body-content">
    <!-- main sidebar -->
    <!-- <div style="min-height: inherit;"> -->
    <aside
      class="sidebar-dark-primary elevation-2 <?php echo $keyStorage->get('adminlte.sidebar-no-expand') ? 'sidebar-no-expand' : null ?> custom-sidebar display-sidebar"
      id="custom-sidebar">
      <!-- brand logo -->
      <!-- <a href="/"
          class="brand-link text-center <?php echo $keyStorage->get('adminlte.brand-text-small') ? 'text-sm' : null ?>"> -->

      <!--         <span class="fas fa-school"></span>-->
      <!-- <div class="sidebar-logo">
            <img src="/img/2.svg" alt="logo">
          </div>
          <span class="brand-text font-weight-bold "><?php echo Yii::t('backend', Yii::$app->name) ?></span>
        </a> -->
      <!-- /brand logo -->

      <!-- sidebar -->
      <div class="sidebar">
        <!-- sidebar user panel -->
        <div class="user-panel">
          <div class="image">
            <?php echo Html::img(
              Yii::$app->user->identity->userProfile->getAvatar('/img/anonymous.png'),
              ['class' => ['img-circle', 'elevation-2', 'bg-white'], 'alt' => 'User image']
            ) ?>
          </div>
          <div class="info">
            <a href="/sign-in/profile" class="d-block"><?php echo Yii::$app->user->identity->publicIdentity ?></a>
          </div>
        </div>
        <!-- /sidebar user panel -->

        <!-- sidebar menu -->
        <nav class="mt-2">
          <?php
          if (Yii::$app->user->can('administrator')) {
            $this->beginContent('@app/views/layouts/_administrator_menu.php');
            $this->endContent();
          } elseif (Yii::$app->user->can('manager')) {
            $this->beginContent('@app/views/layouts/_manager_menu.php');
            $this->endContent();
          } elseif (Yii::$app->user->can('teacher')) {
            $this->beginContent('@app/views/layouts/_teacher_menu.php');
            $this->endContent();
          }
          ?>


        </nav>
        <!-- /sidebar menu -->
      </div>
      <!-- /sidebar -->
    </aside>
    <!-- </div> -->
    <!-- /main sidebar -->


    <!-- content wrapper -->
    <!-- <div class="content-wrapper" style="min-height: 402px;"> -->
    <div class="content-wrapper">
      <!-- content header -->
      <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0 text-dark"><?php echo Html::encode($this->title) ?></h1>
            </div>
            <div class="col-sm-6">
              <?php echo Breadcrumbs::widget([
                'tag' => 'ol',
                'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                'options' => ['class' => ['breadcrumb']]
              ]) ?>
            </div>
          </div>
        </div>
      </div>
      <!-- /content header -->

      <!-- main content -->
      <section class="content">
        <div class="container-fluid">
          <?php if (Yii::$app->session->hasFlash('alert')) : ?>
          <?php echo Alert::widget([
              'body' => ArrayHelper::getValue(Yii::$app->session->getFlash('alert'), 'body'),
              'options' => ArrayHelper::getValue(Yii::$app->session->getFlash('alert'), 'options'),
            ]) ?>
          <?php endif; ?>
          <?php echo $content ?>
        </div>
      </section>
      <!-- /main content -->

      <?php echo Html::a(FAS::icon('chevron-up'), '#', [
        'class' => ['btn', 'btn-primary', 'back-to-top'],
        'role' => 'button',
        'aria-label' => 'Scroll to top',
      ]) ?>
    </div>
    <!-- /content wrapper -->
  </div>


  <!-- footer -->
  <footer class="main-footer <?php echo $keyStorage->get('adminlte.footer-small-text') ? 'text-sm' : null ?>">
    <strong>&copy; My Company <?php echo date('Y') ?></strong>
    <div class="float-right d-none d-sm-inline-block"><?php echo Yii::powered() ?></div>
  </footer>
  <!-- /footer -->


  <?php if (Yii::$app->user->can('administrator')) : ?>
  <!-- control sidebar -->
  <div class="control-sidebar control-sidebar-dark overflow-auto">
    <div class="control-sidebar-content p-3">
      <?php echo FormWidget::widget([
          'model' => new FormModel([
            'keys' => [
              'frontend.options' => [
                'type' => FormModel::TYPE_HEADER,
                'content' => 'Frontend Options'
              ],
              'frontend.maintenance' => [
                'label' => Yii::t('backend', 'Maintenance mode'),
                'type' => FormModel::TYPE_DROPDOWN,
                'items' => [
                  'disabled' => Yii::t('backend', 'Disabled'),
                  'enabled' => Yii::t('backend', 'Enabled'),
                ],
              ],
              'backend.options' => [
                'type' => FormModel::TYPE_HEADER,
                'content' => 'Backend Options'
              ],
              'adminlte.body-small-text' => [
                'label' => Yii::t('backend', 'Body small text'),
                'type' => FormModel::TYPE_CHECKBOX,
              ],
              'adminlte.no-navbar-border' => [
                'label' => Yii::t('backend', 'No navbar border'),
                'type' => FormModel::TYPE_CHECKBOX,
              ],
              'adminlte.navbar-small-text' => [
                'label' => Yii::t('backend', 'Navbar small text'),
                'type' => FormModel::TYPE_CHECKBOX,
              ],
              'adminlte.navbar-fixed' => [
                'label' => Yii::t('backend', 'Fixed navbar'),
                'type' => FormModel::TYPE_CHECKBOX,
              ],
              'adminlte.footer-small-text' => [
                'label' => Yii::t('backend', 'Footer small text'),
                'type' => FormModel::TYPE_CHECKBOX,
              ],
              'adminlte.footer-fixed' => [
                'label' => Yii::t('backend', 'Fixed footer'),
                'type' => FormModel::TYPE_CHECKBOX,
              ],
              'adminlte.sidebar-small-text' => [
                'label' => Yii::t('backend', 'Sidebar small text'),
                'type' => FormModel::TYPE_CHECKBOX,
              ],
              'adminlte.sidebar-flat' => [
                'label' => Yii::t('backend', 'Sidebar flat style'),
                'type' => FormModel::TYPE_CHECKBOX,
              ],
              'adminlte.sidebar-legacy' => [
                'label' => Yii::t('backend', 'Sidebar legacy style'),
                'type' => FormModel::TYPE_CHECKBOX,
              ],
              'adminlte.sidebar-compact' => [
                'label' => Yii::t('backend', 'Sidebar compact style'),
                'type' => FormModel::TYPE_CHECKBOX,
              ],
              'adminlte.sidebar-fixed' => [
                'label' => Yii::t('backend', 'Fixed sidebar'),
                'type' => FormModel::TYPE_CHECKBOX,
              ],
              'adminlte.sidebar-collapsed' => [
                'label' => Yii::t('backend', 'Collapsed sidebar'),
                'type' => FormModel::TYPE_CHECKBOX,
              ],
              'adminlte.sidebar-mini' => [
                'label' => Yii::t('backend', 'Mini sidebar'),
                'type' => FormModel::TYPE_CHECKBOX,
              ],
              'adminlte.sidebar-child-indent' => [
                'label' => Yii::t('backend', 'Indent sidebar child menu items'),
                'type' => FormModel::TYPE_CHECKBOX,
              ],
              'adminlte.sidebar-no-expand' => [
                'label' => Yii::t('backend', 'Disable sidebar hover/focus auto expand'),
                'type' => FormModel::TYPE_CHECKBOX,
              ],
              'adminlte.brand-small-text' => [
                'label' => Yii::t('backend', 'Brand small text'),
                'type' => FormModel::TYPE_CHECKBOX,
              ],
            ],
          ]),
          'submitText' => FAS::icon('save') . ' ' . Yii::t('backend', 'Save'),
          'submitOptions' => ['class' => 'btn btn-primary'],
          'formOptions' => [
            'action' => ['/system/settings/index'],
            'method' => 'post'
          ],
        ]) ?>
    </div>
  </div>
  <!-- /control sidebar -->
  <?php endif; ?>
</div>
<?php $this->endContent(); ?>

<script>
const sidebar = document.getElementById('custom-sidebar')
// const sidebardisplay = sidebar.style.display;

function toggleSidebar() {
  // console.log(sidebardisplay);
  // if (sidebardisplay === 'block') {
  //   sidebar.style.display = 'none'
  // } else {
  //   sidebar.style.display = 'block'
  // }
  if (sidebar.classList.contains('display-sidebar')) {
    sidebar.classList.remove('display-sidebar')
    sidebar.classList.add('hide-sidebar');
  } else {
    sidebar.classList.remove('hide-sidebar')
    sidebar.classList.add('display-sidebar');
  }
}
</script>