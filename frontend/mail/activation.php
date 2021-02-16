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
    <h2 class="brand">Iqraa</h2>
    <div class="container">
        <div class="icon">
            <i class="fas fa-user-check"></i>
        </div>
        <div class="content">
            <h4>Email Verification</h4>
            <h5>Hello, ... </h5>
            <h5>Welcome to Iqraa</h5>
            <p>Please click the below link to verify your email address</p>
            <?php echo $url ?>
            <p>If you didn't signup to Iqraa please ignore this email</p>
            <div>
                <span>Iqraa support Team</span>
            </div>
            <!--            <div class="button">-->
            <!--                <a href="--><?php //echo $content ?><!--">Verify Email</a>-->
<!--            --><?php //echo Html::a('Verify Email',$url) ?>
            <!--            </div>-->
        </div>
    </div>
</div>