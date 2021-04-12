<?php


namespace api\controllers;



use api\resources\CourseDetails;
use api\resources\CoursesList;
use common\models\Section;
use yii\rest\ActiveController;

class CourseController extends ActiveController
{
    public $modelClass = 'api\resources\CourseDetails';

    public function behaviors(){
        $behaviors = parent::behaviors();
        $behaviors['corsFilter'] = [
            'class' => \yii\filters\Cors::className(),
            'cors' => [
                'Origin' => ['*'],
//                'Origin' => self::allowedDomains(),
                'Access-Control-Request-Method' => ['GET', 'POST', 'PUT', 'PATCH', 'DELETE', 'HEAD', 'OPTIONS'],
                'Access-Control-Request-Headers' => ['*'],
            ],
        ];
        return $behaviors;
    }

//    public function actionIndex()
//    {
//        $courses = CoursesList::find()->all();
//        return $courses;
//    }
//
//    public function actionView($id)
//    {
//        return CourseDetails::findOne($id);
//    }

    public function actionSection()
    {
        return Section::find()->all();
        
    }

}

