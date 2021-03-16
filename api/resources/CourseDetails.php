<?php


namespace api\resources;


use common\models\CourseClasses;
use function foo\func;

class CourseDetails extends \common\models\Course
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
            'teacher_name' => function ($model) {
                return $model->teacher->userProfile->getFullName();
            },
            'section_id',
            'section' => function ($model) {
                return $model->section->title;
            },
            'start_at' => function ($model) {
                return (int)$model->start_at;
            },
            'end_at' => function ($model) {
                return (int)$model->end_at;
            },
            'requirement',
            'target_student',
            'targeted_skills',
            'image' => function ($model) {
                return $model->picture ?: \Yii::getAlias('@backendUrl') . "/img/logo.png";
            },
            'rate' => function ($model) {
                $course = CourseDetails::find()->getRate($model->id);
                return [
                    "rate_average" => $course['rate_average'],
                    "voters" => $course['voters']
                ];
            },
            'sessions' => function ($model) {
                $course = CourseDetails::find()->getScheduleAndDuration($model->id);
                return count($course['classes_number']);
            },
            'duration' => function ($model) {
                $course = CourseDetails::find()->getScheduleAndDuration($model->id);
                return $course['total_time'];
            },
            'status' => function ($model) {
                $course = CourseDetails::find()->getStatus($model->id);
                return $course['status'];
            },
            'finished_classes' => function ($model) {
                $course = CourseDetails::find()->getStatus($model->id);
                return $course['finished_classes_number'];
            },
            'not_finished_classes' => function ($model) {
                $course = CourseDetails::find()->getStatus($model->id);
                return $course['not_finished_classes_number'];
            },
            'finished_duration' => function ($model) {
                $course = CourseDetails::find()->getStatus($model->id);
                return $course['finished_duration'];
            },
            'not_finished_duration' => function ($model) {
                $course = CourseDetails::find()->getStatus($model->id);
                return $course['not_finished_duration'];
            },
            'student_number' => function ($model) {
                $course = CourseDetails::find()->getJoinedStudents($model->id);
                return count($course);
            },
            'created_at',
            'days_number' => function ($model) {
                return CourseDetails::find()->getDaysNumber($model->id);
            },
            'classes' => function ($model) {
                return $model->courseClasses;
            },
//            'teacher'=>function($model){
//            return $model->teacher->userProfile;
//            }

            'reviews' => function ($model) {
                return $model->courseReviews;
            }

        ];
    }

}