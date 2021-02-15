<?php declare(strict_types=1);

namespace api\controllers;

use api\resources\User;
//use common\models\User;
use Yii;
use yii\rest\Controller;
use yii\web\NotFoundHttpException;
use yii\helpers\Url;
class SiteController extends ApiController
{
        /**
     * @inheritdoc
     */
    public function actions(): array
    {
        return [
            'docs' => [
                'class' => \yii2mod\swagger\SwaggerUIRenderer::class,
                'restUrl' => Url::to(['site/json-schema']),
            ],
            'json-schema' => [
                'class' => \yii2mod\swagger\OpenAPIRenderer::class,
                // Тhe list of directories that contains the swagger annotations.
                'scanDir' => [
                    Yii::getAlias('@api/modules/v1/controllers'),
                    Yii::getAlias('@api/modules/v1/models'),
                ],
            ],
        ];
    }
    public function actionIndex()
    {
//        return $this->redirect(['site/docs']);
        return $this->redirect(\Yii::getAlias('@frontendUrl'));
    }

    public function actionTest(){

        return 'Test API...';
        //return $this->redirect(\Yii::getAlias('@frontendUrl'));
    }
    public function actionLogin(){

        $params = \Yii::$app->request->post();
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $user = User::find()
//            ->active()
            ->andWhere(['or', ['username' => $params['identity'] ], ['email' => $params['identity']]])
            ->one();

        if(!$user){
            return ['status'=>0 , 'message'=>'Email not found'];
        }
        if($user->status == User::STATUS_NOT_ACTIVE){
            return ['status'=>0 , 'message'=>'You must verify your email first'];
        }

        $valid_password = Yii::$app->getSecurity()->validatePassword($params['password'], $user->password_hash);

        if($valid_password){
            return ['status'=>1,  'profile'=> $user ];


        }else{
            return ['status'=>0 , 'message'=>'Invalid password'];

        }

    }


    public function actionError()
    {
        if (($exception = Yii::$app->getErrorHandler()->exception) === null) {
            $exception = new NotFoundHttpException(Yii::t('yii', 'Page not found.'));
        }

        if ($exception instanceof \HttpException) {
            Yii::$app->response->setStatusCode($exception->getCode());
        } else {
            Yii::$app->response->setStatusCode(500);
        }

        return $this->asJson(['error' => $exception->getMessage(), 'code' => $exception->getCode()]);
    }
}
