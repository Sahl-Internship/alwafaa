<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%countries}}".
 *
 * @property int $id
 * @property int $phone_code
 * @property string $country_code
 * @property string $country_name
 */
class Countries extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%countries}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['phone_code', 'country_code', 'country_name'], 'required'],
            [['phone_code'], 'integer'],
            [['country_code'], 'string', 'max' => 2],
            [['country_name'], 'string', 'max' => 80],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('backend', 'ID'),
            'phone_code' => Yii::t('backend', 'Phone Code'),
            'country_code' => Yii::t('backend', 'Country Code'),
            'country_name' => Yii::t('backend', 'Country Name'),
        ];
    }
}
