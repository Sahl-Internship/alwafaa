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

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Almarai&display=swap" rel="stylesheet">

    <?php $this->head() ?>
    <style>

        body {
            margin: 0;
            padding: 0;
            top: 0;
            box-sizing: border-box;
            font-family: 'Almarai', sans-serif;
            /* background-color: #7a889b; */
            background-color: #f1f1f1;
        }

        h4,
        h5 {
            margin: 10px 0px;
        }

        .root {
            padding: 20px;
        }

        .container {
            width: 80%;
            margin: 10px 10%;
            padding: 20px 0px;
            padding-bottom: 40px;
            background: #fff;
            border-radius: 5px;
            text-align: center;
            padding-top: 0px;
            box-shadow: 5px 5px 5px 5px #b3b3b3;
        }

        .logo-container {
            width: 80%;
            height: 70px;
            margin: 0px 10%;
            padding: 6px 0%;
            /* background: #fff; */
            border-radius: 6px;
        }

        img {
            width: 100%;
            border-radius: 5px 5px 0px 0px;
            height: 123px;
        }

        /*.logo {*/
        /*    background: url('2.svg') no-repeat center;*/
        /*    height: 100%;*/
        /*}*/

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
            color: #636e7d;
        }

        .link {
            width: 50%;
            margin: 10px 25%;
            background-color: #26c5f9;
            padding: 10px 0px;
            border-radius: 5px;
        }

        a {
            text-decoration: none;
            padding: 10px 0px;
            color: #fff;
        }

        hr {
            color: #636e7d;
            margin: 3px 5px;
        }

        .p-footer {
            color: #636e7d;
            display: inline;
            font-size: 14px;
            margin: 0 5px;
        }

        span {
            display: inline;
            color: #51e69b;
            font-size: 14px;

        }

        @media screen and (max-width: 767px) {
            p {
                font-size: 12px;
            }

            .p-footer,
            span {
                display: block;
                font-size: 12px;
            }
        }

        @media screen and (max-width:340px) {
            img {
                height: 80px;
            }

            h4,
            h5 {
                font-size: 12px;
            }

            p {
                font-size: 10px;
            }

            .p-footer,
            span {
                display: block;
                font-size: 11px;
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
