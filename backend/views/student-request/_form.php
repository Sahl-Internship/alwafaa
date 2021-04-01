<?php

use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;

/**
 * @var yii\web\View $this
 * @var common\models\StudentRequest $model
 * @var yii\bootstrap4\ActiveForm $form
 */
?>

<div class="student-request-form">
    <?php $form = ActiveForm::begin(); ?>
        <div class="card">
            <div class="card-body">
                <?php echo $form->errorSummary($model); ?>

                <?php echo $form->field($model, 'course_id')->textInput() ?>
                <?php echo $form->field($model, 'firstname')->textInput(['maxlength' => true]) ?>
                <?php echo $form->field($model, 'lastname')->textInput(['maxlength' => true]) ?>
                <?php echo $form->field($model, 'email')->textInput(['maxlength' => true]) ?>
                <?php echo $form->field($model, 'sub_title')->textInput(['maxlength' => true]) ?>
                <?php echo $form->field($model, 'country')->textInput(['maxlength' => true]) ?>
                <?php echo $form->field($model, 'gender')->textInput() ?>
                <?php echo $form->field($model, 'phone_key')->textInput(['maxlength' => true]) ?>
                <?php echo $form->field($model, 'phone')->textInput(['maxlength' => true]) ?>
                <?php echo $form->field($model, 'status')->textInput() ?>
                <?php echo $form->field($model, 'is_parent')->textInput() ?>
                <?php echo $form->field($model, 'created_by')->textInput() ?>
                
            </div>
            <div class="card-footer">
                <?php echo Html::submitButton($model->isNewRecord ? Yii::t('backend', 'Create') : Yii::t('backend', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
            </div>
        </div>
    <?php ActiveForm::end(); ?>
</div>
