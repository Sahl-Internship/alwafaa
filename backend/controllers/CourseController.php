<?php

namespace backend\controllers;

use common\models\CourseAttachment;
use common\models\CourseClasses;
use common\models\Section;
use common\models\User;
use edofre\fullcalendar\models\Event;
use Yii;
use common\models\Course;
use backend\models\search\CourseSearch;
use yii\bootstrap4\Modal;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

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
        if (Yii::$app->user->can('administrator') || Yii::$app->user->can('manager')) {
            $view = 'index';
        } elseif (Yii::$app->user->can('teacher')) {
            $view = 'teacher-index';
        } else {
            $view = 'teacher-index';
        }
        return $this->render($view, [
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
        if (Yii::$app->user->can('administrator') || Yii::$app->user->can('manager')) {
            $view = 'view';
        } elseif (Yii::$app->user->can('teacher')) {
            $view = '_teacher_view';
        }
        return $this->render($view, [
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
        $files = new CourseAttachment();
        $teachers = $user->getTeacher();
        $teachers_name = [];
        foreach ($teachers as $index => $teacher) {
            $teachers_name[$teacher->id]= $teacher->userProfile->getFullName();
        }
        $model->classes = [];
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            if ($model->classes) {
                $model->classSchedule($model->classes);
                $model->setEvents($model->id);
            }
            return $this->redirect(['view', 'id' => $model->id]);
        }
        return $this->render('create', [
            'model' => $model,
            'files' => $files,
            'sectionList' => ArrayHelper::map(Section::find()->all(), 'id', 'title'),
            'teacherList' =>$teachers_name
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
        if (!Yii::$app->user->can('administrator') || !Yii::$app->user->can('manager')) {
            $courses_id = User::find()->getOwnCoursesIds(Yii::$app->user->id);
            if (!in_array($id, $courses_id)) {
                throw new \yii\web\HttpException(403, 'You are not allowed to perform this action.');
            }
            $view = 'index';
        } else {
            $view = 'view';
        }
//        $files = CourseAttachment::find()->andWhere('course_id=:id', ['id' => $id]);
        $model = $this->findModel($id);
        $user = new User();
        $teachers = $user->getTeacher();
        $teachers_name = [];
        foreach ($teachers as $index => $teacher) {
            $teachers_name[$teacher->id]= $teacher->userProfile->getFullName();
        }
        $model->classes = CourseClasses::find()->where('course_id=:id', ['id' => $id])->all();
        if ($model->load(Yii::$app->request->post()) && $model->save()) {

            if ($model->classes) {
                CourseClasses::deleteAll(['course_id' => $model->id]);
                $model->classSchedule($model->classes);
            }
            return $this->redirect([$view, 'id' => $model->id]);
        }
        return $this->render('update', [
            'model' => $model,
//            'files' => $files,
            'sectionList' => ArrayHelper::map(Section::find()->all(), 'id', 'title'),
            'teacherList' =>$teachers_name
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

    public function actionCalender($id)
    {
        $classes = \common\models\Event::find()->andWhere('course_id=:id',['id'=>$id])->all();
        $course = Course::find()->andWhere('id=:cid', ['cid' => $id])->one();
        $events = [new Event([
            'title' => 'Start of Course',
            'start' => date('Y-m-d', $course->start_at),
            'color' => 'green',
        ]),
            new Event([
                'title' => 'End of Course',
                'start' => date('Y-m-d', $course->end_at),
                'color' => 'red',
            ]),
        ];
        foreach ($classes as $class) {
            $event = new Event([
                'id' => $class->id,
                'title' => $class->title,
                'start' => date('Y-m-d', $class->date) . date('\Th:i:s', $class->from),
                'end' => date('Y-m-d', $class->date) . date('\Th:i:s', $class->to),
                'url' => Url::to(['event-update','id'=>$class->id]),
                'editable' => true,
            ]);
            array_push($events, $event);
        }

        return render('calender', [
            'events' => $events,
        ]);

    }

    public function actionEventUpdate($id)
    {
        $model = \common\models\Event::find()->andWhere('id=:e_id',['e_id'=>$id])->one();
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['calender', 'id' => $model->course_id]);
        }
        return $this->render('event-update', [
            'model' => $model,
        ]);
    }
}


