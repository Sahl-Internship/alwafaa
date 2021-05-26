<?php

use yii\grid\GridView;

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
                    'attribute' => 'fullName',
                    'label' => Yii::t('backend','Student Name'),
                    'value' => function ($data) {
                        return $data->userProfile->getFullName();
                    },
                ],
                'email:email',
                [
                    'attribute' => 'phone',
                    'label' => Yii::t('backend','Phone'),
                    'value' => function ($data) {
                        return $data->userProfile->phone;
                    },
                ],
                [
                    'attribute' => 'country',
                    'label' => Yii::t('backend','Country'),
                    'value' => function ($data) {
                        return $data->userProfile->country;
                    }
                ],
            ],
        ]); ?>
    </div>

    <div class="card-footer">
        <?php echo getDataProviderSummary($dataProvider) ?>
    </div>
</div>
