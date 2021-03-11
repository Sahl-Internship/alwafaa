<?php

use common\grid\EnumColumn;
use common\models\User;
use kartik\date\DatePicker;
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

<div class="card">

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
                    'class' => 'yii\grid\SerialColumn',
                    'contentOptions' => ['style' => 'width:50px']
                ],
                [
                    'label' => Yii::t('backend','Student Name'),
                    'content' => function ($model) {
                        return $model->userProfile->getFullName();
                    },
                ],
                'email:email',
                [
                    'attribute' => Yii::t('backend','phone'),
                    'value' => function ($model) {
                        return $model->userProfile->phone;
                    },
                ],
                [
                    'attribute' => Yii::t('backend','Country'),
                    'value' => function ($model) {
                        return $model->userProfile->country;
                    }
                ],
//                [
//                    'class' => EnumColumn::class,
//                    'attribute' => 'status',
//                    'enum' => User::statuses(),
//                    'filter' => User::statuses()
//                ],
            ],
        ]); ?>
    </div>

    <div class="card-footer">
        <?php echo getDataProviderSummary($dataProvider) ?>
    </div>
</div>
