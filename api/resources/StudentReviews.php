<?php


namespace api\resources;


use common\models\CourseClasses;
use function foo\func;


class StudentReviews extends \common\models\CourseReview
{

    public function fields()
    {
        return [
            'rate',
            'review',
            'course'=>function($model){
            return [
                'name'=>$model->course->title,
                'section'=>$model->course->section->title,
                'teacher'=>$model->course->teacher->userProfile->getFullName(),
                'teacher_avatar'=>$model->course->teacher->userProfile->avatar,
            ];
            },

            'created_at',
        ];
    }

}