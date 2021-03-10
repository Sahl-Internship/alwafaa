<?php

namespace common\models\query;

use common\models\CourseClasses;

/**
 * This is the ActiveQuery class for [[\common\models\CourseClasses]].
 *
 * @see \common\models\CourseClasses
 */
class CourseClassesQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return \common\models\CourseClasses[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return \common\models\CourseClasses|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }


//    public function getDurationPerWeek($id)
//    {
//        $classes = CourseClasses::findBySql("
//            SELECT c.id,c.from,c.to FROM course_classes c WHERE course_id=:id",['id'=>$id])->all();
//        $duration = [];
//        foreach ($classes as $class) {
//            $classTime =  ($class->to - $class->from);
//            $timeByMin =  round($classTime/60);
//             array_push($duration,$timeByMin);
//        }
//        return array_sum($duration);
//    }
}
