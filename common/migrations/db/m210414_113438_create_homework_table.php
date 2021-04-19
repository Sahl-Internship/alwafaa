<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%homework}}`.
 */
class m210414_113438_create_homework_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {

        $this->createTable('{{%homework}}', [
            'id' => $this->primaryKey(),
            'event_id'=>$this->integer(),
            'path'=>$this->string(),
            'base_url'=>$this->string(),
            'type'=>$this->string(),
            'size'=>$this->integer(),
            'name'=>$this->string(),
            'created_at'=>$this->integer(),
            'updated_at'=>$this->integer(),
            'created_by'=>$this->integer(),
        ]);
        $this->addForeignKey(
            'fk_homework_event_id',
            '{{%homework}}',
            'event_id',
            '{{%event}}',
            'id',
            'cascade',
            'cascade'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk_homework_event_id', '{{%homework}}');
        $this->dropTable('{{%homework}}');
    }
}
