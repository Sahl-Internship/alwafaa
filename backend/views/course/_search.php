<?php

use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;

/**
 * @var yii\web\View $this
 * @var backend\models\search\CourseSearch $model
 * @var yii\bootstrap4\ActiveForm $form
 */
?>

<div class="course-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?php echo $form->field($model, 'id') ?>
    <?php echo $form->field($model, 'start_at') ?>
    <?php echo $form->field($model, 'end_at') ?>
    <?php echo $form->field($model, 'title') ?>
    <?php echo $form->field($model, 'description') ?>
    <?php // echo $form->field($model, 'section_id') ?>
    <?php // echo $form->field($model, 'teacher_id') ?>
    <?php // echo $form->field($model, 'zoom_link') ?>

    <div class="form-group">
        <?php echo Html::submitButton('Search', ['class' => 'btn search-btn-primary']) ?>
        <?php echo Html::resetButton('Reset', ['class' => 'btn search-btn-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
