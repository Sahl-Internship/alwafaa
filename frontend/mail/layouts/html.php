<?php

use yii\helpers\Html;

/* @var $this \yii\web\View view component instance */
/* @var $message \yii\mail\MessageInterface the message bing composed */
/* @var $content string main view render result */
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="<?php echo Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo Html::encode($this->title) ?></title>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"
          integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />

    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <?php $this->head() ?>
    <style>
        body {
            margin: 0;
            padding: 0;
            top: 0;
            box-sizing: border-box;
            font-family: 'Roboto', sans-serif;
            background-color: #636e7d;
        }
        h2,h3,h4,h5{
            margin: 10px 0px;
        }
        .root {
            padding: 20px;
            padding-bottom: 60px;
        }

        .container {
            width: 80%;
            margin: 40px 10%;
            padding: 20px 0px;
            padding-bottom: 40px;
            background: #26c5f9;
            border-radius: 5px;
        }

        .logo-container {
            width: 80%;
            height: 70px;
            margin: 20px 8%;
            padding: 6px 2%;
            background: #fff;
            border-radius: 6px;
        }
        .logo{
            background: url('2.svg') no-repeat center;
            height: 100%;
        }
        .fa-user-check {
            color: #234957;
            text-align: center;
            font-size: 30px;
            padding-top: 15px;
        }

        .content {
            width: 80%;
            margin: 0 8%;
            padding: 20px 2%;
            background: #fff;
            color: #000;
            border-radius: 5px;
        }

        p {
            line-height: 1.4;
            margin: 10px 0px;
        }

        a {

            padding: 10px 0px;
        }
        hr{
            color: #636e7d;
            margin: 3px 5px;
        }
        .p-footer{
            color: #636e7d;
            display: inline;
            font-size: 14px;
            margin: 0 5px;
        }
        span{
            display: inline;
            color: #51e69b;
            font-size: 14px;

        }
        @media screen and (max-width: 767px){
            p{
                font-size: 14px;
            }
            .p-footer,span{
                display: block;
                font-size: 12px;
            }
        }
    </style>
</head>
<body>
<?php $this->beginBody() ?>

<?php echo $content ?>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
