
<?= edofre\fullcalendar\Fullcalendar::widget([
    'events' => $events,
    'header' => [
        'center' => 'title',
        'left' => 'prev,next, today',
        'right' => 'basicDay,basicWeek,month'
    ],
]);
?>
