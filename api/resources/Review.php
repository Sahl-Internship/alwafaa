<?php


namespace api\resources;


use common\models\CourseClasses;
use function foo\func;


class Review extends \common\models\CourseReview
{

    public function fields()
    {
        return [
            'rate',
            'review',
            'student_name'=>function($model){
            return $model->createdBy->userProfile->getFullName();
            },
            'student_photo'=>function($model){
                return $model->createdBy->userProfile->avatar;
            },
            'created_at',
        ];
    }

}