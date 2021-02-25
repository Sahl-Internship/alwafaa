<?php

use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;

/**
 * @var yii\web\View $this
 * @var common\models\Section $model
 * @var yii\bootstrap4\ActiveForm $form
 */
?>

<div class="section-form">
    <?php $form = ActiveForm::begin(); ?>
        <div class="card">
            <div class="card-body">
                <?php echo $form->errorSummary($model); ?>
                <div class="row">
                    <div class="col-sm-6">
                        <?php echo $form->field($model, 'title')->textInput(['maxlength' => true]) ?>
                    </div>
                    <div class="col-sm-6">
                        <?php echo $form->field($model, 'description')->textInput(['maxlength' => true]) ?>
                    </div>
                </div>

                
            </div>
            <div class="card-footer">
                <?php echo Html::submitButton(
                        $model->isNewRecord ? Yii::t('backend','Create')
                            : Yii::t('backend','Update'),
                        ['class' => $model->isNewRecord ? 'btn' : 'btn btn-primary']) ?>
            </div>
        </div>
    <?php ActiveForm::end(); ?>
</div>
