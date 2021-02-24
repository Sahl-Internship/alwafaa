<?php


namespace backend\models;


use common\models\Course;
use common\models\Section;
use common\models\User;
use yii\base\Model;

class CourseForm extends Model
{
    public $title ;
    public $description ;
    public $section_id ;
    public $teacher_id ;
    public $zoom_link ;
    public $time ;
    public $duration ;
    public $class_title ;
    public $class_time ;
    public $class_duration ;
    public $attachments ;

    private $model;
    public function rules()
    {
        return [
            [['time', 'duration', 'section_id','title','description','class_title','class_time','class_duration','attachments'], 'required'],
            [['duration', 'section_id', 'teacher_id'], 'integer'],
            [['title', 'description', 'zoom_link','class_title'], 'string', 'max' => 255],
            [['time','class_time'], 'filter', 'filter' => 'strtotime', 'skipOnEmpty' => true],
            [['attachments'], 'safe'],
        ];
    }


    public function addCourse()
    {
        if ($this->validate()) {
            $course = new Course();
            $course->title = $this->title;
            $course->description = $this->description;
            $course->section_id = $this->section_id;
            $course->teacher_id = $this->teacher_id;
            $course->zoom_link = $this->zoom_link;
            $course->time = $this->time;
            $course->duration = $this->duration;

            $course->addCourseClasses();

            return $course;
        }

        return null;
    }


}