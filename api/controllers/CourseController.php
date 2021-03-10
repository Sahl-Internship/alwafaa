<?php


namespace api\controllers;



use api\resources\Course;
use common\models\CourseReview;
use common\models\JoinCourses;
use yii\filters\auth\CompositeAuth;
use yii\filters\auth\HttpBasicAuth;
use yii\filters\auth\HttpBearerAuth;
use yii\filters\auth\HttpHeaderAuth;
use yii\filters\auth\QueryParamAuth;

class CourseController extends ApiController
{
    public function  behaviors()
    {
        $behaviors = parent::behaviors();
        // remove authentication filter if there is one
        unset($behaviors['authenticator']);
        // add CORS filter before authentication


        $behaviors['corsFilter'] = [
            'class' => \yii\filters\Cors::className(),
        ];
        // Put in a bearer auth authentication filter
        // https://www.yiiframework.com/doc/api/2.0/yii-filters-auth-httpbearerauth
        $behaviors['authenticator'] = [
            'class' => CompositeAuth::class,
            'authMethods' => [
                HttpBasicAuth::class,
                HttpBearerAuth::class,
                HttpHeaderAuth::class,
                QueryParamAuth::class
            ]
        ];
        // avoid authentication on CORS-pre-flight requests (HTTP OPTIONS method)
        $behaviors['authenticator']['except'] = ['options'];
        return $behaviors;
    }

    public function actionIndex()
    {
        $courses = Course::find()->all();
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