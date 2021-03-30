<?php


namespace api\resources;


use common\models\CourseClasses;
use common\models\Event;
use function foo\func;

class Classes extends \common\models\Event
{

    public function fields()
    {
        return [
            'id',
            'title',
            'date',
            'day_id',
            'from',
            'to',
            'attachments'=>function ($model) {
                return Event::find()->getAttachments($model->id);
            },
        ];
    }

}