<?php
/**
 * @var $this \yii\web\View
 * @var $url \common\models\User
 */

use yii\bootstrap4\Html;

?>
<?php //echo Yii::t('frontend', 'Your activation link: {url}', ['url' => Yii::$app->formatter->asUrl($url)]) ?>
<?php //echo Yii::t('frontend', 'Your activation link: {url}', ['url' => $url]) ?>
<?php //echo Yii::$app->formatter->asUrl($url) ?>
<?php //echo $url ?>


<div class="root">
    <div class="container">
        <div class="logo-container">
            <div class="logo"></div>
        </div>
        <div class="content">
            <h4>Email Verification</h4>
            <h5>Hello,</h5>
            <h5>Welcome to Iqraa</h5>
            <p>Please click the below button to verify your email address</p>
            <?php echo $url ?>
            <p>If you didn't signup to Iqraa please ignore this email</p>
            <p>Thank you</p>
            <hr>
            <p class="p-footer">Iqraa support Team <span>copyright&copy;2021</span></p>
            <!-- <span>copyright&copy;2021</span> -->
        </div>
    </div>
</div>

