<?php

use common\models\User;
use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\UserForm */
/* @var $form yii\bootstrap4\ActiveForm */
/* @var $roles yii\rbac\Role[] */
/* @var $permissions yii\rbac\Permission[] */
?>

<div class="user-form">
    <?php $form = ActiveForm::begin() ?>
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-xs-12 col-sm-6">
                        <?php echo $form->field($model, 'username') ?>
                    </div>
                    <div class="col-xs-12 col-sm-6">
                        <?php echo $form->field($model, 'email') ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12 col-sm-6">
                        <?php echo $form->field($model, 'password')->passwordInput() ?>
                    </div>
                    <div class="col-xs-12 col-sm-6">
                        <?php echo $form->field($model, 'status')->dropDownList(User::statuses()) ?>
                    </div>
                </div>


                <div class="row">
                    <div class="col-3">
                    <?php echo $form->field($model, 'roles')->checkboxList($roles) ?>
                    </div>
                </div>
   
            </div>
            <div class="card-footer">
                <?php echo Html::submitButton(Yii::t('backend', 'Save'), ['class' => 'btn submit-btn', 'name' => 'signup-button']) ?>
            </div>
        </div>
    <?php ActiveForm::end() ?>
</div>
