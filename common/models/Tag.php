<?php

namespace common\models;

use Yii;
use yii\behaviors\SluggableBehavior;

/**
 * This is the model class for table "{{%tags}}".
 *
 * @property int $id
 * @property string|null $title
 * @property string|null $slug
 *
 * @property TagCourse[] $tagCourses
 */
class Tag extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%tags}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'slug'], 'string', 'max' => 255],
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
            'slug' => Yii::t('backend', 'Slug'),
        ];
    }

    public function behaviors()
    {
        return [
            [
            'class' => SluggableBehavior::className(),
            'attribute' => 'title',
            // 'slugAttribute' => 'slug',
        ],
        ];
    }

    public function getCourses()
    {
        return $this->hasMany(Course::className(), ['id' => 'course_id'])
            ->viaTable(TagCourse::tableName(),['tag_id'=>'id']);
    }
}
