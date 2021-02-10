<?php


namespace api\resources;


use Yii;

class User extends \common\models\User
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

            'username',
            'token'=>function($model){

                return $model->access_token;
            },
            'full_name'=>function($model){
                return $model->getPublicIdentity();
            },
            'email',
            'image'=>function($model){
                return   $model->userProfile->avatar?: \Yii::getAlias('@backendUrl'). "/img/anonymous.jpg" ;
            },

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
        $auth->assign($auth->getRole(\common\models\User::ROLE_USER), $id);
    }
}
