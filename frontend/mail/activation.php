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
    <div class="logo-container">
<!--        <div class="logo"></div>-->
        <img src="layouts/img/2.svg" alt="Email">
    </div>
    <div class="container">
        <img src="layouts/img/header.png" alt="Email">
        <div class="content">
            <h4>تأكيد البريد الإلكتروني</h4>
            <h5> اهلا بك في اكاديمية اقرأ</h5>
            <p>من فضلك اضغط على الزر التالي لتاكيد بريدك الإلكتروني</p>
            <div class="link"><a href=" <?php echo substr($url,1) ?>">تأكيد</a></div>
            <p> إذا لم تقم بالتسجيل في اكاديمية اقرأ من فضلك تجاهل هذا البريد الإلكتروني</p>
            <p>شكراً لك.</p>
            <hr>
            <p class="p-footer">فريق دعم اقرأ <span>&copy;٢٠٢١</span></p>
        </div>
    </div>
</div>

