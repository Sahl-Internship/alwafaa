<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%chat}}`.
 */
class m210418_065225_create_chat_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%conversation}}', [
            'id' => $this->primaryKey(),
            'user1'=>$this->integer(),
            'user2'=>$this->integer(),
            'last_message'=>$this->string(),
        ]);

        $this->createTable('{{%chat}}', [
            'id' => $this->primaryKey(),
            'conversation_id'=>$this->integer(),
            'message'=>$this->string(),
            'sender'=>$this->integer(),
        ]);
        $this->addForeignKey(
            'fk_chat_conversation_id',
            '{{%chat}}',
            'conversation_id',
            '{{%conversation}}',
            'id',
            'CASCADE',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk_chat_conversation_id', '{{%chat}}');
        $this->dropTable('{{%chat}}');
        $this->dropTable('{{%conversation}}');
    }
}
