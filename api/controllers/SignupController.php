<?php


namespace api\controllers;


use frontend\modules\user\models\StudentForm;
use yii\rest\ActiveController;
//use yii\rest\Controller;

class SignupController extends ApiController
{

    public function actions()
    {
        $actions = parent::actions();
        unset($actions['create']);
        return $actions;
    }

    public function actionCreate()
    {
        $params = \Yii::$app->request->post();

//        return $params;

				// return $params;
        $user = new StudentForm();
        $user->profile = [];
        $user->load(['StudentForm' => $params]);
        if ($user->validate() and $registerUser = $user->signup()) {
            return ['status'=>1, 'message'=>'Successfully Registration'];
        }elseif($user->errors){
                return ['status'=>0,'message'=> $user->errors,'key'=>'dataError'];
        }else{
            return ['status'=>0,  'message'=> 'Error,Try again' ];
        }
    }




//    public function actionSignup()
//    {
//        $params = \Yii::$app->request->post();
//        \Yii::$app->language = 'ar';
//
//        $model = new StudentForm();
//
//        $model->load(['ParentSignup' => $params]);
////        $model->phone = myConvertNumbers($model->phone);
//        if ($model->validate() and $registerUser = $model->signup()) {
//            $user = User::find()->where(['id'=>$registerUser->id])->one();
//            User::CheckProfile($user);
//            EmailHelper::instance()->SendParentWelcomeEmail($user);
//            return ResponseHelper::sendSuccessResponse(['message' => Yii::t('common', 'Request Sent Successfully'),'data'=> $user ]);
//        } else {
//            return ResponseHelper::sendFailedResponse($model->errors, 400);
//        }
//    }

}
