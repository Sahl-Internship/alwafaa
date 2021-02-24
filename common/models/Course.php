<?php

namespace common\models;

use trntv\filekit\behaviors\UploadBehavior;
use Yii;

/**
 * This is the model class for table "{{%course}}".
 *
 * @property int $id
 * @property integer $time
 * @property int|null $duration
 * @property string $title
 * @property string $description
 * @property int $section_id
 * @property int $teacher_id
 * @property string|null $zoom_link
 *
 * @property CourseAttachment[] $courseAttachments
 * @property CourseClasses[] $courseClasses
 * @property Section $section
 * @property User $teacher
 */
class Course extends \yii\db\ActiveRecord
{
    public $classes;

    public $attachments;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%course}}';
    }
    public function behaviors()
    {
        return [
            [
                'class' => UploadBehavior::class,
                'attribute' => 'attachments',
                'multiple' => true,
                'uploadRelation' => 'courseAttachments',
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
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['time', 'duration', 'section_id','title','description'], 'required'],
            [['duration', 'section_id', 'teacher_id'], 'integer'],
            [['title', 'description', 'zoom_link'], 'string', 'max' => 255],
            [['time'], 'filter', 'filter' => 'strtotime', 'skipOnEmpty' => true],
            [['section_id'], 'exist', 'skipOnError' => true, 'targetClass' => Section::className(), 'targetAttribute' => ['section_id' => 'id']],
            [['teacher_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['teacher_id' => 'id']],
            [['attachments', 'classes'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('backend', 'ID'),
            'time' => Yii::t('backend', 'Time'),
            'duration' => Yii::t('backend', 'Duration'),
            'title' => Yii::t('backend', 'Title'),
            'description' => Yii::t('backend', 'Description'),
            'section_id' => Yii::t('backend', 'Section'),
            'teacher_id' => Yii::t('backend', 'Teacher'),
            'zoom_link' => Yii::t('backend', 'Zoom Link'),
        ];
    }

    /**
     * Gets query for [[CourseAttachments]].
     *
     * @return \yii\db\ActiveQuery|\common\models\query\CourseAttachmentQuery
     */
    public function getCourseAttachments()
    {
        return $this->hasMany(CourseAttachment::className(), ['course_id' => 'id']);
    }

    /**
     * Gets query for [[CourseClasses]].
     *
     * @return \yii\db\ActiveQuery|\common\models\query\CourseClassesQuery
     */
    public function getCourseClasses()
    {
        return $this->hasMany(CourseClasses::className(), ['course_id' => 'id']);
    }

    /**
     * Gets query for [[Section]].
     *
     * @return \yii\db\ActiveQuery|\common\models\query\SectionQuery
     */
    public function getSection()
    {
        return $this->hasOne(Section::className(), ['id' => 'section_id']);
    }

    /**
     * Gets query for [[Teacher]].
     *
     * @return \yii\db\ActiveQuery|\common\models\query\UserQuery
     */
    public function getTeacher()
    {
        return $this->hasOne(User::className(), ['id' => 'teacher_id']);
    }

    /**
     * {@inheritdoc}
     * @return \common\models\query\CourseQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\CourseQuery(get_called_class());
    }


    public function addCourseClasses()
    {
        $this->refresh();
//        Yii::$app->commandBus->handle(new AddToTimelineCommand([
//            'category' => 'course',
//            'event' => 'new course',
//            'data' => [
//                'public_identity' => $this->getPublicIdentity(),
//                'user_id' => $this->getId(),
//                'created_at' => $this->created_at
//            ]
//        ]));
        $classes = new CourseClasses();
        $classes->locale = Yii::$app->language;
        $profile->load($profileData, '');
        $this->link('userProfile', $profile);
        $this->trigger(self::EVENT_AFTER_SIGNUP);
        // Default role


    }
}
