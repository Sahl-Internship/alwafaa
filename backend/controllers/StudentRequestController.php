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
        $this->isOwnRequest($id);
        $model = $this->findModel($id);
        $attachments = $model->requestAttachments;
        foreach ($attachments as $attachment) {
            $attachFiles[]= Yii::getAlias($attachment->base_url . '/' . $attachment->path);
        }
        return $this->render('view', [
            'model' =>$model,
            'files' =>$attachFiles
        ]);
    }


    public function actionRefuse($id)
    {
        $this->isOwnRequest($id);
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
        $this->isOwnRequest($id);
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

    protected function isOwnRequest($id){
        if (!Yii::$app->user->can('administrator')){
            $request_id = StudentRequest::find()->getOwnRequestsIds();
            if (!in_array($id, $request_id)) {
                throw new \yii\web\HttpException(403, 'You are not allowed to perform this action.');
            }
        }
    }
}
