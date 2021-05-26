<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%section}}".
 *
 * @property int $id
 * @property string|null $title
 * @property string|null $description
 * @property int $manager_id
 * @property int|null $is_deleted
 */
class Section extends \yii\db\ActiveRecord
{

    const DELETED = 1;
    const NOT_DELETED = 0;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%section}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'description'], 'string', 'max' => 255],
            [['is_deleted'], 'in', 'range' => [self::DELETED,self::NOT_DELETED]],
            [['manager_id'],'exist','skipOnError'=>true,'targetClass'=>User::className(),'targetAttribute'=>['manager_id'=>'id']]
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => Yii::t('backend','Title'),
            'description' => Yii::t('backend','Description'),
            'manager_id' => Yii::t('backend','Manager'),
        ];
    }

    /**
     * {@inheritdoc}
     * @return \common\models\query\SectionQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\SectionQuery(get_called_class());
    }
}
