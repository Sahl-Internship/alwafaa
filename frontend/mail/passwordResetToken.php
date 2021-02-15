<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $user common\models\User */
/* @var $token string */

//$resetLink = Yii::$app->urlManager->createAbsoluteUrl(['@frontendUrl/user/sign-in/reset-password', 'token' => $token]);

?>

<!--Hello --><?php //echo Html::encode($user->username) ?><!--,-->
<!---->
<!--Follow the link below to reset your password:-->
<div class="root">
    <h2 class="brand">Iqraa</h2>
    <div class="container">
        <div class="icon">
            <i class="fas fa-user-check"></i>
        </div>
        <div class="content">
            <h4>Email Verification</h4>
            <h5>Hello, <?php echo Html::encode($user->username) ?> </h5>
            <h5>Welcome to Iqraa</h5>
            <p>Please Follow the link below to reset your password:</p>
            <?php echo \yii\helpers\Url::to(['@frontendUrl/user/sign-in/reset-password','token' => $token]) ?>
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
<?php //echo Html::a(Html::encode($resetLink), $resetLink) ?>
<?php //echo Html::a('reset', $resetLink) ?>
<?php //echo \yii\helpers\Url::to(['@frontendUrl/user/sign-in/reset-password','token' => $token]) ?>
