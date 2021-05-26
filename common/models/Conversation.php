<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%conversation}}".
 *
 * @property int $id
 * @property int|null $user1
 * @property int|null $user2
 * @property string|null $last_message
 *
 * @property Chat[] $chats
 */
class Conversation extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%conversation}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user1', 'user2'], 'integer'],
            [['last_message'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('backend', 'ID'),
            'user1' => Yii::t('backend', 'User1'),
            'user2' => Yii::t('backend', 'User2'),
            'last_message' => Yii::t('backend', 'Last Message'),
        ];
    }

    /**
     * Gets query for [[Chats]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getChats()
    {
        return $this->hasMany(Chat::className(), ['conversation_id' => 'id']);
    }

    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user2']);
    }
}
