<?php


namespace api\controllers;


use api\resources\User;
use frontend\modules\user\models\StudentForm;
use yii\rest\ActiveController;
//use yii\rest\Controller;

class ProfileController extends ApiController
{

  public function actions()
  {
    $actions = parent::actions();
    unset($actions['create']);
    return $actions;
  }

  public function actionUploadPicture()
  {
    $params = \Yii::$app->request->post();
    $base64String = $params['avatar'];
    $decoder = base64_decode($base64String);
    $img = imagecreatefromstring($decoder);
    return $img;
  }


  public function actionUpdate()
  {

    $params = \Yii::$app->request->post();
    //\Yii::$app->user->identity->getId()
    $user = User::findOne(['id' => \Yii::$app->user->identity->getId()]);
    if (!$user) {
      return "Kullanıcı yok";
    }
    $profile = $user->userProfile;

    //        if (isset($params['full_name'])){
    //            $names = split_name($params['full_name']);
    //            $profile->firstname= $names[0] ;
    //            $profile->lastname= $names[1] ;
    //        }
    if (isset($params['firstname'])) $profile->firstname = $params['firstname'];
    if (isset($params['lastname'])) $profile->lastname = $params['lastname'];
    if (isset($params['birthdate'])) $profile->birthdate = $params['birthdate'];
    if (isset($params['bio'])) $profile->bio = json_encode($params['bio']);
    if (isset($params['phone_key'])) $profile->phone_key = $params['phone_key'];
    if (isset($params['phone'])) $profile->phone = $params['phone'];
    if (isset($params['country'])) $profile->country = $params['country'];
    if (isset($params['city'])) $profile->city = $params['city'];

    if (isset($params['email'])) $user->email = $params['email'];

    //        if (isset($params['binary'] )  &&  $params['binary']!= "" ){
    ////            $filename = Media::PrepareImage($params['binary'] );
    ////            $profile->image ='/uploads/profile/'.$filename ;
    //        }

    if (isset($params['password'])) $user->password = $params['password'];

    //var_dump($params);

    if ($user->save() && $profile->save()) {

      return ['status' => 1, 'profile' => $user];
    } else {

      return ['status' => 0, 'message' => 'Invalid Data', 'errors' => $profile->errors];
    }
  }
}