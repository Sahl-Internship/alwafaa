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
<!--    <h4>Order Items</h4>-->
<!--    <table class="table table-sm">-->
<!--        <thead>-->
<!--        <tr>-->
<!--            <th>Day</th>-->
<!--            <th>date</th>-->
<!--            <th>title</th>-->
<!--            <th>Duration</th>-->
<!--            <th>Teacher name</th>-->
<!--        </tr>-->
<!--        </thead>-->
<!--        <tbody>-->
<!--        --><?php //foreach ($model->classes as $class): ?>
<!--            <tr>-->
<!--                <td>-->
<!--                    --><?php //echo $class->time ?>
<!--                </td>-->
<!--                <td>--><?php ////echo $item->product_name ?><!--</td>-->
<!--                <td>--><?php ////echo $item->quantity ?><!--</td>-->
<!--                <td>--><?php ////echo Yii::$app->formatter->asCurrency( $item->unit_price)  ?><!--</td>-->
<!--                <td>--><?php ////echo Yii::$app->formatter->asCurrency($item->quantity * $item->unit_price)  ?><!--</td>-->
<!--            </tr>-->
<!--        --><?php //endforeach; ?>
<!--        </tbody>-->
<!--    </table>-->


</div>
