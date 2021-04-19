<?php

use common\widgets\ActionColumn;
use rmrevin\yii\fontawesome\FAS;
use yii\grid\SerialColumn;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;

/**
 * @var yii\web\View $this
 * @var integer $event_id
 * @var string $course_name
 * @var string $event_name
 * @var backend\models\search\HomeworkSearch $searchModel
 * @var yii\data\ActiveDataProvider $dataProvider
 */

$this->title = Yii::t('backend', 'Homeworks') . " : " . $course_name;
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="homework-index">
    <div class="card">
        <div class="card-header">
            <h3><?php echo $event_name ?></h3>
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
                    [
                        'attribute' => 'id',
                        'options' => ['style' => 'width: 80px'],
                        'filter' => false
                    ],
                    [
                        'label' => Yii::t('backend', "Name"),
                        'value' => function ($data) {
                            return $data->userProfile->getFullName();
                        }
                    ],
                    [
                        'label' => Yii::t('backend', "Email"),
                        'value' => function ($data) {
                            return $data->email;
                        }
                    ],
                    [
                        'label' => Yii::t('backend', 'Status'),
                        'value' => function ($data) use ($event_id) {
                            $homework = \common\models\Homework::findBySql("SELECT * FROM homework WHERE event_id=:evId AND created_by=:userId", ['evId' => $event_id, 'userId' => $data->id])->all();
                            if ($homework) {
                                $msg = Yii::t('backend', 'Homework uploaded');
                                return Html::tag('span', $msg, ['class' => 'badge badge-success']);
                            } else {
                                $msg = Yii::t('backend', 'Did not send');
                                return Html::tag('span', $msg, ['class' => 'badge badge-danger']);
                            }
                        },
                        'format' => 'html',
                    ],
                    [
                        'class' => ActionColumn::class,
                        'template' => '{view} {delete}',
                        'options' => ['style' => 'width: 140px'],

                    ],

                ],
            ]); ?>

        </div>
        <div class="card-footer">
            <?php echo getDataProviderSummary($dataProvider) ?>
        </div>
    </div>

</div>
