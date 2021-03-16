<?php


namespace api\controllers;



use api\resources\CourseDetails;
use common\models\CourseReview;
use common\models\JoinCourses;

class JoinCourseController extends ApController
{

    public function actionIndex()
    {
        $courses = CourseDetails::find()->all();
        return $courses;

    }

    public function actionReview(){
        $params = \Yii::$app->request->post();
        $review = new CourseReview();

        $review->load(['CourseReview' => $params]);
        if ($review->validate() and $registerUser = $review->save()) {
            return ['status'=>1, 'message'=>'Successfully Rated'];
        }elseif($review->errors){
            return ['status'=>0,'message'=> $review->errors,'key'=>'dataError'];
        }else{
            return ['status'=>0,  'message'=> 'Error,Try again' ];
        }
    }

    public function actionJoinCourse()
    {
        $params = \Yii::$app->request->post();
        $join = new JoinCourses();
        $join->load(['JoinCourses'=>$params]);
        if ($join->validate() and  $join->save()) {
            return ['status'=>1, 'message'=>'Successfully Joined'];
        }elseif($join->errors){
            return ['status'=>0,'message'=> $join->errors,'key'=>'dataError'];
        }else{
            return ['status'=>0,  'message'=> 'Error,Try again' ];
        }
    }


}