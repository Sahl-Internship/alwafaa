<?php


namespace api\controllers;



use api\resources\CourseDetails;
use api\resources\CoursesList;
use yii\rest\ActiveController;

class CourseController extends ActiveController
{
    public $modelClass = 'api\resources\CoursesList';
    public function actions()
    {
        $actions = parent::actions();
        // disable the "index" and "view" actions
        unset($actions['index'], $actions['view']);
        return $actions;
    }

    public function actionIndex()
    {
//         $this->modelClass = 'api\resources\CoursesList';
        $courses = CoursesList::find()->all();
        return $courses;
    }

    public function actionView($id)
    {
        return CourseDetails::findOne($id);
    }

}