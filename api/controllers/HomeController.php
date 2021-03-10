<?php


namespace api\controllers;



use api\resources\Course;

class HomeController extends ApiController
{
    public function actionIndex()
    {
        $courses = Course::find()->all();
        return $courses;
    }
}