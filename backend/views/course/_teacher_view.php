<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/**
 * @var yii\web\View $this
 * @var common\models\Course $model
 */

//$this->title = $model->title;
//$this->params['breadcrumbs'][] = ['label' => ' / '.Yii::t('backend','Courses'),
//    'url' => ['index']];
//$this->params['breadcrumbs'][] = $this->title;
?>
<div class="course-view">
    <div class="card">
        <div class="card-body">
            <?php echo DetailView::widget([
                'model' => $model,
                'attributes' => [
                    'id',
                    'time:date',
                    'duration',
                    'title',
                    'description:html',
                    [
                            'attribute'=>'teacher_id',
                        'value'=>$model->teacher->username,
                    ],
                    [
                        'attribute'=>'section_id',
                        'value'=> $model->section->title,
                    ],
                    'zoom_link',
                    
                ],
            ]) ?>
        </div>
    </div>
    <h4>
        <?php echo Yii::t('backend','Course schedule') ?>
    </h4>
    <table class="table table-sm">
        <thead>
        <tr>
            <th>Day</th>
            <th>date</th>
            <th>time</th>
            <th>title</th>
            <th>Duration</th>
            <th>Teacher name</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($model->courseClasses as $class): ?>
            <tr>
                <td>
                    <?php echo date('D',$class->time) ?>
                </td>
                <td><?php echo date('d-m-Y',$class->time) ?></td>
                <td><?php echo date('H:m A',$class->time) ?></td>
                <td><?php echo $class->title ?></td>
                <td><?php echo $class->duration  . ' min' ?></td>
                <td><?php echo ($model->teacher->userProfile->firstname.' '.$model->teacher->userProfile->lastname) ?? $model->teacher->username ?></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>


</div>
