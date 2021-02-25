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
    <h4>Classes</h4>
    <table class="table table-sm">
        <thead>
        <tr>
            <th>Day</th>
            <th>date</th>
            <th>hours</th>
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
                <td><?php echo date('d-m-Y H:m',$class->time) ?></td>
                <td><?php echo $class->title ?></td>
                <td><?php echo $class->duration  . ' hours' ?></td>
                <td><?php echo $model->teacher->username ?></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>


</div>
