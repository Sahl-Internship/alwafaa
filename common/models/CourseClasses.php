<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%course_classes}}".
 *
 * @property int $id
 * @property int|null $course_id
 * @property string|null $title
 * @property int|null $time
 * @property int|null $duration
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
            [['course_id', 'duration','time','title'], 'required'],
            [['course_id', 'duration'], 'integer'],
            [['time'], 'filter', 'filter' => 'strtotime', 'skipOnEmpty' => true],
            [['title'], 'string', 'max' => 255],
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
            'course_id' => Yii::t('backend', 'Course ID'),
            'title' => Yii::t('backend', 'Title'),
            'time' => Yii::t('backend', 'Time'),
            'duration' => Yii::t('backend', 'Duration'),
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
}
