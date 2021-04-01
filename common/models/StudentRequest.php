<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%student_requests}}".
 *
 * @property int $id
 * @property int|null $course_id
 * @property string|null $firstname
 * @property string|null $lastname
 * @property string|null $email
 * @property string|null $sub_title
 * @property string|null $country
 * @property int|null $gender
 * @property string|null $phone_key
 * @property string|null $phone
 * @property int|null $status
 * @property int|null $is_parent
 * @property int|null $created_by
 *
 * @property RequestAttachment[] $requestAttachments
 */
class StudentRequest extends \yii\db\ActiveRecord
{

    const REQUEST_WAITING = 0;
    const REQUEST_ACCEPTED = 1;
    const REQUEST_REFUSED = 2;

    const NOT_PARENT = 0;
    const PARENT = 1;

    const GENDER_MALE = 1;
    const GENDER_FEMALE = 2;


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%student_requests}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['course_id', 'gender', 'status', 'is_parent', 'created_by'], 'integer'],
            [['gender'], 'in', 'range' => [self::GENDER_FEMALE, self::GENDER_MALE]],
            [['is_parent'], 'in', 'range' => [self::NOT_PARENT, self::PARENT]],
            [['firstname', 'lastname', 'email', 'sub_title', 'country'], 'string', 'max' => 255],
            [['phone','phone_key'], 'number'],
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
            'firstname' => Yii::t('backend', 'Firstname'),
            'lastname' => Yii::t('backend', 'Lastname'),
            'email' => Yii::t('backend', 'Email'),
            'sub_title' => Yii::t('backend', 'Sub Title'),
            'country' => Yii::t('backend', 'Country'),
            'gender' => Yii::t('backend', 'Gender'),
            'phone_key' => Yii::t('backend', 'Phone Key'),
            'phone' => Yii::t('backend', 'Phone'),
            'status' => Yii::t('backend', 'Status'),
            'is_parent' => Yii::t('backend', 'Is Parent'),
            'created_by' => Yii::t('backend', 'Created By'),
        ];
    }

    /**
     * Gets query for [[RequestAttachments]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRequestAttachments()
    {
        return $this->hasMany(RequestAttachment::className(), ['request_id' => 'id']);
    }
}
