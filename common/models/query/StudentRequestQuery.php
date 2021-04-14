<?php

namespace common\models\query;

use common\models\StudentRequest;
use common\models\User;

/**
 * This is the ActiveQuery class for [[\common\models\StudentRequest]].
 *
 * @see \common\models\StudentRequest
 */
class StudentRequestQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return \common\models\StudentRequest[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return \common\models\StudentRequest|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }

    public function getOwnRequestsIds()
    {
        $courses_ids = User::find()->getOwnCoursesIds();
        $requests = StudentRequest::findBySql("SELECT * FROM student_requests WHERE course_id IN (" . implode(',', array_map('intval', $courses_ids)) . ")")->all();
        $requests_ids = [];
        foreach ($requests as $request) {
            array_push($requests_ids, $request->id);
        }
        return $requests_ids;
    }
}
