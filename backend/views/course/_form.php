<?php

use kartik\datetime\DateTimePicker;
use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;

/**
 * @var yii\web\View $this
 * @var common\models\Course $model
 * @var yii\bootstrap4\ActiveForm $form
 * @var common\models\Section $sectionList
 * @var common\models\User $teacherList
 */
?>
<div class="course-form">
    <?php $form = ActiveForm::begin([
//        'tooltipStyleFeedback' => true,
    ]); ?>
    <?php echo $form->errorSummary($model); ?>

    <div class="card">
        <div class="card-body">
            <?php
            echo \yii\bootstrap4\Tabs::widget([

                'items' => [
                    [
                        'label' => Yii::t('backend', 'Details'),
                        'content' => $this->render('_courseDetails',
                            [
                                'form' => $form,
                                'model' => $model,
                                'sectionList' => $sectionList,
                                'teacherList' => $teacherList,
//                                'course_time'=>$course_time,

                            ]),
                        'active' => true
                    ],
                    [
                        'label' => Yii::t('backend', 'Classes'),
                        'content' => $this->render('_courseClasses', [
                            'form' => $form,
                            'model' => $model,
                        ]),
                    ],
                    [
                        'label' => Yii::t('backend', 'Media'),
                        'content' => $this->render('_courseMedia', [
                            'form' => $form,
                            'model' => $model,
                        ]),
                    ],

                ]
            ]);
            ?>


        </div>
        <div class="card-footer">
            <?php echo Html::submitButton($model->isNewRecord ?
                Yii::t('backend', 'Create') :
                Yii::t('backend', 'Update'),
                ['class' => $model->isNewRecord ? 'btn success-btn' : 'btn btn-primary']) ?>
        </div>
    </div>
    <?php ActiveForm::end(); ?>
</div>
