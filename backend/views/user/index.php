<?php

use common\models\User;
use yii\helpers\Html;
use yii\grid\GridView;
use rmrevin\yii\fontawesome\FAS;

/**
 * @var yii\web\View $this
 * @var backend\models\search\UserSearch $searchModel
 * @var yii\data\ActiveDataProvider $dataProvider
 * @var $title
 */
$this->title = $title;
$this->params['breadcrumbs'][] = $this->title;
?>
<?php
if(Yii::$app->controller->action->id === 'student'){
    $createMsg = 'Create New Student';
}elseif(Yii::$app->controller->action->id === 'teacher'){
    $createMsg = 'Create New Teacher';
}elseif(Yii::$app->controller->action->id === 'manager'){
    $createMsg = 'Create New Manager';
}else{
    $createMsg = 'Create New User';
}

?>

<div class="card">
    <div class="card-header">

        <?php
        if(Yii::$app->controller->id === 'user' && Yii::$app->controller->action->id === 'index') {
            echo Html::a(FAS::icon('user-plus').' '.Yii::t('backend', $createMsg, [
                    'modelClass' => 'User',
                ]), ['create'], ['class' => 'btn success-btn']);
        }
         ?>
    </div>

    <div class="card-body p-0">
        <?php echo GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'layout' => "{items}\n{pager}",
            'options' => [
                'class' => ['gridview', 'table-responsive'],
            ],
            'tableOptions' => [
                'class' => ['table', 'text-nowrap', 'table-striped', 'table-bordered', 'mb-0'],
            ],
            'columns' => [
                [
                    'attribute' => 'id',
                    'options' => ['style' => 'width: 5%'],
                ],
                'fullName',
                'email:email',
                [
                    'attribute'=>'status',
                    'value'=>function($data){
                        $status = User::statuses();
                        return $status[$data->status];
                    },
                    'filter'=>Html::activeDropDownList($searchModel,'status',\common\models\User::statuses(),[
                        'class'=>'form-control',
                        'prompt'=>'All'
                    ]),
                ],
                [
                    'attribute'=>'country',
                    'label'=>Yii::t('backend','Country'),
                    'value'=>function($data){
                        return $data->userProfile->country;
                    },
                ],
                [
                    'attribute'=>'phone',
                    'label'=>Yii::t('backend','Phone'),
                    'value'=>function($data){
                        return $data->userProfile->phone;
                    },
                ],
                [
                    'class' => \common\widgets\ActionColumn::class,
                    'template' => '{view} {update} {delete}',
                    'options' => ['style' => 'width: 140px'],
                    'buttons' => [
                        'login' => function ($url) {
                            return Html::a(
                                FAS::icon('sign-in-alt', ['aria' => ['hidden' => true], 'class' => ['fa-fw']]),
                                $url,
                                [
                                    'title' => Yii::t('backend', 'Login'),
                                    'class' => ['btn', 'btn-xs', 'btn-secondary']
                                ]
                            );
                        },
                    ],
                    'visibleButtons' => [
                        'login' => Yii::$app->user->can('administrator')
                    ]

                ],
            ],
        ]); ?>
    </div>

    <div class="card-footer">
        <?php echo getDataProviderSummary($dataProvider) ?>
    </div>
</div>
