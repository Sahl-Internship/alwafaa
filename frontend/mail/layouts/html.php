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
        }



        .root {
            background: #5e1855;
            padding: 20px;
            padding-bottom: 70px;
        }

        .brand {
            color: #fff;
            text-align: center;
            margin: 0;
            margin-bottom: 20px;
        }

        .container {
            width: 80%;
            margin: 0 10%;
            padding: 20px 0px;
            background: #f1f1f1;
            border-radius: 5px;
        }

        .icon {

            text-align: center;
            width: 80%;
            margin: 10px 5%;
            padding: 20px 5%;
        }

        i {
            background-color: #fff;
            width: 70px;
            height: 50px;
            border-radius: 50%;
        }

        .fa-user-check {
            color: #5e1855;
            text-align: center;
            font-size: 30px;
            padding-top: 15px;
        }

        .content {
            width: 80%;
            margin: 0 5%;
            padding: 20px 5%;
            background: #fff;
            color: #000;
            border-radius: 5px;
        }

        .button {
            text-align: center;
            margin-top: 20px;
            margin-bottom: 20px;
        }

        p {
            line-height: 1.4;
        }

        a {
            text-decoration: none;
            color: #fff;
            background: #5e1855;
            margin: 0px;
            padding: 10px 20px;
            border: none;
            outline: none;
            border-radius: 3px;
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
