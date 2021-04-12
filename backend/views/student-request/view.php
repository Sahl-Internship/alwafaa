<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/**
 * @var yii\web\View $this
 * @var common\models\StudentRequest $model
 */

$this->title = $model->getFullName();
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', 'Student Requests'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="student-request-view">
    <div class="card">
        <div class="card-header">
            <?php echo Html::a(Yii::t('backend', 'Accept'), ['accept', 'id' => $model->id], [
                'class' => 'btn btn-success',
                'data' => ['method' => 'post']
            ]) ?>
            <?php echo Html::a(Yii::t('backend', 'Refuse'), ['refuse', 'id' => $model->id], [
                'class' => 'btn btn-danger',
                'data' => ['method' => 'post']
            ]) ?>
        </div>
        <div class="card-body">
            <?php echo DetailView::widget([
                'model' => $model,
                'attributes' => [
                    'id',
                    [
                        'attribute' => Yii::t('backend', 'Full Name'),
                        'value' => $model->getFullName(),
                    ],
                    'email:email',
                    'sub_title',
                    'country',
                    [
                        'attribute' => Yii::t('backend', 'Gender'),
                        'value' => $model->getGender($model->gender),
                    ],
                    [
                        'attribute' => Yii::t('backend', 'Phone'),
                        'value' => "(" . $model->phone_key . ")" . $model->phone,
                    ],
                    [
                        'label' => Yii::t('backend', 'Requested Course'),
                        'value' => $course = \common\models\Course::findOne(['id' => $model->course_id])->title,
                    ],
                    [
                        'label' => Yii::t('backend', 'Request status'),
                        'value' => $model->getStatus($model->status),
                        'format' => 'html'
                    ],
//                    'is_parent',
                    'created_by',
                    [
                        'label' => Yii::t('backend', 'applicant'),
                        'value' => $course = \common\models\User::findOne(['id' => $model->created_by])->userProfile->getFullName() .
                            ' ( ' . \common\models\User::findOne(['id' => $model->created_by])->email . " )",
                    ],
                ],
            ]) ?>



        </div>
    </div>
    <div class="card">
        <div class="card-header">
            <h2><?php echo Yii::t('backend','Attachment') ?></h2>
        </div>
        <div class="card-body">
            <?php foreach ($files as $file): ?>
            <iframe src="<?php echo $file?>" style="width:450px; height:500px;" frameborder="1"></iframe>
            <?php endforeach; ?>

        </div>
    </div>
</div>
