<?php


namespace api\resources;


use common\models\Course;
use common\models\User;
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
            'days_number' => function ($model) {
                return Course::find()->getDaysNumber($model->id);
            },
            'classes' => function ($model) {
                $ids = Course::find()->getClasses($model->id);
                return Classes::find()->andWhere(['in', 'id', $ids])->all();
            },
            'teacher' => function ($model) {
                $teacher_name = $model->teacher->userProfile->getFullName();
                $teacher_avatar = $model->teacher->userProfile->avatar;
                $students_number = User::find()->getTeacherPortfolio($model->teacher->id);
                $duration = 990;
                $classes_number = 42;
//                $Students_number = 230;
                return [
                    'name' => $teacher_name,
                    'job_title' => "معلم اللغة العربية والقران الكريم",
                    'avatar' => $teacher_avatar,
                    'students' => $students_number['student_number'],
                    'duration' => $students_number['duration'],
                    'classes_number' => $students_number['classes'],
//                    'students' => $Students_number,
                    'bio' => "مدرس اللغة العربية الفصحي والعامية المصرية لدي منهج وكتب جيدة لتعليم العربية لغير الناطقين بها في وقت قصير",
                ];
            },

            'reviews' => function ($model) {
                $ids = Course::find()->getReview($model->id);
                return Review::find()->andWhere(['in', 'id', $ids])->all();
            }

        ];
    }

}