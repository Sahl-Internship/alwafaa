<?php

use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap4\ActiveForm */
/* @var $model \backend\models\LoginForm */

$this->title = Yii::t('backend', 'Sign In');
$this->params['breadcrumbs'][] = $this->title;
$this->params['body-class'] = 'login-page';
?>
<div class="login-container row align-items-center">
  <div class="col-xs-12 col-sm-8 col-md-7 row justify-content-center align-items-center form-section">
    <div class="col-xs-11 col-sm-10 col-md-7 login-box">
      <div class="login-logo">
        <h2><?php echo Html::encode($this->title) ?></h2>
      </div><!-- /.login-logo -->

      <hr class="title-separator">

      <!-- <div class="card"> -->
      <!-- <div class="card-body login-card-body"> -->
      <p class="login-box-msg"><?php echo Yii::t('backend', 'Sign in to start your session') ?></p>

      <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>

      <?php echo $form->errorSummary($model) ?>

      <?php echo $form->field($model, 'username', [
        'inputTemplate' => '<div class="input-group">
            <div class="input-group-append"><span class="input-group-text"><span class="fas fa-user"></span></span></div>
            {input}
        </div>',
      ])->textInput(['placeholder' => "Username"])->label(false) ?>

      <?php echo $form->field($model, 'password', [
        'inputTemplate' => '<div class="input-group">
            <div class="input-group-append"><span class="input-group-text"><span class="fas fa-lock"></span></span></div>
            {input}
          </div>',
      ])->passwordInput(['placeholder' => "Password"])->label(false) ?>

      <?php echo $form->field($model, 'rememberMe')->checkbox() ?>

      <?php echo Html::submitButton(Yii::t('backend', 'Sign In') . ' <span class="fas fa-arrow-right fa-sm"></span>', [
        'class' => 'btn btn-primary btn-block',
        'name' => 'login-button'
      ]) ?>
      <?php ActiveForm::end() ?>
      <!-- </div> -->
      <!-- </div> -->
    </div>
  </div>

  <div class="col-sm-4 col-md-5 logo-section row justify-content-center align-items-center">
    <img alt="elearning-icon" src="/img/auth-logo.png" class="self-center auth-page-img" />
  </div>
</div>