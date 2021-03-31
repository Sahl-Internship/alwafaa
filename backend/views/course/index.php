<?php

use common\models\Section;
use common\widgets\ActionColumn;
use kartik\date\DatePicker;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\grid\GridView;
/**
 * @var yii\web\View $this
 * @var backend\models\search\CourseSearch $searchModel
 * @var yii\data\ActiveDataProvider $dataProvider
 */

$this->title = Yii::t('backend', 'Courses');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="course-index">
    <div class="card">
        <div class="card-header">
            <?php echo Html::a(Yii::t('backend', 'Create Course'),
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

                    ['attribute' => 'id',
                        'contentOptions' => ['style' => 'width:60px']
                    ],

                    ['attribute' => 'title',
                        'contentOptions' => ['style' => 'width:60px']
                    ],

                    [
                        'attribute' => 'start_at',
                        'format' => 'date',
                        'filter' => DatePicker::widget([
                            'model' => $searchModel,
                            'attribute' => 'start_at',
                            'type' => DatePicker::TYPE_COMPONENT_APPEND,
                            'pluginOptions' => [
                                'format' => 'dd-mm-yyyy',
                                'showMeridian' => true,
                                'todayBtn' => true,
                            ]
                        ]),
                    ],

                    ['attribute' => 'end_at',
                        'format' => 'date',
                        'filter' => DatePicker::widget([
                            'model' => $searchModel,
                            'attribute' => 'end_at',
                            'type' => DatePicker::TYPE_COMPONENT_APPEND,
                            'pluginOptions' => [
                                'format' => 'dd-mm-yyyy',
                                'showMeridian' => true,
                                'todayBtn' => true,
//                                'endDate' => '0d',
                            ]
                        ]),
                    ],
                    [
                        'attribute' => 'teacherName',
                        'label'=>Yii::t('backend','Teacher Name'),
                        'value' => function($data){
                              return  $data->teacher->userProfile->getFullName();
                        },
                    ],
                    [
                        'attribute' => 'section_id',
                        'value' => function($data){
                            return  $data->section->title;
                        },
                        'filter'=>ArrayHelper::map(Section::find()->asArray()->all(), 'id', 'title'),
                    ],
                    [
                        'label'=>Yii::t('backend','Students'),
                        'content'=>function($model){
                            return count($model->find()->getJoinedStudents($model->id));
                        }
                    ],
                    ['class' => ActionColumn::class],
                ],
            ]); ?>

        </div>
        <div class="card-footer">
            <?php echo getDataProviderSummary($dataProvider) ?>
        </div>
    </div>

</div>
