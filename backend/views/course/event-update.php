<?php

use kartik\date\DatePicker;
use kartik\time\TimePicker;
use trntv\filekit\widget\Upload;
use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;

/**
 * @var yii\web\View $this
 * @var common\models\Event $model
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
        <!--                <div class="col-sm-6">-->
        <!--                    --><?php //echo $form->field($model,'date')->widget(DatePicker::classname(), []); 
                                    ?>
        <!--                </div>-->
      </div>

      <!--            <div class="row">-->
      <!--                <div class="col-sm-6">-->
      <!--                    --><?php //echo $form->field($model, 'from')->widget(TimePicker::classname(), []); 
                                  ?>
      <!--                </div>-->
      <!--                <div class="col-sm-6">-->
      <!--                    --><?php //echo $form->field($model, 'to')->widget(TimePicker::classname(), []); 
                                  ?>
      <!--                </div>-->
      <!--            </div>-->

      <div class="row course-attachment-section">
        <?php echo $form->field($model, 'attachments')->widget(
          Upload::class,
          [
            'url' => ['/file/storage/upload'],
            'sortable' => true,
            'maxFileSize' => 10000000, // 10 MiB
            'maxNumberOfFiles' => 10,
            //        'acceptFileTypes' => new JsExpression('(.*?)\.(docx|doc|pdf|xml|bmp|ppt|xls)$'),
          ]
        ) ?>
      </div>


      <div class="card-footer">
        <?php echo Html::submitButton(
          $model->isNewRecord ? Yii::t('backend', 'Create')
            : Yii::t('backend', 'Update'),
          ['class' => $model->isNewRecord ? 'primary-btn' : 'btn btn-primary']
        ) ?>
      </div>
    </div>
    <?php ActiveForm::end(); ?>
  </div>