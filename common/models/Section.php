<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%section}}".
 *
 * @property int $id
 * @property string|null $title
 * @property string|null $description
 */
class Section extends \yii\db\ActiveRecord
{
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
