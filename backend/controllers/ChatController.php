<?php

namespace backend\controllers;

use common\models\Conversation;
use Yii;
use common\models\Chat;
use backend\models\search\ChatSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ChatController implements the CRUD actions for Chat model.
 */
class ChatController extends Controller
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
     * Creates a new Chat model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Chat();
        $conversations = Conversation::find()->all();
        $messages  = Chat::find()->all();
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }
        return $this->render('chat', [
            'model' => $model,
            'conversations' => $conversations,
            'messages' => $messages,
        ]);
    }

    public function actionChat($id)
    {
        $conversations = Conversation::find()->all();
        $conversation = Conversation::findOne(['id'=>$id]);
        $messages  = Chat::find()->andWhere(['conversation_id'=>$id])->all();
        $avatar = $conversation->user->userProfile->avatar;
        return $this->render('conversations', [
            'conversations' => $conversations,
            'messages' => $messages,
            'avatar' => $avatar,
        ]);
    }
    public function actionConversations($id)
    {
        $messages  = Chat::find()->andWhere(['conversation_id'=>$id])->all();

        return $this->render('conversations', [
            'messages' => $messages,
        ]);
    }

    /**
     * Updates an existing Chat model.
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

    /**
     * Deletes an existing Chat model.
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
     * Finds the Chat model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Chat the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Chat::findOne($id)) !== null) {
            return $model;
        }
        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
