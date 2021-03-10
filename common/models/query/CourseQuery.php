<?php

namespace common\models\query;

use common\models\Course;
use common\models\CourseClasses;

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
        $schedule =[];//carry days of classes over all the course period
        $totalTime =0;//carry duration of classes over all the course period by minutes
        $start_date = date("Y-m-d", $course->start_at);
        $end_date = date("Y-m-d", $course->end_at);
        foreach ($classDays as $classDay) {
            //calculate class time
            $classTime =  ($classDay->to - $classDay->from);
            $timeByMin =  round($classTime/60);
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
                    $totalTime +=$timeByMin;
                }
            }
        }
        return [
            'classes_number'=>count($schedule),
            'total_time'=>$totalTime
        ];

    }
}
