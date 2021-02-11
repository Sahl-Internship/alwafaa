<?php


namespace api\controllers;


use yii\web\Controller;

class ApiController extends Controller
{
    public function behaviors(){
        $behaviors = parent::behaviors();
        $behaviors['corsFilter'] = [
            'class' => \yii\filters\Cors::className(),
            'cors' => [
//                'Origin' => ['*'],
                'Origin' => self::allowedDomains(),
                'Access-Control-Request-Method' => ['GET', 'POST', 'PUT', 'PATCH', 'DELETE', 'HEAD', 'OPTIONS'],
                'Access-Control-Request-Headers' => ['*'],
            ],
        ];
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