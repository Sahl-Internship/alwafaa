<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/**
 * @var yii\web\View $this
 * @var common\models\Course $model
 */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => ' / '.Yii::t('backend','Courses'),
    'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="course-view">
    <div class="card">
        <div class="card-header">
            <?php echo Html::a(Yii::t('backend','Update'), ['update', 'id' => $model->id], ['class' => 'btn view-btn']) ?>
            <?php echo Html::a(Yii::t('backend','Delete'), ['delete', 'id' => $model->id], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' =>Yii::t('backend','Are you sure you want to delete this item?'),
                    'method' => 'post',
                ],
            ]) ?>
        </div>
        <div class="card-body">
            <?php echo DetailView::widget([
                'model' => $model,
                'attributes' => [
                    'id',
                    'start_at:date',
                    'end_at:date',
                    'title',
                    [
                        'attribute'=>'section_id',
                        'value'=> $model->section->title,
                    ],
                    [
                        'attribute'=>'teacher_id',
                        'value'=>$model->teacher->username,
                    ],
                    'zoom_link',
                    'description:html',
                    'requirement:html',
                    'target_student:html',
                    'targeted_skills:html',



                ],
            ]) ?>
        </div>
    </div>
    <h4><?php echo Yii::t('backend','Course schedule') ?></h4>
    <table class="table table-sm">
        <thead>
        <tr>
            <th>Day</th>
            <th>From</th>
            <th>To</th>
<!--            <th>title</th>-->
<!--            <th>Duration</th>-->
            <th>Teacher name</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($model->courseClasses as $class): ?>
            <tr>
                <td>
                    <?php echo Yii::t('common', $class->getWeekDay($class->day_id)) ?>
                </td>
                <td><?php echo date('H:i A',$class->from)  ?></td>
                <td><?php echo date('H:i A',$class->to) ?></td>
<!--                <td>--><?php //echo $class->title ?><!--</td>-->
<!--                <td>--><?php //echo $class->duration  . ' min' ?><!--</td>-->
                <td><?php echo ($model->teacher->userProfile->firstname.' '.$model->teacher->userProfile->lastname) ?? $model->teacher->username ?></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>


</div>
