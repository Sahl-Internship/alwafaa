<?php


namespace api\resources;


use Yii;

class Profile extends \common\models\User
{
//    public function fields()
//    {
//        $user = parent::fields();
//        return array_merge($user,['userProfile']);
//    }

    public function fields()
    {
        return [
            'id'=>function($model){
                return $model->id;
            },

            'firstname'=>function($model){
                return $model->userProfile->firstname;
            },
            'lastname'=>function($model){
                return $model->userProfile->lastname;
            },
            'sub_title'=>function($model){
                return $model->userProfile->sub_title;
            },
            'birthdate'=>function($model){
                return $model->userProfile->birthdate;
            },
            'phone_key'=>function($model){
                return $model->userProfile->phone_key;
            },
         'phone'=>function($model){
                return $model->userProfile->phone;
            },
            'country'=>function($model){
                return $model->userProfile->country;
            },
            'city'=>function($model){
                return $model->userProfile->city;
            },
             'bio'=>function($model){
                return json_decode( $model->userProfile->bio);
            },
              'email',
            'token'=>function($model){
                return $model->access_token;
            },

            'image'=>function($model){
                return   $model->userProfile->avatar?: \Yii::getAlias('@backendUrl'). "/img/anonymous.jpg" ;
            },
            'cover'=>function($model){
                return   $model->userProfile->pcover?: \Yii::getAlias('@backendUrl'). "/img/anonymous.jpg" ;
            },
//            'reviews' => function ($model) {
//                $ids = User::find()->getReview($model->id);
//                return StudentReviews::find()->andWhere(['in', 'id', $ids])->all();
//            }

        ];
    }






//    public function extraFields()
//    {
//        return ['userProfile'];
//    }
//
//    public function userRole()
//    {
//        $auth = Yii::$app->authManager;
//        $auth->assign($auth->getRole(User::ROLE_USER), $this->getId());
//
//    }

    public function setRole($id)
    {
        $auth = Yii::$app->authManager;
        $auth->assign($auth->getRole(\common\models\User::ROLE_STUDENT), $id);
    }
}
