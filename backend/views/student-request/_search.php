<?php

use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;

/**
 * @var yii\web\View $this
 * @var common\models\StudentRequest $model
 * @var yii\bootstrap4\ActiveForm $form
 */
?>

<div class="student-request-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?php echo $form->field($model, 'id') ?>
    <?php echo $form->field($model, 'course_id') ?>
    <?php echo $form->field($model, 'firstname') ?>
    <?php echo $form->field($model, 'lastname') ?>
    <?php echo $form->field($model, 'email') ?>
    <?php // echo $form->field($model, 'sub_title') ?>
    <?php // echo $form->field($model, 'country') ?>
    <?php // echo $form->field($model, 'gender') ?>
    <?php // echo $form->field($model, 'phone_key') ?>
    <?php // echo $form->field($model, 'phone') ?>
    <?php // echo $form->field($model, 'status') ?>
    <?php // echo $form->field($model, 'is_parent') ?>
    <?php // echo $form->field($model, 'created_by') ?>

    <div class="form-group">
        <?php echo Html::submitButton(Yii::t('backend', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?php echo Html::resetButton(Yii::t('backend', 'Reset'), ['class' => 'btn btn-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
