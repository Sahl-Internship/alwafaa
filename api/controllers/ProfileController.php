<?php


namespace api\controllers;


use api\resources\CourseDetails;
use api\resources\User;
use common\models\UserProfile;

class ProfileController extends ApController
{
//    public $modelClass = 'api\resources\User';

//    public function actions()
//    {
//        $actions = parent::actions();
//        unset($actions['update']);
//        return $actions;
//    }

    public function actionUploadPicture()
    {
        $params = \Yii::$app->request->post();
        $user = User::findOne(['id' => \Yii::$app->user->identity->getId()]);
        $profile = $user->userProfile;
        $data = $params['avatar'] ?? $params['cover'];
        if (preg_match('/^data:image\/(\w+);base64,/', $data, $type)) {
            $data = substr($data, strpos($data, ',') + 1);
            $type = strtolower($type[1]); // jpg, png, gif
            if (!in_array($type, ['jpg', 'jpeg', 'gif', 'png'])) {
                throw new \Exception('invalid image type');
            }
            $data = str_replace(' ', '+', $data);
            $data = base64_decode($data);
            if ($data === false) {
                throw new \Exception('base64_decode failed');
            }
        } else {
            throw new \Exception('did not match data URI with image data');
        }
        $image_path = \Yii::getAlias('@storage/web/source/profile/');
        $image_name = \Yii::$app->getSecurity()->generateRandomString() . "." . $type;

        if ($params['avatar']) {
            $profile->avatar_base_url = \Yii::getAlias('@storageUrl/source');
            $profile->avatar_path = "profile/" . $image_name;
        } else {
            $profile->cover_base_url = \Yii::getAlias('@storageUrl/source');
            $profile->cover_path = "profile/" . $image_name;
        }
        if ($profile->save()) {
            file_put_contents($image_path . $image_name, $data);
            return ['status' => 1, 'profile' => $user];
        } else {
            return "failed";
        }
    }


    public function actionUpdate()
    {

        $params = \Yii::$app->request->post();
        $user = User::findOne(['id' => \Yii::$app->user->identity->getId()]);
        $profile = UserProfile::findOne(['user_id'=>\Yii::$app->user->identity->getId()]);
        $profile->load(['UserProfile'=>$params]);
        if (isset($params['bio'])) $profile->bio= json_encode($params['bio']);
        if (isset($params['password'])) $user->password = $params['password'];
////        if (isset($params['binary'] )  &&  $params['binary']!= "" ){
//////            $filename = Media::PrepareImage($params['binary'] );
//////            $profile->image ='/uploads/profile/'.$filename ;
////        }

        if ( $profile->validate() &&$profile->save() && $user->save())
         {
            return ['status' => 1, 'profile' => $user];

        } else {

            return ['status' => 0, 'message' => 'Invalid Data', 'errors' => $profile->errors];
        }


    }

    public function actionJoinedCourses()
    {
        $course_ids =\common\models\User::find()->getStudentCourses();
        $courses = CourseDetails::find()->andWhere(['in','id',$course_ids])->all();
        return $courses;
    }

}
