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
if ($model->birthdate)
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


        <!--            --><?php //echo $form->field($model, 'picture')->widget(\trntv\filekit\widget\Upload::class, [
        //                'url' => ['avatar-upload']
        //            ]) ?>
        <input id="image" type="file" accept="image/*">
<!--        <img src="" alt="">-->
        <img id="img" src="<?php echo (isset($model->avatar))? $model->avatar:'' ?>" height="200" alt="Image preview..." style="<?php echo (isset($model->avatar))? '':'display: none' ?>">


    </div>
    <div class="card-footer">
        <?php echo Html::submitButton(FAS::icon('save') . ' ' . Yii::t('backend', 'Save Changes'), ['class' => 'btn btn-primary']) ?>
    </div>
</div>
<?php ActiveForm::end() ?>
<!---->
<?php //Yii::$app->user->id;
//
//?>

<script>
    const fileInput = document.getElementById('image'); //get input of img
    function handleUploadImage() { // convert to base 64 and call endpoint
        const file = document.getElementById('image').files[0]; //value of img
        const preview = document.getElementById('img');//element of img
        const reader = new FileReader() //convert to base 64
        reader.onload = e => {
            const base64Val = e.target.result
            console.log(base64Val)
            if (base64Val) {
                preview.style.display = 'inline';
                preview.src = base64Val;
                postData({avatar: base64Val}).then(data => {
                    console.log(data); // JSON data parsed by `data.json()` call
                });
            }
        }
        reader.readAsDataURL(file)
    }

    // Example POST method implementation:
    async function postData(data = {}) {
        console.log(JSON.stringify(data));
        // Default options are marked with *
        const url = "http://endpoints.alwafaa.localhost/profile/upload-picture"
        const response = await fetch(url, {
            method: 'PUT', // *GET, POST, PUT, DELETE, etc.
            // mode: 'cors', // no-cors, *cors, same-origin
            // cache: 'no-cache', // *default, no-cache, reload, force-cache, only-if-cached
            // credentials: 'same-origin', // include, *same-origin, omit
            headers: {
                'Content-Type': 'application/json',
                'Authorization': 'Bearer L3IggvwP1IlkCvvhOszxiMlDfm4e087tuuMpEx2Y'
                // 'Content-Type': 'application/x-www-form-urlencoded',
            },
            // redirect: 'follow', // manual, *follow, error
            // referrerPolicy: 'no-referrer', // no-referrer, *no-referrer-when-downgrade, origin, origin-when-cross-origin, same-origin, strict-origin, strict-origin-when-cross-origin, unsafe-url
            body: JSON.stringify(data) // body data type must match "Content-Type" header
        });
        return response.json(); // parses JSON response into native JavaScript objects
    }

    fileInput.addEventListener('change', handleUploadImage)


</script>
