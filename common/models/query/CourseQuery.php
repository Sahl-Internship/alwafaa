<?php

namespace common\models\query;

use common\models\Course;
use common\models\CourseClasses;
use common\models\CourseReview;
use common\models\JoinCourses;

/**
 * This is the ActiveQuery class for [[\common\models\Course]].
 *
 * @see \common\models\Course
 */
class CourseQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return \common\models\Course[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return \common\models\Course|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }

//    public function getAllDays($id)
//    {
//        $course = Course::findOne($id);
//        $classDays = $course->courseClasses;
//        $days = [];
//        foreach ($classDays as $classDay) {
//            array_push($days,$classDay->day_id);
//        }
//        var_dump($days);
//        $start_date = date("Y-m-d",$course->start_at);
//        $end_date = date("Y-m-d",$course->end_at);
////        echo $start_date . "<br>";
////        echo $end_date;
////        die();
////        for ($i=date("W",$course->start_at);$i<=date("W",$course->end_at);$i++){
////            echo $i."<br>";
////
////            $day_index = date("w", $course->start_at);
////            if ($day_index == 3 || $day_index == 6) {
////                echo "Week End ";
////                die();
////            }
////        }
////        if($start_date != $end_date){
//////            for()
////        }
//        while (strtotime($start_date) != strtotime($end_date)) {
//            $day_index = date("w", $course->start_at);
//            if ($day_index == 0 || $day_index == 6) {
//                echo "Week End ";
//            }
//            $now = strtotime(date("Y-m-d", $course->start_at) . "+1 day");
//        }
//
//    }

    public function getScheduleAndDuration($id)
    {
        $course = Course::find()->andWhere('id=:id', ['id' => $id])->one();
        $classDays = $course->courseClasses;
        $courseClasses = new CourseClasses();
        $days = []; //carry days of classes per week
        $schedule = [];//carry days of classes over all the course period
        $totalTime = 0;//carry duration of classes over all the course period by minutes
        $start_date = date("d-m-Y", strtotime('-1 day',$course->start_at ));//subtracting 1 day because $day_date will search from next day
        $end_date = date("d-m-Y", $course->end_at);
        foreach ($classDays as $classDay) {
            //calculate class time
            $classTime = ($classDay->to - $classDay->from);
            $timeByMin = round($classTime / 60);
            $day_date = date("d-m-Y", strtotime("first " . $courseClasses->getWeekDay($classDay->day_id) . " " . $start_date));
            array_push($days, $day_date);
            for ($i = date("z", $course->start_at); $i <= date("z", $course->end_at); $i++) {
                if (strtotime($day_date) <= strtotime($end_date)) {
                    $date = strtotime($day_date);
                    //save schedule in array as date ,if you need timestamp remove date()
                    array_push($schedule, $date);
//                    echo date('d-m-Y', $date) . "<br>";
                    $date = strtotime("+7 day", $date);//day in next week
                    $day_date = date("Y-m-d", $date); //set new value to day variable
                    $totalTime += $timeByMin;
                }
            }
        }
        return [
            'classes_number' => $schedule,
            'total_time' => $totalTime
        ];
    }

    public function getRate($id)
    {
        $reviews = CourseReview::findBySql(
            "SELECT rate FROM course_review WHERE course_id=:id", ['id' => $id])->all();
        if ($reviews) {
            $voters = count($reviews);
            $all_rates = [];
            foreach ($reviews as $review) {
                array_push($all_rates, $review->rate);
            }
            $rate_average = array_sum($all_rates) / $voters;
            return [
                "voters" => $voters,
                "rate_average" => $rate_average
            ];
        } else {
            return [
                "voters" => 0,
                "rate_average" => 0
            ];
        }

    }
    public function getReview($id)
    {
        $reviews = CourseReview::find()->andWhere('course_id=:id',['id'=>$id])->all();
        $review_ids = [];
        foreach ($reviews as $review) {
            array_push($review_ids,$review->id);
        }
        return $review_ids;
    }
    public function getDayDuration($id)
    {
        $classes = CourseClasses::findBySql("
            SELECT c.id,c.day_id,c.from,c.to FROM course_classes c WHERE course_id=:id", ['id' => $id])->all();
        $duration = [];
        foreach ($classes as $class) {
            $day_duration[$class->day_id] = round(($class->to - $class->from) / 60);
            array_push($duration, $day_duration);
        }
        return end($duration);
    }

    public function getStatus($id)
    {
        $course = Course::find()->andWhere('id=:id', ['id' => $id])->one();
        $days_duration = $this->getDayDuration($id);
        $finished_classes = [];
        $not_finished_classes = [];
        $finished_duration = [];
        $not_finished_duration = [];
        $classes = $this->getScheduleAndDuration($id);
        if (time() > $course->start_at && time() < $course->end_at) {
            foreach ($classes['classes_number'] as $class) {
                switch ($class) {
                    case ($class < time()):
                        array_push($finished_classes, $class);
                        array_push($finished_duration, $days_duration[date('w', $class)]);
                        break;
                    case ($class >= time()):
                        array_push($not_finished_classes, $class);
                        array_push($not_finished_duration, $days_duration[date('w', $class)]);
                        break;
                }
            }
            $status = Course::STATUS_NOT_FINISHED;
            $finished_classes_number = count($finished_classes);
            $not_finished_classes_number = count($not_finished_classes);
            $finished_duration = array_sum($finished_duration);
            $not_finished_duration = array_sum($not_finished_duration);
        } elseif (time() < $course->start_at) {
            $status = Course::STATUS_NOT_STARTED;
            $finished_classes_number = 0;
            $not_finished_classes_number = count($classes['classes_number']);
            $finished_duration = 0;
            $not_finished_duration = $classes['total_time'];
        } else {
            $status = Course::STATUS_FINISHED;
            $finished_classes_number = count($classes['classes_number']);
            $not_finished_classes_number = 0;
            $finished_duration = $classes['total_time'];
            $not_finished_duration = 0;
        }

        return [
            'status' => $status,
            'finished_classes_number' => $finished_classes_number,
            'not_finished_classes_number' => $not_finished_classes_number,
            'finished_duration' => $finished_duration,
            'not_finished_duration' => $not_finished_duration,
        ];
    }

    public function getJoinedStudents($id)
    {
        $students = JoinCourses::findBySql(
            "SELECT user_id FROM join_courses WHERE course_id=:id", ['id' => $id])->all();
        $student_ids = [];
        foreach ($students as $student) {
            array_push($student_ids, $student->user_id);
        }
        return $student_ids;
    }

    public function getDaysNumber($id)
    {
        $course = Course::find()->andWhere('id=:id', ['id' => $id])->one();
        $days =  ($course->end_at-$course->start_at);
        $days_number = round($days / (60 * 60 * 24))+1;//add 1 because we want days number not difference
        return $days_number;
    }

    public function getClasses($id)
    {
        $classes = CourseClasses::find()->andWhere('course_id=:id', ['id' => $id])->all();
        $class_ids = [];
        foreach ($classes as $class) {
            array_push($class_ids,$class->id);
        }
        return $class_ids;
    }
}
