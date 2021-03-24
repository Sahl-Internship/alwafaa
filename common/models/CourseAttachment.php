<?php

namespace common\models;

use Yii;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "{{%course_attachment}}".
 *
 * @property int $id
 * @property int $course_id
 * @property int|null $class_id
 * @property string $path
 * @property string $base_url
 * @property string $type
 * @property int $size
 * @property string $name
 * @property int $created_at
 * @property int $created_by
 *
 * @property Course $course
 */
class CourseAttachment extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%course_attachment}}';
    }

    public function behaviors()
    {
        return [
            [
               'class'=> BlameableBehavior::class,
                'updatedByAttribute'=>false,
            ],
            [
                'class' => TimestampBehavior::class,
                'updatedAtAttribute' => false
            ]

        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [

            [['course_id','base_url', 'path', 'created_by','name'], 'required'],
            [['course_id','class_id','size', 'created_at', 'created_by'], 'integer'],
            [['path', 'base_url', 'type', 'name'], 'string', 'max' => 255],
            [['course_id'], 'exist', 'skipOnError' => true, 'targetClass' => Course::className(), 'targetAttribute' => ['course_id' => 'id']],
            [['class_id'], 'exist', 'skipOnError' => true, 'targetClass' => CourseClasses::className(), 'targetAttribute' => ['class_id' => 'id']],
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
            'path' => Yii::t('backend', 'Path'),
            'base_url' => Yii::t('backend', 'Base Url'),
            'type' => Yii::t('backend', 'Type'),
            'size' => Yii::t('backend', 'Size'),
            'name' => Yii::t('backend', 'Name'),
            'created_at' => Yii::t('backend', 'Created At'),
            'created_by' => Yii::t('backend', 'Created By'),
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
     * @return \common\models\query\CourseAttachmentQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\CourseAttachmentQuery(get_called_class());
    }

}
