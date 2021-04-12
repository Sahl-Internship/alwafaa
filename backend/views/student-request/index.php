<?php

use common\widgets\ActionColumn;
use yii\helpers\Html;
use yii\grid\GridView;

/**
 * @var yii\web\View $this
 * @var backend\models\search\StudentRequestSearch $searchModel
 * @var yii\data\ActiveDataProvider $dataProvider
 */

$this->title = Yii::t('backend', 'Student Requests');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="student-request-index">
    <div class="card">
        <?php if (Yii::$app->session->hasFlash('flashMsg')) { ?>
            <div class="alert alert-success">
                <?php echo Yii::$app->session->getFlash('flashMsg'); ?>
            </div>
        <?php } ?>
    </div>

    <div class="card-body p-0">
        <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

        <?php echo GridView::widget([
            'layout' => "{items}\n{pager}",
            'options' => [
                'class' => ['gridview', 'table-responsive'],
            ],
            'tableOptions' => [
                'class' => ['table', 'text-nowrap', 'table-striped', 'table-bordered', 'mb-0'],
            ],
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],

                [
                    'attribute' => 'fullName',
                    'label' => Yii::t('backend', 'Name')
                ],
                'email:email',
                [
                    'attribute' => 'course_id',
                    'label' => Yii::t('backend', 'Courses'),
                    'value' => function ($data) {
                        $course = \common\models\Course::findOne(['id' => $data->course_id]);
                        return $course->title;
                    }
                ],
                // 'sub_title',
                // 'country',
                // 'gender',
                // 'phone_key',
                // 'phone',
                [
                    'label' => Yii::t('backend', 'Request status'),
                    'format' => 'html',
                    'value' => function ($data) {
                        return $data->getStatus($data->status);
                    },
                    'filter'=>Html::activeDropDownList($searchModel,'status',\common\models\StudentRequest::statuses(),[
                        'class'=>'form-control',
                        'prompt'=>Yii::t('backend','All')
                    ]),
                ],
                // 'is_parent',
                // 'created_by',

                ['class' => ActionColumn::class,
                    'template' => '{view}',
                ],

            ],
        ]); ?>

    </div>
    <div class="card-footer">
        <?php echo getDataProviderSummary($dataProvider) ?>
    </div>
</div>

</div>
