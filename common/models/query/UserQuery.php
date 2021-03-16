<?php

namespace common\models\query;

use backend\modules\rbac\models\RbacAuthAssignment;
use common\models\Course;
use common\models\JoinCourses;
use common\models\User;
use Yii;
use yii\db\ActiveQuery;

/**
 * Class UserQuery
 * @package common\models\query
 * @author Eugene Terentev <eugene@terentev.net>
 */
class UserQuery extends ActiveQuery
{
    /**
     * @return $this
     */
    public function notDeleted()
    {
        $this->andWhere(['!=', 'status', User::STATUS_DELETED]);
        return $this;
    }

    /**
     * @return $this
     */
    public function active()
    {

        $this->andWhere(['status' => User::STATUS_ACTIVE]);
        return $this;
    }


    public function getTeacher()
    {
        $role_user = RbacAuthAssignment::find()->andWhere(['item_name' => 'teacher'])->all();
        $teacher_ids = [];
        foreach ($role_user as $index => $value) {
            $id = $value['user_id'];
            array_push($teacher_ids, $id);
        }
        return User::findBySql("SELECT * FROM user WHERE id IN (" . implode(',', array_map('intval', $teacher_ids)) . ")");
    }


    public function getStudent()
    {
        $role_user = RbacAuthAssignment::find()->andWhere(['item_name' => 'student'])->all();
        $user_ids = [];
        foreach ($role_user as $index => $value) {
            $id = $value['user_id'];
            array_push($user_ids, $id);
        }
        return User::findBySql("SELECT * FROM user WHERE id IN (" . implode(',', array_map('intval', $user_ids)) . ")");
    }

    public function getOwnStudents()
    {
        $courses = new Course();
        $courses =  $courses->findOwnCourses()->all();
        $students_ids = [];
        foreach ($courses as $course) {
            $joined_students = Course::find()->getJoinedStudents($course->id);
            array_push($students_ids,$joined_students);
        }
        $all_students = call_user_func_array('array_merge', $students_ids);
        $students_number = count($all_students);
        $students = array_unique($all_students);

//        return User::findBySql("SELECT * FROM user WHERE id IN (" . implode(',', array_map('intval', $students)) . ")");
        //if you want to get ids and number of students
        return ['students'=>$students, 'student_number'=>$students_number,];
    }

    public function getOwnCourses()
    {
        $joined = JoinCourses::findBySql("SELECT course_id FROM join_courses WHERE user_id=:id",['id'=>Yii::$app->user->id])->all();
        $courses_status = [];
        foreach ($joined as $item) {
            array_push($courses_status, $item->course_id);
        }
return $courses_status;
    }
}