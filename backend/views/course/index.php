<?php

use yii\helpers\Html;
use yii\grid\GridView;
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
        <div class="card-header">
            <?php echo Html::a(Yii::t('backend','Create Course'),
                ['create'], ['class' => 'btn index-success-btn']) ?>
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

                    ['attribute'=>'id',
                        'contentOptions'=>['style'=>'width:60px']
                    ],

                    ['attribute'=>'title',
                        'contentOptions'=>['style'=>'width:60px']
                    ],

                    ['attribute'=>'start_at',
                        'format'=>'date',
                        'contentOptions'=>['style'=>'width:60px']
                    ],

                    ['attribute'=>'end_at',
                        'format'=>'date',
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
                    
                    ['class' => \common\widgets\ActionColumn::class],
                ],
            ]); ?>
    
        </div>
        <div class="card-footer">
            <?php echo getDataProviderSummary($dataProvider) ?>
        </div>
    </div>

</div>
