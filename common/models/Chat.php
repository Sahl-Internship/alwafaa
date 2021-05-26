<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%chat}}".
 *
 * @property int $id
 * @property int|null $conversation_id
 * @property string|null $message
 * @property int|null $sender
 *
 * @property Conversation $conversation
 */
class Chat extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%chat}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['conversation_id', 'sender'], 'integer'],
            [['message'], 'string', 'max' => 255],
            [['conversation_id'], 'exist', 'skipOnError' => true, 'targetClass' => Conversation::className(), 'targetAttribute' => ['conversation_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('backend', 'ID'),
            'conversation_id' => Yii::t('backend', 'Conversation ID'),
            'message' => Yii::t('backend', 'Message'),
            'sender' => Yii::t('backend', 'Sender'),
        ];
    }

    /**
     * Gets query for [[Conversation]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getConversation()
    {
        return $this->hasOne(Conversation::className(), ['id' => 'conversation_id']);
    }
}
