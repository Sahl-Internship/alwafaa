<?php


namespace api\controllers;


use yii\filters\auth\CompositeAuth;
use yii\filters\auth\HttpBasicAuth;
use yii\filters\auth\HttpBearerAuth;
use yii\filters\auth\HttpHeaderAuth;
use yii\filters\auth\QueryParamAuth;
use yii\rest\ActiveController;
use yii\rest\Controller;

class ApController extends Controller
{
    public function behaviors()
    {
        $behaviors = parent::behaviors();
        // remove authentication filter if there is one
        unset($behaviors['authenticator']);
        // add CORS filter before authentication


        $behaviors['corsFilter'] = [
            'class' => \yii\filters\Cors::className(),
            'cors' => [
//                'Origin' => ['*'],
                'Origin' => self::allowedDomains(),
                'Access-Control-Request-Method' => ['GET', 'POST', 'PUT', 'PATCH', 'DELETE', 'HEAD', 'OPTIONS'],
                'Access-Control-Request-Headers' => ['*'],
            ],
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
    public static function allowedDomains()
    {
        return [
            //  '*', // star allows all domains
            'http://localhost:4000',
            'http://localhost:4001',
            'https://jquery.com',
//            'http://booking.yaschools.localhost',
//            "http://booking.yaschools.localhost",
//            'http://endpoints.yaschools.localhost',
//            'http://schooladmin.yaschools.localhost',
//            'http://yaschools.localhost',
//            'https://yaschools.com',
//            'http://yaschools.localhost',
//            'https://showroom.yaschools.com'
        ];
    }
}