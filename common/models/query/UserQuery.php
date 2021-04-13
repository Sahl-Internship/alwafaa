<?php

namespace common\models\query;

use backend\modules\rbac\models\RbacAuthAssignment;
use common\models\Course;
use common\models\CourseReview;
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
    public function getManager()
    {
        $role_user = RbacAuthAssignment::find()->andWhere(['item_name' => 'manager'])->all();
        foreach ($role_user as $index =>$value){
            $manager_ids[] = $value['user_id'];
        }
        return User::findBySql("SELECT * FROM user WHERE id IN (" . implode(',',array_map('intval',$manager_ids)) . ")");

    }

    public function getTeacherPortfolio($id)
    {
        $courses = Course::find()->andWhere('teacher_id=:id',['id'=>$id])->all();
        $students_ids = [];
        $sessions = [];
        $duration = [];
        foreach ($courses as $course) {
            $joined_students = Course::find()->getJoinedStudents($course->id);
            $classes = Course::find()->getScheduleAndDuration($course->id);
            array_push($students_ids,$joined_students);
            array_push($sessions,count($classes['classes_number']));
            array_push($duration,$classes['total_time']);
        }
        $all_students = call_user_func_array('array_merge', $students_ids);
        $students_number = count($all_students);
        $students = array_unique($all_students);
        $total_duration =array_sum($duration);
        $sessions_number =array_sum($sessions);
        return [
            'students'=>$students,
            'student_number'=>$students_number,
            'classes'=>$sessions_number,
            'duration'=>$total_duration
        ];

    }

    public function getOwnCoursesIds($id)
    {
        $courses = Course::find()->andWhere('teacher_id=:id',['id'=>$id])->all();
        $courses_ids = [];
        foreach ($courses as $course) {
            array_push($courses_ids,$course->id);
        }
        return $courses_ids;
    }

    public function getTeacherClassesAndDuration()
    {

    }

    public function getStudentCourses()
    {
        $joined = JoinCourses::findBySql("SELECT course_id FROM join_courses WHERE user_id=:id",['id'=>Yii::$app->user->id])->all();
        $courses_status = [];
        foreach ($joined as $item) {
            array_push($courses_status, $item->course_id);
        }
return $courses_status;
    }

    public function getReview($id)
    {
        $reviews = CourseReview::find()->andWhere('created_by=:id',['id'=>$id])->all();
        $review_ids = [];
        foreach ($reviews as $review) {
            array_push($review_ids,$review->id);
        }
        return $review_ids;
    }
}