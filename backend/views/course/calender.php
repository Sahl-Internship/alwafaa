<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;

/**
 * @var yii\web\View $this
 * @var common\models\Course $events
 */
?>
<!---->
<?php //echo yii2fullcalendar\yii2fullcalendar::widget(array(
//    'ajaxEvents' => Url::to(['/timetrack/default/jsoncalendar']),
////'events'=>$events,
//));
//?>
<?//= yii2fullcalendar\yii2fullcalendar::widget([
//    'options' => [
//        //... more options to be defined here!
//    ],
//    'events' => $events
//]);
//?>
<?= \yii2fullcalendar\yii2fullcalendar::widget(array(
    'events'=> $events,
));


