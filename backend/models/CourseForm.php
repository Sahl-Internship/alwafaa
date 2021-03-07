<?php

namespace backend\models;

use common\models\Course;
use common\models\Section;
use common\models\User;
use Yii;
use yii\base\Exception;
use yii\base\Model;
use yii\helpers\ArrayHelper;

class CourseForm extends Model
{
    public $id;
    public $title;
    public $sub_title;
    public $description;
    public $section_id;
    public $teacher_id;
    public $zoom_link;
    public $start_at;
    public $end_at;
    public $requirement;
    public $target_student;
    public $targeted_skills;
    public $intro_base_url;
    public $intro_path;

// Course Scheduling
    public $course_id;
    public $day_id;
    public $from;
    public $to;

// Course Attachments
    public $class_id;
    public $path;
    public $base_url;
    public $type;
    public $size;
    public $name;
    public $created_at;
    public $created_by;

    private $model;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['start_at', 'end_at', 'section_id', 'title', 'description','teacher_id'], 'required'],
            [['section_id', 'teacher_id'], 'integer'],
            [['title', 'sub_title', 'zoom_link'], 'string', 'max' => 255],
            [['description','requirement','target_student','targeted_skills','intro_base_url','intro_path'], 'string', 'max' => 1024],
            [['start_at','end_at'], 'filter', 'filter' => 'strtotime', 'skipOnEmpty' => true],
            [['section_id'], 'exist', 'skipOnError' => true, 'targetClass' => Section::className(), 'targetAttribute' => ['section_id' => 'id']],
            [['teacher_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['teacher_id' => 'id']],
            [['attachments', 'classes'], 'safe'],

//            [['course_id', 'day_id'], 'required'],
            [['course_id', 'day_id'], 'integer'],
            [['from','to'], 'filter', 'filter' => 'strtotime', 'skipOnEmpty' => true],
            [['course_id'], 'exist', 'skipOnError' => true, 'targetClass' => Course::className(), 'targetAttribute' => ['course_id' => 'id']],

        ];
    }

    /**
     * @return Course
     */
    public function getModel()
    {
        if (!$this->model) {
            $this->model = new Course();
        }
        return $this->model;
    }

    /**
     * @param Course $model
     * @return mixed
     */
    public function setModel($model)
    {
        $this->id = $model->id;
        $this->title = $model->title;
        $this->sub_title = $model->sub_title;
        $this->description = $model->description;
        $this->section_id = $model->section_id;
        $this->teacher_id = $model->teacher_id;
        $this->zoom_link = $model->zoom_link;
        $this->start_at = $model->start_at;
        $this->end_at = $model->end_at;
        $this->requirement = $model->requirement;
        $this->target_student = $model->target_student;
        $this->targeted_skills = $model->targeted_skills;
        $this->intro_base_url = $model->intro_base_url;
        $this->intro_path = $model->intro_path;
        $this-> model= $model;

        return $this->model;
    }

    /**
     * Signs user up.
     * @return Course|null the saved model or null if saving fails
     * @throws Exception
     */
    public function save()
    {
        if ($this->validate()) {
            $model = $this->getModel();
            $isNewRecord = $model->getIsNewRecord();
            $model->title = $this->title;
            $model->sub_title = $this->sub_title;
            $model->description = $this->description;
            $model->section_id = $this->section_id;
            $model->teacher_id = $this->teacher_id;
            $model->zoom_link = $this->zoom_link;
            $model->start_at = $this->start_at;
            $model->end_at = $this->end_at;
            $model->requirement = $this->requirement;
            $model->target_student = $this->target_student;
            $model->targeted_skills = $this->targeted_skills;
            $model->intro_base_url = $this->intro_base_url;
            $model->intro_path = $this->intro_path;

            if (!$model->save()) {
                throw new Exception('Model not saved');
            }
            if ($isNewRecord) {
                $model->classSchedule();
            }
            return !$model->hasErrors();
        }
        return null;
    }
}
