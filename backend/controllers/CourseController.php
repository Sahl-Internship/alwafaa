<?php

namespace backend\controllers;

use common\models\CourseClasses;
use common\models\Section;
use common\models\User;
use Yii;
use common\models\Course;
use backend\models\search\CourseSearch;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * CourseController implements the CRUD actions for Course model.
 */
class CourseController extends Controller
{
    /** @inheritdoc */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all Course models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new CourseSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Course model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Course model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Course();
        $user = new User();
        $teacher = $user->getTeacher();
        $model->classes = [];
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            if($model->classes){
//                var_dump($model->classes);
//                die();
                foreach($model->classes as $class){
                    $courseClass = new CourseClasses();
                    $courseClass->course_id = $model->id;
                    $courseClass->title = $class['title'];
                    $courseClass->time = $class['time'];
                    $courseClass->duration = $class['duration'];
                    $courseClass->save();
                }
            }
            return $this->redirect(['view', 'id' => $model->id]);
        }
        return $this->render('create', [
            'model' => $model,
            'sectionList'=>ArrayHelper::map(Section::find()->all(),'id','title'),
            'teacherList'=>ArrayHelper::map($teacher,'id','username')
        ]);
    }

    /**
     * Updates an existing Course model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $user = new User();
        $teacher = $user->getTeacher();

        $model->classes = CourseClasses::find()->where('course_id=:id',['id'=>$id])->all();
        if ($model->load(Yii::$app->request->post()) && $model->save()) {

            if($model->classes){
                CourseClasses::deleteAll(['course_id'=>$model->id]);
                foreach($model->classes as $class){
                    $courseClass = new CourseClasses();
                    $courseClass->course_id = $model->id;
                    $courseClass->title = $class['title'];
                    $courseClass->time = $class['time'];
                    $courseClass->duration = $class['duration'];
                    $courseClass->save();
                }
            }
            return $this->redirect(['view', 'id' => $model->id]);
        }
        return $this->render('update', [
            'model' => $model,
            'sectionList'=>ArrayHelper::map(Section::find()->all(),'id','title'),
            'teacherList'=>ArrayHelper::map($teacher,'id','username')
        ]);
    }

    /**
     * Deletes an existing Course model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Course model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Course the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Course::findOne($id)) !== null) {
            return $model;
        }
        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
