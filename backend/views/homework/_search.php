<?php

use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;

/**
 * @var yii\web\View $this
 * @var common\models\Homework $model
 * @var yii\bootstrap4\ActiveForm $form
 */
?>

<div class="homework-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?php echo $form->field($model, 'id') ?>
    <?php echo $form->field($model, 'event_id') ?>
    <?php echo $form->field($model, 'path') ?>
    <?php echo $form->field($model, 'base_url') ?>
    <?php echo $form->field($model, 'type') ?>
    <?php echo $form->field($model, 'email') ?>
    <?php // echo $form->field($model, 'size') ?>
    <?php // echo $form->field($model, 'name') ?>
    <?php // echo $form->field($model, 'created_at') ?>
    <?php // echo $form->field($model, 'updated_at') ?>
    <?php // echo $form->field($model, 'created_by') ?>

    <div class="form-group">
        <?php echo Html::submitButton(Yii::t('backend', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?php echo Html::resetButton(Yii::t('backend', 'Reset'), ['class' => 'btn btn-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
