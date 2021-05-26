<?php

use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;
use rmrevin\yii\fontawesome\FAS;

/**
 * @var yii\web\View $this
 * @var common\models\UserProfile $model
 * @var yii\bootstrap4\ActiveForm $form
 */

$this->title = Yii::t('backend', 'Edit account')
?>

<?php $form = ActiveForm::begin() ?>
<div class="user-profile-form card">
    <div class="card-body">
        <div class="row">
            <div class="col-6">
                <?php echo $form->field($model, 'username') ?>
            </div>
            <div class="col-6">
                <?php echo $form->field($model, 'email')->input('email') ?>
            </div>
        </div>
        <div class="row">
            <div class="col-6">
                <?php echo $form->field($model, 'password')->passwordInput() ?>
            </div>
            <div class="col-6">
                <?php echo $form->field($model, 'password_confirm')->passwordInput() ?>
            </div>
        </div>
    </div>
    <div class="card-footer">
        <?php echo Html::submitButton(FAS::icon('save').' '.Yii::t('backend', 'Save Changes'), ['class' => 'btn btn-primary']) ?>
    </div>
</div>
<?php ActiveForm::end() ?>