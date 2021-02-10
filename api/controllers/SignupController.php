<?php


namespace api\controllers;


use common\models\User;
use frontend\modules\user\models\StudentForm;
use Yii;
use yii\rest\Controller;

class SignupController extends Controller
{
    public function behaviors(){
        $behaviors = parent::behaviors();
        $behaviors['corsFilter'] = [
            'class' => \yii\filters\Cors::className(),
            'cors' => [
                'Origin' => ['*'],
                'Access-Control-Request-Method' => ['GET', 'POST', 'PUT', 'PATCH', 'DELETE', 'HEAD', 'OPTIONS'],
                'Access-Control-Request-Headers' => ['*'],
            ],
        ];
        return $behaviors;
    }
    public function actions()
    {
        $actions = parent::actions();
        unset($actions['create']);
        return $actions;
    }

    public function actionCreate()
    {
        $params = \Yii::$app->request->post();
				// return $params;
        $user = new StudentForm();
        $user->profile = [];
        $user->load(['StudentForm' => $params]);
        if ($user->validate() and $registerUser = $user->signup()) {
            return "success";
        }else{
            return "failedgggg";
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