<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%course_classes}}".
 *
 * @property int $id
 * @property int $course_id
 * @property int $day_id
 * @property int $from
 * @property int $to
 *
 * @property Course $course
 */
class CourseClasses extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%course_classes}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['course_id', 'day_id'], 'required'],
            [['course_id', 'day_id'], 'integer'],
            [['from','to'], 'filter', 'filter' => 'strtotime', 'skipOnEmpty' => true],
            [['course_id'], 'exist', 'skipOnError' => true, 'targetClass' => Course::className(), 'targetAttribute' => ['course_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('backend', 'ID'),
            'course_id' => Yii::t('backend', 'Course'),
            'day_id' => Yii::t('backend', 'Day'),
            'from' => Yii::t('backend', 'From'),
            'to' => Yii::t('backend', 'To'),
        ];
    }

    /**
     * Gets query for [[Course]].
     *
     * @return \yii\db\ActiveQuery|\common\models\query\CourseQuery
     */
    public function getCourse()
    {
        return $this->hasOne(Course::className(), ['id' => 'course_id']);
    }

    /**
     * {@inheritdoc}
     * @return \common\models\query\CourseClassesQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\CourseClassesQuery(get_called_class());
    }
//    public function afterFind() {
//        parent::afterFind ();
//        $this->time=Yii::$app->formatter->asDate($this->time);
//    }

    public function getWeekDay($key)
    {
        $days = [
            0 => 'Sunday',
            1 => 'Monday',
            2 => 'Tuesday',
            3 => 'Wednesday',
            4 => 'Thursday',
            5 => 'Friday',
            6 => 'Saturday',
        ];
        return $days[$key];

    }

//    public function getClassDuration($id)
//    {
//        $classes = CourseClasses::findBySql("
//            SELECT c.id,c.from,c.to FROM course_classes c WHERE course_id=:id",['id'=>$id])->all();
//
//        return $classes;
////        $time1 = strtotime($this->from);
////        $time2 = strtotime($this->to);
////        $difference = round(abs($time2 - $time1) / 3600,2);
//    }
}
