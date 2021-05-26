<?php

namespace common\models;

use Yii;
use yii\behaviors\BlameableBehavior;

/**
 * This is the model class for table "{{%join_courses}}".
 *
 * @property int|null $course_id
 * @property int|null $user_id
 *
 * @property Course $course
 * @property User $user
 */
class JoinCourses extends \yii\db\ActiveRecord
{

    public static function tableName()
    {
        return '{{%join_courses}}';
    }

    public function rules()
    {
        return [
            [['course_id', 'user_id'], 'required'],
            [['course_id', 'user_id'], 'unique', 'targetAttribute' => ['course_id', 'user_id']],
            [['course_id', 'user_id'], 'integer'],
            [['course_id'], 'exist', 'skipOnError' => true, 'targetClass' => Course::className(), 'targetAttribute' => ['course_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    public function attributeLabels()
    {
        return [
            'course_id' => Yii::t('backend', 'Course ID'),
            'user_id' => Yii::t('backend', 'User ID'),
        ];
    }

    public function getCourse()
    {
        return $this->hasOne(Course::className(), ['id' => 'course_id']);
    }

    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}
