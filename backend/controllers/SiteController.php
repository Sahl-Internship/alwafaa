<?php

namespace backend\controllers;

use backend\models\search\CourseSearch;
use common\models\Course;
use common\models\CourseClasses;
use common\models\Event;
use common\models\query\CourseClassesQuery;
use common\models\User;
use Yii;

/**
 * Site controller
 */
class SiteController extends \yii\web\Controller
{
    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    public function beforeAction($action)
    {
        $this->layout = Yii::$app->user->isGuest || !Yii::$app->user->can('loginToBackend') ? 'base' : 'common';

        return parent::beforeAction($action);
    }

    public function actionIndex()
    {
        $dataProvider = null;
        //according to user roles open the suitable daschboard
        if (Yii::$app->user->can('manager') or Yii::$app->user->can('administrator')) {
//            $searchModel = new SchoolBookingSearch();
//            $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

            $view = 'index';
        } else if (Yii::$app->user->can('teacher')) {
            $courses_number = count(Course::findOwnCourses()->all());
            $teacher_portfolio = User::find()->getTeacherPortfolio(Yii::$app->user->id);
            $view = 'teacher';
        } else {
            //logout
            return $this->redirect(['/sign-in/login']);
        }

        //var_dump(Yii::$app->user->identity->userProfile->school); die;

        return $this->render($view, [
            'courses_number' => $courses_number,
            'students_number' => $teacher_portfolio['student_number'],
            'sessions' => $teacher_portfolio['classes'],
            'duration' => $teacher_portfolio['duration'],
        ]);
    }

    public function actionTest()
    {
        $classes = Event::find()->getAttachments(11);
        return $this->render('test', [

            'data' => $classes,
        ]);
    }
//
//    public function actionTry()
//    {
//        $classes = CourseClasses::find()->getDurationPerWeek(27);
////        $course = Course::find()->getAllDays(27);
//
//        $course = Course::find()->andWhere('id=:id', ['id' => 27])->one();
//        $classDays = $course->courseClasses;
//        $courseClasses = new CourseClasses();
//        $days = []; //carry days of classes per week
//        $schedule =[];//carry days of classes over all the course period
//        $totalTime =0;//carry duration of classes over all the course period by minutes
//        $start_date = date("Y-m-d", $course->start_at);
//        $end_date = date("Y-m-d", $course->end_at);
//        foreach ($classDays as $classDay) {
//            //calculate class time
//            $classTime =  ($classDay->to - $classDay->from);
//            $timeByMin =  round($classTime/60);
//            $day_date = date("d-m-Y", strtotime("first " . $courseClasses->getWeekDay($classDay->day_id) . " " . $start_date));
//            array_push($days, $day_date);
////            echo $timeByMin . "<br>";
//            for ($i = date("W", $course->start_at); $i <= date("W", $course->end_at); $i++) {
//                if (strtotime($day_date) <= strtotime($end_date)) {
//                    $date = strtotime($day_date);
//                    //save schedule in array as date ,if you need timestamp remove date()
//                    array_push($schedule, $date);
////                    echo date('d-m-Y', $date) . "<br>";
//                    $date = strtotime("+7 day", $date);//day in next week
//                    $day_date = date("Y-m-d", $date); //set new value to day variable
//                    $totalTime +=$timeByMin;
//                }
//            }
//        }
////        echo $totalTime . "<br>";
//
//        return $this->render('test', [
////            'data' => $course,
//            'schedule'=>$schedule,
//            'totalTime'=>$totalTime,
//        ]);
//    }
}
