<?php


namespace api\controllers;


use common\models\CourseReview;
use common\models\Homework;
use common\models\RequestAttachment;
use common\models\StudentRequest;
use Yii;
use yii\base\BaseObject;

class JoinCourseController extends ApController
{
    public function actionReview()
    {
        $params = Yii::$app->request->post();
        $params['created_by'] = Yii::$app->user->id;
        $review = new CourseReview();
        $review->load(['CourseReview' => $params]);
        if ($review->validate() and $review->save()) {
            return ['status' => 1, 'message' => 'Successfully Rated'];
        } elseif ($review->errors) {
            return ['status' => 0, 'message' => $review->errors, 'key' => 'dataError'];
        } else {
            return ['status' => 0, 'message' => 'Error,Try again'];
        }
    }

    public function actionJoinCourse()
    {
        $params = Yii::$app->request->post();
        $request = new StudentRequest();
        $params['created_by'] = Yii::$app->user->id;
        $params['status'] = $request::REQUEST_WAITING;
        $request->load(['StudentRequest' => $params]);
        if ($request->validate() and $request->save()) {
            if ($params['attachment']) {
                $this->attachedFiles($params['attachment'], $request->id);
            }
            return ['status' => 1, 'message' => 'Your Request Successfully sent'];
        } elseif ($request->errors) {
            return ['status' => 0, 'message' => $request->errors, 'key' => 'dataError'];
        } else {
            return ['status' => 0, 'message' => 'Error,Try again'];
        }
    }

    public function attachedFiles($files, $id)
    {
        foreach ($files as $index => $file) {
            if (preg_match('/^data:@file\/(\w+);base64,/', $file, $type)) {
                $data = substr($file, strpos($file, ',') + 1);
                $type = strtolower($type[1]); // jpg, png, gif
                if (!in_array($type, ['jpg', 'jpeg', 'gif', 'png', 'pdf'])) {
                    throw new \Exception('invalid image type');
                }
                $data = str_replace(' ', '+', $data);
                $data = base64_decode($data);
                if ($data === false) {
                    throw new \Exception('base64_decode failed');
                }
            } else {
                throw new \Exception('did not match data URI with image data');
            }
            $image_path = Yii::getAlias('@storage/web/source/1/');
            $image_name = Yii::$app->getSecurity()->generateRandomString() . "." . $type;

            file_put_contents($image_path . $image_name, $data);
            $attachment = new RequestAttachment();
            $attachment->request_id = $id;
            $attachment->base_url = Yii::getAlias('@storageUrl/source');
            $attachment->path = "1/" . $image_name;
            $attachment->type = $type;
            $attachment->name = $image_name;
            $attachment->size = filesize($image_path . $image_name);
            $attachment->save();
        }

    }

    public function actionUploadHomework()
    {
        $params = Yii::$app->request->post();
        $files = $params['attachment'];
        foreach ($files as $index => $file) {
            if (preg_match('/^data:@file\/(\w+);base64,/', $file, $type)) {
                $data = substr($file, strpos($file, ',') + 1);
                $type = strtolower($type[1]); // jpg, png, gif
                if (!in_array($type, ['jpg', 'jpeg', 'gif', 'png', 'pdf'])) {
                    throw new \Exception('invalid image type');
                }
                $data = str_replace(' ', '+', $data);
                $data = base64_decode($data);
                if ($data === false) {
                    throw new \Exception('base64_decode failed');
                }
            } else {
                throw new \Exception('did not match data URI with image data');
            }
            $image_path = Yii::getAlias('@storage/web/source/1/');
            $image_name = Yii::$app->getSecurity()->generateRandomString() . "." . $type;


                $attachment = new Homework();
                $attachment->event_id = $params['event_id'];
                $attachment->base_url = Yii::getAlias('@storageUrl/source');
                $attachment->path = "1/" . $image_name;
                $attachment->type = $type;
                $attachment->name = $params['name'];
            if (file_put_contents($image_path . $image_name, $data)) {
                $attachment->size = filesize($image_path . $image_name);
                $attachment->save();
            } else {
                return ['status' => 0, 'message' => "Something wrong !!  plz try again later"];
            }
        }
        return ['status' => 1, 'message' => "Homework uploaded successfully"];

    }


}