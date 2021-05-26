<?php


namespace api\controllers;


use yii\rest\ActiveController;
use yii\rest\Controller;

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
            'http://backend.alwafaa.localhost',
        ];
    }
}