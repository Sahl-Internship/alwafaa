<?php

namespace common\models;

use Yii;
use yii\behaviors\BlameableBehavior;

/**
 * This is the model class for table "{{%course_review}}".
 *
 * @property int $id
 * @property int|null $course_id
 * @property float|null $rate
 * @property string|null $review
 * @property int|null $created_by
 *
 * @property Course $course
 * @property User $createdBy
 */
class CourseReview extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%course_review}}';
    }

    public function behaviors()
    {
        return [
            [
                'class' => BlameableBehavior::class,
                'updatedByAttribute' => false
            ]
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['course_id', 'created_by'], 'integer'],
            [['rate'], 'number'],
            [['review'], 'string', 'max' => 255],
            [['course_id'], 'exist', 'skipOnError' => true, 'targetClass' => Course::className(), 'targetAttribute' => ['course_id' => 'id']],
            [['created_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['created_by' => 'id']],
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
            'rate' => Yii::t('backend', 'Rate'),
            'review' => Yii::t('backend', 'Review'),
            'created_by' => Yii::t('backend', 'Created By'),
        ];
    }

    /**
     * Gets query for [[Course]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCourse()
    {
        return $this->hasOne(Course::className(), ['id' => 'course_id']);
    }

    /**
     * Gets query for [[CreatedBy]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCreatedBy()
    {
        return $this->hasOne(User::className(), ['id' => 'created_by']);
    }
}
