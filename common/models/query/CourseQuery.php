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
        $start_date = date("Y-m-d", $course->start_at);
        $end_date = date("Y-m-d", $course->end_at);
        foreach ($classDays as $classDay) {
            //calculate class time
            $classTime = ($classDay->to - $classDay->from);
            $timeByMin = round($classTime / 60);
            $day_date = date("d-m-Y", strtotime("first " . $courseClasses->getWeekDay($classDay->day_id) . " " . $start_date));
            array_push($days, $day_date);
//            echo $timeByMin . "<br>";
            for ($i = date("W", $course->start_at); $i <= date("W", $course->end_at); $i++) {
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
//    public function getReview($id)
//    {
//        $reviews = CourseReview::find()->andWhere('course_id=:id',['id'=>$id])->all();
//        $voters = count($reviews);
//        echo $voters . "<br>";
//        foreach ($reviews as $review) {
//            echo $review->course_id . "<br>";
//            echo $review->rate . "<br>";
//            echo $review->review . "<br>";
//            echo $review->created_by . "<br>" ."*********" ."<br>";
//
//        }
//
//        die();
//
//    }
    public function getDayDuration($id)
    {
        $classes = CourseClasses::findBySql("
            SELECT c.id,c.day_id,c.from,c.to FROM course_classes c WHERE course_id=:id",['id'=>$id])->all();
        $duration = [];
        foreach ($classes as $class) {
            $day_duration[$class->day_id]=($class->to - $class->from)/60;
            array_push($duration,$day_duration);
            echo "from " .date("h:i:s",$class->from) .$class->day_id. "<br>";
            echo "to " .date("h:i:s",$class->to) . "<br>";

//           var_dump($class->to);
//            $classTime =  ($class->to - $class->from);
//            $timeByMin =  round($classTime/60);
//             array_push($duration,$timeByMin);
        }
        var_dump(end($duration));
        return array_sum($duration);
    }

    public function getStatus($id)
    {
        $course = Course::find()->andWhere('id=:id', ['id' => $id])->one();
        $start_date = $course->start_at;
        $end_date = $course->end_at;
        $finished_classes = [];
        $not_finished_classes = [];
        if (time() > $start_date && time() < $end_date) {
            $classes = $this->getScheduleAndDuration(28);
            foreach ($classes['classes_number'] as $class) {
                switch ($class) {
                    case ($class < time()):
                        array_push($finished_classes, $class);
                        break;
                    case ($class >= time()):
                        array_push($not_finished_classes, $class);
                        break;
                }
            }
            sort($finished_classes);
            foreach ($finished_classes as $finished_class) {
                echo date('d-m-Y l', $finished_class) . "<br>";

            }
            echo "<br>";
            sort($not_finished_classes);
            foreach ($not_finished_classes as $not_finished_class) {
                echo date('d-m-Y l', $not_finished_class) . "<br>";
            }
            var_dump($finished_classes);
            var_dump($not_finished_classes);

        } elseif (time() < $start_date) {
            echo "لم تبدأ";
        } else {
            echo "انتهت";
        }
//        echo date('d/m/Y h:i A',$time);
        die();

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
}
