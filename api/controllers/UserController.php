<?php


namespace api\controllers;


use api\resources\User;

//use common\models\User;
use apps\models\parent\StudentSignup;
use common\models\UserProfile;
use frontend\modules\user\models\SignupForm;
use Yii;
use yii\base\Exception;
use yii\rest\ActiveController;

class UserController extends ActiveController
{
    public $modelClass = User::class;

    public function actions()
    {
        $actions = parent::actions();
        unset($actions['create']);
        return $actions;
    }

    public function actionCreate()
    {
        $params = \Yii::$app->request->post();
        $user = new User();
        $user->profile = [];
        $user->username = $params['username'];
        $user->setPassword($params['password']);
        $user->email = $params['email'];
        $user->status = $params['status'];
        if (!$user->save()) {
            throw new Exception("User couldn't be  saved");
        }else{
            $user->setRole($user->id);
            $profile = new UserProfile();
            $profile->user_id = $user->id;
            $profile->locale = Yii::$app->language;
            $profile->firstname = $params['firstname'];
            $profile->middlename = $params['middlename'] ?? "";
            $profile->lastname = $params['lastname'];
            $profile->phone = $params['phone'];
            $profile->gender = $params['gender'];
            $profile->country = $params['country'];
            $profile->birthday = $params['birthday'];
            $profile->save();
        }

    }



//    public function actionSignup()
//    {
//        $params = \Yii::$app->request->post();
//        \Yii::$app->language = 'ar';
//
//        $model = new StudentSignup();
//
//        $model->load(['ParentSignup' => $params]);
//        $model->phone = myConvertNumbers($model->phone);
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