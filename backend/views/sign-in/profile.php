<?php

use common\models\UserProfile;
use kartik\date\DatePicker;
use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;
use rmrevin\yii\fontawesome\FAS;

/* @var $this yii\web\View */
/* @var $model common\models\UserProfile */
/* @var $form yii\bootstrap4\ActiveForm */

$this->title = Yii::t('backend', 'Edit profile');
if($model->birthdate)
$model->birthdate = date('m/d/Y', $model->birthdate);
?>

<?php $form = ActiveForm::begin() ?>
    <div class="user-profile-form card">
        <div class="card-body">
            <div class="row">
                <div class="col-sm-4 col-xs-12">
                    <?php echo $form->field($model, 'firstname')->textInput(['maxlength' => 255]) ?>
                </div>

                <div class="col-sm-4 col-xs-12">
                    <?php echo $form->field($model, 'middlename')->textInput(['maxlength' => 255]) ?>
                </div>
                <div class="col-sm-4 col-xs-12">
                    <?php echo $form->field($model, 'lastname')->textInput(['maxlength' => 255]) ?>
                </div>
            </div>
            <div class="row">
                <div class='col-6'>
                    <?php echo $form->field($model, 'sub_title')->textInput(['maxlength' => 255]) ?>
                </div>
<!--                <div class="col-sm-1 col-xs-12">-->
<!--                    --><?php //echo $form->field($model, 'phone_key')->textInput(['maxlength' => 255])->label('key') ?>
<!--                </div>-->
                <div class="col-sm-6 col-xs-12">
                    <?php echo $form->field($model, 'phone')->textInput(['maxlength' => 255]) ?>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6 col-xs-12">
                    <?php echo $form->field($model, 'country')->textInput(['maxlength' => 255]) ?>
                </div>

                <div class="col-sm-6 col-xs-12">
                    <?php echo $form->field($model, 'city')->textInput(['maxlength' => 255]) ?>
                </div>
            </div>

            <div class='row'>
                <div class='col-6'>
                    <?php echo $form->field($model, 'locale')->dropDownlist(Yii::$app->params['availableLocales']) ?>
                </div>
                <div class='col-6'>
                    <?php echo $form->field($model, 'gender')->dropDownlist([
                        UserProfile::GENDER_FEMALE => Yii::t('backend', 'Female'),
                        UserProfile::GENDER_MALE => Yii::t('backend', 'Male')
                    ]) ?>
                </div>
            </div>
            <div class='row'>
                <div class='col-6'>
                    <?php echo $form->field($model, 'birthdate')->widget(DatePicker::classname(), [
                        'options' => ['placeholder' => 'Enter birth date ...'],
                    ]); ?>
                </div>

            </div>
            <div class="row">
                <div class='col-12'>
                    <?php echo $form->field($model, 'bio')->widget(
                        \yii\imperavi\Widget::class,
                        [
                            'plugins' => ['fullscreen', 'fontcolor'],
                            'options' => [
                                'minHeight' => 200,
                                'maxHeight' => 200,
                                'buttonSource' => true,
                                'convertDivs' => false,
                                'removeEmptyTags' => true,
                            ],
                        ]
                    ) ?>
                </div>
            </div>
            <?php echo $form->field($model, 'picture')->widget(\trntv\filekit\widget\Upload::class, [
                'url' => ['avatar-upload']
            ]) ?>

        </div>
        <div class="card-footer">
            <?php echo Html::submitButton(FAS::icon('save') . ' ' . Yii::t('backend', 'Save Changes'), ['class' => 'btn btn-primary']) ?>
        </div>
    </div>
<?php ActiveForm::end() ?>