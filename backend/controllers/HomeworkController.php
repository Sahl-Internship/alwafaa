<?php

namespace backend\controllers;

use common\models\Course;
use common\models\Event;
use common\models\User;
use Yii;
use common\models\Homework;
use backend\models\search\HomeworkSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * HomeworkController implements the CRUD actions for Homework model.
 */
class HomeworkController extends Controller
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
     * Lists all Homework models.
     * @return mixed
     */
    public function actionIndex($event_id)
    {
        $event = Event::findOne(['id'=>$event_id]);
        $course = Course::findOne(['id'=>$event->course_id]);
        $studentsIds = Course::find()->getJoinedStudents($event->course_id);
        $searchModel = new HomeworkSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams,$studentsIds);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'course_name' => $course->title,
            'event_name' => $event->title,
            'event_id' => $event_id,
        ]);
    }

    /**
     * Displays a single Homework model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $homeworks = Homework::findAll(['created_by'=>$id]);
        foreach ($homeworks as $homework) {
                    $attachFiles[]= Yii::getAlias($homework->base_url . '/' . $homework->path);
                }
        return $this->render('view', [
            'model' => $this->findModel($id),
            'files'=>$attachFiles,
        ]);
    }


    /**
     * Deletes an existing Homework model.
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
     * Finds the Homework model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return User the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = User::findOne($id)) !== null) {
            return $model;
        }
        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
