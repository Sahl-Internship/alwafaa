<?php

namespace backend\controllers;

use common\models\JoinCourses;
use Yii;
use common\models\StudentRequest;
use backend\models\search\StudentRequestSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * StudentRequestController implements the CRUD actions for StudentRequest model.
 */
class StudentRequestController extends Controller
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
     * Lists all StudentRequest models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new StudentRequestSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single StudentRequest model.
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
     * Creates a new StudentRequest model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new StudentRequest();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }
        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing StudentRequest model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }
        return $this->render('update', [
            'model' => $model,
        ]);
    }


    public function actionRefuse($id)
    {
        $model = $this->findModel($id);
        $model->status = $model::REQUEST_REFUSED;
        if($model->save()){
            Yii::$app->session->setFlash('flashMsg', Yii::t('backend','Requested Refused Successfully'));
        }else{
            Yii::$app->session->setFlash('flashMsg', Yii::t('backend','There is an error !! Plz try again'));

        }

        return $this->redirect(['index']);
    }


    public function actionAccept($id)
    {
        $model = $this->findModel($id);
        $model->status = $model::REQUEST_ACCEPTED;
        $join = new JoinCourses();
        $join->course_id = $model->course_id;
        $join->user_id = $model->created_by;
        if ($model->save() && $join->validate() && $join->save()) {
            Yii::$app->session->setFlash('flashMsg', Yii::t('backend','Requested Accepted Successfully'));
        } elseif ($join->errors) {
            Yii::$app->session->setFlash('flashMsg', Yii::t('backend','There is an error !! Plz try again'));
        }


        return $this->redirect(['index']);
    }

    /**
     * Finds the StudentRequest model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return StudentRequest the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = StudentRequest::findOne($id)) !== null) {
            return $model;
        }
        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
