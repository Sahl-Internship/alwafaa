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
                    'start_at:date',
                    'end_at:date',
                    'title',
                    'sub_title',
                    'description:html',
                    'requirement:html',
                    'target_student:html',
                    'targeted_skills:html',
                    [
                            'attribute'=>'teacher_id',
                        'value'=>$model->teacher->userProfile->getFullName(),
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
            <th><?php echo Yii::t('backend','Day') ?></th>
            <th><?php echo Yii::t('backend','From') ?></th>
            <th><?php echo Yii::t('backend','To') ?></th>
            <th><?php echo Yii::t('backend','Teacher name') ?></th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($model->courseClasses as $class): ?>
            <tr>
                <td>
                    <?php echo Yii::t('common',$class->getWeekDay($class->day_id)) ?>
                </td>
                <td><?php echo date('h:i A',$class->from) ?></td>
                <td><?php echo date('h:i A',$class->to) ?></td>
<!--                <td>--><?php //echo $class->title ?><!--</td>-->
<!--                <td>--><?php //echo $class->duration  . ' min' ?><!--</td>-->
                <td><?php echo ($model->teacher->userProfile->firstname.' '.$model->teacher->userProfile->lastname) ?? $model->teacher->username ?></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
    <div class="card-header">
        <?php echo Html::a(Yii::t('backend','More Details'),
            ['create'], ['class' => 'btn btn-primary']) ?>
    </div>


</div>
