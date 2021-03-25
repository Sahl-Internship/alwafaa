<?php


namespace api\resources;



class CoursesList extends \common\models\Course
{

    public function fields()
    {
        return [
            'id',
            'title',
            'teacher' => function ($model) {
            $name = $model->teacher->userProfile->getFullName();
            $avatar =  $model->teacher->userProfile->avatar;
                return ['name'=>$name,'avatar'=>$avatar];
            },
            'section_id',
            'section' => function ($model) {
                return $model->section->title;
            },
            'image'=>function($model){
                return   $model->picture?: \Yii::getAlias('@backendUrl'). "/img/logo.png" ;
            },
            'rate'=>function($model){
            $course = CourseDetails::find()->getRate($model->id);
            return [
               "rate_average"=> $course['rate_average'],
               "voters"=>$course['voters']
            ];
            },
            'sessions'=>function($model){
            $course = CourseDetails::find()->getScheduleAndDuration($model->id);
                return count($course['classes_number']);
            },
            'duration'=>function($model){
                $course = CourseDetails::find()->getScheduleAndDuration($model->id);
                return $course['total_time'];
            },
            'status'=>function($model){
                $course = CourseDetails::find()->getStatus($model->id);
                return $course['status'];
            },
            'student_number'=>function($model){
            $students = CourseDetails::find()->getJoinedStudents($model->id);
                return count($students);
            },
            'created_at',
            'start_at' => function ($model) {
                return (int)$model->start_at;
            },
            'end_at' => function ($model) {
                return (int)$model->end_at;
            },
        ];
    }

}