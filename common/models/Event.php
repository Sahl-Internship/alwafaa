<?php

namespace common\models;

use trntv\filekit\behaviors\UploadBehavior;
use Yii;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "{{%event}}".
 *
 * @property int $id
 * @property string|null $title
 * @property int|null $course_id
 * @property int|null $date
 * @property int|null $day_id
 * @property int|null $from
 * @property int|null $to
 *
 * @property Course $course
 * @property EventAttachment[] $eventAttachments
 */
class Event extends \yii\db\ActiveRecord
{

    public $attachments;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%event}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['course_id', 'date', 'day_id', 'from', 'to'], 'integer'],
            [['title'], 'string', 'max' => 255],
            [['attachments'], 'safe'],
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
            'title' => Yii::t('backend', 'Title'),
            'course_id' => Yii::t('backend', 'Course ID'),
            'date' => Yii::t('backend', 'Date'),
            'day_id' => Yii::t('backend', 'Day ID'),
            'from' => Yii::t('backend', 'From'),
            'to' => Yii::t('backend', 'To'),
            'attachments' => Yii::t('backend', 'Attachment'),
        ];
    }

    public function behaviors()
    {
        return [
            [
                'class' => UploadBehavior::class,
                'attribute' => 'attachments',
                'multiple' => true,
                'uploadRelation' => 'eventAttachments',
                'pathAttribute' => 'path',
                'baseUrlAttribute' => 'base_url',
//                'orderAttribute' => 'order',
                'typeAttribute' => 'type',
                'sizeAttribute' => 'size',
                'nameAttribute' => 'name',
            ],
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
     * Gets query for [[EventAttachments]].
     *
     * @return \yii\db\ActiveQuery|\common\models\query\EventAttachmentQuery
     */
    public function getEventAttachments()
    {
        return $this->hasMany(EventAttachment::className(), ['event_id' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return \common\models\query\EventQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\EventQuery(get_called_class());
    }
}
