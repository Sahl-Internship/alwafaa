<?php

namespace common\models\query;

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
}
