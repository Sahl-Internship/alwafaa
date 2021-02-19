<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $user common\models\User */
/* @var $token string */

//$resetLink = Yii::$app->urlManager->createAbsoluteUrl(['@frontendUrl/user/sign-in/reset-password', 'token' => $token]);
$link = \yii\helpers\Url::to(['http://localhost:4000/reset-password','token' => $token]);
?>

        <div class="content">
            <h4>تغيير كلمة المرور</h4>

            <?php echo '<h5> اهلا بك'. Html::encode($user->username) . '</h5>في اكاديمية اقرأ' ?>
            <p>من فضلك اضغط على الزر التالي لتغيير كلمة المرور</p>
            <div class="link"><a href=" <?php echo substr($link,1) ?>">تغيير</a></div>

            <p> إذا لم تقم بالتسجيل في اكاديمية اقرأ من فضلك تجاهل هذا البريد الإلكتروني</p>
            <p>شكراً لك.</p>
            <hr>
            <p class="p-footer">فريق دعم اقرأ <span>&copy;٢٠٢١</span></p>
        </div>

<?php //echo Html::a(Html::encode($resetLink), $resetLink) ?>
<?php //echo Html::a('reset', $resetLink) ?>
<?php //echo \yii\helpers\Url::to(['@frontendUrl/user/sign-in/reset-password','token' => $token]) ?>
