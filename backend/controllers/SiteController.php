<?php

namespace backend\controllers;

use backend\models\search\CourseSearch;
use common\models\Course;
use Yii;

/**
 * Site controller
 */
class SiteController extends \yii\web\Controller
{
    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    public function beforeAction($action)
    {
        $this->layout = Yii::$app->user->isGuest || !Yii::$app->user->can('loginToBackend') ? 'base' : 'common';

        return parent::beforeAction($action);
    }

    public function actionIndex(){
        $dataProvider= null;
        //according to user roles open the suitable daschboard
        if(Yii::$app->user->can('manager') or Yii::$app->user->can('administrator')){
//            $searchModel = new SchoolBookingSearch();
//            $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

            $view= 'index';
        }else if(Yii::$app->user->can('teacher')){
            $view='teacher';
            $dataProvider = count(Course::findOwnCourses()->all());
        }else{
            //logout
            return $this->redirect(['/sign-in/login']);
        }

        //var_dump(Yii::$app->user->identity->userProfile->school); die;

        return $this->render($view , ['dataProvider'=>$dataProvider]);
    }
}
