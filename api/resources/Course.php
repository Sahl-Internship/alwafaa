<?php


namespace api\resources;


use function foo\func;

class Course extends \common\models\Course
{

    public function fields()
    {
        return [
            'id',
            'title',
            'sub_title',
            'description',
//            'description' => function ($model) {
//                return strip_tags($model->description);
//            },
            'teacher_id' => function ($model) {
                return $model->teacher->userProfile->getFullName();
            },
            'section_id' => function ($model) {
                return $model->section->title;
            },
            'start_at' => function ($model) {
                $date = (int)$model->start_at;
                return date('d-m-Y', $date);
            },
            'end_at' => function ($model) {
                $date = (int)$model->end_at;
                return date('d-m-Y', $date);
            },
            'requirement',
            'target_student',
            'targeted_skills',
        ];
    }

}