<?php

use edofre\fullcalendar\models\Event;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\JsExpression;
use yii\widgets\DetailView;

/**
 * @var yii\web\View $this
 * // * @var common\models\Course $events
 */
?>
<? //= edofre\fullcalendar\Fullcalendar::widget([
//    'clientOptions' => [
//        'eventResize' => new JsExpression("
//                function(event, delta, revertFunc, jsEvent, ui, view) {
//                    console.log(event.id);
//                    console.log(delta);
//                }
//            "),
//    ],
//]);
//?>
<!---->
<?= edofre\fullcalendar\Fullcalendar::widget([
    'events' => $events,
    'header' => [
        'center' => 'title',
        'left' => 'prev,next, today',
        'right' => 'basicDay,basicWeek,month'
    ],
]);
?>

<? //= edofre\fullcalendar\Fullcalendar::widget([
//    'options'       => [
//        'id'       => 'calendar',
//    ],
//    'clientOptions' => [
//        'weekNumbers' => false,
//        'selectable'  => true,
//        'defaultView' => 'agendaWeek',
//        'eventResize' => new JsExpression("
//                function(event, delta, revertFunc, jsEvent, ui, view) {
//                    console.log(event);
//                }
//            "),
//
//    ],
//    'events'        => Url::to(['course/calender', 'id' => 26]),
//]);
//?>
