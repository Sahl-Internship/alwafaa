<?php


namespace api\resources;

use common\models\Course;
use common\models\User;
use Yii;

class CourseDetails extends Course
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
            'section_id',
            'section' => function ($model) {
                return $model->section->title;
            },
            'tags' => function ($model) {
                return $model->tags;
            },
            'start_at' => function ($model) {
                return (int)$model->start_at;
            },
            'end_at' => function ($model) {
                return (int)$model->end_at;
            },
            'zoom_link',
            'requirement',
            'target_student',
            'targeted_skills',
            'image' => function ($model) {
                return $model->picture ?: Yii::getAlias('@backendUrl') . "/img/logo.png";
            },
            'rate' => function ($model) {
                $course = Course::find()->getRate($model->id);
                return [
                    "rate_average" => $course['rate_average'],
                    "voters" => $course['voters']
                ];
            },
            'sessions' => function ($model) {
                $course = Course::find()->getScheduleAndDuration($model->id);
                return count($course['classes_number']);
            },
            'duration' => function ($model) {
                $course = Course::find()->getScheduleAndDuration($model->id);
                return $course['total_time'];
            },
            'status' => function ($model) {
                $course = Course::find()->getStatus($model->id);
                return $course['status'];
            },
            'finished_classes' => function ($model) {
                $course = Course::find()->getStatus($model->id);
                return $course['finished_classes_number'];
            },
            'not_finished_classes' => function ($model) {
                $course = Course::find()->getStatus($model->id);
                return $course['not_finished_classes_number'];
            },
            'finished_duration' => function ($model) {
                $course = Course::find()->getStatus($model->id);
                return $course['finished_duration'];
            },
            'not_finished_duration' => function ($model) {
                $course = Course::find()->getStatus($model->id);
                return $course['not_finished_duration'];
            },
            'student_number' => function ($model) {
                $course = Course::find()->getJoinedStudents($model->id);
                return count($course);
            },
            'created_at',
            'updated_at',
            'days_number' => function ($model) {
                return Course::find()->getDaysNumber($model->id);
            },
            'classes' => function ($model) {
                return Classes::find()->andWhere('course_id=:id', ['id' => $model->id])->all();
            },
            'teacher' => function ($model) {
                $teacher_portfolio = User::find()->getTeacherPortfolio($model->teacher->id);
                return [
                    'name' => $model->teacher->userProfile->getFullName(),
                    'sub_title' => $model->teacher->userProfile->sub_title,
                    'avatar' => $model->teacher->userProfile->avatar ?: Yii::getAlias('@backendUrl') . "/img/anonymous.jpg",
                    'students' => $teacher_portfolio['student_number'],
                    'duration' => $teacher_portfolio['duration'],
                    'classes_number' => $teacher_portfolio['classes'],
                    'bio' => $model->teacher->userProfile->bio,
                ];
            },
            'reviews' => function ($model) {
                $ids = Course::find()->getReview($model->id);
                return CourseReviews::find()->andWhere(['in', 'id', $ids])->all();
            }

        ];
    }

}