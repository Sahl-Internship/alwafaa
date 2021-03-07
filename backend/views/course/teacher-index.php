<?php

use kartik\grid\GridView;
use yii\helpers\Html;
use yii\helpers\StringHelper;

/**
 * @var yii\web\View $this
 * @var backend\models\search\CourseSearch $searchModel
 * @var yii\data\ActiveDataProvider $dataProvider
 */

$this->title = Yii::t('backend','Courses');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="course-index">
    <div class="card">
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

                    [
                            'class' => 'yii\grid\SerialColumn',
                        'contentOptions'=>['style'=>'width:50px']
                    ],

                    ['attribute'=>'time',
                        'format'=>'date',
                        'contentOptions'=>['style'=>'width:60px']
                    ],

                    ['attribute'=>'duration',
                        'contentOptions'=>['style'=>'width:60px']
                    ],

                    ['attribute'=>'title',
                        'contentOptions'=>['style'=>'width:60px']
                    ],

                    [
                        'attribute'=>'description',
                        'content'=>function($model){
                            return StringHelper::truncateWords($model->description,7);
                        }
                    ],
                    // 'section_id',
                    // 'teacher_id',
                    // 'zoom_link',

                    [
                        'class' => 'kartik\grid\ExpandRowColumn',
                        'width' => '50px',
                        'value' => function ($model, $key, $index, $column) {
                            return GridView::ROW_COLLAPSED;
                        },
                        'detail' => function ($model, $key, $index, $column) {
                            return Yii::$app->controller->renderPartial('_teacher_view', ['model' => $model]);
                        },
                        'headerOptions' => ['class' => 'kartik-sheet-style'] ,
                        'expandOneOnly' => true
                    ],
                ],
            ]); ?>
    
        </div>
        <div class="card-footer">
            <?php echo getDataProviderSummary($dataProvider) ?>
        </div>
    </div>

</div>
