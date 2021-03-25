<?php

use yii\bootstrap4\Modal;

?>

<?= edofre\fullcalendar\Fullcalendar::widget([
    'events' => $events,
    'header' => [
        'center' => 'title',
        'left' => 'prev,next, today',
        'right' => 'basicDay,basicWeek,month'
    ],
]);
?>
<!---->
<?php
//Modal::begin([
//
//    'toggleButton' => [
//
//        'label' => '<i class="glyphicon glyphicon-plus"></i> Add',
//
//        'class' => 'btn btn-success'
//
//    ],
//
//    'closeButton' => [
//
//        'label' => 'Close',
//
//        'class' => 'btn btn-danger btn-sm pull-right',
//
//    ],
//
//    'size' => 'modal-lg',
//
//]);
//
////    $myModel = new \common\models\Course();
//echo $this->render('/course/calender',[]);
//
//Modal::end();
//
//?>

