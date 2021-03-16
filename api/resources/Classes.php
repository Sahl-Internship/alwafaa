<?php


namespace api\resources;


use common\models\CourseClasses;
use function foo\func;

class Classes extends \common\models\CourseClasses
{

    public function fields()
    {
        return [
            'day_id',
            'from',
            'to',
        ];
    }

}