<?php


namespace api\controllers;


use api\resources\User;
use common\models\CourseReview;
use yii\filters\auth\CompositeAuth;
use yii\filters\auth\HttpBasicAuth;
use yii\filters\auth\HttpBearerAuth;
use yii\filters\auth\HttpHeaderAuth;
use yii\filters\auth\QueryParamAuth;
use yii\web\Controller;

class ProfileController extends ApiController
{
//    public $modelClass = 'api\resources\User';

//    public function actions()
//    {
//        $actions = parent::actions();
//        unset($actions['update']);
//        return $actions;
//    }

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

    public function actionUploadPicture()
    {
        $params = \Yii::$app->request->post();
        $base64String = $params['avatar'];
//        $base64String = mb_convert_encoding($base64String, 'UTF-8', 'UTF-8');
        $base = json_encode($base64String);
        $decoder = base64_decode($base64String);
        return $decoder;
        die();
        $img = imagecreatefromstring($decoder);
        return $img;
    }


    public function actionUpdate(){

        $params = \Yii::$app->request->post();
        $user= User::findOne(['id'=>\Yii::$app->user->identity->getId()]) ;
        $profile=$user->userProfile;

//        if (isset($params['full_name'])){
//            $names = split_name($params['full_name']);
//            $profile->firstname= $names[0] ;
//            $profile->lastname= $names[1] ;
//        }
        if (isset($params['firstname'])) $profile->firstname= $params['firstname'] ;
        if (isset($params['lastname'])) $profile->lastname= $params['lastname'] ;
        if (isset($params['birthdate'])) $profile->birthdate= $params['birthdate'] ;
        if (isset($params['bio'])) $profile->bio= json_encode($params['bio']) ;
        if (isset($params['phone_key'])) $profile->phone_key= $params['phone_key'] ;
        if (isset($params['phone'])) $profile->phone= $params['phone'] ;
        if (isset($params['country'])) $profile->country= $params['country'] ;
        if (isset($params['city'])) $profile->city= $params['city'] ;

        if (isset($params['email'])) $user->email= $params['email'] ;

//        if (isset($params['binary'] )  &&  $params['binary']!= "" ){
////            $filename = Media::PrepareImage($params['binary'] );
////            $profile->image ='/uploads/profile/'.$filename ;
//        }

        if (isset($params['password']) ) $user->password= $params['password'];

        //var_dump($params);

        if($user->save() && $profile->save()){

            return ['status'=>1 , 'profile'=>$user ];

        }else{

            return ['status'=>0 , 'message'=>'Invalid Data','errors'=>$profile->errors ];
        }


    }

    public function actionReview(){
        $params = \Yii::$app->request->post();
        $review = new CourseReview();

        $review->load(['CourseReview' => $params]);
        if ($review->validate() and $registerUser = $review->save()) {
            return ['status'=>1, 'message'=>'Successfully Registration'];
        }elseif($review->errors){
            return ['status'=>0,'message'=> $review->errors,'key'=>'dataError'];
        }else{
            return ['status'=>0,  'message'=> 'Error,Try again' ];
        }


    }


}
