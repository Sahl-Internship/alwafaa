<?php
/** @var common\models\Event $events */
/** @var string $landing */

?>
<?= edofre\fullcalendar\Fullcalendar::widget([
    'clientOptions' => [
        'now' => $landing,
        'events' => $events,
    ],
    'options'=>[
            'color' => '#C3D6E4'
    ],
    'header' => [
        'center' => 'title',
        'left' => 'prev,next',
        'right' => 'basicDay,basicWeek,month'
    ],
]);
?>
