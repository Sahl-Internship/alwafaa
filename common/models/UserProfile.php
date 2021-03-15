<?php

namespace common\models;

use kartik\widgets\DatePicker;
use trntv\filekit\behaviors\UploadBehavior;
use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "user_profile".
 *
 * @property integer $user_id
 * @property string $firstname
 * @property string $middlename
 * @property string $lastname
 * @property string $phone_key
 * @property string $phone
 * @property string $picture
 * @property string $avatar
 * @property string $avatar_path
 * @property string $avatar_base_url
 * @property integer $locale
 * @property integer $gender
 * @property string $country
 * @property string $city
 * @property integer $birthdate
 * @property string $bio
 * @property string $cover
 * @property string $cover_base_url
 * @property string $cover_path
 *
 * @property User $user
 */
class UserProfile extends ActiveRecord
{
    const GENDER_MALE = 1;
    const GENDER_FEMALE = 2;

    /**
     * @var
     */
    public $picture;
//    public $cover;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%user_profile}}';
    }

    /**
     * @return array
     */
    public function behaviors()
    {
        return [
//            'picture' => [
//                'class' => UploadBehavior::class,
//                'attribute' => 'picture',
//                'pathAttribute' => 'avatar_path',
//                'baseUrlAttribute' => 'avatar_base_url'
//            ],
//            'cover' => [
//                'class' => UploadBehavior::class,
//                'attribute' => 'cover',
//                'pathAttribute' => 'cover_path',
//                'baseUrlAttribute' => 'cover_base_url'
//            ]
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id'], 'required'],
            [['user_id', 'gender'], 'integer'],
            [['gender'], 'in', 'range' => [NULL, self::GENDER_FEMALE, self::GENDER_MALE]],
            [['firstname', 'middlename', 'lastname', 'avatar_path', 'avatar_base_url','cover_path', 'cover_base_url','country','city'], 'string', 'max' => 255],
            ['locale', 'default', 'value' => Yii::$app->language],
            ['locale', 'in', 'range' => array_keys(Yii::$app->params['availableLocales'])],
            [['picture','cover'], 'safe'],
            ['bio', 'safe'],
            [['phone','phone_key'], 'number'],
            ['birthdate', 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'user_id' => Yii::t('common', 'User ID'),
            'firstname' => Yii::t('common', 'Firstname'),
            'middlename' => Yii::t('common', 'Middlename'),
            'lastname' => Yii::t('common', 'Lastname'),
            'phone_key' => Yii::t('common', 'Phone Key'),
            'phone' => Yii::t('common', 'Phone'),
            'locale' => Yii::t('common', 'Locale'),
            'picture' => Yii::t('common', 'Picture'),
            'gender' => Yii::t('common', 'Gender'),
            'country' => Yii::t('common', 'Country'),
            'city' => Yii::t('common', 'City'),
            'birthdate' => Yii::t('common', 'Birth Date'),
            'bio' => Yii::t('common', 'Bio'),
            'cover' => Yii::t('common', 'Cover'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }

    /**
     * @return null|string
     */
    public function getFullName()
    {
        if ($this->firstname || $this->lastname) {
            return implode(' ', [$this->firstname, $this->lastname]);
        }
        return null;
    }

    /**
     * @param null $default
     * @return bool|null|string
     */
    public function getAvatar($default = null)
    {
        return $this->avatar_path
            ? Yii::getAlias($this->avatar_base_url . '/' . $this->avatar_path)
            : $default;
    }
    /**
     * @param null $default
     * @return bool|null|string
     */
    public function getCover($default = null)
    {
        return $this->cover_path
            ? Yii::getAlias($this->cover_base_url . '/' . $this->cover_path)
            : $default;
    }
}
