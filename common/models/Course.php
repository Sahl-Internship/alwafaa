<?php

namespace common\models;

use trntv\filekit\behaviors\UploadBehavior;
use Yii;
use yii\base\Exception;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "{{%course}}".
 *
 * @property int $id
 * @property string $title
 * @property string $sub_title
 * @property string $description
 * @property int $section_id
 * @property int $teacher_id
 * @property string|null $zoom_link
 * @property int $start_at
 * @property int $end_at
 * @property string $requirement
 * @property string $target_student
 * @property string $targeted_skills
 * @property string $image_path
 * @property string $image_base_url
 ** @property string $intro_path
 * @property string $intro_base_url
 * @property int $created_at
 * @property CourseAttachment[] $courseAttachments
 * @property CourseClasses[] $courseClasses
 * @property CourseReview[] $courseReview
 * @property Event[] $events
 * @property Section $section
 * @property User $teacher
 */
class Course extends \yii\db\ActiveRecord
{
    const STATUS_NOT_STARTED = 0;
    const STATUS_NOT_FINISHED = 1;
    const STATUS_FINISHED = 2;
    public $classes;
    public $events;
    public $attachments;
    public $review;
    public $intro_video;
    public $image;

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
            [
                'class' => UploadBehavior::class,
                'attribute' => 'image',
                'pathAttribute' => 'image_path',
                'baseUrlAttribute' => 'image_base_url',
            ],

            [
                'class' => UploadBehavior::class,
                'attribute' => 'intro_video',
                'pathAttribute' => 'intro_path',
                'baseUrlAttribute' => 'intro_base_url',
            ],
            [
                'class'=>TimestampBehavior::class,
                'updatedAtAttribute' => false
            ],

        ];
    }


    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['start_at', 'end_at', 'section_id', 'title','teacher_id'], 'required'],
            [['section_id', 'teacher_id'], 'integer'],
            [['title', 'sub_title', 'zoom_link'], 'string', 'max' => 255],
            [['description','requirement','target_student','targeted_skills'], 'string', 'max' => 5000],
            [['start_at','end_at'], 'filter', 'filter' => 'strtotime', 'skipOnEmpty' => true],
            [['section_id'], 'exist', 'skipOnError' => true, 'targetClass' => Section::className(), 'targetAttribute' => ['section_id' => 'id']],
            [['teacher_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['teacher_id' => 'id']],
            [['attachments', 'classes','intro_video','image'], 'safe'],
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
            'sub_title' => Yii::t('backend', 'Sub Title'),
            'description' => Yii::t('backend', 'Description'),
            'section_id' => Yii::t('backend', 'Section'),
            'teacher_id' => Yii::t('backend', 'Teacher'),
            'zoom_link' => Yii::t('backend', 'Zoom Link'),
            'start_at' => Yii::t('backend', 'Starts At'),
            'end_at' => Yii::t('backend', 'Ends In'),
            'requirement' => Yii::t('backend', 'Requirement'),
            'target_student' => Yii::t('backend', 'Target Student'),
            'targeted_skills' => Yii::t('backend', 'Targeted Skills'),
            'intro_video' => Yii::t('backend', 'Course Introduction'),
            'image' => Yii::t('backend', 'Course Image'),
        ];
    }

    /**
     * Gets query for [[CourseReview]].
     *
     * @return \yii\db\ActiveQuery|\common\models\CourseReview
     */
    public function getCourseReviews()
    {
        return $this->hasMany(CourseReview::className(), ['course_id' => 'id']);
    }

    /**
     * Gets query for [[CourseAttachment]].
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
     * Gets query for [[Events]].
     *
     * @return \yii\db\ActiveQuery|\common\models\query\EventQuery
     */
    public function getEvents()
    {
        return $this->hasMany(Event::className(), ['course_id' => 'id']);
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

//    public function afterFind() {
//        parent::afterFind ();
//        $this->time=Yii::$app->formatter->asDate($this->time);
//    }

    public function findOwnCourses()
    {
        return Course::find()->andWhere('teacher_id=:id',['id'=> Yii::$app->user->id]);
    }

    public function getPicture($default = null)
    {
        return $this->image_path
            ? Yii::getAlias($this->image_base_url . '/' . $this->image_path)
            : $default;
    }

    public function classSchedule($classesData)
    {
        foreach($classesData as $class){
            $courseClass = new CourseClasses();
            $courseClass->course_id = $this->id;
            $courseClass->day_id = $class['day_id'];
            $courseClass->from = $class['from'];
            $courseClass->to = $class['to'];
            $courseClass->save();
        }
    }

    public function setEvents($course_id)
    {
        $classes = Course::find()->getClasses($course_id);
        foreach ($classes as $class) {
            $event = new Event();
            $event->course_id = $this->id;
            $event->title = "class Time";
            $event->date = $class['date'];
            $event->day_id = $class['day_id'];
            $event->from = $class['from'];
            $event->to = $class['to'];
            $event->save();
        }
    }

    public function getAllDays()
    {
        $start_date = $this->start_at;
        $end_date = $this->end_at;
        while (date("Y-m-d", $start_date) != date("Y-m-d", $end_date)) {
            $day_index = date("w", $start_date);
            if ($day_index == 0 || $day_index == 6) {
                echo "test";
            }
            $now = strtotime(date("Y-m-d", $start_date) . "+1 day");
        }

    }
}
